<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manageps_passwd.class.php');
require_once(SYSCONFIG_ROOT_PATH.'helpers/encryption.helper.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "manageps_passwd.tpl.php"
,"add" => "manageps_passwd_form.tpl.php"
,"edit" => "manageps_passwd_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Master Data' => ''
,'Manage Access Level' => ''
,'Manage Payslip Access' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Payslip Access');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsManagePS_Passwd = new clsManagePS_Passwd($dbconn);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Payslip Access'] = 'setup.php?statpos=manageps_passwd';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsManagePS_Passwd->doValidateData($_POST)){
				$objClsManagePS_Passwd->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManagePS_Passwd->Data);
//				printa($objClsManagePS_Passwd->Data);
			}else {
				$objClsManagePS_Passwd->doPopulateData($_POST);
				$objClsManagePS_Passwd->doSaveAdd();
				header("Location: setup.php?statpos=manageps_passwd");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Manage Payslip Access'] = 'setup.php?statpos=manageps_passwd';
		$arrbreadCrumbs['Edit'] = "";
		$centerPanelBlock->assign("oData",$objClsManagePS_Passwd->dbFetch($_GET['edit']));
		if (count($_POST)>0) {
			// update
			if(!$objClsManagePS_Passwd->doValidateData($_POST)){
				$objClsManagePS_Passwd->doPopulateData($_POST);
//				printa($objClsManagePS_Passwd->Data);
			}else {
				$objClsManagePS_Passwd->doPopulateData($_POST);
				$objClsManagePS_Passwd->doSaveEdit();
				header("Location: setup.php?statpos=manageps_passwd");
				exit;
			}
		}else{
			$oData = $objClsManagePS_Passwd->dbFetch($_GET['edit']);
			if($oData['ps_passwd_password'] != ''){
				$oData['ps_passwd_password'] = clsEncryptHelper::decrypt($oData['ps_passwd_password'], BASE_URL);
			}
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsManagePS_Passwd->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=manageps_passwd");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Payslip Access'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManagePS_Passwd->getTableList());
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