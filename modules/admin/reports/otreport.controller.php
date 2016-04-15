<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/otreport.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/otrate.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "otreport.tpl.php"
,"add" => "otreport_form.tpl.php"
,"edit" => "otreport_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
 'Reports'=>''
,'Analysis Tools' => ''
);

$cmapKey = isset($_GET['exportOT'])?"exportOT":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','OT Rate List');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsOTReport = new clsOTReport($dbconn);
$objClsMnge_OTR = new clsMnge_OTR($dbconn);

switch ($cmapKey) {
	case 'exportOT':
		$arrbreadCrumbs['OT Report'] = "reports.php?statpos=otrpt";
		$arrbreadCrumbs['OT Rate List'] = 'reports.php?statpos=otreport';
		$arrbreadCrumbs['Edit'] = "";
		if($_GET['exportOT'] == "" || $_GET['exportOT'] == 'pdf'){
			$output = $objClsOTReport->getPDFResultMCRF($oData, $_GET);
			Misc::FileDownloadHeader("201 Master List ".date('Y-m-d').".pdf", "application/pdf", strlen($output));
		}else{
			$objClsOTReport->generateXLSOTListReport($_GET);
		}
		break;
	default:
		$arrbreadCrumbs['OT Report'] = "reports.php?statpos=otrpt";
		$arrbreadCrumbs['OT Rate List'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_OTR->getTableList());
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