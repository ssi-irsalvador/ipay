<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/resignation.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "resignation.tlp.php"
,"add" => "resignation_form.tpl.php"
,"edit" => "resignation_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '','EMR' =>''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Resignation/Termination/Retirement');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsResignation = new clsResignation($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Resignation/Termination/Retirement'] = 'transaction.php?statpos=resignation';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsResignation->doValidateData($_POST)){
				$objClsResignation->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsResignation->Data);
//				printa($objClsResignation->Data);
			}else {
				$objClsResignation->doPopulateData($_POST);
				$objClsResignation->doSaveAdd();
				header("Location: transaction.php?statpos=resignation");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Resignation/Termination/Retirement'] = 'transaction.php?statpos=resignation';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsResignation->doValidateData($_POST)){
				$objClsResignation->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsResignation->Data);
//				printa($objClsResignation->Data);
			}else {
				$objClsResignation->doPopulateData($_POST);
				$objClsResignation->doSaveEdit();
				header("Location: transaction.php?statpos=resignation");
				exit;
			}
		}else{
			$oData = $objClsResignation->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsResignation->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=resignation");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Resignation/Termination/Retirement'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsResignation->getTableList());
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