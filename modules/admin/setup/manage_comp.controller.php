<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manage_comp.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "manage_comp.tpl.php"
,"add" => "manage_comp_form.tpl.php"
,"edit" => "manage_comp_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => '',
'Libraries' => '',
'Manage Company' => '',
'Company Profile' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Company Profile');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsManage_Comp = new clsManage_Comp($dbconn);

$centerPanelBlock->assign('comptype',$objClsManage_Comp->comptype());

switch ($cmapKey) {
	case 'add': 
		if ($_GET['popadd']==1) {
			$mainBlock->templateFile = "index_popup.tpl.php";
		}
		$arrbreadCrumbs['Company Profile'] = 'setup.php?statpos=manage_comp';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsManage_Comp->doValidateData($_POST)) {
				$objClsManage_Comp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Comp->Data);
//				printa($objClsManage_Comp->Data);
			} else {
				$objClsManage_Comp->doPopulateData($_POST);
				$objClsManage_Comp->doSaveAdd();
				header("Location: setup.php?statpos=manage_comp");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Company Profile'] = 'setup.php?statpos=manage_comp';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsManage_Comp->doValidateData($_POST)){
				$objClsManage_Comp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManage_Comp->Data);
//				printa($objClsManage_Comp->Data);
			} else {
				$objClsManage_Comp->doPopulateData($_POST);
				$objClsManage_Comp->doSaveEdit($_GET['edit']);
				header("Location: setup.php?statpos=manage_comp");
				exit;
			}
		}else{
			$oData = $objClsManage_Comp->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsManage_Comp->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=manage_comp");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Company'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManage_Comp->getTableList());
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