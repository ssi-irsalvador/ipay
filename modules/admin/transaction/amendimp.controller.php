<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/amendimp.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "amendimp.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
,'Payroll Import' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Import Amendments');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsImportAmendments = new clsImportAmendments($dbconn);

switch ($cmapKey) {
	default:
		$arrbreadCrumbs['Import Amendments'] = "";
		$centerPanelBlock->assign("payperiod",$objClsImportAmendments->getPayperiod(" WHERE pp_stat_id=1 "));
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
//			printa($postData);
			if (!$objClsImportAmendments->doValidateData($postData)) {
				$centerPanelBlock->assign("oData",$postData);
			} else { // do save
				$uptahead_id_=$objClsImportAmendments->doSaveImportAmendments($postData);
				header("Location: transaction.php?statpos=amendimp");
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