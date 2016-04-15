<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/branchpro.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "branchpro.tpl.php"
,"add" => "branchpro_form.tpl.php"
,"edit" => "branchpro.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Libraries' => ''
,'Manage Company' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Branch Profile');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsBranchPro = new clsBranchPro($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Branch Profile'] = 'setup.php?statpos=branchpro';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsBranchPro->doValidateData($_POST)){
				$objClsBranchPro->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBranchPro->Data);
//				printa($objClsBranchPro->Data);
			}else {
				$objClsBranchPro->doPopulateData($_POST);
				$objClsBranchPro->doSaveAdd();
				header("Location: setup.php?statpos=branchpro");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Branch Profile'] = 'setup.php?statpos=branchpro';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsBranchPro->doValidateData($_POST)){
				$objClsBranchPro->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBranchPro->Data);
//				printa($objClsBranchPro->Data);
			}else {
				$objClsBranchPro->doPopulateData($_POST);
				$objClsBranchPro->doSaveEdit();
				header("Location: setup.php?statpos=branchpro");
				exit;
			}
		}else{
			$oData = $objClsBranchPro->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsBranchPro->getTableList());
		}
		break;
		
	case "delete":
		$objClsBranchPro->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=branchpro");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Branch Profile'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsBranchPro->doValidateData($_POST)){
				$objClsBranchPro->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBranchPro->Data);
//				printa($objClsBranchPro->Data);
			}else {
				$objClsBranchPro->doPopulateData($_POST);
				$objClsBranchPro->doSaveAdd();
				header("Location: setup.php?statpos=branchpro");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsBranchPro->getTableList());
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