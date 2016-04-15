<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/ps_amend.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/amendimp.class.php');
Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "ps_amend.tpl.php"
,"add" => "ps_amend_form.tpl.php"
,"edit" => "ps_amend_form.tpl.php"
,"empinput_add" => "psamend_emp_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'Payroll' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['empinput_add'])?"empinput_add":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['empinput_del'])?"empinput_del":$cmapKey;


// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Pay Slip Amendments');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsPS_Amend = new clsPS_Amend($dbconn);
$objClsImportAmendments = new clsImportAmendments($dbconn);
$centerPanelBlock->assign('getPSAccnt',$objClsPS_Amend->getPSAccnt());
$centerPanelBlock->assign('getPSAccntALL',$objClsPS_Amend->getPSAccntALL());
$centerPanelBlock->assign('psar_istaxable',$psar_istaxable);
$centerPanelBlock->assign("payperiod",$objClsImportAmendments->getPayperiod());
switch ($cmapKey) {
	case 'add':
		$arrbreadCrumbs['Payroll Amendments'] = 'transaction.php?statpos=ps_amend';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPS_Amend->doValidateData($_POST)){
				$objClsPS_Amend->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPS_Amend->Data);
//				printa($objClsPS_Amend->Data);
			} else {
				$objClsPS_Amend->doPopulateData($_POST);
				$amend = $objClsPS_Amend->doSaveAdd();
				header("Location: transaction.php?statpos=ps_amend&edit=".$amend);
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Payroll Amendments'] = 'transaction.php?statpos=ps_amend';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPS_Amend->doValidateData($_POST)){
				$objClsPS_Amend->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPS_Amend->Data);
//				printa($objClsPS_Amend->Data);
			} else {
				if($_POST['bntsave']=='Save Amount'){
					$objClsPS_Amend->doPopulateData($_POST);
					$objClsPS_Amend->doAmendAmount($_POST);
					header("Location: transaction.php?statpos=ps_amend&edit=".$_GET['edit']);
					exit;
				}else{
					$objClsPS_Amend->doPopulateData($_POST);
					$objClsPS_Amend->doSaveEdit();
					header("Location: transaction.php?statpos=ps_amend");
					exit;
				}
			}
		}else{
//			$oData = $objClsPS_Amend->dbFetch($_GET['edit']);
//			$centerPanelBlock->assign("oData",$oData);
//			$centerPanelBlock->assign('tblDataList_',$objClsPS_Amend->getTableList_EmpSave());
		}
		$oData = $objClsPS_Amend->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList_',$objClsPS_Amend->getTableList_EmpSave());
		break;
		
	case 'empinput_add':
		$arrbreadCrumbs['Payroll Amendments'] = 'transaction.php?statpos=ps_amend';
		$arrbreadCrumbs['Edit'] = "transaction.php?statpos=ps_amend&edit=".$_GET['edit'];	
		$arrbreadCrumbs['Select Employee'] = "";
		if (count($_POST)>0) {
			if (isset($_POST['btn_saveEmployee'])){
				// save add new
//				if(!$objClsPS_Amend->doValidateData($_POST)){
//					$objClsPS_Amend->doPopulateData($_POST);
//					$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
//	//				printa($objClsRecurringPSAmend->Data);
//				} else {
					$objClsPS_Amend->doPopulateData($_POST);
					$objClsPS_Amend->doSaveEmployee($_POST);
					header("Location: transaction.php?statpos=ps_amend&edit=".$_GET['edit']);
					exit;
//				}
			}else{
				$centerPanelBlock->assign('tblDataList',$objClsPS_Amend->getTableList_Emp());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsPS_Amend->getTableList_Emp());
		}
		break;
		
	case "delete":
		$objClsPS_Amend->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=ps_amend");
		exit;		
		break;
		
	case "empinput_del":
		$arrbreadCrumbs['Payroll Amendments'] = "transaction.php?statpos=ps_amend";
		$arrbreadCrumbs['Edit'] = "";
		$objClsPS_Amend->doDelete_Emp($_GET['empinput_del']);
		header("Location: transaction.php?statpos=ps_amend&edit=".$_GET['edit']);
		exit;		
		break;	

	default:
		$arrbreadCrumbs['Payroll Amendments'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsPS_Amend->getTableList());
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