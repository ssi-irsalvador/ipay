<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_register.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_summary.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/custom_paydetails.class.php');

Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=0;
$cmap = array(
"default" => "payroll_register.tpl.php"
,"add" => "payroll_register_form.tpl.php"
,"edit" => "payroll_register_form.tpl.php"
,"report" => "payroll_register_form_report.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports'=>'',
'Analysis Tools' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['report'])?"report":$cmapKey;
$cmapKey = isset($_GET['rpt_excel'])?"rpt_excel":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Payroll Register');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
//$objClsTimekeeping = new clsTimekeeping($dbconn);
$objClsPayrollRegister = new clsPayrollRegister($dbconn);
$objClsPayrollSummary = new clsPayrollSummary($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign("emptype",$emptype);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('locinfo',$objClsSSS->dbfetchLocationDetails());
$centerPanelBlock->assign("empstat",$objClsEMP_MasterFile->empstat());
$centerPanelBlock->assign("haveLoc",$objClsPayrollRegister->getDept());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPayrollRegister->doValidateData($_POST)){
				$objClsPayrollRegister->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayrollRegister->Data);
//				printa($objClsPayrollRegister->Data);
			}else {
				$objClsPayrollRegister->doPopulateData($_POST);
				$objClsPayrollRegister->doSaveAdd();
				header("Location: reports.php?statpos=payroll_register");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register&pps_id='.$_GET['edit'];
		$arrbreadCrumbs['View'] = "";
		if (count($_POST)>0) {
			if($_POST['format'] == 'excel'){
            	header("Location: reports.php?statpos=payroll_register&rpt_excel&edit=".$_GET['edit']."&payperiod_id=".$_GET['payperiod_id']."&type=".$_POST['emp_type']."&cc=".$_POST['costcenter']."&bank=".$_POST['bank']."&acc_no=".$_POST['acct_no']."&sbydpart=".$_POST['isdpart']."&nodays=".$_POST['nodays']."&leaves=".$_POST['leaves']."&tnt=".$_POST['tnt']."&bonuspay=".$_POST['bonuspay']."&category=".$_POST['category']."&earnings=".$_POST['earnings']."&deductions=".$_POST['deductions']."&eer_share=".$_POST['eer_share']."&branchinfo_id=".$_POST['branchinfo_id']."&comp=".$_POST['comp_id']);
            	exit;
			}else{
				header("Location: reports.php?statpos=payroll_register&report&edit=".$_GET['edit']."&payperiod_id=".$_GET['payperiod_id']."&type=".$_POST['emp_type']."&cc=".$_POST['costcenter']."&bank=".$_POST['bank']."&acc_no=".$_POST['acct_no']."&sbydpart=".$_POST['isdpart']."&nodays=".$_POST['nodays']."&leaves=".$_POST['leaves']."&tnt=".$_POST['tnt']."&bonuspay=".$_POST['bonuspay']."&category=".$_POST['category']."&earnings=".$_POST['earnings']."&deductions=".$_POST['deductions']."&eer_share=".$_POST['eer_share']."&branchinfo_id=".$_POST['branchinfo_id']."&comp=".$_POST['comp_id']);
            	exit;
			}
		}else{
			$oData = $objClsPayrollSummary->dbFetch($_GET['payperiod_id']);//Get Payperiod List
			$centerPanelBlock->assign("oData",$oData);
            $dept = $objClsPayrollRegister->dbFetchHeadDepartment();//Get Department list
            $centerPanelBlock->assign("category",$category);
            $centerPanelBlock->assign("earnings",$earnings_sub);
            $centerPanelBlock->assign("deductions",$deduction_sub);
			$centerPanelBlock->assign("dept",$dept);
		}
		break;
	case 'report':
        $mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register';
		$arrbreadCrumbs['Report'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPayrollRegister->doValidateData($_POST)){
				$objClsPayrollRegister->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayrollRegister->Data);
//				printa($objClsPayrollRegister->Data);
			}else {
				$objClsPayrollRegister->doPopulateData($_POST);
				$objClsPayrollRegister->doSaveEdit();
				header("Location: reports.php?statpos=payroll_register");
				exit;
			}
		}else{
		/* $oData = $objClsPayrollRegister->genReport($_GET);
			$centerPanelBlock->assign("oData",$oData);
//            printa($oData);
//            $payperiodstatus = $objClsTimekeeping->getPayperiodDetails($_GET['payperiod_id'],null,null);
//            $centerPanelBlock->assign("payperiodstatus",$payperiodstatus);
            $branch_details = $objClsSSS->dbfetchCompDetails(1);
            $centerPanelBlock->assign("branch_details",$branch_details);
            $empdept_type = $objClsPayrollRegister->dbFetch($_GET['type']);
			$centerPanelBlock->assign("empdept_type",$empdept_type);
//          $objClsPayrollRegister->generateXLSPayrollRegisterReport($_GET);*/
			$objClsPayrollRegister->generatePDFPayrollRegisterReport($_GET);
		}
		break;
	case 'rpt_excel':
        $mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['Payroll Register'] = 'reports.php?statpos=payroll_register';
		$arrbreadCrumbs['Report'] = "";
        //$objClsPayrollRegister->generateXLSPayrollRegisterReport($_GET);//OLD
       	(($_GET['rprt_tpye']=='custom') ? $objClsPayrollRegister->generateCustomReport($_GET) : $objClsPayrollRegister->generateExcelPayrollRegisterReport($_GET)); 
        break;
	case "delete":
		$objClsPayrollRegister->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=payroll_register");
		exit;		
		break;
	default:
		$arrbreadCrumbs['Payroll Register'] = "";
        $centerPanelBlock->assign('payperiod',$objClsPayrollSummary->getPayperiod());
		$centerPanelBlock->assign('tblDataList',$objClsPayrollRegister->getTableList());
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