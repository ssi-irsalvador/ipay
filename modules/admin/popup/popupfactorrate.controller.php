<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/factor_rate.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popupfactorrate.tpl.php"
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
$mainBlock->assign('PageTitle','Popup Factor Rate');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsFactor_Rate = new clsFactor_Rate($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Factor Rate'] = 'popup.php?statpos=popupfactorrate';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsFactor_Rate->doValidateData($_POST)){
				$objClsFactor_Rate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFactor_Rate->Data);
//				printa($objClsFactor_Rate->Data);
			}else {
				$objClsFactor_Rate->doPopulateData($_POST);
				$objClsFactor_Rate->doSaveAdd();
				header("Location: popup.php?statpos=popupfactorrate");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Factor Rate'] = 'popup.php?statpos=popupfactorrate';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsFactor_Rate->doValidateData($_POST)){
				$objClsFactor_Rate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFactor_Rate->Data);
//				printa($objClsFactor_Rate->Data);
			}else {
				$objClsFactor_Rate->doPopulateData($_POST);
				$objClsFactor_Rate->doSaveEdit();
				header("Location: popup.php?statpos=popupfactorrate");
				exit;
			}
		}else{
			$oData = $objClsFactor_Rate->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsFactor_Rate->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupfactorrate");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Factor Rate'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsFactor_Rate->getTableList());
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