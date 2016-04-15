<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/popup/popup_loanpaymenthistory.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popuploanpaymenthistory.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Employee Type' => ''
);

$cmapKey = isset($_GET['edit'])?"exportexcel":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','PopupType');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objclsPopup_LoanPaymentHistory = new clsPopup_LoanPaymentHistory($dbconn);
$objClsSSS = new clsSSS($dbconn);

switch ($cmapKey) {
	case "exportexcel":
		$objclsPopup_LoanPaymentHistory->generateXLSLoanDetailsReport($_GET);
		break;
	case "delete":
		$objclsPopup_LoanPaymentHistory->doDelete($_GET['delete'],$_GET['loan_id']);
		header("Location: popup.php?statpos=popuploanpaymenthistory&emp_id=".$_GET['emp_id']."&loan_id=".$_GET['loan_id']."&loantype_id=".$_GET['type']);
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupType'] = "popup.php?statpos=popuploanpaymenthistory";
		$centerPanelBlock->assign('tblDataList',$objclsPopup_LoanPaymentHistory->getPopup_loanpaymenthistory());
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