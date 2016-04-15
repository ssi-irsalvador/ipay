<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/monthly_collection.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "monthly_collection.tpl.php"
,"add" => "monthly_collection_form.tpl.php"
,"edit" => "monthly_collection_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Monthly Collection');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMonthlyCollection = new clsMonthlyCollection($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Monthly Collection'] = 'reports.php?statpos=monthly_collection';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMonthlyCollection->doValidateData($_POST)){
				$objClsMonthlyCollection->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMonthlyCollection->Data);
//				printa($objClsMonthlyCollection->Data);
			}else {
				$objClsMonthlyCollection->doPopulateData($_POST);
				$objClsMonthlyCollection->doSaveAdd();
				header("Location: reports.php?statpos=monthly_collection");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Monthly Collection'] = 'reports.php?statpos=monthly_collection';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMonthlyCollection->doValidateData($_POST)){
				$objClsMonthlyCollection->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMonthlyCollection->Data);
//				printa($objClsMonthlyCollection->Data);
			}else {
				$objClsMonthlyCollection->doPopulateData($_POST);
				$objClsMonthlyCollection->doSaveEdit();
				header("Location: reports.php?statpos=monthly_collection");
				exit;
			}
		}else{
			$oData = $objClsMonthlyCollection->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsMonthlyCollection->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=monthly_collection");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Monthly Collection'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMonthlyCollection->getTableList());
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