<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/ytdentry_details.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "ytdentry_details.tpl.php"
,"add" => "ytdentry_details_form.tpl.php"
,"edit" => "ytdentry_details_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'YTD Entry' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','YTD Entry Details');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsYTDEntry_Details = new clsYTDEntry_Details($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['YTD Entry Details'] = 'transaction.php?statpos=ytdentry_details';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsYTDEntry_Details->doValidateData($_POST)){
				$objClsYTDEntry_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDEntry_Details->Data);
//				printa($objClsYTDEntry_Details->Data);
			}else {
				$objClsYTDEntry_Details->doPopulateData($_POST);
				$objClsYTDEntry_Details->doSaveAdd();
				header("Location: transaction.php?statpos=ytdentry_details");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['YTD Entry Details'] = 'transaction.php?statpos=ytdentry_details';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsYTDEntry_Details->doValidateData($_POST)){
				$objClsYTDEntry_Details->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDEntry_Details->Data);
//				printa($objClsYTDEntry_Details->Data);
			}else {
				$objClsYTDEntry_Details->doPopulateData($_POST);
				$objClsYTDEntry_Details->doSaveEdit();
				header("Location: transaction.php?statpos=ytdentry_details");
				exit;
			}
		}else{
			$oData = $objClsYTDEntry_Details->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsYTDEntry_Details->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=ytdentry_details");
		exit;		
		break;

	default:
		$arrbreadCrumbs['YTD Entry Details'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsYTDEntry_Details->getTableList());
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