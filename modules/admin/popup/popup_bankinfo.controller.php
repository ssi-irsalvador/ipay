<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/popup/popup_bankinfo.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popup_bankinfo.tpl.php"
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
$mainBlock->assign('PageTitle','Popup Bank Info');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsPopup_BankInfo = new clsPopup_BankInfo($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Bank Info'] = 'popup.php?statpos=popup_bankinfo';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPopup_BankInfo->doValidateData($_POST)){
				$objClsPopup_BankInfo->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPopup_BankInfo->Data);
//				printa($objClsPopup_BankInfo->Data);
			}else {
				$objClsPopup_BankInfo->doPopulateData($_POST);
				$objClsPopup_BankInfo->doSaveAdd();
				header("Location: popup.php?statpos=popup_bankinfo");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Bank Info'] = 'popup.php?statpos=popup_bankinfo';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPopup_BankInfo->doValidateData($_POST)){
				$objClsPopup_BankInfo->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPopup_BankInfo->Data);
//				printa($objClsPopup_BankInfo->Data);
			}else {
				$objClsPopup_BankInfo->doPopulateData($_POST);
				$objClsPopup_BankInfo->doSaveEdit();
				header("Location: popup.php?statpos=popup_bankinfo");
				exit;
			}
		}else{
			$oData = $objClsPopup_BankInfo->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsPopup_BankInfo->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popup_bankinfo");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Bank Info'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsPopup_BankInfo->getTableList());
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