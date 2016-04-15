<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_te.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_te.tpl.php"
,"add" => "mnge_te_form.tpl.php"
,"edit" => "mnge_te.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => '',
'Manage Income Tax' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Tax Employer');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_TE = new clsMnge_TE($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Tax Employer'] = 'setup.php?statpos=mnge_te';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			//print "<script>alert('".$_GET['action']."');</script>";
			// save add new
			if(!$objClsMnge_TE->doValidateData($_POST)){
				$objClsMnge_TE->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_TE->Data);
//				printa($objClsMnge_TE->Data);
			} else {
				$objClsMnge_TE->doPopulateData($_POST);
				$objClsMnge_TE->doSaveAdd();
				header("Location: setup.php?statpos=mnge_te");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Tax Employer'] = 'setup.php?statpos=mnge_te';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_TE->doValidateData($_POST)){
				$objClsMnge_TE->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_TE->Data);
//				printa($objClsMnge_TE->Data);
			} else {
				$objClsMnge_TE->doPopulateData($_POST);
				$objClsMnge_TE->doSaveEdit();
				header("Location: setup.php?statpos=mnge_te");
				exit;
			}
		}else{
			$oData = $objClsMnge_TE->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_TE->getTableList());
		}
		break;
		
	case "delete":
		$objClsMnge_TE->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_te");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Tax Employer'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_TE->doValidateData($_POST)){
				$objClsMnge_TE->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_TE->Data);
//				printa($objClsMnge_TE->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_TE->getTableList());
			} else {
				$objClsMnge_TE->doPopulateData($_POST);
				$objClsMnge_TE->doSaveAdd();
				header("Location: setup.php?statpos=mnge_te");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsMnge_TE->getTableList());
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