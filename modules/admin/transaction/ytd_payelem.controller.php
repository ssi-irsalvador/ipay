<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/ytd_payelem.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "ytd_payelem.tpl.php"
,"add" => "ytd_payelem_form.tpl.php"
,"edit" => "ytd_payelem_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'YTD Import' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','YTD Pay Elements');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsYTD_PayElem = new clsYTD_PayElem($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['YTD Pay Elements'] = 'transaction.php?statpos=ytd_payelem';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsYTD_PayElem->doValidateData($_POST)){
				$objClsYTD_PayElem->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTD_PayElem->Data);
//				printa($objClsYTD_PayElem->Data);
			}else {
				$objClsYTD_PayElem->doPopulateData($_POST);
				$objClsYTD_PayElem->doSaveAdd();
				header("Location: transaction.php?statpos=ytd_payelem");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['YTD Pay Elements'] = 'transaction.php?statpos=ytd_payelem';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsYTD_PayElem->doValidateData($_POST)){
				$objClsYTD_PayElem->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTD_PayElem->Data);
//				printa($objClsYTD_PayElem->Data);
			}else {
				$objClsYTD_PayElem->doPopulateData($_POST);
				$objClsYTD_PayElem->doSaveEdit();
				header("Location: transaction.php?statpos=ytd_payelem");
				exit;
			}
		}else{
			$oData = $objClsYTD_PayElem->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsYTD_PayElem->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=ytd_payelem");
		exit;		
		break;

	default:
		$arrbreadCrumbs['YTD Pay Elements'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsYTD_PayElem->getTableList());
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