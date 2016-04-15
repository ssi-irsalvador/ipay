<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bank_export_report.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/compbanks.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bank_export_union.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bank_export_metrobank.class.php');

Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=1;
$cmap = array(
"default" => "bank_export_report.tpl.php"
,"add" => "bank_export_report_form.tpl.php"
,"edit" => "bank_export_report_form.tpl.php"
,"report" => "bank_export_report_form_report.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['report'])?"report":$cmapKey;
$cmapKey = isset($_GET['view'])?"view":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Bank Export Report');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsBankExportReport = new clsBankExportReport($dbconn);
$objClsBankExport = new clsCompBanks($dbconn);
$objCLSBankExportUnion = new clsBankExportUnion($dbconn);
$objCLSBankExportMetrobank = new clsBankExportMetrobank($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Bank Export Report'] = 'reports.php?statpos=bank_export_report';
		$arrbreadCrumbs['Add New'] = "";
        if (count($_POST)>0) {
			// save add new
			if (!$objClsBankExportReport->doValidateData($_POST)) {
				$objClsBankExportReport->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsHDMF->Data);
				//printa($objClsHDMF->Data);
			} else {
				$objClsBankExportReport->doPopulateData($_POST);
				if($_POST['format'] == 'ibank'){
					$objClsBankExportReport->doSaveAddiBank();
				} else {
					$objClsBankExportReport->doSaveAdd();
				}
				header("Location: reports.php?statpos=bank_export_report");
				exit;
			}
		}
		break;
	case 'edit':
		$mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['Bank Export Report'] = 'reports.php?statpos=bank_export_report';
		$arrbreadCrumbs['Edit'] = "";
		 $info = $objClsBankExportReport->getHashFileInfo($_GET['edit']);
         $output = $objClsBankExportReport->getHashFile($_GET['edit'],$_GET['pdf'],$info['pbr_bank_name']);
         IF ($_GET['pdf']) {
            Misc::FileDownloadHeader($info['pbr_company_code'].".pdf", "application/pdf", strlen($output));
         	echo $output;
         	exit;
         } ELSE {
         	 IF($_GET['bankname']=='Union Bank'){
				$objCLSBankExportUnion->getXLSResult_Union($output);
         	 }ELSEIF($_GET['bankname']=='Metrobank'){
         	 	Misc::FileDownloadHeader("PAYROLL.DAT", "application/text", strlen($output));
         	 	echo $output;
         		exit;
         	 }ELSE{
         	 	//Misc::FileDownloadHeader($info['pbr_company_code']."_".date("mdYHis").".txt", "text/plain", strlen($output));
         	 	Misc::FileDownloadHeader(str_replace(" ", "_", $info['pbr_company_code']).date("mdy").$info['pbr_batchno'], "application/text", strlen($output));
         	 	echo $output;
         		exit;
         	 }
         }
      	 break; 
    case 'report':
		$arrbreadCrumbs['Bank Export Report'] = 'reports.php?statpos=bank_export_report';
		$arrbreadCrumbs['Edit'] = 'reports.php?statpos=bank_export_report&edit='.$_GET['edit'];
		$arrbreadCrumbs['report'] = "";
//		$oData = $objClsBankExportReport->generateReport($_GET);
//		$centerPanelBlock->assign("oData",$oData);
		break;
	case "delete":
		$objClsBankExportReport->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=bank_export_report");
		exit;		
		break;
		
	case "view":
		$oData = $objClsBankExportReport->getPayrollBankReport($_GET['view']);
		if($_GET['excel']){
			//letter
			$objCLSBankExportUnion->generateIBankLetter($oData);
		} else {
			//details
			$objCLSBankExportUnion->getXLSResult_Union($oData);
		}
		break;
		
	default:
		$arrbreadCrumbs['Bank Export Report'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsBankExportReport->getTableList());
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