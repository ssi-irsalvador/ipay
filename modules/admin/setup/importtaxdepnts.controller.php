<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/importtaxdepnts.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "importtaxdepnts.tpl.php"
,"add" => "importtaxdepnts_form.tpl.php"
,"edit" => "importtaxdepnts_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Manage Import' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Import Tax Dependents');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsImportTaxDepnts = new clsImportTaxDepnts($dbconn);

switch ($cmapKey) {
	default:
		$arrbreadCrumbs['Import Tax Dependents'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
//			printa($postData);
			if(!$objClsImportTaxDepnts->doValidateData($postData)){
				$centerPanelBlock->assign("oData",$postData);
			}else { // do save
				$uptahead_id_=$objClsImportTaxDepnts->doSaveImportTaxDepents($postData);
				header("Location: setup.php?statpos=importtaxdepnts");
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