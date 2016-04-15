<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payslip_form2.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=0;

$cmap = array(
"default" => "payroll_details.tpl.php"
,"add" => "payroll_details_form.tpl.php"
,"edit" => "payroll_details_form.tpl.php"
,"psdetails" => "paystub_details.tpl.php"
,"pdfrep" => "paystub_details.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'Payroll' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['psdetails'])?"psdetails":$cmapKey;
$cmapKey = isset($_GET['pdfrep'])?"pdfrep":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Payroll Details');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsPayroll_Details = new clsPayroll_Details($dbconn);
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsMnge_PG = new clsMnge_PG($dbconn);
$objClsPayslip_Form2 = new clsPayslip_Form2($dbconn);
$objClsMngeDecimal = new Application();

/*-!-!-!-!-!-!-!-!-*/
/* Initial Declaration */
$centerPanelBlock->assign('get_totalEmp',$objClsMnge_PG->get_totalEmp($_GET['edit'],$_GET['ppsched_view'],true));
switch ($cmapKey) {
	case 'add':
		$arrbreadCrumbs['Payroll Details'] = 'transaction.php?statpos=payroll_details';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPayroll_Details->doValidateData($_POST)){
				$objClsPayroll_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Details->Data);
			} else {
				$objClsPayroll_Details->doPopulateData($_POST);
				$objClsPayroll_Details->doSaveAdd();
				header("Location: transaction.php?statpos=payroll_details");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Payroll Details'] = 'transaction.php?statpos=payroll_details';
		$arrbreadCrumbs['Employee List'] = '';
		if (count($_POST) > 0) {
			// Delete
			if (isset($_POST['btn_remove'])) {
				if (!$objClsPayroll_Details->doValidate($_POST, $kind_of_validation = 'Remove')) {
					header("Location: transaction.php?statpos=payroll_details&edit={$_GET['edit']}&ppsched_view={$_GET['ppsched_view']}&ppstat_id={$_GET['ppstat_id']}");
				} else {
					$objClsPayroll_Details->remove($_POST);
					header("Location: transaction.php?statpos=payroll_details&edit={$_GET['edit']}&ppsched_view={$_GET['ppsched_view']}&ppstat_id={$_GET['ppstat_id']}");
					exit;
				}
			}
			// Update
			if (!$objClsPayroll_Details->doValidateData($_POST)) {
				$objClsPayroll_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Details->Data);
			} else {
				$objClsPayroll_Details->doPopulateData($_POST);
				$objClsPayroll_Details->doReProcessPayroll($_GET['psdetails'],$_GET['emp']);
				header("Location: transaction.php?statpos=payroll_details");
				exit;
			}
		} else {
			$oData = $objClsProcess_Payroll->dbFetch($_GET['ppsched_view'],$_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsPayroll_Details->getTableList_Emppaystub());
			$_SESSION['ppsched_view'] = $_GET['ppsched_view'];
			$_SESSION['ppsched_edit'] = $_GET['edit'];
			$_SESSION['ppstat_id'] = $_GET['ppstat_id'];
		}
		break;
	case 'psdetails':
		$arrbreadCrumbs['Payroll Details'] = 'transaction.php?statpos=payroll_details';
		$arrbreadCrumbs['Employee List'] = 'transaction.php?statpos=payroll_details&edit='.$_SESSION['ppsched_edit'].'&ppsched_view='.$_SESSION['ppsched_view'].'&ppstat_id='.$_SESSION['ppstat_id'];
		$arrbreadCrumbs['Payslip Details'] = "";
		if (count($_POST) > 0) {
			// update
			$objClsPayroll_Details->doPopulateData($_POST);
			$objClsPayroll_Details->doReProcessPayroll($_GET['psdetails'],$_GET['emp']);
//			header("Location: transaction.php?statpos=payroll_details&edit=".$_SESSION['ppsched_edit']."&ppsched_view=".$_SESSION['ppsched_view']);
			header("Location: transaction.php?statpos=payroll_details&psdetails=".$_GET['psdetails']."&emp=".$_GET['emp']);
			exit;
		} else {
			$oData = $objClsPayroll_Details->dbFetch_Payslip($_GET['psdetails'],$_GET['emp']);
			//printa($oData);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign("objClsMngeDecimal",$objClsMngeDecimal);
		}
		break;
	case 'pdfrep':
		$arrbreadCrumbs['Payroll Details'] = 'transaction.php?statpos=payroll_details';
		$arrbreadCrumbs['Employee List'] = 'transaction.php?statpos=payroll_details&edit='.$_SESSION['ppsched_edit'].'&ppsched_view='.$_SESSION['ppsched_view'].'&ppstat_id='.$_SESSION['ppstat_id'];
		$arrbreadCrumbs['Payslip Details'] = "";
		$mainBlock->templateFile = 'index_blank.tpl.php';
		if (count($_POST) > 0) {
			// update
			if (!$objClsPayroll_Details->doValidateData($_POST)) {
				$objClsPayroll_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Details->Data);
			} else {
				$objClsPayroll_Details->doPopulateData($_POST);
				$objClsPayroll_Details->doReProcessPayroll();
				header("Location: transaction.php?statpos=payroll_details");
				exit;
			}
		} else {
			$oData_ = $objClsPayroll_Details->dbFetch_Payslip($_GET['pdfrep']);
			$GenData = $objClsPayroll_Details->getGeneralSetup('Location as Company');
			$payslipFORMAT = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
			IF($payslipFORMAT['set_stat_type']=='2'){
				//PAYSLIP FORMAT2(FEAP PAYSLIP Format)
				$output = $objClsPayslip_Form2->getPayslip_Form2_PDF($oData_);
			}elseif($payslipFORMAT['set_stat_type']=='3'){
				$output = $objClsPayroll_Details->getPDFResult_Format3($oData_,1);
			}ELSE{
				//PAYSLIP FORMAT1(Original PAYSLIP Format)
				$output = $objClsPayroll_Details->getPDFResult($oData_,$GenData['set_stat_type']);
			}
			Misc::FileDownloadHeader("payslip.pdf", "application/pdf", strlen($output));
		}
		break;
	default:
		$arrbreadCrumbs['Payroll Details'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsPayroll_Details->getTableList());
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