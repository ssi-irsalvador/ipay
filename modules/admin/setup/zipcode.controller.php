<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/zipcode.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "zipcode.tpl.php"
,"add" => "zipcode_form.tpl.php"
,"edit" => "zipcode_form.tpl.php"
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
$mainBlock->assign('PageTitle', 'Zip Codes');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsZipCode = new clsZipCode($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Zip Codes'] = 'setup.php?statpos=zipcode';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsZipCode->doValidateData($_POST)){
				$objClsZipCode->doPopulateData($_POST);
				$centerPanelBlock->assign("oData", $objClsZipCode->Data);
//				printa($objClsZipCode->Data);
			} else {
				$objClsZipCode->doPopulateData($_POST);
				$objClsZipCode->doSaveAdd();
				header("Location: setup.php?statpos=zipcode");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Zip Codes'] = 'setup.php?statpos=zipcode';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsZipCode->doValidateData($_POST)){
				$objClsZipCode->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsZipCode->Data);
//				printa($objClsZipCode->Data);
			} else {
				$objClsZipCode->doPopulateData($_POST);
				$objClsZipCode->doSaveEdit();
				header("Location: setup.php?statpos=zipcode");
				exit;
			}
		}else{
			$oData = $objClsZipCode->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsZipCode->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=zipcode");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Zip Codes'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsZipCode->getTableList());
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