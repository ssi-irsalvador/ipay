<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/region.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "region.tpl.php "
,"add" => "region_form.tpl.php"
,"edit" => "region_form.tpl.php"
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
$mainBlock->assign('PageTitle', 'Region');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsRegion = new clsRegion($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Region'] = 'setup.php?statpos=region';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsRegion->doValidateData($_POST)) {
				$objClsRegion->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRegion->Data);
//				printa($objClsRegion->Data);
			} else {
				$objClsRegion->doPopulateData($_POST);
				$objClsRegion->doSaveAdd();
				header("Location: setup.php?statpos=region");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Region'] = 'setup.php?statpos=region';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsRegion->doValidateData($_POST)){
				$objClsRegion->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsRegion->Data);
//				printa($objClsRegion->Data);
			} else {
				$objClsRegion->doPopulateData($_POST);
				$objClsRegion->doSaveEdit();
				header("Location: setup.php?statpos=region");
				exit;
			}
		}else{
			$oData = $objClsRegion->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsRegion->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=region");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Region'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsRegion->getTableList());
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