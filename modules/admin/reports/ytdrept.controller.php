<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/ytdrept.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "ytdrept.tpl.php"
,"add" => "ytdrept_form.tpl.php"
,"edit" => "ytdrept.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Analysis Tools' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Year to Date (YTD) Report');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);

/*-!-!-!-!-!-!-!-!-*/

$objClsYTDRept = new clsYTDRept($dbconn);
$centerPanelBlock->assign("haveLoc",$objClsYTDRept->getDept());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Year to Date (YTD) Report'] = 'reports.php?statpos=ytdrept';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsYTDRept->doValidateData($_POST)){
				$objClsYTDRept->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDRept->Data);
//				printa($objClsYTDRept->Data);
			}else {
				$objClsYTDRept->doPopulateData($_POST);
				$objClsYTDRept->doSaveAdd();
				header("Location: reports.php?statpos=ytdrept");
				exit;
			}
		}
		break;

	case 'edit':
		$compData = $objClsYTDRept->getCompanyDetails($_GET['comp']);
		$oData = $objClsYTDRept->getCompanyList();
		$deptData = $objClsYTDRept->getDepartment();
		$emp = $objClsYTDRept->filterEmployees($_GET);
		$status = $objClsYTDRept->getEmpStatus();
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign("deptData",$deptData);
		$centerPanelBlock->assign("emp",$emp);
		$centerPanelBlock->assign("status",$status);
		$arrbreadCrumbs['Year to Date (YTD) Report'] = "";
		if($objClsYTDRept->doValidateData($_GET)){
			if($_GET['rformat'] == 'peremp'){
				$objClsYTDRept->getYTDReportExcel($_GET, $compData);
			} else {
				//$objClsYTDRept->getYTDReportExcelSummary($_GET, $compData);
				$objClsYTDRept->generateYTDReportSummary($_GET, $compData);
				
			}
			/*if($_GET['filetype'] == 'pdf'){
				$objClsYTDRept->getYTDReportPDF($_GET, $compData);
			} else {
				$objClsYTDRept->getYTDReportExcel($_GET, $compData);
			}*/
		} else {
			header("Location:" . $_SERVER['HTTP_REFERER']); 
			exit;
		}
		/*$arrbreadCrumbs['Year to Date (YTD) Report'] = 'reports.php?statpos=ytdrept';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsYTDRept->doValidateData($_POST)){
				$objClsYTDRept->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTDRept->Data);
//				printa($objClsYTDRept->Data);
			}else {
				$objClsYTDRept->doPopulateData($_POST);
				$objClsYTDRept->doSaveEdit();
				header("Location: reports.php?statpos=ytdrept");
				exit;
			}
		}else{
			$oData = $objClsYTDRept->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}*/
		break;
		
	case "delete":
		$objClsYTDRept->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=ytdrept");
		exit;		
		break;

	default:
		$oData = $objClsYTDRept->getCompanyList();
		$deptData = $objClsYTDRept->getDepartment();
		$emp = $objClsYTDRept->filterEmployees($_GET);
		$status = $objClsYTDRept->getEmpStatus();
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign("deptData",$deptData);
		$centerPanelBlock->assign("emp",$emp);
		$centerPanelBlock->assign("status",$status);
		$arrbreadCrumbs['Year to Date (YTD) Report'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=ytdrept&edit&frommonth=".$_POST['frommonth']."&tomonth=".$_POST['tomonth']."&fromyear=".$_POST['fromyear']."&toyear=".$_POST['toyear']."&filetype=".$_POST['format']."&comp=".$_POST['comp_id']."&emp_status=".$_POST['emp_status']."&dept=".$_POST['dept']."&isdpart=".$_POST['isdpart']."&emp_id=".$_POST['emp_id']."&rformat=".$_POST['rformat']);
        	exit;
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