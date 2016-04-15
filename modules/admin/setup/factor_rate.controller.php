<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/factor_rate.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "factor_rate.tpl.php"
,"add" => "factor_rate_form.tpl.php"
,"edit" => "factor_rate.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Factor Rate');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsFactor_Rate = new clsFactor_Rate($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign("wrate",$objClsFactor_Rate->GetWageRate());
switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Factor Rate'] = 'setup.php?statpos=factor_rate';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsFactor_Rate->doValidateData($_POST)){
				$objClsFactor_Rate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFactor_Rate->Data);
//				printa($objClsFactor_Rate->Data);
			} else {
				$objClsFactor_Rate->doPopulateData($_POST);
				$objClsFactor_Rate->doSaveEdit();
				header("Location: setup.php?statpos=factor_rate");
				exit;
			}
		}else{
			$oData = $objClsFactor_Rate->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsFactor_Rate->getTableList());
		}
		break;
	case "delete":
		$objClsFactor_Rate->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=factor_rate");
		exit;		
		break;
	default:
		$arrbreadCrumbs['Factor Rate'] = "";
		
		if (count($_POST)>0) {
			// save add new
			if(!$objClsFactor_Rate->doValidateData($_POST)){
				$objClsFactor_Rate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFactor_Rate->Data);
//				printa($objClsFactor_Rate->Data);
				$centerPanelBlock->assign('tblDataList',$objClsFactor_Rate->getTableList());
			} else {
				$objClsFactor_Rate->doPopulateData($_POST);
				$objClsFactor_Rate->doSaveAdd();
				header("Location: setup.php?statpos=factor_rate");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsFactor_Rate->getTableList());
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