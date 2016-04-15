<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/ottable.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "ottable.tpl.php"
,"add" => "ottable.tpl.php"
,"edit" => "ottable.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Master Data' => '',
'OT Manage' => ''
);

$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = $_POST?"add":$cmapKey;
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_POST['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['deletetr'])?"deletetr":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'OT Table');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMnge_OT = new clsMnge_OT($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['OT Table'] = 'setup.php?statpos=ottable';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsMnge_OT->doValidateData($_POST)) {
				$objClsMnge_OT->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_OT->Data);
//				printa($objClsRegion->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_OT->getTableList());
			} else {
				$objClsMnge_OT->doPopulateData($_POST);
				$objClsMnge_OT->doSaveAdd();
				header("Location: setup.php?statpos=ottable&ot_id=".mysql_insert_id());
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['OT Table'] = 'setup.php?statpos=ottable';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_OT->doValidateData($_POST)){
				$objClsMnge_OT->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_OT->Data);
//				printa($objClsRegion->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_OT->getTableList());
			} else {
				$objClsMnge_OT->doPopulateData($_POST);
				$objClsMnge_OT->doSaveEdit();
				header("Location: setup.php?statpos=ottable&ot_id=".$_POST['ot_id']."&edit=".$_POST['ot_id']);
				exit;
			}
		} else {
			$oData = $objClsMnge_OT->dbFetch($_GET['ot_id']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_OT->getTableList());
			$centerPanelBlock->assign('otname',$objClsMnge_OT->ot_tbls());
		}
		break;
	case "delete":
		$objClsMnge_OT->doDelete($_GET['ot_id']);
		header("Location: setup.php?statpos=ottable");
		exit;		
		break;
	case "deletetr":
		$objClsMnge_OT->doDelete($_GET['deletetr'],$_GET['deleteotr']);
		header("Location: setup.php?statpos=ottable&ot_id=".$_GET['deletetr']."&edit=".$_GET['deletetr']);
		exit;		
		break;
	default:
		$arrbreadCrumbs['OT Table'] = "";
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsMnge_OT->getTableList());
		$centerPanelBlock->assign('otname',$objClsMnge_OT->ot_tbls());
		break;
}
if(isset($_SESSION['eMsg'])){
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}
/*-!-!-!-!-!-!-!-!-*/
$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>