<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_tt.class.php');

Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=0;

$cmap = array(
"default" => "mnge_pg.tpl.php"
,"add" => "mnge_pg_form.tpl.php"
,"edit" => "mnge_pg_form.tpl.php"
,"ppsched" => "payperiod.tpl.php"
,"ppsched_add" => "payperiod_form.tpl.php"
,"ppsched_edit" => "payperiod.tpl.php"
,"ppsched_view" => "payperiodview_form.tpl.php"
,"empinput" => "payperiodsched_emp.tpl.php"
,"empinput_add" => "payperiodsched_emp_form.tpl.php"
,"paystubreport" => "pay_stub_report.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['ppsched'])?"ppsched":$cmapKey;
$cmapKey = isset($_GET['ppsched_add'])?"ppsched_add":$cmapKey;
$cmapKey = isset($_GET['ppsched_view_genpaystub'])?"ppsched_view_genpaystub":$cmapKey;
$cmapKey = isset($_GET['ppsched_edit'])?"ppsched_edit":$cmapKey;
$cmapKey = isset($_GET['ppsched_del'])?"ppsched_del":$cmapKey;
$cmapKey = isset($_GET['ppsched_view'])?"ppsched_view":$cmapKey;
$cmapKey = isset($_GET['empinput'])?"empinput":$cmapKey;
$cmapKey = isset($_GET['empinput_add'])?"empinput_add":$cmapKey;
$cmapKey = isset($_GET['empinput_del'])?"empinput_del":$cmapKey;
$cmapKey = isset($_GET['paystubreport'])?"paystubreport":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Manage Pay Group');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
//$centerPanelBlock->assign("typePS",$typePS);
//$centerPanelBlock->assign("transdate",$transdate);
//$centerPanelBlock->assign("transdate_month",$transdate_month);
$objClsMnge_PG = new clsMnge_PG($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsMnge_TT = new clsMnge_TT($dbconn);

/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign("typePS",$typePS);
$centerPanelBlock->assign("processTYPE",$processTYPE);
$centerPanelBlock->assign("weekdays",$weekdays);
$centerPanelBlock->assign("transdate",$transdate);
$centerPanelBlock->assign("transdate_month",$transdate_month);
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign('get_totalEmp',$objClsMnge_PG->get_totalEmp($_GET['ppsched']));
$centerPanelBlock->assign('paygroup',$objClsMnge_TT->paygroup);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg ';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_PG->doValidateData($_POST)){
				$objClsMnge_PG->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
//				printa($objClsMnge_PG->Data);
			} else {
				$objClsMnge_PG->doPopulateData($_POST);
				$objClsMnge_PG->doSaveAdd();
				header("Location: setup.php?statpos=mnge_pg ");
				exit;
			}
		}
		break;
	case 'ppsched_add': 
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg';
		$arrbreadCrumbs['Pay Period List'] = "setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched'];
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_PG->doValidateData_pp($_POST)){
				$objClsMnge_PG->doPopulateData_pp($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
//				printa($objClsPayPeriodSched->Data);
			} else {
				$objClsMnge_PG->doPopulateData_pp($_POST);
				$objClsMnge_PG->doSaveAdd_PP();
				header("Location: setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched']);
				exit;
			}
		}
		break;
	case 'empinput_add': 
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg';
		$arrbreadCrumbs['Employee Selection'] = 'setup.php?statpos=mnge_pg&empinput='.$_GET['empinput'];
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			if (isset($_POST['btn_saveEmployee'])){
				// save add new
				if(!$objClsMnge_PG->doValidateData_emp($_POST)){
					$objClsMnge_PG->doPopulateData($_POST);
					$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
	//				printa($objClsRecurringPSAmend->Data);
					$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_Emp());
				} else {
					$objClsMnge_PG->doPopulateData($_POST);
					$objClsMnge_PG->doSaveEmployee($_POST);
					header("Location: setup.php?statpos=mnge_pg&empinput=".$_GET['empinput']);
					exit;
				}
			} else {
				$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_Emp());
			}
		} else {
			$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_Emp());
		}
		break;	
	case 'ppsched_edit':
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg';
		$arrbreadCrumbs['Pay Period List'] = "setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched'];
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_PG->doValidateData_pp($_POST)){
				$objClsMnge_PG->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PG->Data_);
//				printa($objClsPayPeriodSched->Data);
			} else {
				$objClsMnge_PG->doPopulateData_pp($_POST);
				$objClsMnge_PG->doSaveEdit_PP();
				header("Location: setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched']);
				exit;
			}
		}else{
			$oData = $objClsMnge_PG->dbFetch_pp($_GET['ppsched_edit']);
			$centerPanelBlock->assign("oData",$oData);
			$oData_ = $objClsMnge_PG->dbFetch($_GET['ppsched']);
			$centerPanelBlock->assign("oData_",$oData_);
		}
		$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_SchedList());
		if ( $oData['stat_id'] == 3 OR $oData['stat_id'] == 4 ) {
				//Once pay period is closed, do not allow it to re-open.
				$status_filter_arr = array(3,4);
			} else {
				//Only allow to close pay period if AFTER end date.
//				if ( date('Y-m-d',dDate::getTime()) >= $oData['payperiod_end_date'] ) {
					$status_filter_arr = array(1,2,$oData['stat_id'], 3);
//				} else {
//					$status_filter_arr = array(1,2,$oData['stat_id']);
//				}
			}
			$stat =$objClsMnge_PG->getByArray($status_filter_arr,$stat);
			$centerPanelBlock->assign("stat",$stat);
		break;
	case 'edit':
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg ';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_PG->doValidateData($_POST)){
				$objClsMnge_PG->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
//				printa($objClsMnge_PG->Data);
			} else {
				$objClsMnge_PG->doPopulateData($_POST);
				$objClsMnge_PG->doSaveEdit();
				header("Location: setup.php?statpos=mnge_pg ");
				exit;
			}
		}else{
			$oData = $objClsMnge_PG->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case "ppsched_view":
		$arrbreadCrumbs['Manage Pay Group'] = 'setup.php?statpos=mnge_pg';
		$arrbreadCrumbs['Pay Period List'] = "setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched'];
		$arrbreadCrumbs['View Pay Period'] = "";
		
		if (count($_POST)>0) {
			//update
			if(isset($_POST['btnGeneratePayStubs'])){
//				$objClsPayPeriodSched->doSaveGeneReport($_GET['ppsched_view']);
				header("Location: setup.php?statpos=mnge_pg&paystubreport=".$_GET['ppsched_view']);
				exit;
			}else{
				$objClsMnge_PG->doSaveEdit_PPstat($_GET['ppsched_view']);
				header("Location: setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
				exit;
			}
		}else{
			$oData = $objClsMnge_PG->dbFetch_pp($_GET['ppsched_view']);
			$centerPanelBlock->assign("oData",$oData);
			if ( $oData['stat_id'] == 3 OR $oData['stat_id'] == 4 ) {
				//Once pay period is closed, do not allow it to re-open.
				$status_filter_arr = array(3,4);
			} else {
				//Only allow to close pay period if AFTER end date.
				if ( date('Y-m-d',dDate::getTime()) >= $oData['payperiod_end_date'] ) {
					$status_filter_arr = array(1,2,$oData['stat_id'], 3);
				} else {
					$status_filter_arr = array(1,2,$oData['stat_id']);
				}
			}
			$stat =$objClsMnge_PG->getByArray($status_filter_arr,$stat);
			$centerPanelBlock->assign("stat",$stat);
		}
		break;
	case "delete":
		$objClsMnge_PG->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=mnge_pg");
		exit;
		break;
	case "empinput_del":
		$arrbreadCrumbs['Manage Pay Group'] = "setup.php?statpos=mnge_pg";
		$arrbreadCrumbs['Employee Selection'] = "";
		$objClsMnge_PG->doDelete_Emp($_GET['empinput_del']);
		header("Location: setup.php?statpos=mnge_pg&empinput=".$_GET['empinput']);
		exit;		
		break;
	case "ppsched_del":
//		$arrbreadCrumbs['Manage Pay Group'] = "setup.php?statpos=mnge_pg";
//		$arrbreadCrumbs['Employee Selection'] = "";
		$objClsMnge_PG->DeletePayPeriodList($_GET['ppsched_del']);
		header("Location: setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched']);
		exit;		
		break;
	case 'empinput':
		$arrbreadCrumbs['Manage Pay Group'] = "setup.php?statpos=mnge_pg";
		$arrbreadCrumbs['Employee Selection'] = "";
		
		$oData = $objClsMnge_PG->dbFetch($_GET['empinput']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_EmpSave());
		break;	
	case 'ppsched':
		$arrbreadCrumbs['Manage Pay Group'] = "setup.php?statpos=mnge_pg";
		$arrbreadCrumbs['Pay Period List'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_PG->doValidateData_pp($_POST)){
				$objClsMnge_PG->doPopulateData_pp($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_PG->Data);
				$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_SchedList());
				$centerPanelBlock->assign("oData_",$objClsMnge_PG->dbFetch($_GET['ppsched']));
//				printa($objClsPayPeriodSched->Data);
			} else {
				if($_POST['type']=='1'){
					$objClsMnge_PG->doPopulateData_pp($_POST);
					$objClsMnge_PG->doSaveAdd_PP();
				} else {
					$objClsMnge_PG->doSaveAdd_PP_YTD();
				}
				header("Location: setup.php?statpos=mnge_pg&ppsched=".$_GET['ppsched']);
				exit;
			}
		}else{
			$oData_ = $objClsMnge_PG->dbFetch($_GET['ppsched']);
			$centerPanelBlock->assign("oData_",$oData_);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList_SchedList());
		}
		break;
	case 'ppsched_view_genpaystub':		
		$objClsMnge_PG->doSaveGeneReport($_GET['ppsched_view'],$_GET['ppsched']);
		header("Location: setup.php?statpos=mnge_pg");
		exit;		
		break;	
	default:
		$arrbreadCrumbs['Manage Pay Group'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_PG->getTableList());
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