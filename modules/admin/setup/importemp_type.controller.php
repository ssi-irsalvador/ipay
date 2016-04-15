<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/importemp_type.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "importemp_type.tpl.php"
,"add" => "importemp_type_form.tpl.php"
,"edit" => "importemp_type_form.tpl.php"
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
$mainBlock->assign('PageTitle','Import Employee Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsImportEmp_Type = new clsImportEmp_Type($dbconn);

switch ($cmapKey) {
	default:
		$arrbreadCrumbs['Import Employee Type'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
			if(!$objClsImportEmp_Type->doValidateData($postData)){
				$centerPanelBlock->assign("oData",$postData);
			}else { // do save
				$uptahead_id_=$objClsImportEmp_Type->doSaveImportType($postData);
				header("Location: setup.php?statpos=importemp_type");
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