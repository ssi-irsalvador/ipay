<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/dload_dbase.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "dload_dbase.tpl.php"
,"add" => "dload_dbase_form.tpl.php"
,"edit" => "dload_dbase_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Database' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Download File');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsDload_Dbase = new clsDload_Dbase($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Download File'] = 'setup.php?statpos=dload_dbase';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsDload_Dbase->doValidateData($_POST)){
				$objClsDload_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDload_Dbase->Data);
//				printa($objClsDload_Dbase->Data);
			}else {
				$objClsDload_Dbase->doPopulateData($_POST);
				$objClsDload_Dbase->doSaveAdd();
				header("Location: setup.php?statpos=dload_dbase");
				exit;
			}
		}
		break;

	case 'edit':
	/*	$arrbreadCrumbs['Download File'] = 'setup.php?statpos=dload_dbase';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsDload_Dbase->doValidateData($_POST)){
				$objClsDload_Dbase->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDload_Dbase->Data);
//				printa($objClsDload_Dbase->Data);
			}else {
				$objClsDload_Dbase->doPopulateData($_POST);
				$objClsDload_Dbase->doSaveEdit();
				header("Location: setup.php?statpos=dload_dbase");
				exit;
			}
		}else{
			$oData = $objClsDload_Dbase->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;*/
		$objClsDload_Dbase->downloadFile($_GET['file']);
		break;
		
	case "delete":
		$objClsDload_Dbase->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=dload_dbase");
		exit;		
		break;		
		
	default:
		$arrbreadCrumbs['Download File'] = "";
		$file = '*.sql';
		$listing = $objClsDload_Dbase->listdir_by_date(SYSCONFIG_DBBACKUP_PATH.$file);
		if(count($listing) > 0){
		$arr = array_reverse($listing);
		}
		$centerPanelBlock->assign('listFile',$arr);
		//$centerPanelBlock->assign('tblDataList',$objClsDload_Dbase->getTableList());
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