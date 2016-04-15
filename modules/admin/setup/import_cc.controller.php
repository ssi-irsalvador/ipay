<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/import_cc.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "import_cc.tpl.php"
,"add" => "import_cc_form.tpl.php"
,"edit" => "import_cc_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Import Cost Center' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Cost Center Accounts');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsImportCC = new clsImportCC($dbconn);
switch ($cmapKey) {
	default:
		$arrbreadCrumbs['Cost Center Accounts'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
//			printa($postData);
			
			if (!$objClsImportCC->doValidateData($postData)) {
				$centerPanelBlock->assign("oData",$postData);
			} else { // do save
				$uptahead_id_=$objClsImportCC->doSaveImportPayElement($postData);
				header("Location: setup.php?statpos=import_pe");
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