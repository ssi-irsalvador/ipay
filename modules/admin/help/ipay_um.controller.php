<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/help/ipay_um.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "ipay_um.tpl.php"
,"add" => "ipay_um_form.tpl.php"
,"edit" => "ipay_um_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','iPAY User Manual');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/help";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsIPay_UM = new clsIPay_UM($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['iPAY User Manual'] = 'help.php?statpos=ipay_um';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsIPay_UM->doValidateData($_POST)){
				$objClsIPay_UM->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsIPay_UM->Data);
//				printa($objClsIPay_UM->Data);
			}else {
				$objClsIPay_UM->doPopulateData($_POST);
				$objClsIPay_UM->doSaveAdd();
				header("Location: help.php?statpos=ipay_um");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['iPAY User Manual'] = 'help.php?statpos=ipay_um';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsIPay_UM->doValidateData($_POST)){
				$objClsIPay_UM->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsIPay_UM->Data);
//				printa($objClsIPay_UM->Data);
			}else {
				$objClsIPay_UM->doPopulateData($_POST);
				$objClsIPay_UM->doSaveEdit();
				header("Location: help.php?statpos=ipay_um");
				exit;
			}
		}else{
			$oData = $objClsIPay_UM->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsIPay_UM->doDelete($_GET['delete']);
		header("Location: help.php?statpos=ipay_um");
		exit;		
		break;

	default:
		$arrbreadCrumbs['iPAY User Manual'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsIPay_UM->getTableList());
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