<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_calen.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_calen.tpl.php"
,"add" => "mnge_calen_form.tpl.php"
,"edit" => "mnge_calen_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Calendar');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_Calen = new clsMnge_Calen($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Calendar'] = 'setup.php?statpos=mnge_calen';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_Calen->doValidateData($_POST)){
				$objClsMnge_Calen->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_Calen->Data);
//				printa($objClsMnge_Calen->Data);
			}else {
				$objClsMnge_Calen->doPopulateData($_POST);
				$objClsMnge_Calen->doSaveAdd();
				header("Location: setup.php?statpos=mnge_calen");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Calendar'] = 'setup.php?statpos=mnge_calen';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_Calen->doValidateData($_POST)){
				$objClsMnge_Calen->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_Calen->Data);
//				printa($objClsMnge_Calen->Data);
			}else {
				$objClsMnge_Calen->doPopulateData($_POST);
				$objClsMnge_Calen->doSaveEdit();
				header("Location: setup.php?statpos=mnge_calen");
				exit;
			}
		}else{
			$oData = $objClsMnge_Calen->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsMnge_Calen->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_calen");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Calendar'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_Calen->getTableList());
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