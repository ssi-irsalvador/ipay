<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/other_lr.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "other_lr.tpl.php"
,"add" => "other_lr_form.tpl.php"
,"edit" => "other_lr_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Loan Report' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Other Loan Report');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsOther_LR = new clsOther_LR($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Other Loan Report'] = 'reports.php?statpos=other_lr';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsOther_LR->doValidateData($_POST)){
				$objClsOther_LR->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsOther_LR->Data);
//				printa($objClsOther_LR->Data);
			}else {
				$objClsOther_LR->doPopulateData($_POST);
				$objClsOther_LR->doSaveAdd();
				header("Location: reports.php?statpos=other_lr");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Other Loan Report'] = 'reports.php?statpos=other_lr';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsOther_LR->doValidateData($_POST)){
				$objClsOther_LR->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsOther_LR->Data);
//				printa($objClsOther_LR->Data);
			}else {
				$objClsOther_LR->doPopulateData($_POST);
				$objClsOther_LR->doSaveEdit();
				header("Location: reports.php?statpos=other_lr");
				exit;
			}
		}else{
			$oData = $objClsOther_LR->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsOther_LR->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=other_lr");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Other Loan Report'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsOther_LR->getTableList());
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