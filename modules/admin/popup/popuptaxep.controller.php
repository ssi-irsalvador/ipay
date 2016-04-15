<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/tax_excep.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "popuptaxep.tpl.php"
,"add" => ""
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Change This!!!' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Popup Tax Exception');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsTax_Excep = new clsTax_Excep($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Popup Tax Exception'] = 'popup.php?statpos=popuptaxep';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTax_Excep->doValidateData($_POST)){
				$objClsTax_Excep->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTax_Excep->Data);
//				printa($obj->Data);
			}else {
				$objClsTax_Excep->doPopulateData($_POST);
				$objClsTax_Excep->doSaveAdd();
				header("Location: popup.php?statpos=popuptaxep");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Popup Tax Exception'] = 'popup.php?statpos=popuptaxep';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTax_Excep->doValidateData($_POST)){
				$objClsTax_Excep->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTax_Excep->Data);
//				printa($obj->Data);
			}else {
				$objClsTax_Excep->doPopulateData($_POST);
				$objClsTax_Excep->doSaveEdit();
				header("Location: popup.php?statpos=popuptaxep");
				exit;
			}
		}else{
			$oData = $obj->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsTax_Excep->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptaxep");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Popup Tax Exception'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsTax_Excep->getTableList());
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