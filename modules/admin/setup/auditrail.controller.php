<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/auditrail.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "auditrail.tpl.php"
,"add" => "auditrail_form.tpl.php"
,"edit" => "auditrail_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Audit Trail');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsAudiTrail = new clsAudiTrail($dbconn);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Audit Trail'] = 'setup.php?statpos=auditrail';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsAudiTrail->doValidateData($_POST)){
				$objClsAudiTrail->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsAudiTrail->Data);
//				printa($objClsAudiTrail->Data);
			}else {
				$objClsAudiTrail->doPopulateData($_POST);
				$objClsAudiTrail->doSaveAdd();
				header("Location: setup.php?statpos=auditrail");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Audit Trail'] = 'setup.php?statpos=auditrail';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsAudiTrail->doValidateData($_POST)){
				$objClsAudiTrail->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsAudiTrail->Data);
//				printa($objClsAudiTrail->Data);
			}else {
				$objClsAudiTrail->doPopulateData($_POST);
				$objClsAudiTrail->doSaveEdit();
				header("Location: setup.php?statpos=auditrail");
				exit;
			}
		}else{
			$oData = $objClsAudiTrail->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsAudiTrail->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=auditrail");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Audit Trail'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsAudiTrail->getTableList());
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