<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/applicant_database.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/application_form.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "applicant_database.tpl.php"
,"add" => "applicant_database_form.tpl.php"
,"edit" => "applicant_database_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
,'Recruitment' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Applicant Database');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsApplicant_Database = new clsApplicant_Database($dbconn);
$objClsApplication_Form = new clsApplication_Form($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Applicant Database'] = 'transaction.php?statpos=applicant_database';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsApplicant_Database->doValidateData($_POST)){
				$objClsApplicant_Database->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsApplicant_Database->Data);
//				printa($objClsApplicant_Database->Data);
			}else {
				$objClsApplicant_Database->doPopulateData($_POST);
				$objClsApplicant_Database->doSaveAdd();
				header("Location: transaction.php?statpos=applicant_database");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Applicant Database'] = 'transaction.php?statpos=applicant_database';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsApplicant_Database->doValidateData($_POST)){
				$objClsApplicant_Database->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsApplicant_Database->Data);
//				printa($objClsApplicant_Database->Data);
			}else {
				$objClsApplicant_Database->doPopulateData($_POST);
				$objClsApplicant_Database->doSaveEdit();
				header("Location: transaction.php?statpos=applicant_database");
				exit;
			}
		}else{
			$oData = $objClsApplicant_Database->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsApplicant_Database->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=applicant_database");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Applicant Database'] = "";
		if (count($_POST)>0) {
			if (isset($_POST['bnt_statup'])){
				$objClsApplication_Form->doUpdateStatus_($_POST);
				header("Location: transaction.php?statpos=applicant_database");
				exit;
			}else{
				$centerPanelBlock->assign('tblDataList',$objClsApplication_Form->getTableList());
			}
		}else {
			$centerPanelBlock->assign('tblDataList',$objClsApplication_Form->getTableList());
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