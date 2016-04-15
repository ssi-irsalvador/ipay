<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/ytdentry_process.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "ytdentry_process.tpl.php"
,"add" => "ytdentry_process_form.tpl.php"
,"edit" => "ytdentry_process_form.tpl.php"
,"ppsched_view" => "ytdentry_process_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'YTD Entry' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['ppsched_view'])?"ppsched_view":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','YTD Entry Process');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsYTDEntry_Process = new clsYTDEntry_Process($dbconn);
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsMnge_PG = new clsMnge_PG($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign('finalDecimal',$objClsMngeDecimal->getFinalDecimalSettings());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['YTD Entry Process'] = 'transaction.php?statpos=ytdentry_process';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsYTDEntry_Process->doValidateData($_POST)){
				$objClsYTDEntry_Process->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDEntry_Process->Data);
//				printa($objClsYTDEntry_Process->Data);
			}else {
				$objClsYTDEntry_Process->doPopulateData($_POST);
				$objClsYTDEntry_Process->doSaveAdd();
				header("Location: transaction.php?statpos=ytdentry_process");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['YTD Entry Process'] = 'transaction.php?statpos=ytdentry_process';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsYTDEntry_Process->doValidateData($_POST)){
				$objClsYTDEntry_Process->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDEntry_Process->Data);
//				printa($objClsYTDEntry_Process->Data);
			}else {
				$objClsYTDEntry_Process->doPopulateData($_POST);
				$objClsYTDEntry_Process->doSaveEdit();
				header("Location: transaction.php?statpos=ytdentry_process");
				exit;
			}
		}else{
			$oData = $objClsYTDEntry_Process->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case 'ppsched_view':
		unset($_SESSION['YTD Entry']);
		$arrbreadCrumbs['YTD Entry Process'] = 'transaction.php?statpos=ytdentry_process';
		$arrbreadCrumbs['View'] = "";
		if (count($_POST['chkAttend']) > 0) {
			// update
			if(!$objClsYTDEntry_Process->doValidateData($_POST)){
				$objClsYTDEntry_Process->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDEntry_Process->Data);
//				printa($objClsProcess_Payroll->Data);
			} else {
				$objClsYTDEntry_Process->doSaveYTD($_GET['ppsched_view'],$_POST);//Process YTD
				$Total_emp = $objClsMnge_PG->get_totalEmp($_GET['ppsched'],$_GET['ppsched_view']);
				IF($Total_emp['totalemp'] > 0){//to check if not 0 employee that need to process. 
					header("Location: transaction.php?statpos=ytdentry_process&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
				}else{
					header("Location: transaction.php?statpos=payroll_details&edit=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
				}
				exit;
			}
		}else{
			$Total_emp = $objClsYTDEntry_Process->get_totalEmp($_GET['ppsched'],$_GET['ppsched_view']);
			$centerPanelBlock->assign('get_totalEmp',$Total_emp);//get total employee
			$oData = $objClsProcess_Payroll->dbFetch($_GET['ppsched_view'],$_GET['ppsched']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsYTDEntry_Process->getEmpToProcess());
		}
		break;	
	case "delete":
		$objClsYTDEntry_Process->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=ytdentry_process");
		exit;		
		break;
	default:
		$arrbreadCrumbs['YTD Entry Process'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsYTDEntry_Process->getTableList());
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