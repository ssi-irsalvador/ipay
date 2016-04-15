<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/taxpol.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "taxpol.tpl.php"
,"edit" => "taxpol_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => '',
'Manage Income Tax' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Tax Policy');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsTaxPol = new clsTaxPol($dbconn);

switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Tax Policy'] = 'setup.php?statpos=taxpol';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTaxPol->doValidateData($_POST)){
				$objClsTaxPol->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTaxPol->Data);
//				printa($objClsTaxPol->Data);
			}else {
				$objClsTaxPol->doPopulateData($_POST);
				$objClsTaxPol->doSaveEdit();
				header("Location: setup.php?statpos=taxpol");
				exit;
			}
		}else{
			$oData = $objClsTaxPol->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	default:
		$arrbreadCrumbs['Tax Policy'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsTaxPol->getTableList());
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