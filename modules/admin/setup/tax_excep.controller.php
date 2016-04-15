<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/tax_excep.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "tax_excep.tpl.php"
,"add" => "tax_excep_form.tpl.php"
,"edit" => "tax_excep.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
 'Setup' => ''
,'Libraries' => ''
,'Manage 201' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Tax Exemption');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsTax_Excep = new clsTax_Excep($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Tax Exemption'] = 'setup.php?statpos=tax_excep';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTax_Excep->doValidateData($_POST)){
				$objClsTax_Excep->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTax_Excep->Data);
//				printa($objClsTax_Excep->Data);
			} else {
				$objClsTax_Excep->doPopulateData($_POST);
				$objClsTax_Excep->doSaveAdd();
				header("Location: setup.php?statpos=tax_excep");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Tax Exemption'] = 'setup.php?statpos=tax_excep';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTax_Excep->doValidateData($_POST)){
				$objClsTax_Excep->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTax_Excep->Data);
//				printa($objClsTax_Excep->Data);
			} else {
				$objClsTax_Excep->doPopulateData($_POST);
				$objClsTax_Excep->doSaveEdit();
				header("Location: setup.php?statpos=tax_excep");
				exit;
			}
		}else{
			$oData = $objClsTax_Excep->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsTax_Excep->getTableList());
		}
		break;
		
	case "delete":
		$objClsTax_Excep->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=tax_excep");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Tax Exemption'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTax_Excep->doValidateData($_POST)){
				$objClsTax_Excep->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTax_Excep->Data);
//				printa($objClsTax_Excep->Data);
				$centerPanelBlock->assign('tblDataList',$objClsTax_Excep->getTableList());
			} else {
				$objClsTax_Excep->doPopulateData($_POST);
				$objClsTax_Excep->doSaveAdd();
				header("Location: setup.php?statpos=tax_excep");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsTax_Excep->getTableList());
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