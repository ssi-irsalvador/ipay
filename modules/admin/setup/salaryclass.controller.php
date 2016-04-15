<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/salaryclass.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "salaryclass.tpl.php"
,"add" => "salaryclass_form.tpl.php"
,"edit" => "salaryclass.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Libraries' => ''
,'Manage 201' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Salary Classification');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsSalaryClass = new clsSalaryClass($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Salary Classification'] = 'setup.php?statpos=salaryclass';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsSalaryClass->doValidateData($_POST)){
				$objClsSalaryClass->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSalaryClass->Data);
//				printa($objClsSalaryClass->Data);
			} else {
				$objClsSalaryClass->doPopulateData($_POST);
				$objClsSalaryClass->doSaveAdd();
				header("Location: setup.php?statpos=salaryclass");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Salary Classification'] = 'setup.php?statpos=salaryclass';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsSalaryClass->doValidateData($_POST)){
				$objClsSalaryClass->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSalaryClass->Data);
//				printa($objClsSalaryClass->Data);
			} else {
				$objClsSalaryClass->doPopulateData($_POST);
				$objClsSalaryClass->doSaveEdit();
				header("Location: setup.php?statpos=salaryclass");
				exit;
			}
		}else{
			$oData = $objClsSalaryClass->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsSalaryClass->getTableList());
		}
		break;
		
	case "delete":
		$objClsSalaryClass->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=salaryclass");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Salary Classification'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsSalaryClass->doValidateData($_POST)){
				$objClsSalaryClass->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSalaryClass->Data);
//				printa($objClsSalaryClass->Data);
				$centerPanelBlock->assign('tblDataList',$objClsSalaryClass->getTableList());
			} else {
				$objClsSalaryClass->doPopulateData($_POST);
				$objClsSalaryClass->doSaveAdd();
				header("Location: setup.php?statpos=salaryclass");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsSalaryClass->getTableList());
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