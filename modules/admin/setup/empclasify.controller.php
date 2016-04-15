<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/empclasify.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "empclasify.tpl.php"
,"add" => "empclasify.tpl.php"
,"edit" => "empclasify.tpl.php"
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
$mainBlock->assign('PageTitle','Classification');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsEmpClasify = new clsEmpClasify($dbconn);

switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Classification'] = 'setup.php?statpos=empclasify';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsEmpClasify->doValidateData($_POST)){
				$objClsEmpClasify->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEmpClasify->Data);
//				printa($objClsEmpClasify->Data);
			}else {
				$objClsEmpClasify->doPopulateData($_POST);
				$objClsEmpClasify->doSaveEdit();
				header("Location: setup.php?statpos=empclasify");
				exit;
			}
		}else{
			$oData = $objClsEmpClasify->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsEmpClasify->getTableList());
		}
		break;
		
	case "delete":
		$objClsEmpClasify->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=empclasify");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Classification'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsEmpClasify->doValidateData($_POST)){
				$objClsEmpClasify->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEmpClasify->Data);
//				printa($objClsEmpClasify->Data);
			}else {
				$objClsEmpClasify->doPopulateData($_POST);
				$objClsEmpClasify->doSaveAdd();
				header("Location: setup.php?statpos=empclasify");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsEmpClasify->getTableList());
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