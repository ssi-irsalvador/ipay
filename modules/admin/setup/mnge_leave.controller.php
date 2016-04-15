<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_leave.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mnge_leave.tpl.php"
,"add" => "mnge_leave_form.tpl.php"
,"edit" => "mnge_leave.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => '',
'Libraries' => '',
'Manage Timekeeping Attendance' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Manage Leave Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_Leave = new clsMnge_Leave($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Leave Type'] = 'setup.php?statpos=mnge_leave';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_Leave->doValidateData($_POST)){
				$objClsMnge_Leave->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_Leave->Data);
//				printa($objClsMnge_Leave->Data);
			} else {
				$objClsMnge_Leave->doPopulateData($_POST);
				$objClsMnge_Leave->doSaveAdd();
				header("Location: setup.php?statpos=mnge_leave");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Leave Type'] = 'setup.php?statpos=mnge_leave';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_Leave->doValidateData($_POST)){
				$objClsMnge_Leave->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_Leave->Data);
//				printa($objClsMnge_Leave->Data);
			} else {
				$objClsMnge_Leave->doPopulateData($_POST);
				$objClsMnge_Leave->doSaveEdit();
				header("Location: setup.php?statpos=mnge_leave");
				exit;
			}
		}else{
			$oData = $objClsMnge_Leave->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_Leave->getTableList());
		}
		break;
		
	case "delete":
		$objClsMnge_Leave->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_leave");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Leave Type'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_Leave->doValidateData($_POST)){
				$objClsMnge_Leave->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_Leave->Data);
//				printa($objClsMnge_Leave->Data);
			} else {
				$objClsMnge_Leave->doPopulateData($_POST);
				$objClsMnge_Leave->doSaveAdd();
				header("Location: setup.php?statpos=mnge_leave");
				exit;
			}
		}else{
			$centerPanelBlock->assign('tblDataList',$objClsMnge_Leave->getTableList());
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