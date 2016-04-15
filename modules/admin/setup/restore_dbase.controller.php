<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/restore_dbase.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "restore_dbase.tpl.php"
,"add" => "restore_dbase_form.tpl.php"
,"edit" => "restore_dbase_form.tpl.php"
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
$mainBlock->assign('PageTitle','Restore Database');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsRestore_Dbase = new clsRestore_Dbase($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Restore Database'] = 'setup.php?statpos=restore_dbase';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsRestore_Dbase->doValidateData($_POST)){
				$objClsRestore_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRestore_Dbase->Data);
//				printa($objClsRestore_Dbase->Data);
			}else {
				$objClsRestore_Dbase->doPopulateData($_POST);
				$objClsRestore_Dbase->doSaveAdd();
				header("Location: setup.php?statpos=restore_dbase");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Restore Database'] = 'setup.php?statpos=restore_dbase';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsRestore_Dbase->doValidateData($_POST)){
				$objClsRestore_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRestore_Dbase->Data);
//				printa($objClsRestore_Dbase->Data);
			}else {
				$objClsRestore_Dbase->doPopulateData($_POST);
				$objClsRestore_Dbase->doSaveEdit();
				header("Location: setup.php?statpos=restore_dbase");
				exit;
			}
		}else{
			$oData = $objClsRestore_Dbase->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsRestore_Dbase->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=restore_dbase");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Restore Database'] = "";
		unset($_SESSION['fileList']);
		$_SESSION['fileList'] = $objClsRestore_Dbase->orderByDateCreated(SYSCONFIG_DBBACKUP_PATH."*");
		if(count($_SESSION['fileList']) > 0){
			$_SESSION['fileList'] = array_reverse($_SESSION['fileList']);
		}
		if ($_POST['filename'] != "") {
			if(!$objClsRestore_Dbase->doValidateData($_POST)){
				break;
			} else {
				$objClsRestore_Dbase->restoreDbase($_POST);
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