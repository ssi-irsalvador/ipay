<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/bankaccntype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "bankaccntype.tpl.php"
,"add" => "bankaccntype_form.tpl.php"
,"edit" => "bankaccntype.tpl.php"
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
$mainBlock->assign('PageTitle', 'Bank Account Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsBankAccnType = new clsBankAccnType($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Bank Account Type'] = 'setup.php?statpos=bankaccntype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsBankAccnType->doValidateData($_POST)){
				$objClsBankAccnType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBankAccnType->Data);
//				printa($objClsBankAccnType->Data);
			} else {
				$objClsBankAccnType->doPopulateData($_POST);
				$objClsBankAccnType->doSaveAdd();
				header("Location: setup.php?statpos=bankaccntype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Bank Account Type'] = 'setup.php?statpos=bankaccntype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsBankAccnType->doValidateData($_POST)){
				$objClsBankAccnType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBankAccnType->Data);
//				printa($objClsBankAccnType->Data);
			} else {
				$objClsBankAccnType->doPopulateData($_POST);
				$objClsBankAccnType->doSaveEdit();
				header("Location: setup.php?statpos=bankaccntype");
				exit;
			}
		}else{
			$oData = $objClsBankAccnType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsBankAccnType->getTableList());
		}
		break;
		
	case "delete":
		$objClsBankAccnType->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=bankaccntype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Bank Account Type'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsBankAccnType->doValidateData($_POST)){
				$objClsBankAccnType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBankAccnType->Data);
//				printa($objClsCompType->Data);
				$centerPanelBlock->assign('tblDataList',$objClsBankAccnType->getTableList());
			} else {
				$objClsBankAccnType->doPopulateData($_POST);
				$objClsBankAccnType->doSaveAdd();
				header("Location: setup.php?statpos=bankaccntype");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsBankAccnType->getTableList());
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