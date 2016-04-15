<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/country.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupcountry.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Employee Type' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','PopupCountry');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsCountry = new clsCountry ($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PopupCountry'] = 'popup.php?statpos=popupcountry';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsCountry->doValidateData($_POST)){
				$objClsCountry->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCountry->Data);
//				printa($objClsCountry->Data);
			} else {
				$objClsCountry->doPopulateData($_POST);
				$objClsCountry->doSaveAdd();
				header("Location: popup.php?statpos=popupcountry");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['PopupCountry'] = 'popup.php?statpos=popupcountry';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsCountry->doValidateData($_POST)){
				$objClsCountry->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCountry->Data);
//				printa($objClsCountry->Data);
			} else {
				$objClsCountry->doPopulateData($_POST);
				$objClsCountry->doSaveEdit();
				header("Location: popup.php?statpos=popupcountry");
				exit;
			}
		}else{
			$oData = $objClsCountry->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsCountry->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupcountry");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupCountry'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsCountry->getTableList($_GET['p_id_']));
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