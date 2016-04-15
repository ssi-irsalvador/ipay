<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bir_alphalist.class.php');

Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=0;

$cmap = array(
"default" => "process_payroll.tpl.php"
,"add" => "process_payroll_form.tpl.php"
,"edit" => "process_payroll_ot_form.tpl.php"
,"ppsched_view" => "process_payroll_form.tpl.php"
,"payslipstatus" => "endpayperiod_form_report.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'Payroll' => ''
);

$cmapKey = isset($_GET['otcomp'])?"otcomp":$cmapKey;
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['ppsched_view'])?"ppsched_view":$cmapKey;
$cmapKey = isset($_GET['payslipstatus'])?"payslipstatus":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Process Payroll');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsPayroll_Details = new clsPayroll_Details($dbconn);
$objClsMnge_PG = new clsMnge_PG($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign('finalDecimal',$objClsMngeDecimal->getFinalDecimalSettings());
/*-!-!-!-!-!-!-!-!-*/
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Process Payroll'] = 'transaction.php?statpos=process_payroll';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			} else {
				$objClsProcess_Payroll->doPopulateData($_POST);
				$objClsProcess_Payroll->doSaveAdd();
				header("Location: transaction.php?statpos=process_payroll");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Process Payroll'] = 'transaction.php?statpos=process_payroll';
		$arrbreadCrumbs['View'] = "transaction.php?statpos=process_payroll&ppsched=".$_GET['otcomp']."&ppsched_view=".$_GET['edit'];
		$arrbreadCrumbs['TA'] = "";
		if (count($_POST)>0){
			// update
			if(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			}else{
				$objClsProcess_Payroll->doPopulateData($_POST);
				$objClsProcess_Payroll->doSaveOT($_GET['emp'],$_GET['edit'],$_POST);
				$objClsProcess_Payroll->doSaveTA($_GET['emp'],$_GET['edit'],$_POST);
				$objClsProcess_Payroll->doSaveLeave($_GET['emp'],$_GET['edit'],$_POST);
				$objClsProcess_Payroll->doSaveCF($_GET['emp'],$_GET['edit'],$_POST);
				header("Location: transaction.php?statpos=process_payroll&ppsched=".$_GET['otcomp']."&ppsched_view=".$_GET['edit']);
				exit;
			}
		}else{
			$oData = $objClsProcess_Payroll->dbFetch_OT($_GET['edit'],$_GET['otcomp'],$_GET['emp']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsProcess_Payroll->getpopup_OTrate($_GET['emp'],$_GET['edit']));
			$centerPanelBlock->assign('tblDataListLeave',$objClsProcess_Payroll->Leaverate($_GET['emp']));
			$centerPanelBlock->assign('tblDataListTA',$objClsProcess_Payroll->TArate($_GET['emp'],$_GET['edit']));
			$centerPanelBlock->assign('tblDataListCF',$objClsProcess_Payroll->getCustomFields($_GET['emp'],$_GET['edit']));
		}
		break;
	case 'otcomp':
		$arrbreadCrumbs['Process Payroll'] = 'transaction.php?statpos=process_payroll';
		$arrbreadCrumbs['View'] = "transaction.php?statpos=process_payroll&ppsched=".$_GET['otcomp']."&ppsched_view=".$_GET['edit'];
		$arrbreadCrumbs['TA'] = "";
		if (count($_POST)>0){
			// update
			if(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			}else{
				$objClsProcess_Payroll->doPopulateData($_POST);
				$objClsProcess_Payroll->doSaveEdit();
				header("Location: transaction.php?statpos=process_payroll");
				exit;
			}
		}else{
			$oData = $objClsProcess_Payroll->dbFetch();
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case 'ppsched_view':
		unset($_SESSION['payslip']);
		$arrbreadCrumbs['Process Payroll'] = 'transaction.php?statpos=process_payroll';
		$arrbreadCrumbs['View'] = "";
		IF (count($_POST['chkAttend']) > 0) {
			// update
			IF(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			} ELSE {
					IF($_POST['payperiod_type']=='Bonus'){
						IF($_POST['wbonus']){
							$objClsProcess_Payroll->doGenerateBonus($_GET['ppsched_view'],$_POST);
						} ELSE {
							IF($_POST['psaid'] > 0 AND $_POST['bonus_id'] > 0){
								$objClsProcess_Payroll->doGenerateBonus($_GET['ppsched_view'],$_POST);
							}ELSE{
								$Total_emp = $objClsMnge_PG->get_totalEmp($_GET['ppsched'],$_GET['ppsched_view']);
								$centerPanelBlock->assign('get_totalEmp',$Total_emp);//get total employee
								$oData = $objClsProcess_Payroll->dbFetch($_GET['ppsched_view'],$_GET['ppsched']);
								$centerPanelBlock->assign("oData",$oData);
								$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_Emp());
								$centerPanelBlock->assign("getALLBonusPEAccnt",$objClsProcess_Payroll->getALLBonusPEAccnt());
								$centerPanelBlock->assign("getALLBonusFormula",$objClsProcess_Payroll->formula);
							}
						}
					}ELSEIF($_POST['payperiod_type']=='Others'){
						$objClsMnge_PG->doSaveGeneReportOtherPay($_GET['ppsched_view'],$_POST);
						$Total_emp = $objClsMnge_PG->get_totalEmpOther($_GET['ppsched'],$_GET['ppsched_view']);
					}ELSE{
						$objClsMnge_PG->doSaveGeneReport($_GET['ppsched_view'],$_POST);
						$Total_emp = $objClsMnge_PG->get_totalEmp($_GET['ppsched'],$_GET['ppsched_view']);
					}
					IF($Total_emp['totalemp'] > 0){//to check if not 0 employee that need to process.
						header("Location: transaction.php?statpos=process_payroll&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
					}ELSE{
						header("Location: transaction.php?statpos=payroll_details&edit=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
					}
					exit;
			}
		}ELSE{
			$oData = $objClsProcess_Payroll->dbFetch($_GET['ppsched_view'],$_GET['ppsched']);
			$centerPanelBlock->assign("oData",$oData); //printa($oData); exit;
			if($oData['payperiod_type']==4){
				$Total_emp = $objClsMnge_PG->get_totalEmpOther($_GET['ppsched'],$_GET['ppsched_view']);
				$centerPanelBlock->assign('get_totalEmp',$Total_emp);//get total employee.
				$centerPanelBlock->assign('tblDataList',$objClsProcess_Payroll->getTableList_Emp_OtherPay());
			} else {
				$Total_emp = $objClsMnge_PG->get_totalEmp($_GET['ppsched'],$_GET['ppsched_view']);
				$centerPanelBlock->assign('get_totalEmp',$Total_emp);//get total employee.
				$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_Emp());
			}
			$centerPanelBlock->assign("getALLBonusPEAccnt",$objClsProcess_Payroll->getALLBonusPEAccnt());
			$centerPanelBlock->assign("getALLBonusFormula",$objClsProcess_Payroll->formula);
		}
		break;
	case "delete":
		$objClsProcess_Payroll->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=process_payroll");
		exit;
		break;
	default:
		$arrbreadCrumbs['Process Payroll'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsProcess_Payroll->getTableList());
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