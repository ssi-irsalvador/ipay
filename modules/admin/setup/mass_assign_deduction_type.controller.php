<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mass_assign_deduction_type.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mass_assign_deduction_type.tpl.php"
,"dec_id" => "mass_assign_deduction_type.tpl.php"
,"select_employee" => "mass_assign_deduction_type.tpl.php"
,"select_pay_period" => "mass_assign_deduction_type.tpl.php"
,"pay_period" => "mass_assign_deduction_type.tpl.php"
);

$cmapKey = (isset($_GET['action'])) ? $_GET['action'] : "default";
$arrbreadCrumbs = array(
'Admin' => '',
'Mass Assign' => ''
);

$cmapKey = isset($_GET['dec_id']) ? "dec_id" : $cmapKey;
$cmapKey = isset($_GET['select_employee']) ? "select_employee" : $cmapKey;
$cmapKey = isset($_GET['select_pay_period']) ? "select_pay_period" : $cmapKey;
$cmapKey = isset($_GET['pay_period']) ? "pay_period" : $cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Deduction Type Mass Assign');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

$objclsMassAssignDeductionType = new clsMassAssignDeductionType($dbconn);

switch ($cmapKey) {
	case 'dec_id':
		$arrbreadCrumbs['Deduction Type Mass Assign'] = 'setup.php?statpos=mass_assign_deduction_type';
		$arrbreadCrumbs['Assigned Employee'] = "";

		$oData = $objclsMassAssignDeductionType->dbFetch($_GET['dec_id']);
		$centerPanelBlock->assign("oData",$oData);
		
		$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListAssignedEmployee());
		
		if (isset($_POST['btn_removeEmployee'])) {
			if (!$objclsMassAssignDeductionType->doValidateData($_POST, $kind_of_validation = 'Remove')) {
				
			} else {
				$objclsMassAssignDeductionType->removeEmployee($_POST);
				header("Location: setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET['dec_id']}");
				exit;
			}
		}
		
		break;

	case 'select_employee':
		$arrbreadCrumbs['Deduction Type Mass Assign'] = 'setup.php?statpos=mass_assign_deduction_type';
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}";
		$arrbreadCrumbs['Select Employee'] = "";
		
		if (!$objclsMassAssignDeductionType->checkEmployeeWithNoDeductionType()) {
			header("Location: setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET['dec_id']}");
			exit;
		}
		
		if (count($_POST) > 0) {
			if (isset($_POST['btn_assignEmployee'])) {
				if (!$objclsMassAssignDeductionType->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithNoDeductionTypeAssigned());
				} else {
					$objclsMassAssignDeductionType->assignEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET['dec_id']}");
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithNoDeductionTypeAssigned());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithNoDeductionTypeAssigned());
		}
		
		break;
		
	case 'select_pay_period':
		$arrbreadCrumbs['Deduction Type Mass Assign'] = 'setup.php?statpos=mass_assign_deduction_type';
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}";
		$arrbreadCrumbs['Select Pay Period'] = "";
		
		break;
		
	case 'pay_period':
		$arrbreadCrumbs['Deduction Type Mass Assign'] = 'setup.php?statpos=mass_assign_deduction_type';
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}";
		$arrbreadCrumbs['Select Pay Period'] = "setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1";
		
		switch ($_GET[pay_period]) {
			case 1: $pay_period = '1st Pay Period'; break;
			case 2: $pay_period = '2nd Pay Period'; break;
			case 3: $pay_period = '3rd Pay Period'; break;
			case 4: $pay_period = '4th Pay Period'; break;
			case 5: $pay_period = '5th Pay Period'; break;
			default: $pay_period = 'Pay Period'; break;
		}
		
		$arrbreadCrumbs[$pay_period] = "";
		
		if (count($_POST) > 0) {
			if (isset($_POST['btn_assignEmployee'])) {
				if (!$objclsMassAssignDeductionType->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithThisPayPeriod());
				} else {
					$objclsMassAssignDeductionType->assignEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET['dec_id']}");
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithThisPayPeriod());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableListEmployeeWithThisPayPeriod());
		}
		
		break;
	
	default:
		$arrbreadCrumbs['Deduction Type Mass Assign'] = "";
		
		$centerPanelBlock->assign('tblDataList',$objclsMassAssignDeductionType->getTableList());
		
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>