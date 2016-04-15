<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/export.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "export.tpl.php"
,"add" => "export_form.tpl.php"
,"edit" => "export_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Export Report');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsExport = new clsExport($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Export Report'] = 'reports.php?statpos=export';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsExport->doValidateData($_POST)){
				$objClsExport->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsExport->Data);
//				printa($objClsExport->Data);
			}else {
				$objClsExport->doPopulateData($_POST);
				$objClsExport->doSaveAdd();
				header("Location: reports.php?statpos=export");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Export Report'] = 'reports.php?statpos=export';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsExport->doValidateData($_POST)){
				$objClsExport->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsExport->Data);
//				printa($objClsExport->Data);
			}else {
				$objClsExport->doPopulateData($_POST);
				$objClsExport->doSaveEdit();
				header("Location: reports.php?statpos=export");
				exit;
			}
		}else{
			$oData = $objClsExport->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsExport->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=export");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Export Report'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsExport->getTableList());
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