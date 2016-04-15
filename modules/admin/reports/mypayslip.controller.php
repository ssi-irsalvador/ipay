<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/mypayslip.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array("default" => "mypayslip.tpl.php");

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['pdfrep'])?"pdfrep":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','My Payslip');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMyPayslip = new clsMyPayslip($dbconn);
$objClsPayroll_Details = new clsPayroll_Details($dbconn);

switch ($cmapKey) {
	case 'pdfrep':
		$arrbreadCrumbs['My Payslip'] = 'reports.php?statpos=mypayslip';
		$arrbreadCrumbs['Edit'] = "";
		$mainBlock->templateFile = 'index_blank.tpl.php';
		//Process PDF Payslip
		$payslip_list = $objClsMyPayslip->checkPayslips($_SESSION['admin_session_obj']['user_data']['emp_id']);
		IF(in_array($_GET['pdfrep'],$payslip_list)){
			$oData_ = $objClsPayroll_Details->dbFetch_Payslip($_GET['pdfrep']);
			$GenData = $objClsPayroll_Details->getGeneralSetup('Location as Company');
			$payslipFORMAT = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
			IF($payslipFORMAT['set_stat_type']=='2'){
				//PAYSLIP FORMAT2(FEAP PAYSLIP Format)
				$output = $objClsPayslip_Form2->getPayslip_Form2_PDF($oData_);
			}elseif($payslipFORMAT['set_stat_type']=='3'){
				$output = $objClsPayroll_Details->getPDFResult_Format3($oData_,$GenData['set_stat_type']);
			}ELSE{
				//PAYSLIP FORMAT1(Original Payslip Format)
				$output = $objClsPayroll_Details->getPDFResult($oData_,$GenData['set_stat_type']);
			}
			Misc::FileDownloadHeader("payslip.pdf", "application/pdf", strlen($output));
			
		} else {
			$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
			$host     = $_SERVER['HTTP_HOST'];
			$script   = $_SERVER['SCRIPT_NAME'];
			$params   = $_SERVER['QUERY_STRING'];
			$currentUrl = $protocol . '://' . $host . $script . '?' . $params;
			$fullname = $_SESSION['admin_session_obj']['user_data']['user_fullname'];
			$sql = "INSERT INTO audit_access SET fullname=?, track_module=?";
			$dbconn->Execute($sql,array($fullname,$currentUrl));
			header("Location: reports.php?statpos=mypayslip");
		}
		break;
	default:
		$arrbreadCrumbs['My Payslip'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMyPayslip->getTableList());
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