<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupbenpe.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Employee Type' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','PopupType');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsPayroll_Details = new clsPayroll_Details($dbconn);
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsMnge_PG = new clsMnge_PG($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPayroll_Details->doValidateData($_POST)){
				$objClsPayroll_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Details->Data);
//				printa($objClsPayroll_Details->Data);
			}else {
				$objClsPayroll_Details->doPopulateData($_POST);
				$objClsPayroll_Details->doSaveAdd();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPayroll_Details->doValidateData($_POST)){
				$objClsPayroll_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPayroll_Details->Data);
//				printa($objClsPayroll_Details->Data);
			}else {
				$objClsPayroll_Details->doPopulateData($_POST);
				$objClsPayroll_Details->doSaveEdit($_GET['psdetails'],$_GET['emp']);
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}else{
			$oData = $objClsPayroll_Details->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsPayroll_Details->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupType'] = "";
		$oData = $objClsPayroll_Details->dbFetch_PayslipBEN($_GET['p_id_']);
//		$centerPanelBlock->assign('oData',);
		$centerPanelBlock->assign("oData",$oData);
//		printa($oData);
//		exit;
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