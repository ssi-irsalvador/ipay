<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/for_hire.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "for_hire.tpl.php"
,"add" => "for_hire_form.tpl.php"
,"edit" => "for_hire_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
,'Employee Master File' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

//get the employee picture
if (isset($_GET['img'])) {
	$sql = "select emp_picture from emp_masterfile where emp_id = ?";
	$rsResult = $dbconn->Execute($sql,array($_GET['img']));
//	exit;
	if (!$rsResult->EOF) {
		if (!empty($rsResult->fields['emp_picture'])){
				header("Content-type: image/jpeg");
				print $rsResult->fields['emp_picture'];
		}else {
			header("Content-type: image/jpeg");
			echo file_get_contents(SYSCONFIG_THEME_PATH.SYSCONFIG_THEME."/images/nopic.PNG");
		}
	}
	exit;
}

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','For Hire');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsFor_Hire = new clsFor_Hire($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

$centerPanelBlock->assign('departments',$objClsEMP_MasterFile->departments());
$centerPanelBlock->assign('comp',$objClsEMP_MasterFile->comp());
$centerPanelBlock->assign('emptype',$objClsEMP_MasterFile->emptype());
$centerPanelBlock->assign('empcateg',$objClsEMP_MasterFile->empcateg());
$centerPanelBlock->assign('empstat_',$objClsEMP_MasterFile->empstat());
$centerPanelBlock->assign('position',$objClsEMP_MasterFile->position());
$centerPanelBlock->assign("taxep",$objClsEMP_MasterFile->tax_exemption());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['For Hire'] = 'transaction.php?statpos=for_hire';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsFor_Hire->doValidateData($_POST)){
				$objClsFor_Hire->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFor_Hire->Data);
//				printa($objClsFor_Hire->Data);
			}else {
				$objClsFor_Hire->doPopulateData($_POST);
				$objClsFor_Hire->doSaveAdd();
				header("Location: transaction.php?statpos=for_hire");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['For Hire'] = 'transaction.php?statpos=for_hire';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsFor_Hire->doValidateData($_POST)){
				$objClsFor_Hire->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsFor_Hire->Data);
//				printa($objClsFor_Hire->Data);
			}else {
				$objClsFor_Hire->doPopulateData($_POST);
				$objClsFor_Hire->doSaveEdit();
				header("Location: transaction.php?statpos=for_hire");
				exit;
			}
		}else{
			$oData = $objClsFor_Hire->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsFor_Hire->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=for_hire");
		exit;		
		break;

	default:
		$arrbreadCrumbs['For Hire'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsFor_Hire->getTableList());
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