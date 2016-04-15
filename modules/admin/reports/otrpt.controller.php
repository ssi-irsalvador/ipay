<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/otrpt.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_register.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_summary.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "otrpt.tpl.php"
,"add" => "otrpt_form.tpl.php"
,"edit" => "otrpt_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
 'Reports'=>''
,'Analysis Tools' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['report'])?"report":$cmapKey;
$cmapKey = isset($_GET['rpt_excel'])?"rpt_excel":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','OT Report');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsOTRpt = new clsOTRpt($dbconn);
$objClsPayrollRegister = new clsPayrollRegister($dbconn);
$objClsPayrollSummary = new clsPayrollSummary($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

$centerPanelBlock->assign("emptype",$emptype);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('locinfo',$objClsSSS->dbfetchLocationDetails());
$centerPanelBlock->assign("empstat",$objClsEMP_MasterFile->empstat());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['OT Report'] = 'reports.php?statpos=otrpt';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsOTRpt->doValidateData($_POST)){
				$objClsOTRpt->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsOTRpt->Data);
//				printa($objClsOTRpt->Data);
			}else {
				$objClsOTRpt->doPopulateData($_POST);
				$objClsOTRpt->doSaveAdd();
				header("Location: reports.php?statpos=otrpt");
				exit;
			}
		}
		break;

	case 'edit':
		/**$arrbreadCrumbs['OT Report'] = 'reports.php?statpos=otrpt';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			if($_POST['format'] == 'excel'){
            	header("Location: reports.php?statpos=otrpt&rpt_excel&edit=".$_GET['edit']."&payperiod_id=".$_GET['payperiod_id']."&type=".$_POST['emp_type']."&cc=".$_POST['costcenter']."&bank=".$_POST['bank']."&acc_no=".$_POST['acct_no']."&sbydpart=".$_POST['isdpart']."&nodays=".$_POST['nodays']."&rpt_type=".$_POST['rpt_type']);
            	exit;
			}else{
				header("Location: reports.php?statpos=otrpt&report&edit=".$_GET['edit']."&payperiod_id=".$_GET['payperiod_id']."&type=".$_POST['emp_type']."&cc=".$_POST['costcenter']."&bank=".$_POST['bank']."&acc_no=".$_POST['acct_no']."&sbydpart=".$_POST['isdpart']."&nodays=".$_POST['nodays']."&rpt_type=".$_POST['rpt_type']);
            	exit;
			}
		}else{
			$oData = $objClsPayrollSummary->dbFetch($_GET['payperiod_id']);//Get Payperiod List
			$centerPanelBlock->assign("oData",$oData);
            $dept = $objClsPayrollRegister->dbFetchHeadDepartment();//Get Department list
			$centerPanelBlock->assign("dept",$dept);
		}**/
		$objClsOTRpt->generateXLSOTRecordReport($_GET);
		break;
	
	case 'report': 
		//PDF REPORT
        $mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register';
		$arrbreadCrumbs['Report'] = "";
		
		$objClsPayrollRegister->generatePDFPayrollRegisterReport($_GET);
		break;

	case 'rpt_excel': 
		//EXCEL REPORT
        $mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register';
		$arrbreadCrumbs['Report'] = "";
		
        $objClsOTRpt->generateXLSOTRecordReport($_GET);
        //$objClsPayrollRegister->generateExcelPayrollRegisterReport($_GET);
        break;	
		
	case "delete":
		$objClsOTRpt->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=otrpt");
		exit;		
		break;

	default:
		$arrbreadCrumbs['OT Report'] = "";
		$centerPanelBlock->assign('payperiod',$objClsPayrollSummary->getPayperiod());
		$centerPanelBlock->assign('tblDataList',$objClsOTRpt->getTableList());
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