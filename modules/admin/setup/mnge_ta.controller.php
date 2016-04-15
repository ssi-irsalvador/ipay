<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_ta.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_ta.tpl.php"
//,"add" => "mnge_ta.tpl.php"
,"edit" => "mnge_ta.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Master Data' => '',
);

$cmapKey = isset($_POST['Submit'])?"add":"default";
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Manage TA');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsMnge_TA = new clsMnge_TA($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage TA'] = 'setup.php?statpos=mnge_ta';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			$objClsMnge_TA->doPopulateData($_POST);
			$objClsMnge_TA->doSaveAdd();
			header("Location: setup.php?statpos=mnge_ta");
			exit;
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage TA'] = 'setup.php?statpos=mnge_ta';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_TA->doValidateData($_POST)){
				$objClsMnge_TA->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_TA->Data);
//				printa($objClsMnge_TA->Data);
			} else {
				$objClsMnge_TA->doPopulateData($_POST);
				$objClsMnge_TA->doSaveEdit();
				header("Location: setup.php?statpos=mnge_ta");
				exit;
			}
		}else{
			$oData = $objClsMnge_TA->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_TA->getTableList());
		}
		break;
		
	case "delete":
		$objClsMnge_TA->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_ta");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage TA'] = "";
		if (count($_POST)>0) {
			$objClsMnge_TA->doPopulateData($_POST);
			$objClsMnge_TA->doSaveAdd();
			header("Location: setup.php?statpos=mnge_ta");
			exit;
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsMnge_TA->getTableList());
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