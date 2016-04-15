<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/loantype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "loantype.tpl.php"
,"add" => "loantype_form.tpl.php"
,"edit" => "loantype.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Master Data' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Loan Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsLoanType = new clsLoanType($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Loan Type'] = 'setup.php?statpos=loantype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsLoanType->doValidateData($_POST)){
				$objClsLoanType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoanType->Data);
//				printa($objClsLoanType->Data);
			}else {
				$objClsLoanType->doPopulateData($_POST);
				$objClsLoanType->doSaveAdd();
				header("Location: setup.php?statpos=loantype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Loan Type'] = 'setup.php?statpos=loantype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsLoanType->doValidateData($_POST)){
				$objClsLoanType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoanType->Data);
//				printa($objClsLoanType->Data);
			}else {
				$objClsLoanType->doPopulateData($_POST);
				$objClsLoanType->doSaveEdit();
				header("Location: setup.php?statpos=loantype");
				exit;
			}
		}else{
			$oData = $objClsLoanType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsLoanType->getTableList());
		}
		break;
		
	case "delete":
		$objClsLoanType->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=loantype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Loan Type'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsLoanType->doValidateData($_POST)){
				$objClsLoanType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsLoanType->Data);
				$centerPanelBlock->assign('tblDataList',$objClsLoanType->getTableList());
//				printa($objClsLoanType->Data);
			}else {
				$objClsLoanType->doPopulateData($_POST);
				$objClsLoanType->doSaveAdd();
				header("Location: setup.php?statpos=loantype");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsLoanType->getTableList());
		}
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