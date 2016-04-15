<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/otherprocess.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "otherprocess.tpl.php"
,"add" => "otherprocess_form.tpl.php"
,"edit" => "otherprocess_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'Payroll' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Other Process');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsOtherProcess = new clsOtherProcess($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Other Process'] = 'transaction.php?statpos=otherprocess';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsOtherProcess->doValidateData($_POST)){
				$objClsOtherProcess->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsOtherProcess->Data);
//				printa($objClsOtherProcess->Data);
			}else {
				$objClsOtherProcess->doPopulateData($_POST);
				$objClsOtherProcess->doSaveAdd();
				header("Location: transaction.php?statpos=otherprocess");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Other Process'] = 'transaction.php?statpos=otherprocess';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsOtherProcess->doValidateData($_POST)){
				$objClsOtherProcess->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsOtherProcess->Data);
//				printa($objClsOtherProcess->Data);
			}else {
				$objClsOtherProcess->doPopulateData($_POST);
				$objClsOtherProcess->doSaveEdit();
				header("Location: transaction.php?statpos=otherprocess");
				exit;
			}
		}else{
			$oData = $objClsOtherProcess->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsOtherProcess->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=otherprocess");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Other Process'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsOtherProcess->getTableList());
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