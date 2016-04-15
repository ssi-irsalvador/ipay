<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mass_assign_cc.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "mass_assign_cc.tpl.php"
,"add" => "mass_assign_cc_form.tpl.php"
,"edit" => "mass_assign_cc_form.tpl.php"
,"cc_id" => "mass_assign_cc_form.tpl.php"
,"select_employee" => "mass_assign_cc_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['cc_id'])?"cc_id":$cmapKey;
$cmapKey = isset($_GET['select_employee'])?"select_employee":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Cost Center Mass Assign');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMassAssignCC = new clsMassAssignCC($dbconn);
switch ($cmapKey) {
	case 'cc_id':
		$arrbreadCrumbs['Cost Center Mass Assign'] = 'setup.php?statpos=mass_assign_cc';
		$arrbreadCrumbs['Assign Employees'] = "";
		$oData = $objClsMassAssignCC->dbFetch($_GET['cc_id']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign("getTotalEmployee",$objClsMassAssignCC->getTotalEmployee($_GET['cc_id']));
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignCC->getTableListEmployeeWithCC());
		if (count($_POST) > 0) {
			// remove
			if (isset($_POST['btn_removeEmployee'])) {
				if (!$objClsMassAssignCC->doValidateData($_POST, $kind_of_validation = 'Remove')) {
					
				} else {
					$objClsMassAssignCC->removeEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_cc&cc_id={$_GET['cc_id']}");
					exit;
				}
			} elseif(isset($_POST['btn_updateEmployee'])){
				$objClsMassAssignCC->updateEmployee($_POST);
				header("Location: setup.php?statpos=mass_assign_cc&cc_id={$_GET['cc_id']}");
				exit;
			} else {
				exit;
			}
		}
		break;
		
	case 'select_employee':
		$arrbreadCrumbs['Cost Center Mass Assign'] = 'setup.php?statpos=mass_assign_cc';
		$arrbreadCrumbs['Assign Employees'] = "";
		if (count($_POST) > 0) {
			if (isset($_POST['btn_saveEmployee'])) {
				if (!$objClsMassAssignCC->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					$centerPanelBlock->assign('tblDataList',$objClsMassAssignCC->getTableListEmployee());
				} else {
					$objClsMassAssignCC->assignEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_cc&cc_id={$_GET['cc_id']}");
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsMassAssignCC->getTableListEmployee());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsMassAssignCC->getTableListEmployee());
		}
		break;
		
	case 'add': 
		$arrbreadCrumbs['Cost Center Mass Assign'] = 'setup.php?statpos=mass_assign_cc';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMassAssignCC->doValidateData($_POST)){
				$objClsMassAssignCC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMassAssignCC->Data);
//				printa($objClsMassAssignCC->Data);
			}else {
				$objClsMassAssignCC->doPopulateData($_POST);
				$objClsMassAssignCC->doSaveAdd();
				header("Location: setup.php?statpos=mass_assign_cc");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Cost Center Mass Assign'] = 'setup.php?statpos=mass_assign_cc';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMassAssignCC->doValidateData($_POST)){
				$objClsMassAssignCC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMassAssignCC->Data);
//				printa($objClsMassAssignCC->Data);
			}else {
				$objClsMassAssignCC->doPopulateData($_POST);
				$objClsMassAssignCC->doSaveEdit();
				header("Location: setup.php?statpos=mass_assign_cc");
				exit;
			}
		}else{
			$oData = $objClsMassAssignCC->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsMassAssignCC->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mass_assign_cc");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Cost Center Mass Assign'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMassAssignCC->getTableList());
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