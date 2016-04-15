<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/pslipr.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');
require_once(SYSCONFIG_ROOT_PATH.'helpers/encryption.helper.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "pslipr.tpl.php"
,"add" => "pslipr_form.tpl.php"
,"edit" => "pslipr_form.tpl.php"
,"email" => "pslipr_email.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['email'])?"email":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Payslip Report');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsPslipR = new clsPslipR($dbconn);
$objClsPayroll_Details = new clsPayroll_Details($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsMnge = new clsMnge_PG($dbconn);

$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Payslip Report'] = 'reports.php?statpos=pslipr';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0){
			// save add new
			if(!$objClsPslipR->doValidateData($_POST)){
				$objClsPslipR->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPslipR->Data);
//				printa($objClsPslipR->Data);
			}else {
				$objClsPslipR->doPopulateData($_POST);
				$objClsPslipR->doSaveAdd();
				header("Location: reports.php?statpos=pslipr");
				exit;
			}
		}
		break;
	case 'email':
		$arrbreadCrumbs['Payslip Report'] = 'reports.php?statpos=pslipr';
		$arrbreadCrumbs['Email'] = "";
		$payslipFORMAT_ = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
		if (count($_POST)>0){
			if(!$objClsPslipR->doValidateData($_POST)){
				$centerPanelBlock->assign('tblDataList',$objClsPslipR->getTableList_Emp());
			} else {
				if(isset($_POST['SendEmail'])){
					$oData_ = $objClsPslipR->dbFetch_Payslip($_GET['email']);
					$_SESSION['pData'] = $_POST;
					header("Location: index.php?statpos=send&send=".$_GET['email']);
					//$objClsPslipR->sendEmail($_POST,$oData_,$aData_,$payslipFORMAT_);
				} else {
					$GenData = $objClsPayroll_Details->getGeneralSetup('Location as Company');
					$payslipFORMAT = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
					$oData_ = $objClsPslipR->dbFetch_Payslip($_GET['email'],$_POST['chkAttend']);
					$_SESSION['pData'] = $_POST;
					IF($payslipFORMAT['set_stat_type']=='2'){
						//PAYSLIP FORMAT2(FEAP PAYSLIP Format)
						$output = $objClsPslipR->getFEAPPayslipPDF($oData_);
					}elseif($payslipFORMAT['set_stat_type']=='3'){
						$output = $objClsPslipR->getPDFResult_Format3($oData_);
					}ELSE{
						//PAYSLIP FORMAT1(Original PAYSLIP Format)
						$output = $objClsPslipR->getPDFResult($oData_,$GenData['set_stat_type']);
					}
					Misc::FileDownloadHeader("payslip.pdf", "application/pdf", strlen($output));
				}
			}
		}
		$oData = $objClsPslipR->dbFetch($_GET['email']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsPslipR->getTableList_Emp());
		break;
	case 'edit':
		$arrbreadCrumbs['Payslip Report'] = 'reports.php?statpos=pslipr';
		$arrbreadCrumbs['Edit'] = "";
		//Process PDF Payslip 
		$oData_ = $objClsPslipR->dbFetch_Payslip($_GET['edit']);
		$GenData = $objClsPayroll_Details->getGeneralSetup('Location as Company');
		$payslipFORMAT = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
		IF($payslipFORMAT['set_stat_type']=='2'){
			//PAYSLIP FORMAT2(FEAP PAYSLIP Format)
			$output = $objClsPslipR->getFEAPPayslipPDF($oData_);
		}elseif($payslipFORMAT['set_stat_type']=='3'){
			$output = $objClsPslipR->getPDFResult_Format3($oData_);
		}ELSE{
			//PAYSLIP FORMAT1(Original PAYSLIP Format)
			$output = $objClsPslipR->getPDFResult($oData_,$GenData['set_stat_type']);
		}
		Misc::FileDownloadHeader("payslip.pdf", "application/pdf", strlen($output));
		break;
	case "delete":
		$objClsPslipR->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=pslipr");
		exit;		
		break;
	
//	case 'send':
//		$sendData = $_SESSION['pData'];
//		$oData = $objClsPslipR->dbFetch($_GET['send']);
//		$payslipFORMAT_ = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
//		$centerPanelBlock->assign("oData",$oData);
//		$centerPanelBlock->assign("empList",$objClsPslipR->get_StatusEmp($sendData));
////		$objClsPslipR->sendEmail($sendData,$oData,$payslipFORMAT_);
////		header("Location: reports.php?statpos=pslipr&email".$_GET['send']);
//		break;
		
	default:
		$arrbreadCrumbs['Payslip Report'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsPslipR->getTableList());
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