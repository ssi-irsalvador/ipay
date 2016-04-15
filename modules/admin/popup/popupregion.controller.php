<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/region.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupregion.tpl.php"
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
$mainBlock->assign('PageTitle','PopupRegion');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsRegion = new clsRegion ($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PopupRegion'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsRegion->doValidateData($_POST)){
				$objClsRegion->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRegion->Data);
//				printa($objClsRegion->Data);
			} else {
				$objClsRegion->doPopulateData($_POST);
				$objClsRegion->doSaveAdd();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['PopupRegion'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsRegion->doValidateData($_POST)){
				$objClsRegion->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRegion->Data);
//				printa($objClsRegion->Data);
			} else {
				$objClsRegion->doPopulateData($_POST);
				$objClsRegion->doSaveEdit();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}else{
			$oData = $objClsRegion->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsRegion->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupRegion'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsRegion->getTableList($_GET['p_id_']));
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