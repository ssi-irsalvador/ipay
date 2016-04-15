<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/manage_user.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/application_form.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
require_once(SYSCONFIG_ROOT_PATH.'helpers/encryption.helper.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "manage_user.tpl.php",
"add" => "manage_user_form.tpl.php",
"edit" => "manage_user_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Master Data' => '',
'Manage Access Level' => '',
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

//get the employee picture
if (isset($_GET['img'])) {
	$sql = "select user_picture from payroll_db.app_users where user_id = ?";
	$rsResult = $dbconn->Execute($sql,array($_GET['img']));
//	exit;
	if (!$rsResult->EOF) {
		if (!empty($rsResult->fields['user_picture'])){
				header("Content-type: image/jpeg");
				print $rsResult->fields['user_picture'];
		} else {
			header("Content-type: image/jpeg");
			echo file_get_contents(SYSCONFIG_THEME_PATH.SYSCONFIG_THEME."/images/nopic.PNG");
		}
	}
	exit;
}

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle' ,'Manage User');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsManageUser = new clsManageUser($dbconn);
$objClsApplication_Form = new clsApplication_Form($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

$centerPanelBlock->assign("lstUserDept",$objClsManageUser->getCompanyList());
$centerPanelBlock->assign("lstBranch",$objClsManageUser->getBranchList());
$centerPanelBlock->assign("lst201Stat",$objClsManageUser->get201StatList());
$centerPanelBlock->assign("lstPayGroup",$objClsManageUser->getPayGroupList());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage User'] = 'setup.php?statpos=manageuser';
		$arrbreadCrumbs['Add New'] = "";
		$centerPanelBlock->assign("lstStatus",$arrStatus);
		$centerPanelBlock->assign("lstUserType",$objClsManageUser->getUserTypes());
		$centerPanelBlock->assign("lstDepartment",$objClsManageUser->getDepartment());
		$centerPanelBlock->assign("lstActiveEmployees",$objClsManageUser->getActiveEmployeeList());
		if (count($_POST)>0) {
			// save add new
			if(!$objClsManageUser->doValidateData($_POST)){
				$objClsManageUser->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManageUser->Data);
			} else {
				$objClsManageUser->doPopulateData($_POST);
				$objClsManageUser->doSaveAdd();
				header("Location: setup.php?statpos=manageuser");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Manage User'] = 'setup.php?statpos=manageuser';
		$arrbreadCrumbs['Edit'] = "";
		$centerPanelBlock->assign("lstStatus",$arrStatus);
		$centerPanelBlock->assign("lstUserType",$objClsManageUser->getUserTypes());
		$centerPanelBlock->assign("lstDepartment",$objClsManageUser->getDepartment());
		$centerPanelBlock->assign("lstPayGroup",$objClsManageUser->getPayGroupList());
		$centerPanelBlock->assign("lstActiveEmployees",$objClsManageUser->getActiveEmployeeList());
		if (count($_POST)>0) {
			// update
			if(!$objClsManageUser->doValidateData($_POST)){
				$objClsManageUser->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsManageUser->Data);
			} else {
				$sendTest = TRUE;
				if($_POST['test_email'] == 'test'){
					$sendTest = $objClsManageUser->sendEmail($_POST);
				}
				if($sendTest){
					$objClsManageUser->doPopulateData($_POST);
					$objClsManageUser->doSaveEdit();
				}
				header("Location: setup.php?statpos=manageuser");
				exit;
			}
		}else{
			$oData = $objClsManageUser->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "delete":
		$objClsManageUser->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=manageuser");
		exit;
		break;
	default:
		$arrbreadCrumbs['Manage User'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsManageUser->getTableList());
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