<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pe.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$dbconn->debug=0;
$cmap = array(
"default" => "mnge_pe.tpl.php"
,"add" => "mnge_pe_form.tpl.php"
,"edit" => "mnge_pe_form.tpl.php"
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
$mainBlock->assign('PageTitle', 'Manage Pay Element');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign("typePSAccnt",$typePSAccnt);
$centerPanelBlock->assign("clsfiPSAccnt",$clsfiPSAccnt);
$centerPanelBlock->assign("typeStat",$typeStat);
$centerPanelBlock->assign("propertycode",$propertycode);

$objClsMnge_PE = new clsMnge_PE($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Pay Element'] = 'setup.php?statpos=mnge_pe';
		$arrbreadCrumbs['Add New'] = "";
		$centerPanelBlock->assign("getPrio",$objClsMnge_PE->getPrio());
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_PE->doValidateData($_POST)){
				$objClsMnge_PE->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PE->Data);
			} else {
				$objClsMnge_PE->doPopulateData($_POST);
				$objClsMnge_PE->doSaveAdd();
				header("Location: setup.php?statpos=mnge_pe");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Manage Pay Element'] = 'setup.php?statpos=mnge_pe';
		$arrbreadCrumbs['Edit'] = "";
		
		$centerPanelBlock->assign("getPrio",$objClsMnge_PE->getPrio($_GET['edit']));
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_PE->doValidateData($_POST)){
				$objClsMnge_PE->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PE->Data);
				$centerPanelBlock->assign("formula",$objClsMnge_PE->getFormula($oData['psa_name']));
				$centerPanelBlock->assign("kWords",$objClsMnge_PE->getKeywords());
				$centerPanelBlock->assign("showF",$objClsMnge_PE->validateFormula($_GET['edit']));
			} else {
				$objClsMnge_PE->doPopulateData($_POST);
				$objClsMnge_PE->doSaveEdit();
				header("Location: setup.php?statpos=mnge_pe");
				exit;
			}
		}else{
			$oData = $objClsMnge_PE->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign("formula",$objClsMnge_PE->getFormula($oData['psa_name']));
			$centerPanelBlock->assign("kWords",$objClsMnge_PE->getKeywords());
			$centerPanelBlock->assign("showF",$objClsMnge_PE->validateFormula($_GET['edit']));
		}
		break;
	case "delete":
		$objClsMnge_PE->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_pe");
		exit;		
		break;
	default:
		$arrbreadCrumbs['Manage Pay Element'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_PE->getTableList());
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