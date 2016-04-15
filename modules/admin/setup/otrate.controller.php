<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/otrate.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "otrate.tpl.php"
,"add" => "otrate.tpl.php"
,"edit" => "otrate.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Master Data' => '',
'OT Manage' => ''
);


$cmapKey = (isset($_POST['Submit']))?"add":"default";
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'OT Rate');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_OTR = new clsMnge_OTR($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['OT Rate'] = 'setup.php?statpos=otrate';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsMnge_OTR->doValidateData($_POST)) {
				$objClsMnge_OTR->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_OTR->Data);
//				printa($objClsRegion->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_OTR->getTableList());
			} else {
				$objClsMnge_OTR->doPopulateData($_POST);
				$objClsMnge_OTR->doSaveAdd();
				header("Location: setup.php?statpos=otrate");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['OT Rate'] = 'setup.php?statpos=otrate';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_OTR->doValidateData($_POST)){
				$objClsMnge_OTR->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_OTR->Data);
//				printa($objClsRegion->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_OTR->getTableList());
			} else {
				$objClsMnge_OTR->doPopulateData($_POST);
				$objClsMnge_OTR->doSaveEdit($_POST['otr_id']);
				header("Location: setup.php?statpos=otrate");
				exit;
			}
		} else {
			$oData = $objClsMnge_OTR->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_OTR->getTableList());
		}
		break;
		
	case "delete":
		$objClsMnge_OTR->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=otrate");
		exit;		
		break;

	default:
		$arrbreadCrumbs['OT Rate'] = "";
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsMnge_OTR->getTableList());
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