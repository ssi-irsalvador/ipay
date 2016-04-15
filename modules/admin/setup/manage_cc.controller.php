<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manage_cc.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "manage_cc.tpl.php"
,"add" => "manage_cc_form.tpl.php"
,"edit" => "manage_cc_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Cost Center');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsManageCC = new clsManageCC($dbconn);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Cost Center'] = 'setup.php?statpos=manage_cc';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsManageCC->doValidateData($_POST)){
				$objClsManageCC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManageCC->Data);
//				printa($objClsManageCC->Data);
			}else {
				$objClsManageCC->doPopulateData($_POST);
				$objClsManageCC->doSaveAdd();
				header("Location: setup.php?statpos=manage_cc");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Manage Cost Center'] = 'setup.php?statpos=manage_cc';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsManageCC->doValidateData($_POST)){
				$objClsManageCC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManageCC->Data);
//				printa($objClsManageCC->Data);
			}else {
				$objClsManageCC->doPopulateData($_POST);
				$objClsManageCC->doSaveEdit();
				header("Location: setup.php?statpos=manage_cc");
				exit;
			}
		}else{
			$oData = $objClsManageCC->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsManageCC->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=manage_cc");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Cost Center'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManageCC->getTableList());
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