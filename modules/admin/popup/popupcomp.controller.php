<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manage_comp.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popupcomp.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Company' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Company');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsManage_Comp = new clsManage_Comp($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Company'] = 'popup.php?statpos=popupcomp';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsManage_Comp->doValidateData($_POST)){
				$objClsManage_Comp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Comp->Data);
//				printa($objClsManage_Comp->Data);
			} else {
				$objClsManage_Comp->doPopulateData($_POST);
				$objClsManage_Comp->doSaveAdd();
				header("Location: popup.php?statpos=popupcomp");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Company'] = 'popup.php?statpos=popupcomp';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsManage_Comp->doValidateData($_POST)){
				$objClsManage_Comp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Comp->Data);
//				printa($objClsManage_Comp->Data);
			} else {
				$objClsManage_Comp->doPopulateData($_POST);
				$objClsManage_Comp->doSaveEdit();
				header("Location: popup.php?statpos=popupcomp");
				exit;
			}
		}else{
			$oData = $objClsManage_Comp->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsManage_Comp->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupcomp");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Company'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManage_Comp->getTableList());
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