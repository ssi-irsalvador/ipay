<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/custom_paydetails.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/variance.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "custom_paydetails.tpl.php"
,"add" => "custom_paydetails_form.tpl.php"
,"edit" => "custom_paydetails_report.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => ''
,'Analysis Tools' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Custom Pay Details');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsCustomPayDetails = new clsCustomPayDetails($dbconn);
$objClsVariance = new clsVariance($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Custom Pay Details'] = 'reports.php?statpos=custom_paydetails';
		$arrbreadCrumbs['Add New'] = "";
		$selectedList = array();
		IF(count($_POST) > 0){
			IF(!$objClsCustomPayDetails->doValidateData($_POST)){
				$listAll = $objClsCustomPayDetails->getPayElementList();
				IF(count($_POST['selected_list']) > 0){
					FOREACH($_POST['selected_list'] as $key => $value){
						$selectedList[$value] = $objClsCustomPayDetails->getPayElementName($value);
						unset($listAll[$value]);
					}
				}
				IF(count($_POST['emp_info_selected_list']) > 0){
					FOREACH($_POST['emp_info_selected_list'] as $key => $value){
						$selectedListInfo[$value] = $objClsCustomPayDetails->empInfo[$value];
						unset($objClsCustomPayDetails->empInfo[$value]);
					}
				}
			} ELSE {
				$objClsCustomPayDetails->doPopulateData($_POST);
				$objClsCustomPayDetails->doSaveAdd();
				header("Location: reports.php?statpos=custom_paydetails");
				exit;
			}
			$centerPanelBlock->assign('options',$options);
			$centerPanelBlock->assign('payElementList',$listAll);
			$centerPanelBlock->assign('selectedList',$selectedList);
			$centerPanelBlock->assign('empInfo',$objClsCustomPayDetails->empInfo);
			$centerPanelBlock->assign('selectedListInfo',$selectedListInfo);
			//printa($_POST);
		} ELSE {
			$centerPanelBlock->assign('options',$options);
			$centerPanelBlock->assign('payElementList',$objClsCustomPayDetails->getPayElementList());
			$centerPanelBlock->assign('selectedList',$selectedList);
			$centerPanelBlock->assign('empInfo',$objClsCustomPayDetails->empInfo);
			$centerPanelBlock->assign('selectedListInfo',$selectedListInfo);
		}
		break;
		
	case 'edit':
		$arrbreadCrumbs['Custom Pay Details'] = 'reports.php?statpos=custom_paydetails';
		$arrbreadCrumbs['Edit'] = "";
		IF(count($_POST)>0){
			IF(isset($_POST['year'])){
				header("Location: reports.php?statpos=payroll_register&rpt_excel&rprt_tpye=custom&custom_report_id=".$_GET['custom_report_id']."&select=".$_POST['select']."&year=".$_POST['year']);
			} ELSE {
				header("Location: reports.php?statpos=payroll_register&rpt_excel&rprt_tpye=custom&custom_report_id=".$_GET['custom_report_id']."&select=".$_POST['select']);
			}
		} ELSE {
			$type = $objClsCustomPayDetails->getReportType($_GET['custom_report_id']);
			$centerPanelBlock->assign("reportName",$type['custom_report_name']);
			IF($type['custom_report_type']==1){
				$centerPanelBlock->assign("tag","Pay Period");
				$centerPanelBlock->assign("list",$objClsCustomPayDetails->getPayPeriod());
			} ELSE {
				$centerPanelBlock->assign("year",$objClsVariance->getYear());
				$centerPanelBlock->assign("tag","Month");
				$centerPanelBlock->assign("list",$objClsCustomPayDetails->month);
			}
		}
		break;
	case "delete":
		$objClsCustomPayDetails->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=custom_paydetails");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Custom Pay Details'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsCustomPayDetails->getTableList());
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