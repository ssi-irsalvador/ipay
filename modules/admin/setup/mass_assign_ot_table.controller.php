<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mass_assign_ot_table.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mass_assign_ot_table.tpl.php"
,"ot_id" => "mass_assign_ot_table.tpl.php"
,"select_employee" => "mass_assign_ot_table.tpl.php"
);

$cmapKey = (isset($_GET['action'])) ? $_GET['action'] : "default";
$arrbreadCrumbs = array(
'Admin' => '',
'Mass Assign' => ''
);

$cmapKey = isset($_GET['ot_id']) ? "ot_id" : $cmapKey;
$cmapKey = isset($_GET['select_employee']) ? "select_employee" : $cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'OT Table Mass Assign');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMassAssignOTTable = new clsMassAssignOTTable($dbconn);

switch ($cmapKey) {
	case 'ot_id':
		$arrbreadCrumbs['OT Table Mass Assign'] = 'setup.php?statpos=mass_assign_ot_table';
		$arrbreadCrumbs['Assigned Employee'] = "";

		$oData = $objClsMassAssignOTTable->dbFetch($_GET['ot_id']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign("getTotalEmployee",$objClsMassAssignOTTable->getTotalEmployee());

		$centerPanelBlock->assign('tblDataList',$objClsMassAssignOTTable->getTableListEmployee());

		if (isset($_POST['btn_removeEmployee'])) {
			if (!$objClsMassAssignOTTable->doValidateData($_POST, $kind_of_validation = 'Remove')) {

			} else {
				$objClsMassAssignOTTable->removeEmployee($_POST);
				header("Location: setup.php?statpos=mass_assign_ot_table&ot_id=".$_GET['ot_id']);
				exit;
			}
		}
		break;

	case 'select_employee':
		$arrbreadCrumbs['OT Table Mass Assign'] = 'setup.php?statpos=mass_assign_ot_table';
		$arrbreadCrumbs['Assigned Employee'] = "setup.php?statpos=mass_assign_ot_table&ot_id={$_GET[ot_id]}";
		$arrbreadCrumbs['Select Employee'] = "";

		if (!$objClsMassAssignOTTable->checkEmployeeWithNoOTTable()) {
			header("Location: setup.php?statpos=mass_assign_ot_table&ot_id=".$_GET['ot_id']);
			exit;
		}

		if (count($_POST) > 0) {
			if (isset($_POST['btn_saveEmployee'])) {
				if (!$objClsMassAssignOTTable->doValidateData($_POST, $kind_of_validation = 'Assign')) {
					$objClsMassAssignOTTable->doPopulateData($_POST);
					$centerPanelBlock->assign("oData",$objClsMassAssignOTTable->Data);
					$centerPanelBlock->assign('tblDataList',$objClsMassAssignOTTable->getTableListEmployeeWithNoOTTableAssigned());
				} else {
					$objClsMassAssignOTTable->doPopulateData($_POST);
					$objClsMassAssignOTTable->assignEmployee($_POST);
					header("Location: setup.php?statpos=mass_assign_ot_table&ot_id=".$_GET['ot_id']);
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsMassAssignOTTable->getTableListEmployeeWithNoOTTableAssigned());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsMassAssignOTTable->getTableListEmployeeWithNoOTTableAssigned());
		}
		break;

	default:
		$arrbreadCrumbs['OT Table Mass Assign'] = "";

		$centerPanelBlock->assign('tblDataList',$objClsMassAssignOTTable->getTableList());
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