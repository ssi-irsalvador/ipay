<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/popupotrates.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popuppayslip_ta.tpl.php"
,"assign" => "popuppayslip_ta.tpl.php"
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Employee Type' => ''
);

$cmapKey = isset($_POST['assignrates'])?"assign":$cmapKey;

//print "<script>alert('".$cmapKey."');</script>";
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

$objCls_addotrates = new clsEMPType($dbconn);
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign('finalDecimal',$objClsMngeDecimal->getFinalDecimalSettings());
switch ($cmapKey) {
	case 'assign': 
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0 AND !empty($_POST['otr_rate'])) {
			$rates = trim(implode(',',$_POST['otr_rate']));
		}else if(count($_POST)>0 AND empty($_POST['otr_rate'])){
		$rates = 0;
		}
		$objCls_addotrates->doSaveEdit($rates);
		$centerPanelBlock->assign('tblDataList',$objCls_addotrates->getTableList());
		break;

	case 'edit':
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objCls_addotrates->doValidateData($_POST)){
				$objCls_addotrates->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls_addotrates->Data);
//				printa($objCls_addotrates->Data);
			}else {
				$objCls_addotrates->doPopulateData($_POST);
				$objCls_addotrates->doSaveEdit();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}else{
			$oData = $objCls_addotrates->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objCls_addotrates->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupType'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			}else{
				$objClsProcess_Payroll->doPopulateData($_POST);
				$objClsProcess_Payroll->doSaveTA($_GET['emp_id'],$_GET['psdetail'],$_POST);
				header("Location: popup.php?statpos=popuppayslip_ta&emp_id=".$_GET['emp_id']."&psdetail=".$_GET['psdetail']);
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataListTA',$objClsProcess_Payroll->TArate($_GET['emp_id'],$_GET['psdetail']));
			$centerPanelBlock->assign(objClsMngeDecimal,$objClsMngeDecimal);
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