<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mass_assign_bank_group.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mass_assign_bank_group.tpl.php"
,"comp_id" => "mass_assign_bank_group.tpl.php"
,"bank_id" => "mass_assign_bank_group.tpl.php"
,"select_employee" => "mass_assign_bank_group.tpl.php"
);

$cmapKey = (isset($_GET['action'])) ? $_GET['action'] : "default";
$arrbreadCrumbs = array(
'Admin' => '',
'Mass Assign' => ''
);

$cmapKey = isset($_GET['comp_id']) ? "comp_id" : $cmapKey;
$cmapKey = isset($_GET['bank_id']) ? "bank_id" : $cmapKey;
$cmapKey = isset($_GET['select_employee']) ? "select_employee" : $cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Bank Group Mass Assign');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

$objClsMassAssignBankGroup = new clsMassAssignBankGroup($dbconn);
$objClsSSS = new clsSSS($dbconn);

switch ($cmapKey) {
	case 'comp_id':
		$arrbreadCrumbs['Bank Group Mass Assign'] = 'setup.php?statpos=mass_assign_bank_group';
		$arrbreadCrumbs['Company Bank Account/s'] = "";
		
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignBankGroup->getTableListBank($_GET));
		
		break;
		
	case 'bank_id':
		$arrbreadCrumbs['Bank Group Mass Assign'] = 'setup.php?statpos=mass_assign_bank_group';
		$arrbreadCrumbs['Company Bank Account/s'] = "setup.php?statpos=mass_assign_bank_group&comp_id={$_GET[comp_id]}";
		$arrbreadCrumbs['Assigned Employee'] = "";

		$oData = $objClsMassAssignBankGroup->dbFetch($_GET['banklist_id']);
		$centerPanelBlock->assign("oData",$oData);
		
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignBankGroup->getTableListAssignedEmployee());
		
		if (isset($_POST['btn_removeEmployee'])) {
			if (!$objClsMassAssignBankGroup->doValidateData($_POST, $kind_of_validation = 'Remove')) {
				
			} else {
				$objClsMassAssignBankGroup->removeEmployeeAccount($_POST);
				header("Location: setup.php?statpos=mass_assign_bank_group&comp_id={$_GET['comp_id']}&bank_id={$_GET['bank_id']}&banklist_id={$_GET['banklist_id']}");
				exit;
			}
		}
		
		break;

	case 'select_employee':
		$arrbreadCrumbs['Bank Group Mass Assign'] = 'setup.php?statpos=mass_assign_bank_group';
		$arrbreadCrumbs['Company Bank Account/s'] = "setup.php?statpos=mass_assign_bank_group&comp_id={$_GET[comp_id]}";
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_bank_group&comp_id={$_GET[comp_id]}&bank_id={$_GET[bank_id]}&banklist_id={$_GET[banklist_id]}";
		$arrbreadCrumbs['Select Employee'] = "";

		if (!$objClsMassAssignBankGroup->checkEmployeeAccountWithNoBankGroup()) {
			header("Location: setup.php?statpos=mass_assign_bank_group&comp_id={$_GET['comp_id']}&bank_id={$_GET['bank_id']}&banklist_id={$_GET['banklist_id']}");
			exit;
		}

		if (count($_POST) > 0) {
			if (isset($_POST['btn_saveEmployee'])) {
				if (!$objClsMassAssignBankGroup->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					//$objClsMassAssignBankGroup->doPopulateData($_POST);
					//$centerPanelBlock->assign("oData",$objClsMassAssignBankGroup->Data);
					$centerPanelBlock->assign('tblDataList',$objClsMassAssignBankGroup->getTableListEmployeeWithNoBankGroupAssigned());
				} else {
					//$objClsMassAssignBankGroup->doPopulateData($_POST);
					$objClsMassAssignBankGroup->assignEmployeeAccount($_POST);
					header("Location: setup.php?statpos=mass_assign_bank_group&comp_id={$_GET['comp_id']}&bank_id={$_GET['bank_id']}&banklist_id={$_GET['banklist_id']}");
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsMassAssignBankGroup->getTableListEmployeeWithNoBankGroupAssigned());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsMassAssignBankGroup->getTableListEmployeeWithNoBankGroupAssigned());
		}
		
		break;

	default:
		$arrbreadCrumbs['Bank Group Mass Assign'] = "";
		$centerPanelBlock->assign('comp',$objClsSSS->dbfetchCompDetails(1));
		//change this if multiple company.
		//----------------------------->>
		$centerPanelBlock->assign('brachlist',$objClsMassAssignBankGroup->getBrachList(1));
		//-----------------------------<<
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

/*-!-!-!-!-!-!-!-!-*/
$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>