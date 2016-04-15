<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mng_cf.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mng_cf.tpl.php"
,"add" => "mng_cf_form.tpl.php"
,"edit" => "mng_cf_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
 'Admin' => ''
,'Libraries' => ''
,'Manage Pay Element' => 'setup.php?statpos=mnge_pe'
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Custom Fields');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMng_CF = new clsMng_CF($dbconn);

/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign("cusnum",$cusnum);
$centerPanelBlock->assign("cfStat",$cfStat);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Custom Fields'] = 'setup.php?statpos=mng_cf';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMng_CF->doValidateData($_POST)){
				$objClsMng_CF->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_CF->Data);
//				printa($objClsMng_CF->Data);
			}else {
				$objClsMng_CF->doPopulateData($_POST);
				$objClsMng_CF->doSaveAdd();
				header("Location: setup.php?statpos=mng_cf");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Custom Fields'] = 'setup.php?statpos=mng_cf';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMng_CF->doValidateData($_POST)){
				$objClsMng_CF->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_CF->Data);
//				printa($objClsMng_CF->Data);
			}else {
				$objClsMng_CF->doPopulateData($_POST);
				$objClsMng_CF->doSaveEdit();
				header("Location: setup.php?statpos=mng_cf");
				exit;
			}
		}else{
			$oData = $objClsMng_CF->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsMng_CF->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mng_cf");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Custom Fields'] = "";
		IF (count($_POST)>0) {
			// save add new
			IF(!$objClsMng_CF->doValidateData($_POST)){
				$objClsMng_CF->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_CF->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMng_CF->getTableList());
//				printa($objClsMng_CF->Data);
			}ELSE {
				$objClsMng_CF->doPopulateData($_POST);
				$objClsMng_CF->doSaveAdd();
				header("Location: setup.php?statpos=mng_cf");
				exit;
			}
		}ELSE{
			$centerPanelBlock->assign('tblDataList',$objClsMng_CF->getTableList());
		}
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