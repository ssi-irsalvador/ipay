<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/bckup_dbase.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "bckup_dbase.tpl.php"
,"add" => "bckup_dbase_form.tpl.php"
,"edit" => "bckup_dbase_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Database' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Backup Database');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsBckup_Dbase = new clsBckup_Dbase($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Backup Database'] = 'setup.php?statpos=bckup_dbase';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsBckup_Dbase->doValidateData($_POST)){
				$objClsBckup_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBckup_Dbase->Data);
//				printa($objClsBckup_Dbase->Data);
			}else {
				$objClsBckup_Dbase->doPopulateData($_POST);
				$objClsBckup_Dbase->doSaveAdd();
				header("Location: setup.php?statpos=bckup_dbase");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Backup Database'] = 'setup.php?statpos=bckup_dbase';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsBckup_Dbase->doValidateData($_POST)){
				$objClsBckup_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBckup_Dbase->Data);
//				printa($objClsBckup_Dbase->Data);
			}else {
				$objClsBckup_Dbase->doPopulateData($_POST);
				$objClsBckup_Dbase->doSaveEdit();
				header("Location: setup.php?statpos=bckup_dbase");
				exit;
			}
		}else{
			$oData = $objClsBckup_Dbase->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsBckup_Dbase->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=bckup_dbase");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Backup Database'] = "";
		if (count($_POST)>0) {
			if(!$objClsBckup_Dbase->doValidateData($_POST)){
				break;
			} else {
				$objClsBckup_Dbase->backUpDbase($_POST);
			}
		} else {
			break;
		}
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