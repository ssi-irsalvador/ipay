<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mass_assign_factor_rate.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mass_assign_factor_rate.tpl.php"
,"fr_id" => "mass_assign_factor_rate.tpl.php"
,"select_employee" => "mass_assign_factor_rate.tpl.php"
);

$cmapKey = (isset($_GET['action'])) ? $_GET['action'] : "default";
$arrbreadCrumbs = array(
'Admin' => '',
'Mass Assign' => ''
);

$cmapKey = isset($_GET['fr_id']) ? "fr_id" : $cmapKey;
$cmapKey = isset($_GET['select_employee']) ? "select_employee" : $cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Factor Rate Mass Assign');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMassAssignFactorRate = new clsMassAssignFactorRate($dbconn);

switch ($cmapKey) {
	case 'fr_id':
		$arrbreadCrumbs['Factor Rate Mass Assign'] = 'setup.php?statpos=mass_assign_factor_rate';
		$arrbreadCrumbs['Assigned Employee'] = "";
		
		$oData = $objClsMassAssignFactorRate->dbFetch($_GET['fr_id']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign("getTotalEmployee",$objClsMassAssignFactorRate->getTotalEmployee());
		
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignFactorRate->getTableListEmployee());
		
		if (isset($_POST['btn_removeEmployee'])) {
			if (!$objClsMassAssignFactorRate->doValidateData($_POST, $kind_of_validation = 'Remove')) {
				
			} else {
				$objClsMassAssignFactorRate->removeEmployee($_POST);
				header("Location: setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET['fr_id']}");
				exit;
			}
		}
		
		break;
		
	case 'select_employee':
		$arrbreadCrumbs['Factor Rate Mass Assign'] = 'setup.php?statpos=mass_assign_factor_rate';
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET[fr_id]}";
		$arrbreadCrumbs['Select Employee'] = "";
		
		if (!$objClsMassAssignFactorRate->checkEmployeeWithNoFactorRate()) {
			header("Location: setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET['fr_id']}");
			exit;
		}
		
		if (count($_POST) > 0) {
			if (isset($_POST['btn_saveEmployee'])) {
				if (!$objClsMassAssignFactorRate->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					$centerPanelBlock->assign('tblDataList',$objClsMassAssignFactorRate->getTableListEmployeeWithNoFactorRateAssigned());
				} else {
					$objClsMassAssignFactorRate->assignEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET['fr_id']}");
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsMassAssignFactorRate->getTableListEmployeeWithNoFactorRateAssigned());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsMassAssignFactorRate->getTableListEmployeeWithNoFactorRateAssigned());
		}
		break;
		
	default:
		$arrbreadCrumbs['Factor Rate Mass Assign'] = "";
		
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignFactorRate->getTableList());
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