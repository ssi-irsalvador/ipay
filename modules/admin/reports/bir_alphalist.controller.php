<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/bir_alphalist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/misc.class.php');

Application::app_initialize();
$dbconn = Application::db_open();
//$dbconn->debug=1;
$cmap = array(
"default" => "bir_alphalist.tpl.php"
,"add" => "bir_alphalist_form.tpl.php"
,"edit" => "bir_alphalist.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => '',
'Tax Report' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','BIR Alphalist');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsBIRAlphalist = new clsBIRAlphalist($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['BIR Alphalist'] = 'reports.php?statpos=bir_alphalist';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if (!$objClsBIRAlphalist->doValidateData($_POST)) {
				$objClsBIRAlphalist->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBIRAlphalist->Data);
//				printa($objClsBIRAlphalist->Data);
			} else {
				$objClsBIRAlphalist->doPopulateData($_POST);
				$objClsBIRAlphalist->doSaveAdd();
				header("Location: reports.php?statpos=bir_alphalist");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['BIR Alphalist'] = 'reports.php?statpos=bir_alphalist';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if (!$objClsBIRAlphalist->doValidateData($_POST)) {
				$objClsBIRAlphalist->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsBIRAlphalist->Data);
//				printa($objClsBIRAlphalist->Data);
			} else {
				$objClsBIRAlphalist->doPopulateData($_POST);
				$objClsBIRAlphalist->doSaveEdit();
				header("Location: reports.php?statpos=bir_alphalist");
				exit;
			}
		} ELSE {
            if ($_GET['type'] == "" || $_GET['type'] == 10) {
                $output = $objClsBIRAlphalist->getPDFResult($_GET);
                // set header to download the pdf ouput
                Misc::FileDownloadHeader("1604CF.pdf", "application/pdf", strlen($output));
            } elseif ($_GET['type'] == 20) {
            	$objClsBIRAlphalist->get2316($_GET);
            } elseif ($_GET['type'] == 30) {	
            	if($_GET['format'] == 'xls'){
            		$objClsBIRAlphalist->get1604CF7_1($_GET);
            	} else {
            		$objClsBIRAlphalist->get1604CF7_1_diskette($_GET);
            	}
            } elseif ($_GET['type'] == 40) {
            	if($_GET['format'] == 'xls'){
            		$objClsBIRAlphalist->get1604CF7_2($_GET);
            	} else {
            		$objClsBIRAlphalist->get1604CF7_2_diskette($_GET);
            	}
           	} elseif ($_GET['type'] == 50) {
           		if($_GET['format'] == 'xls'){
            		$objClsBIRAlphalist->get1604CF7_3($_GET);
           		} else {
           			$objClsBIRAlphalist->get1604CF7_3_diskette($_GET);
           		}
            } elseif ($_GET['type'] == 60) {
            	if($_GET['format'] == 'xls'){
            		$objClsBIRAlphalist->get1604CF7_4($_GET);
            	} else {
            		$objClsBIRAlphalist->get1604CF7_4_diskette($_GET);
            	}
            } elseif ($_GET['type'] == 70) {
            	if($_GET['format'] == 'xls'){
            		$objClsBIRAlphalist->get1604CF7_5($_GET);
            	} else {
            		$objClsBIRAlphalist->get1604CF7_5_diskette($_GET);
            	}
            } elseif ($_GET['type'] == 80) {
            		$objClsBIRAlphalist->getTransmittal($_GET);
           	} elseif ($_GET['type'] == 90) {
            		$objClsBIRAlphalist->get1604CFDiskette($_GET);
            } else {
                $objClsBIRAlphalist->getXLSResult($_GET);
            }
		}
		break;
	case "delete":
		$objClsBIRAlphalist->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=bir_alphalist");
		exit;		
		break;
	default:
		$arrbreadCrumbs['BIR Alphalist'] = "";
        if (count($_POST)>0) {
        	if($_POST['type']==90){
        		header("Location: reports.php?statpos=bir_alphalist&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&branchinfo_id=".$_POST['branchinfo_id']."&format=".$_POST['format']."&branchcode=".$_POST['branch_code']."&return=".$_POST['return_period']);
		        exit;
        	} else {
	        	if($_POST['format'] == 'xls'){
		            header("Location: reports.php?statpos=bir_alphalist&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&branchinfo_id=".$_POST['branchinfo_id']."&format=".$_POST['format']."&representative=".$_POST['representative1']);
		        	exit;
	        	} else {
	        		header("Location: reports.php?statpos=bir_alphalist&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&branchinfo_id=".$_POST['branchinfo_id']."&format=".$_POST['format']."&branchcode=".$_POST['branch_code']."&return=".$_POST['return_period']);
		        	exit;
	        	}
        	}
        }
        break;
}
if (isset($_SESSION['eMsg'])) {
	$centerPanelBlock->assign('eMsg',$_SESSION['eMsg']);
	unset($_SESSION['eMsg']);
}
/*-!-!-!-!-!-!-!-!-*/
$mainBlock->assign('centerPanel',$centerPanelBlock);
$mainBlock->setBreadCrumbs($arrbreadCrumbs);
$mainBlock->assign('breadCrumbs',$mainBlock->breadCrumbs);
$mainBlock->displayBlock();
?>