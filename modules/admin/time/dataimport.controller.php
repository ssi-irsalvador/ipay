<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/time/dataimport.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "dataimport.tpl.php"
,"add" => "dataimport_form.tpl.php"
,"edit" => "dataimport_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Data Import');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/time";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsDataImport = new clsDataImport($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Data Import'] = 'time.php?statpos=dataimport';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsDataImport->doValidateData($_POST)){
				$objClsDataImport->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDataImport->Data);
//				printa($objClsDataImport->Data);
			}else {
				$objClsDataImport->doPopulateData($_POST);
				$objClsDataImport->doSaveAdd();
				header("Location: time.php?statpos=dataimport");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Data Import'] = 'time.php?statpos=dataimport';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsDataImport->doValidateData($_POST)){
				$objClsDataImport->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDataImport->Data);
//				printa($objClsDataImport->Data);
			}else {
				$objClsDataImport->doPopulateData($_POST);
				$objClsDataImport->doSaveEdit();
				header("Location: time.php?statpos=dataimport");
				exit;
			}
		}else{
			$oData = $objClsDataImport->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsDataImport->doDelete($_GET['delete']);
		header("Location: time.php?statpos=dataimport");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Data Import'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsDataImport->getTableList());
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