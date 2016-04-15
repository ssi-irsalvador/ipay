<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_summary.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "payroll_summary.tpl.php"
,"add" => "payroll_summary_form.tpl.php"
,"edit" => "payroll_summary_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports'=>'',
'Analysis Tools' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Payroll Summary');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsPayroll_Summary = new clsPayrollSummary($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Payroll Summary'] = 'reports.php?statpos=payroll_summary';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPayroll_Summary->doValidateData($_POST)){
				$objClsPayroll_Summary->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Summary->Data);
//				printa($objClsPayroll_Summary->Data);
			}else {
				$objClsPayroll_Summary->doPopulateData($_POST);
				$objClsPayroll_Summary->doSaveAdd();
				header("Location: reports.php?statpos=payroll_summary");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Payroll Summary'] = 'reports.php?statpos=payroll_summary';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPayroll_Summary->doValidateData($_POST)){
				$objClsPayroll_Summary->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Summary->Data);
//				printa($objClsPayroll_Summary->Data);
			}else {
				$objClsPayroll_Summary->doPopulateData($_POST);
				$objClsPayroll_Summary->doSaveEdit();
				header("Location: reports.php?statpos=payroll_summary");
				exit;
			}
		}else{
			$oData = $objClsPayroll_Summary->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsPayroll_Summary->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=payroll_summary");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Payroll Summary'] = "";
		$centerPanelBlock->assign('payperiod',$objClsPayroll_Summary->getPayperiod());
		$centerPanelBlock->assign('tblDataList',$objClsPayroll_Summary->getTableList());
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