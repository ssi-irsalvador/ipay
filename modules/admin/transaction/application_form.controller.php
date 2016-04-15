<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/application_form.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
 "default" => "application.tpl.php"
,"add" => "application_form.tpl.php"
,"edit" => "application_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
,'Recruitment' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

//get the employee picture
if (isset($_GET['img'])) {
	$sql = "select emrpi_picture from emr_personal_info where emrpi_id = ?";
	$rsResult = $dbconn->Execute($sql,array($_GET['img']));
//	exit;
	if (!$rsResult->EOF) {
		if (!empty($rsResult->fields['emrpi_picture'])){
				header("Content-type: image/jpeg");
				print $rsResult->fields['emrpi_picture'];
		}else {
			header("Content-type: image/jpeg");
			echo file_get_contents(SYSCONFIG_THEME_PATH.SYSCONFIG_THEME."/images/nopic.PNG");
		}
	}
	exit;
}

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Application Form');
$mainBlock->templateDir .= "admin";
//$mainBlock->templateFile = "index_blank.tpl.php";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsApplication_Form = new clsApplication_Form($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

/**
 * Get Array Data..
 */
$centerPanelBlock->assign('AppStat',$AppStat);
$centerPanelBlock->assign('position',$objClsEMP_MasterFile->position());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Application Form'] = 'transaction.php?statpos=application_form';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsApplication_Form->doValidateData($_POST)){
				$objClsApplication_Form->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsApplication_Form->Data);
//				printa($objClsApplication_Form->Data);
			}else {
				$objClsApplication_Form->doPopulateData($_POST);
				$objClsApplication_Form->doSaveAdd();
				header("Location: transaction.php?statpos=application_form");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Application Form'] = 'transaction.php?statpos=application_form';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsApplication_Form->doValidateData($_POST)){
				$objClsApplication_Form->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsApplication_Form->Data);
//				printa($objClsApplication_Form->Data);
			}else {
				$objClsApplication_Form->doPopulateData($_POST);
				$objClsApplication_Form->doSaveEdit();
				header("Location: transaction.php?statpos=application_form");
				exit;
			}
		}else{
			$oData = $objClsApplication_Form->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsApplication_Form->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=application_form");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Application Form'] = "";
		if (count($_POST)>0) {
			if (isset($_POST['bnt_statup'])){
				$objClsApplication_Form->doUpdateStatus_($_POST);
				header("Location: transaction.php?statpos=application_form");
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