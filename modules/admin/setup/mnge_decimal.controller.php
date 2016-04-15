<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_decimal.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/compbanks.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_decimal.tpl.php"
,"add" => "mnge_decimal_form.tpl.php"
,"edit" => "mnge_decimal_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Master Data' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','General Setup');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMngeDecimal = new clsMngeDecimal($dbconn);
$objClsCompBanks = new clsCompBanks($dbconn);

switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['General Setup'] = 'setup.php?statpos=manage_decimal';
		$arrbreadCrumbs['Edit'] = "";
//		$centerPanelBlock->assign("decimalVal",$objClsMngeDecimal->getDecimalValues());
		if (count($_POST)>0) {
			// update
			if(!$objClsMngeDecimal->doValidateData($_POST)){
				$objClsMngeDecimal->doPopulateData($_POST);
				//$centerPanelBlock->assign("oData",$objClsMngeDecimal->Data);
//				printa($objClsMngeDecimal->Data);
			}else {
				//$objClsMngeDecimal->doPopulateData($_POST);
				$objClsMngeDecimal->doUpdate($_POST);
				header("Location: setup.php?statpos=manage_decimal");
				exit;
			}
		}
		$oData = $objClsMngeDecimal->dbFetch($_GET['edit']);
//			printa($oData); exit;
			$centerPanelBlock->assign("decimalVal",$oData);
			$centerPanelBlock->assign('oDatacomp',$objClsCompBanks->dbFetch_Company($_GET['edit']));
			$centerPanelBlock->assign("getTaxTableList",$objClsMngeDecimal->getTaxTableList());
			$centerPanelBlock->assign("getStatSSSList",$objClsMngeDecimal->getStatutoryTableList(1));
			$centerPanelBlock->assign("getStatPHICList",$objClsMngeDecimal->getStatutoryTableList(2));
			$centerPanelBlock->assign("getStatHDMFList",$objClsMngeDecimal->getStatutoryTableList(3));
		break;
	case "delete":
		$objClsMngeDecimal->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=manage_decimal");
		exit;		
		break;
	default:
		$arrbreadCrumbs['General Setup'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMngeDecimal->getTableList());
//		$centerPanelBlock->assign("decimalVal",$objClsMngeDecimal->getDecimalValues());
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