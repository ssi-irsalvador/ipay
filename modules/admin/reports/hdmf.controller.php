<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/hdmf.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/payroll_register.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
$cmap = array(
"default" => "hdmf.tpl.php"
,"add" => "hdmf_form.tpl.php"
,"edit" => "hdmf_form.tpl.php"
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
$mainBlock->assign('PageTitle','HDMF');
$mainBlock->templateDir .= "admin";
// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
/*-!-!-!-!-!-!-!-!-*/
$objClsHDMF = new clsHDMF($dbconn);
$objClsSSS = new clsSSS($dbconn);
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign("type",$type);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'edit':
		$arrbreadCrumbs['HDMF'] = 'reports.php?statpos=hdmf';
		$arrbreadCrumbs['Edit'] = "";
		$oData = $objClsSSS->dbFetchContribution($_GET,2);
		$isLoc = $objClsSSS->getSettings($_GET['comp'],12);
			if($_GET['rtype'] == "" || $_GET['rtype'] == 10){
				if($_GET['format'] == 'excel'){
					$objClsHDMF->generateHDMF_Premium_Report($_GET,$oData,$isLoc);
				}else{
					$output = $objClsHDMF->getPDFResultMCRF1($oData, $_GET, $objClsSSS->dbfetchCompDetails($_GET['comp']), $isLoc);
				}
			}else{
				$objClsHDMF->generateXLSHReport($_GET,$oData, $isLoc);
			}
		break;
	default:
		$arrbreadCrumbs['HDMF'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=hdmf&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&signatoryby=".$_POST['signatoryby']."&position=".$_POST['position']."&month=".$_POST['month']."&rtype=".$_POST['rtype']."&format=".$_POST['format']."&branchinfo_id=".$_POST['branchinfo_id']);
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