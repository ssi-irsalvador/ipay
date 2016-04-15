<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/deductype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupdectype.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Deduction Type');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsDeducType = new clsDeducType($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Deduction Type'] = 'popup.php?statpos=popupdectype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsDeducType->doValidateData($_POST)){
				$objClsDeducType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDeducType->Data);
//				printa($objClsDeducType->Data);
			}else {
				$objClsDeducType->doPopulateData($_POST);
				$objClsDeducType->doSaveAdd();
				header("Location: popup.php?statpos=popupdectype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Deduction Type'] = 'popup.php?statpos=popupdectype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsDeducType->doValidateData($_POST)){
				$objClsDeducType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDeducType->Data);
//				printa($objClsDeducType->Data);
			}else {
				$objClsDeducType->doPopulateData($_POST);
				$objClsDeducType->doSaveEdit();
				header("Location: popup.php?statpos=popupdectype");
				exit;
			}
		}else{
			$oData = $objClsDeducType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsDeducType->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupdectype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Deduction Type'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsDeducType->getTableList());
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