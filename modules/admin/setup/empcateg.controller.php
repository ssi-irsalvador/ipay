<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/empcateg.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "empcateg.tpl.php"
,"add" => "empcateg_form.tpl.php "
,"edit" => "empcateg.tpl.php"
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
$mainBlock->assign('PageTitle', 'Employee Category');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsEMPCateg = new clsEMPCateg($dbconn);

switch ($cmapKey) {
	case 'add': 
		$mainBlock->templateFile = "index_popup.tpl.php";
		$arrbreadCrumbs['Employee Category'] = 'setup.php?statpos=empcateg';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsEMPCateg->doValidateData($_POST)) {
				$objClsEMPCateg->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPCateg->Data);
//				printa($objClsEMPCateg->Data);
			} else {
				$objClsEMPCateg->doPopulateData($_POST);
				$objClsEMPCateg->doSaveAdd();
				header("Location: setup.php?statpos=empcateg");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Employee Category'] = 'setup.php?statpos=empcateg';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if (!$objClsEMPCateg->doValidateData($_POST)) {
				$objClsEMPCateg->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPCateg->Data);
//				printa($objClsEMPCateg->Data);
			} else {
				$objClsEMPCateg->doPopulateData($_POST);
				$objClsEMPCateg->doSaveEdit();
				header("Location: setup.php?statpos=empcateg");
				exit;
			}
		} else {
			$oData = $objClsEMPCateg->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsEMPCateg->getTableList());
		}
		break;
		
	case "delete":
		$objClsEMPCateg->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=empcateg");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Employee Category'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsEMPCateg->doValidateData($_POST)) {
				$objClsEMPCateg->doPopulateData($_POST);
				$centerPanelBlock->assign("oData", $objClsEMPCateg->Data);
//				printa($objClsEMPCateg->Data);
				$centerPanelBlock->assign('tblDataList',$objClsEMPCateg->getTableList());
			} else {
				$objClsEMPCateg->doPopulateData($_POST);
				$objClsEMPCateg->doSaveAdd();
				header("Location: setup.php?statpos=empcateg");
				exit;
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsEMPCateg->getTableList());
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