<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/rbd.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "rbd.tpl.php"
,"add" => "rbd_form.tpl.php"
,"edit" => "rbd_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Recurring Benefits & Deduction');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsRDB = new clsRDB($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Recurring Benefits & Deduction'] = 'transaction.php?statpos=rbd';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsRDB->doValidateData($_POST)){
				$objClsRDB->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRDB->Data);
//				printa($objClsRDB->Data);
			}else {
				$objClsRDB->doPopulateData($_POST);
				$objClsRDB->doSaveAdd();
				header("Location: transaction.php?statpos=rbd");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Recurring Benefits & Deduction'] = 'transaction.php?statpos=rbd';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsRDB->doValidateData($_POST)){
				$objClsRDB->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRDB->Data);
//				printa($objClsRDB->Data);
			}else {
				$objClsRDB->doPopulateData($_POST);
				$objClsRDB->doSaveEdit();
				header("Location: transaction.php?statpos=rbd");
				exit;
			}
		}else{
			$oData = $objClsRDB->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsRDB->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=rbd");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Recurring Benefits & Deduction'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsRDB->getTableList());
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