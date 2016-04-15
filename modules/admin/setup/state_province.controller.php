<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/state_province.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "state_province.tpl.php"
,"add" => "state_province_form.tpl.php"
,"edit" => "state_province_form.tpl.php"
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
$mainBlock->assign('PageTitle', 'State / Province');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsState_province = new clsState_province($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['State / Province'] = 'setup.php?statpos=state_province';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsState_province->doValidateData($_POST)){
				$objClsState_province->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsState_province->Data);
//				printa($objClsState_province->Data);
			} else {
				$objClsState_province->doPopulateData($_POST);
				$objClsState_province->doSaveAdd();
				header("Location: setup.php?statpos=state_province");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['State / Province'] = 'setup.php?statpos=state_province';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsState_province->doValidateData($_POST)){
				$objClsState_province->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsState_province->Data);
//				printa($objClsState_province->Data);
			} else {
				$objClsState_province->doPopulateData($_POST);
				$objClsState_province->doSaveEdit();
				header("Location: setup.php?statpos=state_province");
				exit;
			}
		}else{
			$oData = $objClsState_province->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsState_province->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=state_province");
		exit;		
		break;

	default:
		$arrbreadCrumbs['State / Province'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsState_province->getTableList());
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