<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/stat_summary.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/tax.class.php');
Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "stat_summary.tpl.php"
,"add" => "stat_summary_form.tpl.php"
,"edit" => "stat_summary.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Statutory Report' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Statutory Summary');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsStatSummary = new clsStatSummary($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsTax = new clsTAX($dbconn);
// Drop-down menu 

$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('empList',$objClsTax->getEmployeeList());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Statutory Summary'] = 'reports.php?statpos=summary';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsStatSummary->doValidateData($_POST)){
				$objClsStatSummary->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsStatSummary->Data);
//				printa($objClsStatSummary->Data);
			}else {
				$objClsStatSummary->doPopulateData($_POST);
				$objClsStatSummary->doSaveAdd();
				header("Location: reports.php?statpos=summary");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Statutory Summary'] = 'reports.php?statpos=summary';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			header("Location: reports.php?statpos=summary&edit&comp=".$_POST['comp_id']."&emp=".$_POST['employee']."&year=".$_POST['year']."&month=".$_POST['month']);
			// update
			//if(!$objClsStatSummary->doValidateData($_POST)){
				//$objClsStatSummary->doPopulateData($_POST);
				//$centerPanelBlock->assign("oData",$objClsStatSummary->Data);
//				printa($objClsStatSummary->Data);
			//}else {
				//$objClsStatSummary->doPopulateData($_POST);
				//$objClsStatSummary->doSaveEdit();
				//header("Location: reports.php?statpos=summary");
			//	exit;
			//}
		}else{
			if ($_GET['type'] == 01) {
				$oData = $objClsStatSummary->summaryReport($_GET);
			
			} else {
				$objClsStatSummary->getCertrification($_GET);
			}
			
		}
		//$oData = $objClsStatSummary->summaryReport($_GET);
		$centerPanelBlock->assign("oData",$oData);
		break;
		
	case "delete":
		$objClsStatSummary->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=summary");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Statutory Summary'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=summary&edit&comp=".$_POST['comp_id']."&type=".$_POST['mode']."&mode=".$_POST['mode1']."&year=".$_POST['year']."&month=".$_POST['month']."&emp=".$_POST['employee']."&prepby=".$_POST['preparedby1']."&notedby=".$_POST['notedby1']."&certifiedby=".$_POST['Certified1']);
        	exit;
        }
        break;
		//$centerPanelBlock->assign('tblDataList',$objClsStatSummary->getTableList());
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