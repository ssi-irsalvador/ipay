<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/state_province.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupcity.tpl.php"
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
$mainBlock->assign('PageTitle','PopupType');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsState_province = new clsState_province ($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsState_province->doValidateData($_POST)){
				$objClsState_province->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsState_province->Data);
//				printa($objClsState_province->Data);
			} else {
				$objClsState_province->doPopulateData($_POST);
				$objClsState_province->doSaveAdd();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsState_province->doValidateData($_POST)){
				$objClsState_province->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsState_province->Data);
//				printa($objClsState_province->Data);
			} else {
				$objClsState_province->doPopulateData($_POST);
				$objClsState_province->doSaveEdit();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}else{
			$oData = $objClsState_province->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsState_province->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupType'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsState_province->getPopup_zipcode($_GET['p_id_']));
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