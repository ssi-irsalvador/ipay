<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/country.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "country.tpl.php"
,"add" => "country_form.tpl.php"
,"edit" => "country_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => '',
'Libraries' => '',
'General' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Country');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsCountry = new clsCountry($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Country'] = 'setup.php?statpos=country';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsCountry->doValidateData($_POST)){
				$objClsCountry->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCountry->Data);
//				printa($objClsCountry->Data);
			} else {
				$objClsCountry->doPopulateData($_POST);
				$objClsCountry->doSaveAdd();
				header("Location: setup.php?statpos=country");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Country'] = 'setup.php?statpos=country';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsCountry->doValidateData($_POST)){
				$objClsCountry->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCountry->Data);
//				printa($objClsCountry->Data);
			} else {
				$objClsCountry->doPopulateData($_POST);
				$objClsCountry->doSaveEdit();
				header("Location: setup.php?statpos=country");
				exit;
			}
		}else{
			$oData = $objClsCountry->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsCountry->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=country");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Country'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsCountry->getTableList());
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