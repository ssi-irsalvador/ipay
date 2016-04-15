<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/comptype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "comptype.tpl.php"
,"add" => "comptype_form.tpl.php"
,"edit" => "comptype.tpl.php"
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
$mainBlock->assign('PageTitle', 'Company Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsCompType = new clsCompType($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Company Type'] = 'setup.php?statpos=comptype';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsCompType->doValidateData($_POST)){
				$objClsCompType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompType->Data);
//				printa($objClsCompType->Data);
			} else {
				$objClsCompType->doPopulateData($_POST);
				$objClsCompType->doSaveAdd();
				header("Location: setup.php?statpos=comptype");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Company Type'] = 'setup.php?statpos=comptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsCompType->doValidateData($_POST)){
				$objClsCompType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompType->Data);
//				printa($objClsCompType->Data);
			} else {
				$objClsCompType->doPopulateData($_POST);
				$objClsCompType->doSaveEdit();
				header("Location: setup.php?statpos=comptype");
				exit;
			}
		}else{
			$oData = $objClsCompType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsCompType->getTableList());
		}
		break;
		
	case "delete":
		$objClsCompType->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=comptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Company Type'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsCompType->doValidateData($_POST)){
				$objClsCompType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompType->Data);
//				printa($objClsCompType->Data);
				$centerPanelBlock->assign('tblDataList',$objClsCompType->getTableList());
			}else {
				$objClsCompType->doPopulateData($_POST);
				$objClsCompType->doSaveAdd();
				header("Location: setup.php?statpos=comptype");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsCompType->getTableList());
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