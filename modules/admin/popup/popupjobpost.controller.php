<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/jobpost.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popupjobpost.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Popup Job Position' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Job Post');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsJobPost = new clsJobPost($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Job Post'] = 'popup.php?statpos=popupjobpost';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsJobPost->doValidateData($_POST)){
				$objClsJobPost->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsJobPost->Data);
//				printa($objClsJobPost->Data);
			}else {
				$objClsJobPost->doPopulateData($_POST);
				$objClsJobPost->doSaveAdd();
				header("Location: popup.php?statpos=popupjobpost");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Job Post'] = 'popup.php?statpos=popupjobpost';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsJobPost->doValidateData($_POST)){
				$objClsJobPost->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsJobPost->Data);
//				printa($objClsJobPost->Data);
			}else {
				$objClsJobPost->doPopulateData($_POST);
				$objClsJobPost->doSaveEdit();
				header("Location: popup.php?statpos=popupjobpost");
				exit;
			}
		}else{
			$oData = $objClsJobPost->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsJobPost->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupjobpost");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Job Post'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsJobPost->getTableList());
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