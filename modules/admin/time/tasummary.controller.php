<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/time/tasummary.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "tasummary.tpl.php"
,"add" => "tasummary_form.tpl.php"
,"edit" => "tasummary_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Time' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','TA Summary');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/time";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsTASummary = new clsTASummary($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['TA Summary'] = 'time.php?statpos=tasummary';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTASummary->doValidateData($_POST)){
				$objClsTASummary->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTASummary->Data);
//				printa($objClsTASummary->Data);
			}else {
				$objClsTASummary->doPopulateData($_POST);
				$objClsTASummary->doSaveAdd();
				header("Location: time.php?statpos=tasummary");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['TA Summary'] = 'time.php?statpos=tasummary';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTASummary->doValidateData($_POST)){
				$objClsTASummary->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTASummary->Data);
//				printa($objClsTASummary->Data);
			}else {
				$objClsTASummary->doPopulateData($_POST);
				$objClsTASummary->doSaveEdit();
				header("Location: time.php?statpos=tasummary");
				exit;
			}
		}else{
			$oData = $objClsTASummary->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsTASummary->doDelete($_GET['delete']);
		header("Location: time.php?statpos=tasummary");
		exit;		
		break;

	default:
		$arrbreadCrumbs['TA Summary'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsTASummary->getTableList());
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