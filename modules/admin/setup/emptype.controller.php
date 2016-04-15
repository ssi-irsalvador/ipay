<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/emptype.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "emptype.tpl.php"
,"add" => "emptype_form.tpl.php"
,"edit" => "emptype.tpl.php"
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
$mainBlock->assign('PageTitle', 'Employee Type');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsEMPType = new clsEMPType($dbconn);

$centerPanelBlock->assign('classify',$objClsEMPType->dbfetchClassification());
switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['Employee Type'] = 'setup.php?statpos=emptype';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if (!$objClsEMPType->doValidateData($_POST)) {
				$objClsEMPType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPType->Data);
			} else {
				$objClsEMPType->doPopulateData($_POST);
				$objClsEMPType->doSaveEdit();
				header("Location: setup.php?statpos=emptype");
				exit;
			}
		}else{
			$oData = $objClsEMPType->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsEMPType->getTableList());
		}
		break;
		
	case "delete":
		$objClsEMPType->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=emptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Employee Type'] = "";
		
		if (count($_POST)>0) {
			// save add new
			if (!$objClsEMPType->doValidateData($_POST)) {
				$objClsEMPType->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsEMPType->Data);
				$centerPanelBlock->assign('tblDataList',$objClsEMPType->getTableList());
			} else {
				$objClsEMPType->doPopulateData($_POST);
				$objClsEMPType->doSaveAdd();
				header("Location: setup.php?statpos=emptype");
				exit;
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsEMPType->getTableList());
		}
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

/*-!-!-!-!-!-!-!-!-*/

$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();


?>