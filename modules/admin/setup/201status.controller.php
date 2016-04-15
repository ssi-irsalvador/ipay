<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/201status.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "201status.tpl.php"
,"add" => "201status_form.tpl.php"
,"edit" => "201status.tpl.php"
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
$mainBlock->assign('PageTitle','201 Status');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objCls201Status = new cls201Status($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['201 Status'] = 'setup.php?statpos=201status';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objCls201Status->doValidateData($_POST)){
				$objCls201Status->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls201Status->Data);
//				printa($objCls201Status->Data);
			}else {
				$objCls201Status->doPopulateData($_POST);
				$objCls201Status->doSaveAdd();
				header("Location: setup.php?statpos=201status");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['201 Status'] = 'setup.php?statpos=201status';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objCls201Status->doValidateData($_POST)){
				$objCls201Status->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls201Status->Data);
//				printa($objCls201Status->Data);
			}else {
				$objCls201Status->doPopulateData($_POST);
				$objCls201Status->doSaveEdit();
				header("Location: setup.php?statpos=201status");
				exit;
			}
		}else{
			$oData = $objCls201Status->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objCls201Status->getTableList());
		}
		break;
		
	case "delete":
		$objCls201Status->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=201status");
		exit;		
		break;

	default:
		$arrbreadCrumbs['201 Status'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objCls201Status->doValidateData($_POST)){
				$objCls201Status->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls201Status->Data);
//				printa($objClsEMPType->Data);
				$centerPanelBlock->assign('tblDataList',$objCls201Status->getTableList());
			}else {
				$objCls201Status->doPopulateData($_POST);
				$objCls201Status->doSaveAdd();
				header("Location: setup.php?statpos=201status");
				exit;
			}
		}else {
			$centerPanelBlock->assign('tblDataList',$objCls201Status->getTableList());
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