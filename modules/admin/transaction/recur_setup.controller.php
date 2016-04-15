<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/recur_setup.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/loan_app.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "recur_setup.tpl.php"
,"add" => "recur_setup_form.tpl.php"
,"edit" => "recur_setup_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['bendelete'])?"bendelete":$cmapKey;
$cmapKey = isset($_POST['benefitupdate'])?"benefitupdate":$cmapKey;


// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Recurring Setup ');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsRecur_Setup = new clsRecur_Setup($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);
$objClsLoan_App = new clsLoan_App($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign("benData",$objClsEMP_MasterFile->benData());
$centerPanelBlock->assign("payelement",$objClsEMP_MasterFile->payelement());

switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Recurring Setup '] = 'transaction.php?statpos=recur_setup';
		$arrbreadCrumbs['Edit'] = "";
		$centerPanelBlock->assign("salaryClass",$objClsLoan_App->getSalaryClass($_GET['edit']));
		if (count($_POST)>0) {
			// update
			if(!$objClsRecur_Setup->doValidateData($_POST)){
				$objClsRecur_Setup->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRecur_Setup->Data);
//				printa($objClsRecur_Setup->Data);
			}else {
				$objClsRecur_Setup->doPopulateData($_POST);
				$objClsRecur_Setup->doSaveBen();
				header("Location: transaction.php?statpos=recur_setup&edit=".$_GET['edit']);
				exit;
			}
		}else{
			$oDataEMP = $objClsLoan_App->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oDataEMP",$oDataEMP);
			$centerPanelBlock->assign("benList",$objClsEMP_MasterFile->benList($_GET['edit']));
		}
		break;
		
	case "delete":
		$objClsRecur_Setup->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=recur_setup");
		exit;		
		break;
		
	case 'benefitupdate':
		$objClsRecur_Setup->doSaveBen(true);
		header('Location: transaction.php?statpos=recur_setup&edit='.$_GET['edit']);
		break;
		
	case "bendelete":
		$objClsEMP_MasterFile->doDelete('ben_info',$_GET['bendelete']);
		header('Location: transaction.php?statpos=recur_setup&edit='.$_GET['edit']);
		break;

	default:
		$arrbreadCrumbs['Recurring Setup '] = "";
		$centerPanelBlock->assign('tblDataList',$objClsRecur_Setup->getTableList());
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