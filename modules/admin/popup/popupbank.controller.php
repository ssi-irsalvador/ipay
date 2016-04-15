<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manage_bank.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupbank.tpl.php"
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
$mainBlock->assign('PageTitle','Popup Bank');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsManage_Bank = new clsManage_Bank($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Bank'] = 'popup.php?statpos=popupbank';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsManage_Bank->doValidateData($_POST)){
				$objClsManage_Bank->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Bank->Data);
//				printa($objClsManage_Bank->Data);
			}else {
				$objClsManage_Bank->doPopulateData($_POST);
				$objClsManage_Bank->doSaveAdd();
				header("Location: popup.php?statpos=popupbank");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Bank'] = 'popup.php?statpos=popupbank';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsManage_Bank->doValidateData($_POST)){
				$objClsManage_Bank->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Bank->Data);
//				printa($objClsManage_Bank->Data);
			} else {
				$objClsManage_Bank->doPopulateData($_POST);
				$objClsManage_Bank->doSaveEdit();
				header("Location: popup.php?statpos=popupbank");
				exit;
			}
		}else{
			$oData = $objClsManage_Bank->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsManage_Bank->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupbank");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Bank'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManage_Bank->getTableList());
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