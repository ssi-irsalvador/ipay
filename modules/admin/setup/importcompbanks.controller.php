<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/importcompbanks.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "importcompbanks.tpl.php"
,"add" => "importcompbanks_form.tpl.php"
,"edit" => "importcompbanks_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Manage Import' => ''
,'Import Libraries' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Import Company Banks');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsImportCompBanks = new clsImportCompBanks($dbconn);

switch ($cmapKey) {
	default:
		$arrbreadCrumbs['Import Company Banks'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
			if(!$objClsImportCompBanks->doValidateData($postData)){
				$centerPanelBlock->assign("oData",$postData);
			}else { // do save
				$uptahead_id_=$objClsImportCompBanks->doSaveImportCompBanks($postData);
				header("Location: setup.php?statpos=importcomp");
				exit;
			}
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