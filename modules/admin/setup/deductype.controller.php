<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/deductype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "deductype.tpl.php"
,"add" => "deductype_form.tpl.php"
,"edit" => "deductype.tpl.php"
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
$mainBlock->assign('PageTitle', 'Deduction Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsDeducType = new clsDeducType($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Deduction Type'] = 'setup.php?statpos=deductype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsDeducType->doValidateData($_POST)){
				$objClsDeducType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDeducType->Data);
//				printa($objClsDeducType->Data);
			} else {
				$objClsDeducType->doPopulateData($_POST);
				$objClsDeducType->doSaveAdd();
				header("Location: setup.php?statpos=deductype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Deduction Type'] = 'setup.php?statpos=deductype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsDeducType->doValidateData($_POST)){
				$objClsDeducType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDeducType->Data);
//				printa($objClsDeducType->Data);
			} else {
				$objClsDeducType->doPopulateData($_POST);
				$objClsDeducType->doSaveEdit();
				header("Location: setup.php?statpos=deductype");
				exit;
			}
		}else{
			$oData = $objClsDeducType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsDeducType->getTableList());
		}
		break;
		
	case "delete":
		$objClsDeducType->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=deductype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Deduction Type'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsDeducType->doValidateData($_POST)){
				$objClsDeducType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsDeducType->Data);
//				printa($objClsDeducType->Data);
				$centerPanelBlock->assign('tblDataList',$objClsDeducType->getTableList());
			} else {
				$objClsDeducType->doPopulateData($_POST);
				$objClsDeducType->doSaveAdd();
				header("Location: setup.php?statpos=deductype");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsDeducType->getTableList());
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