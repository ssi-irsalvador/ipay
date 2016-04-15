<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/compbanks.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;

$cmap = array(
"default" => "compbanks.tpl.php"
,"add" => "compbanks_form.tpl.php"
,"edit" => "compbanks_form.tpl.php"
,"view" => "compbanks_form.tpl.php"
,"empinput" => "compbanks_emp.tpl.php"
,"empinput_add" => "compbanks_emp_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => ''
,'Master Data' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['view'])?"view":$cmapKey;
$cmapKey = isset($_GET['empinput'])?"empinput":$cmapKey;
$cmapKey = isset($_GET['empinput_add'])?"empinput_add":$cmapKey;
$cmapKey = isset($_GET['empinput_del'])?"empinput_del":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle' ,'Manage Bank');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsCompBanks = new clsCompBanks($dbconn);

$centerPanelBlock->assign("lstStatus",$arrStatus);
$centerPanelBlock->assign('bnkaccntype',$objClsCompBanks->bnkaccntype());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Bank'] = 'setup.php?statpos=compbanks';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsCompBanks->doValidateData($_POST)) {
				$objClsCompBanks->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompBanks->Data);
//				printa($objClsCompBanks->Data);
			} else {
				$objClsCompBanks->doPopulateData($_POST);
				$objClsCompBanks->doSaveAdd();
				header("Location: setup.php?statpos=compbanks");
				exit;
			}
		}
		break;
		
	case 'empinput_add': 
		$arrbreadCrumbs['Manage Bank'] = 'setup.php?statpos=compbanks';
		$arrbreadCrumbs['View'] = "setup.php?statpos=compbanks&view=".$_GET['view'];
		$arrbreadCrumbs['Employee Selection'] = 'setup.php?statpos=compbanks&view='.$_GET['view'].'&empinput='.$_GET['empinput'].'&bank='.$_GET['bank'];
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			if (isset($_POST['btn_saveEmployee'])){
				// save add new
				if(!$objClsCompBanks->doValidateData_emp($_POST)){
					$objClsCompBanks->doPopulateData($_POST);
					$centerPanelBlock->assign("oData",$objClsCompBanks->Data);
	//				printa($objClsRecurringPSAmend->Data);
					$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList_Emp($_GET));
				} else {
					$objClsCompBanks->doPopulateData($_POST);
					$objClsCompBanks->doSaveEmployee($_POST);
					header("Location: setup.php?statpos=compbanks&view=".$_GET['view']."&empinput=".$_GET['empinput']."&bank=".$_GET['bank']);
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList_Emp($_GET));
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList_Emp($_GET));
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Bank'] = 'setup.php?statpos=compbanks';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if (!$objClsCompBanks->doValidateData($_POST)) {
				$objClsCompBanks->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompBanks->Data);
				$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList($_GET['view']));
				$centerPanelBlock->assign('oDatacomp',$objClsCompBanks->dbFetch_Company($_GET['view']));
//				printa($objClsCompBanks->Data);
			} else {
				$objClsCompBanks->doPopulateData($_POST);
				$objClsCompBanks->doSaveEdit($_GET['edit'],$_GET['view_']);
				header("Location: setup.php?statpos=compbanks&view".$_GET['view_']);
				exit;
			}
		} else {
			$oData = $objClsCompBanks->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList($_GET['view_']));
			$centerPanelBlock->assign('oDatacomp',$objClsCompBanks->dbFetch_Company($_GET['view_']));
		}
		break;
	
	case 'view':
		$arrbreadCrumbs['Manage Bank'] = 'setup.php?statpos=compbanks';
		$arrbreadCrumbs['View'] = "";
		if (count($_POST)>0) {
			// update
			if (!$objClsCompBanks->doValidateData($_POST)) {
				$objClsCompBanks->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsCompBanks->Data);
				$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList($_GET['view']));
				$centerPanelBlock->assign('oDatacomp',$objClsCompBanks->dbFetch_Company($_GET['view']));
//				printa($objClsCompBanks->Data);
			} else {
				$objClsCompBanks->doPopulateData($_POST);
				$objClsCompBanks->doSaveAdd();
				header("Location: setup.php?statpos=compbanks");
				exit;
			}
		} else {
			$oData = $objClsCompBanks->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList($_GET['view']));
			$centerPanelBlock->assign('oDatacomp',$objClsCompBanks->dbFetch_Company($_GET['view']));
		}
		break;
		
	case 'empinput':
		$arrbreadCrumbs['Manage Bank'] = "setup.php?statpos=compbanks";
		$arrbreadCrumbs['View'] = "setup.php?statpos=compbanks&view=".$_GET['view'];
		$arrbreadCrumbs['Employee Selection'] = "";
		$oData = $objClsCompBanks->dbFetch($_GET['empinput']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsCompBanks->getTableList_EmpSave());
		break;	
		
	case "empinput_del":
		$objClsCompBanks->doDelete_Emp($_GET['empinput_del']);
		header("Location: setup.php?statpos=compbanks&view=".$_GET['view']."&empinput=".$_GET['empinput']."&bank=".$_GET['bank']);
		exit;		
		break;	
		
	case "delete":
		$objClsCompBanks->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=compbanks");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage Bank'] = "";
		$centerPanelBlock->assign('tblDataList', $objClsCompBanks->getCompany_List());
		break;
}

if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg', $_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}

/*-!-!-!-!-!-!-!-!-*/

$mainBlock->assign('centerPanel', $centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs', $mainBlock->breadCrumbs);
$mainBlock->displayBlock();


?>