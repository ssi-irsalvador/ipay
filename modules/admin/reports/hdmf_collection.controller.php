<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/hdmf_collection.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss_collection.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
$cmap = array(
"default" => "hdmf_collection.tpl.php"
,"add" => "hdmf_collection_form.tpl.php"
,"edit" => "hdmf_collection_form.tpl.php"
);
$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Loan Report' => ''
);
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','HDMF Collection');
$mainBlock->templateDir .= "admin";
// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
/*-!-!-!-!-!-!-!-!-*/
$objClsHDMFCollection = new clsHDMFCollection($dbconn);
$objClsSSSCollection = new clsSSSCollection($dbconn);
$objClsSSS = new clsSSS($dbconn);
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('branch',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['HDMF Collection'] = 'reports.php?statpos=hdmf_collection';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsHDMFCollection->doValidateData($_POST)){
				$objClsHDMFCollection->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsHDMFCollection->Data);
//				printa($objClsHDMFCollection->Data);
			}else {
				$objClsHDMFCollection->doPopulateData($_POST);
				$objClsHDMFCollection->doSaveEdit();
				header("Location: reports.php?statpos=hdmf_collection");
				exit;
			}
		}else{
			$oData = $objClsHDMFCollection->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
	default:
		$arrbreadCrumbs['HDMF Collection'] = "";
		if(count($_POST)>0){
			$oData = $objClsSSSCollection->dbFetchCollection($_POST,2);
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
			if($_POST['rtype'] == "" || $_POST['rtype'] == 10){
				if($_POST['format'] == 'excel'){
					$objClsHDMFCollection->generateHDMF_LOAN_Report($_POST,$oData,$oDataCompany);
				}else{
					//print_r($_POST);
//					$output = header("Location: statutoryreport/HDMF-P2-4.pdf");
					$objClsHDMFCollection->getHDMFP24_1($_POST, $oData, $oDataCompany);
//					Misc::FileDownloadHeader("MCRF".date('Y-m-d').".pdf", "application/pdf", strlen($output));
				}
			}else{
				$objClsHDMFCollection->generateHDMF_MPL_Report($_POST,$oData,$oDataCompany);
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