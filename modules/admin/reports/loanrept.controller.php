<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/loanrept.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "loanrept.tpl.php"
,"add" => "loanrept_form.tpl.php"
,"edit" => "loanrept.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
 'Reports' => ''
,'Loan Report'  => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Loan Balance');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsLoanRept = new clsLoanRept($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

$centerPanelBlock->assign("emptype",$emptype);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('departments',$objClsEMP_MasterFile->departments());
$centerPanelBlock->assign('branch',$objClsEMP_MasterFile->brachlist());
$centerPanelBlock->assign("empstat",$objClsEMP_MasterFile->empstat());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Loan Balance'] = 'reports.php?statpos=loanrept';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsLoanRept->doValidateData($_POST)){
				$objClsLoanRept->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoanRept->Data);
//				printa($objClsLoanRept->Data);
			}else {
				$objClsLoanRept->doPopulateData($_POST);
				$objClsLoanRept->doSaveAdd();
				header("Location: reports.php?statpos=loanrept");
				exit;
			}
		}
		break;

	case 'edit':
		/**$arrbreadCrumbs['Loan Balance'] = 'reports.php?statpos=loanrept';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsLoanRept->doValidateData($_POST)){
				$objClsLoanRept->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoanRept->Data);
//				printa($objClsLoanRept->Data);
			}else {
				$objClsLoanRept->doPopulateData($_POST);
				$objClsLoanRept->doSaveEdit();
				header("Location: reports.php?statpos=loanrept");
				exit;
			}
		}else{
			$oData = $objClsLoanRept->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}**/
		$objClsLoanRept->generateReport($_GET);
		break;
		
	case "delete":
		$objClsLoanRept->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=loanrept");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Loan Balance'] = "";
		//$centerPanelBlock->assign('tblDataList',$objClsLoanRept->getTableList());
		//break;
		if($_POST){
			header("Location: reports.php?statpos=loanrept&edit&comp=".$_POST['comp_id']."&branchinfo_id=".$_POST['branch']."&dept=".$_POST['ud_id']."&status=".$_POST['status']."&isdpart=".$_POST['isdpart']."&islname=".$_POST['islname']);
        	exit;
		}
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