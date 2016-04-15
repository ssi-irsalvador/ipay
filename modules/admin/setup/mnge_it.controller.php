<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_it.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_it.tpl.php"
,"add" => "mnge_it_form.tpl.php"
,"edit" => "mnge_it_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Income Tax');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_IT = new clsMnge_IT($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Income Tax'] = 'setup.php?statpos=mnge_it';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_IT->doValidateData($_POST)){
				$objClsMnge_IT->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_IT->Data);
//				printa($objClsMnge_IT->Data);
			}else {
				$objClsMnge_IT->doPopulateData($_POST);
				$objClsMnge_IT->doSaveAdd();
				header("Location: setup.php?statpos=mnge_it");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Income Tax'] = 'setup.php?statpos=mnge_it';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_IT->doValidateData($_POST)){
				$objClsMnge_IT->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_IT->Data);
//				printa($objClsMnge_IT->Data);
			}else {
				$objClsMnge_IT->doPopulateData($_POST);
				$objClsMnge_IT->doSaveEdit();
				header("Location: setup.php?statpos=mnge_it");
				exit;
			}
		}else{
			$oData = $objClsMnge_IT->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsMnge_IT->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_it");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Income Tax'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_IT->getTableList());
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