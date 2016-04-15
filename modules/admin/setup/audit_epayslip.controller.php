<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/audit_epayslip.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "audit_epayslip.tpl.php"
,"add" => "audit_epayslip_form.tpl.php"
,"edit" => "audit_epayslip_form.tpl.php"
,"view" => "audit_epayslip_log.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Audit Trail' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['view'])?"view":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','ePayslip');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsAuditPayslip = new clsAuditPayslip($dbconn);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['ePayslip'] = 'setup.php?statpos=audit_ePayslip';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsAuditPayslip->doValidateData($_POST)){
				$objClsAuditPayslip->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsAuditPayslip->Data);
//				printa($objClsAuditPayslip->Data);
			}else {
				$objClsAuditPayslip->doPopulateData($_POST);
				$objClsAuditPayslip->doSaveAdd();
				header("Location: setup.php?statpos=audit_ePayslip");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['ePayslip'] = 'setup.php?statpos=audit_ePayslip';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsAuditPayslip->doValidateData($_POST)){
				$objClsAuditPayslip->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsAuditPayslip->Data);
//				printa($objClsAuditPayslip->Data);
			}else {
				$objClsAuditPayslip->doPopulateData($_POST);
				$objClsAuditPayslip->doSaveEdit();
				header("Location: setup.php?statpos=audit_ePayslip");
				exit;
			}
		}else{
			$oData = $objClsAuditPayslip->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsAuditPayslip->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=audit_ePayslip");
		exit;		
		break;

	case "view":
		$arrbreadCrumbs['ePayslip'] = 'setup.php?statpos=audit_ePayslip';
		$arrbreadCrumbs['Log Details'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsAuditPayslip->getTableListLogDetails());
		$centerPanelBlock->assign('AuditTrail',$objClsAuditPayslip->dbFetchAuditTrail($_GET['view']));
		break;
		
	default:
		$arrbreadCrumbs['ePayslip'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsAuditPayslip->getTableList2());
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