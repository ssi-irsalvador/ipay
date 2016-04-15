<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/empcateg.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popupcateg.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Popup Category' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Category');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsEMPCateg = new clsEMPCateg ($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PopupCateg'] = 'popup.php?statpos=popupcateg';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsEMPCateg->doValidateData($_POST)){
				$objClsEMPCateg->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPCateg->Data);
//				printa($objClsEMPCateg->Data);
			}else {
				$objClsEMPCateg->doPopulateData($_POST);
				$objClsEMPCateg->doSaveAdd();
				header("Location: popup.php?statpos=popupcateg");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['PopupCateg'] = 'popup.php?statpos=popupcateg';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsEMPCateg->doValidateData($_POST)){
				$objClsEMPCateg->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPCateg->Data);
//				printa($objClsEMPCateg->Data);
			}else {
				$objClsEMPCateg->doPopulateData($_POST);
				$objClsEMPCateg->doSaveEdit();
				header("Location: popup.php?statpos=popupcateg");
				exit;
			}
		}else{
			$oData = $objClsEMPCateg->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsEMPCateg->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popupcateg");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupCateg'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsEMPCateg->getTableList());
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