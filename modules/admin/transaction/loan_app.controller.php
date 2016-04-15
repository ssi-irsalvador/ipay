<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/loan_app.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "loan_app.tpl.php"
,"add" => "loan_app_form.tpl.php"
,"edit" => "loan_app_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['loandelete'])?"loandelete":$cmapKey;
$cmapKey = isset($_POST['loanupdate'])?"loanupdate":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Loan Application');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsLoan_App = new clsLoan_App($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);
$objClsMngeDecimal = new Application();

$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign("loan",$objClsEMP_MasterFile->loan());
$centerPanelBlock->assign("loantype",$objClsEMP_MasterFile->loantype());
$centerPanelBlock->assign("loanData",$objClsEMP_MasterFile->loanData());

switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Loan Application'] = 'transaction.php?statpos=loan_app';
		$arrbreadCrumbs['Edit'] = "";
		$centerPanelBlock->assign("salaryClass",$objClsLoan_App->getSalaryClass($_GET['edit']));
		if (count($_POST)>0) {
			// update
			if(!$objClsLoan_App->doValidateData($_POST)){
				$objClsLoan_App->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoan_App->Data);
//				printa($objClsLoan_App->Data);
			}else {
				$objClsLoan_App->doPopulateData($_POST);
				$objClsLoan_App->doSaveLOAN();
				header("Location: transaction.php?statpos=loan_app&edit=".$_GET['edit']);
				exit;
			}
		}else{
			$oDataEMP = $objClsLoan_App->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oDataEMP",$oDataEMP);
			$centerPanelBlock->assign("loanList",$objClsEMP_MasterFile->loanList());
		}
		break;
	case 'loanupdate':
		$objClsLoan_App->doSaveLOAN(true);
		header('Location: transaction.php?statpos=loan_app&edit='.$_GET['edit']);
		break;	
	case "loandelete":
		$objClsEMP_MasterFile->doDelete('loan_info',$_GET['loandelete']);
		header('Location: transaction.php?statpos=loan_app&edit='.$_GET['edit']);
		exit;
		break;
	default:
		$arrbreadCrumbs['Loan Application'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsLoan_App->getTableList());
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