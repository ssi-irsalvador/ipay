<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/201file_review.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "201file_review.tlp.php"
,"add" => "201file_review_form.tpl.php"
,"edit" => "201file_review_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','201 File Review');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objCls201File_Review = new cls201File_Review($dbconn);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['201 Review'] = 'transaction.php?statpos=201file_review';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objCls201File_Review->doValidateData($_POST)){
				$objCls201File_Review->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls201File_Review->Data);
//				printa($objCls201File_Review->Data);
			}else {
				$objCls201File_Review->doPopulateData($_POST);
				$objCls201File_Review->doSaveAdd();
				header("Location: transaction.php?statpos=201file_review");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['201 Review'] = 'transaction.php?statpos=201file_review';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objCls201File_Review->doValidateData($_POST)){
				$objCls201File_Review->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls201File_Review->Data);
//				printa($objCls201File_Review->Data);
			}else {
				$objCls201File_Review->doPopulateData($_POST);
				$objCls201File_Review->doSaveEdit();
				header("Location: transaction.php?statpos=201file_review");
				exit;
			}
		}else{
			$oData = $objCls201File_Review->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objCls201File_Review->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=201file_review");
		exit;		
		break;
	default:
		$arrbreadCrumbs['201 Review'] = "";
		$centerPanelBlock->assign('tblDataList',$objCls201File_Review->getTableList());
		$centerPanelBlock->assign('lstemp201status',$objCls201File_Review->emp201status());
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