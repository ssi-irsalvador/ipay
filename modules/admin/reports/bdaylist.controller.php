<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bdaylist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/emp_masterfile.class.php');
Application::app_initialize();
$dbconn = Application::db_open();
$cmap = array(
"default" => "bdaylist.tpl.php"
,"add" => "bdaylist_form.tpl.php"
,"edit" => "bdaylist_form.tpl.php"
);
$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => ''
,'201 Reports' => ''
);
$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Birthday List');
$mainBlock->templateDir .= "admin";
// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];
/*-!-!-!-!-!-!-!-!-*/
$objClsBdayList = new clsBdayList($dbconn);
$objClsSSS = new clsSSS($dbconn);
$objClsEMP_MasterFile = new clsEMP_MasterFile($dbconn);

/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("empstat",$objClsEMP_MasterFile->empstat());
$centerPanelBlock->assign('branch',$objClsEMP_MasterFile->brachlist());
switch ($cmapKey){
	case 'edit':
		$arrbreadCrumbs['Birthday List'] = 'reports.php?statpos=bdaylist';
		$arrbreadCrumbs['Edit'] = "";
		if($_GET['rtype'] == "" || $_GET['rtype'] == 'pdf'){
			$output = $objClsBdayList->getPDFResultMCRF($oData, $_GET);
			Misc::FileDownloadHeader("201 Master List ".date('Y-m-d').".pdf", "application/pdf", strlen($output));
		}else{
			$objClsBdayList->generateXLSBdayReport($_GET);
		}
		break;
	default:
		$arrbreadCrumbs['Birthday List'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=bdaylist&edit&type=".$_POST['emp_type']."&comp=".$_POST['comp_id']."&rtype=".$_POST['format']."&dtype=".$_POST['isdpart']."&month=".$_POST['month']."&lname=".$_POST['islname']."&branchinfo_id=".$_POST['select']);
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