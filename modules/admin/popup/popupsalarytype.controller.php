<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/salaryclass.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popupsalarytype.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Company' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Company');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsSalaryClass = new clsSalaryClass($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Company'] = 'popup.php?statpos=popupcomp';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsSalaryClass->doValidateData($_POST)){
				$objClsSalaryClass->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSalaryClass->Data);
//				printa($objClsSalaryClass->Data);
			}else {
				$objClsSalaryClass->doPopulateData($_POST);
				$objClsSalaryClass->doSaveAdd();
				header("Location: popup.php?statpos=popupcomp");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Company'] = 'popup.php?statpos=popupcomp';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsSalaryClass->doValidateData($_POST)){
				$objClsSalaryClass->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSalaryClass->Data);
//				printa($objClsSalaryClass->Data);
			}else {
				$objClsSalaryClass->doPopulateData($_POST);
				$objClsSalaryClass->doSaveEdit();
				header("Location: popup.php?statpos=popupcomp");
				exit;
			}
		}else{
			$oData = $objClsSalaryClass->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsSalaryClass->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupcomp");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Company'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsSalaryClass->getTableList());
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