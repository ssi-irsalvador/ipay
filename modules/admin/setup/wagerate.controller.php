<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/wagerate.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "wagerate.tpl.php"
,"add" => "wagerate_form.tpl.php"
,"edit" => "wagerate.tpl.php"
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
$mainBlock->assign('PageTitle','Wage Rate');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsWageRate = new clsWageRate($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign("region",$objClsWageRate->GetRegion());
switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Wage Rate'] = 'setup.php?statpos=wagerate';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsWageRate->doValidateData($_POST)){
				$objClsWageRate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsWageRate->Data);
//				printa($objClsWageRate->Data);
			}else {
				$objClsWageRate->doPopulateData($_POST);
				$objClsWageRate->doSaveEdit();
				header("Location: setup.php?statpos=wagerate");
				exit;
			}
		}else{
			$oData = $objClsWageRate->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsWageRate->getTableList());
		}
		break;
	case "delete":
		$objClsWageRate->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=wagerate");
		exit;		
		break;
	default:
		$arrbreadCrumbs['Wage Rate'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsWageRate->doValidateData($_POST)) {
				$objClsWageRate->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsWageRate->Data);
				$centerPanelBlock->assign('tblDataList',$objClsWageRate->getTableList());
//				printa($objClsWageRate->Data);
			} else {
				$objClsWageRate->doPopulateData($_POST);
				$objClsWageRate->doSaveAdd();
				header("Location: setup.php?statpos=wagerate");
				exit;
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsWageRate->getTableList());
		}
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

/*-!-!-!-!-!-!-!-!-*/
$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>