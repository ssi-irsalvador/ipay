<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/imbenduc.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');
require_once(SYSCONFIG_CLASS_PATH."util/PHPExcel.php");
require_once(SYSCONFIG_CLASS_PATH."util/PHPExcel/IOFactory.php");
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "imbenduc.tpl.php"
,"add" => "imbenduc_form.tpl.php"
,"edit" => "imbenduc_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Manage Import' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['download'])?"download":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Import Benefits & Deduction');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsImBenDuc = new clsImBenDuc($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);
$type = array('Fixed Amount','Free Amount');
switch ($cmapKey) {
	case "download":
		$objClsImBenDuc->doDownloadTemplate($objClsEMP_MasterFile->payelement(),$type);
		break;
	default:
		$arrbreadCrumbs['Import Benefits and Deduction'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
//			printa($postData);
			if (!$objClsImBenDuc->doValidateData($postData)) {
				$centerPanelBlock->assign("oData",$postData);
			} else { // do save
				$uptahead_id_=$objClsImBenDuc->doSaveImportBenefitsAndDeduction($postData);
				header("Location: setup.php?statpos=imbenduc");
				exit;
			}
		}
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

/*-!-!-!-!-!-!-!-!-*/

$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();


?>