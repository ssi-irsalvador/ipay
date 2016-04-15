<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss_collection.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
$cmap = array(
"default" => "sss_collection.tpl.php"
,"add" => "sss_collection_form.tpl.php"
,"edit" => "sss_collection_form.tpl.php"
);
$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Loan Report' => ''
);
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','SSS Collection');
$mainBlock->templateDir .= "admin";
// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
/*-!-!-!-!-!-!-!-!-*/
$objClsSSSCollection = new clsSSSCollection($dbconn);
$objClsSSS = new clsSSS($dbconn);
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('branch',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'edit':
//		$mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['SSS Collection'] = 'reports.php?statpos=sss_collection';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsSSSCollection->doValidateData($_POST)){
				$objClsSSSCollection->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSSSCollection->Data);
//				printa($objClsSSSCollection->Data);
			}else {
				$objClsSSSCollection->doPopulateData($_POST);
				$objClsSSSCollection->doSaveEdit();
				header("Location: reports.php?statpos=sss_collection");
				exit;
			}
		}else{
			$oData = $objClsSSSCollection->dbFetchCollection($_GET);
			$centerPanelBlock->assign("oData",$oData);
            $oDataBranch = $objClsSSS->dbfetchBranchDetails(1);
			$centerPanelBlock->assign("oDataBranch",$oDataBranch);
		}
		break;

	default:
		$arrbreadCrumbs['SSS Collection'] = "";
		if(count($_POST)>0){
			$oData = $objClsSSSCollection->dbFetchCollection($_POST,1);
			if($objClsSSS->getSettings($_POST['comp_id'],12) && $_POST['branchinfo_id'] != 0){
		  		$branch_details = $objClsSSS->getLocationInfo($_POST['branchinfo_id']);
		  		$oDataCompany = array(
		  			'comp_name' => $branch_details['branchinfo_name']
		  			,'comp_add' => $branch_details['branchinfo_add']
		  			,'comp_sss' => $branch_details['branchinfo_sss']
		  			,'comp_tin' => $branch_details['branchinfo_tin']
		  			,'comp_tel' => $branch_details['branchinfo_tel1']
		  			);
		  	} else {
		  		$oDataCompany = $objClsSSS->dbfetchCompDetails(1);
		  	}
//			printa($oData);
//			exit;
			
			// SSS Loan Summary
			if($_POST['rtype'] == "" || $_POST['rtype'] == 10){
				if($_POST['format'] == 'excel'){
					$objClsSSSCollection->generateSSS_LOAN_Report($_POST,$oData,$oDataCompany);
				}else{
					$output = header("Location: statutoryreport/SSS LOAN.pdf");
					Misc::FileDownloadHeader("MCRF".date('Y-m-d').".pdf", "application/pdf", strlen($output));
				}
			// SSS ML-1
			}elseif($_POST['rtype'] == "" || $_POST['rtype'] == 30){
				$output = header("Location: statutoryreport/ml1.pdf");
				Misc::FileDownloadHeader("ML-1".date('Y-m-d').".pdf", "application/pdf", strlen($output));
			// SSS Loan Transmittal
			}elseif($_POST['rtype'] == "" || $_POST['rtype'] == 40){
				if(!$objClsSSSCollection->doValidateData($_POST)){
					$centerPanelBlock->assign("postData",$_POST);
				} else {
					IF(count($oData)>0){
						$output = $objClsSSSCollection->getSSSLoanTransmittal($oData,$_POST);
						Misc::FileDownloadHeader("SSSLoanTransmitan_".date('Y-m-d').".pdf", "application/pdf", strlen($output));
					} ELSE {
						$_SESSION['eMsg'][] = "No Record Found.";
					}
				}
			// SSS-LCL Disket
			}else{
				IF(count($oData)>0){
				$output = $objClsSSSCollection->generateTxtFileLCL($oData,$_POST,$oDataCompany);
				Misc::FileDownloadHeader("SSS-LCL_".date('Y-m-d').".txt", "application/text", strlen($output));
				echo($output);
				exit;
				} ELSE {
					$_SESSION['eMsg'][] = "No Record Found.";
				}
			}
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