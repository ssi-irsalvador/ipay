<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "sss.tpl.php"
,"add" => "sss_form.tpl.php"
,"edit" => "sss_form.tpl.php"
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
$mainBlock->assign('PageTitle','SSS');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign("type",$type);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['SSS'] = 'reports.php?statpos=sss';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsSSS->doValidateData($_POST)){
				$objClsSSS->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSSS->Data);
//				printa($objClsSSS->Data);
			}else {
				$objClsSSS->doPopulateData($_POST);
				$objClsSSS->doSaveAdd();
				header("Location: reports.php?statpos=sss");
				exit;
			}
		}
		break;
	case 'edit':
        $mainBlock->templateFile = "index_blank.tpl.php";
		$arrbreadCrumbs['SSS'] = 'reports.php?statpos=sss';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsSSS->doValidateData($_POST)){
				$objClsSSS->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsSSS->Data);
//				printa($objClsSSS->Data);
			}else {
				$objClsSSS->doPopulateData($_POST);
				$objClsSSS->doSaveEdit();
				header("Location: reports.php?statpos=sss");
				exit;
			}
		}else{
			$oData = $objClsSSS->dbFetchContribution($_GET);
//			printa($oData); exit;
			IF($_GET['rtype'] == "" || $_GET['rtype'] == 10){
				$output = $objClsSSS->getPDFR1A1($_GET);	
			}ELSEIF($_GET['rtype'] == "" || $_GET['rtype'] == 20){
            	$output = $objClsSSS->getPDFResultSSSPayment($oData, $_GET);
            }ELSEIF($_GET['rtype'] == "" || $_GET['rtype'] == 30){
            	$objClsSSS->getR3($_GET, $objClsSSS->dbfetchCompDetails($_GET['comp']));
            }ELSEIF($_GET['rtype'] == "" || $_GET['rtype'] == 40){
            	$output = $objClsSSS->getPDFSSSTranmittalCert($oData, $_GET);
	            Misc::FileDownloadHeader("SSS Transmittal".date('Y-m-d').".pdf", "application/pdf", strlen($output));
            }ELSEIF($_GET['rtype'] == "" || $_GET['rtype'] == 50){
            	$output = $objClsSSS->generateTxtFileR3($oData, $_GET);
//            	printa($output);
//            	$myFile = "NR3001DK";
//				$fh = fopen($myFile, 'w') or die("can't open file");
//				$stringData = $output;
//				fwrite($fh, $stringData);
//				fclose($fh);
				Misc::FileDownloadHeader("NR3001DK.dat", "application/data", strlen($output));
				echo ($output);
				exit;
            }ELSE{
            	$objClsSSS->generateSSS_Premium_Report($_GET,$oData);
            }
		}
		break;
	case "delete":
		$objClsSSS->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=sss");
		exit;		
		break;
	default:
		$arrbreadCrumbs['SSS'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=sss&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&corectby=".$_POST['corectby']."&month=".$_POST['month']."&rtype=".$_POST['rtype']."&branchinfo_id=".$_POST['branchinfo_id']."&show=".$_POST['show']."&sbr=".$_POST['receiptno']."&date_paid=".$_POST['trasdate']);
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
