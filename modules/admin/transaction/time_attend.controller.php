<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/time_attend.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_pg.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/process_payroll.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "time_attend.tpl.php"
,"add" => "time_attend_form.tpl.php"
,"edit" => "time_attend_form.tpl.php"
,"ppsched_view" => "time_attend_form.tpl.php"
,"viewuptahead" => "uploadta_details.tpl.php"
,"viewtime" => "process_payroll_ot_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['ppsched_view'])?"ppsched_view":$cmapKey;
$cmapKey = isset($_GET['viewuptahead'])?"viewuptahead":$cmapKey;
$cmapKey = isset($_GET['viewtime'])?"viewtime":$cmapKey;
$cmapKey = isset($_GET['deleteuptadetail'])?"deleteuptadetail":$cmapKey;
$cmapKey = isset($_GET['deleteuptahead'])?"deleteuptahead":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Time and Attendance');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsTime_Attend = new clsTime_Attend($dbconn);
$objClsMnge_PG = new clsMnge_PG($dbconn);
$objClsProcess_Payroll = new clsProcess_Payroll($dbconn);
$objClsMngeDecimal = new Application();
$objClsPayroll_Details = new clsPayroll_Details($dbconn);

$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign('finalDecimal',$objClsMngeDecimal->getFinalDecimalSettings());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['TA Import'] = 'transaction.php?statpos=time_attend';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTime_Attend->doValidateData($_POST)){
				$objClsTime_Attend->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTime_Attend->Data);
//				printa($objClsTime_Attend->Data);
			}else {
				$objClsTime_Attend->doPopulateData($_POST);
				$objClsTime_Attend->doSaveAdd();
				header("Location: transaction.php?statpos=time_attend");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['TA Import'] = 'transaction.php?statpos=time_attend';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTime_Attend->doValidateData($_POST)){
				$objClsTime_Attend->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTime_Attend->Data);
//				printa($objClsTime_Attend->Data);
			}else {
				$objClsTime_Attend->doPopulateData($_POST);
				$objClsTime_Attend->doSaveEdit();
				header("Location: transaction.php?statpos=time_attend");
				exit;
			}
		}else{
			$oData = $objClsTime_Attend->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	case 'ppsched_view':
		$arrbreadCrumbs['TA Import'] = 'transaction.php?statpos=time_attend';
		$arrbreadCrumbs['Upload TA'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
			if(!$objClsTime_Attend->doValidateDataUPTA($postData)){
				$centerPanelBlock->assign("oData",$postData);
			}else { // do save
				$TAFORMAT = $objClsPayroll_Details->getGeneralSetup('TA Import Form');
				IF($TAFORMAT['set_stat_type']=='2'){
					//TA FORM2 - AGROTECH (AGROTECH TA IMPORT)
					$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead_AGRO($postData);
				}ELSEIF($TAFORMAT['set_stat_type']=='3'){
					//TA FORM3 - FAS (FAS TA IMPORT)
					$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead_FAS($postData);
				}ELSEIF($TAFORMAT['set_stat_type']=='4'){
					//TA FORM4 - FEAP (FEAP TA IMPORT)
					$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead_FEAP($postData);
				}ELSEIF($TAFORMAT['set_stat_type']=='5'){
					//TA FORM5 - SIGMA (SIGMA TA IMPORT)
					$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead_SIGMA($postData);
				}ELSE{
					//TA FORM1 - NORMAL (NORMAL TA IMPORT)
					$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead($postData);
				}
//				$uptahead_id_=$objClsTime_Attend->doSaveUploadTAHead_BINGO($postData);//BINGO TA IMPORT
				header("Location: transaction.php?statpos=time_attend&viewuptahead=".$uptahead_id_."&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
				exit;
			}
		}
		$oData = $objClsTime_Attend->dbFetch($_GET['ppsched_view'],$_GET['ppsched']);
		$centerPanelBlock->assign("oData",$oData);
		$centerPanelBlock->assign('tblDataList',$objClsTime_Attend->getHeaderTAupload($_GET['ppsched'],$_GET['ppsched_view']));
		break;
	case "viewuptahead":
		$uploadtaheaderinfo = $objClsTime_Attend->getUploadCIHeadInfo($_GET['viewuptahead']);
		$arrbreadCrumbs['Time and Attendance'] = 'transaction.php?statpos=time_attend';
		$arrbreadCrumbs['Upload TA'] = "transaction.php?statpos=time_attend&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view'];
		$arrbreadCrumbs['View Upload'] = "";
//		printa(unserialize('a:7:{i:1;s:10:"1234567890";i:2;s:11:"Description";i:3;s:1:"3";i:4;s:5:"reams";i:5;s:8:"custcode";i:6;s:3:"100";i:7;s:2:"24";}'));
		$centerPanelBlock->assign("uploadciheaderinfo",$uploadtaheaderinfo);
		$centerPanelBlock->assign('tblDataList',$objClsTime_Attend->getUploadCITableListDetails($_GET['viewuptahead'],$_GET['ppsched'],$_GET['ppsched_view']));
		break;
	case "viewtime":
		$arrbreadCrumbs['TA Import'] = 'transaction.php?statpos=time_attend';
		$arrbreadCrumbs['Upload TA'] = "transaction.php?statpos=time_attend&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view'];
		$arrbreadCrumbs['View Upload'] = "transaction.php?statpos=time_attend&viewuptahead=".$_GET['viewuptahead']."&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view'];
		$arrbreadCrumbs['View Details'] = "";
		if (count($_POST)>0){
			// update
			if(!$objClsProcess_Payroll->doValidateData($_POST)){
				$objClsProcess_Payroll->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsProcess_Payroll->Data);
//				printa($objClsProcess_Payroll->Data);
			}else{
				$objClsProcess_Payroll->doPopulateData($_POST);
				$objClsProcess_Payroll->doSaveOT($_GET['viewtime'],$_GET['ppsched_view'],$_POST);
				$objClsProcess_Payroll->doSaveTA($_GET['viewtime'],$_GET['ppsched_view'],$_POST);
				$objClsProcess_Payroll->doSaveLeave($_GET['viewtime'],$_GET['ppsched_view'],$_POST);
				$objClsProcess_Payroll->doSaveCF($_GET['viewtime'],$_GET['ppsched_view'],$_POST);
				header("Location: transaction.php?statpos=time_attend&viewuptahead=".$_GET['viewuptahead']."&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
				exit;
			}
		}else{
			$oData = $objClsProcess_Payroll->dbFetch_OT($_GET['ppsched_view'],$_GET['ppsched'],$_GET['viewtime']);
			$centerPanelBlock->assign("oData",$oData);
			$TAFORMAT = $objClsPayroll_Details->getGeneralSetup('TA Import Form');
			$centerPanelBlock->assign("TAFORMAT",$TAFORMAT);
			$centerPanelBlock->assign('tblDataList',$objClsProcess_Payroll->getpopup_OTrate($_GET['viewtime'],$_GET['ppsched_view']));
			$centerPanelBlock->assign('tblDataListLeave',$objClsProcess_Payroll->Leaverate($_GET['viewtime']));
			$centerPanelBlock->assign('tblDataListTA',$objClsProcess_Payroll->TArate($_GET['viewtime'],$_GET['ppsched_view']));
			$centerPanelBlock->assign('tblDataListCF',$objClsProcess_Payroll->getCustomFields($_GET['viewtime'],$_GET['ppsched_view'], $_GET['viewuptahead']));
		}
		break;
	case 'transferfinalta':
		$objClsTime_Attend->doTransferFinalTA($_GET['transferfinalci']);
		header("Location: transaction.php?statpos=time_attend&viewuptahead=".$_GET['transferfinalci']);
		exit;
		break;	
	case 'deleteuptahead':
		$objClsTime_Attend->doDeleteUploadTAHead($_GET['deleteuptahead'],$_GET);
		header("Location: transaction.php?statpos=time_attend&ppsched=".$_GET['ppsched']."&ppsched_view=".$_GET['ppsched_view']);
		exit;
		break;
	case 'deleteuptadetail':
		$objClsTime_Attend->doDeleteUploadTADetail($_GET['deleteuptadetail']);
		header("Location: transaction.php?statpos=time_attend&viewuptahead=".$_GET['viewuptahead']);
		exit;
		break;	
	case "delete":
		$objClsTime_Attend->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=time_attend");
		exit;
		break;
	default:
		$arrbreadCrumbs['TA Import'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsTime_Attend->getTableList());
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