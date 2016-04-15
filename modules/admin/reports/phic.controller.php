<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/phic.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "phic.tpl.php"
,"add" => "phic_form.tpl.php"
,"edit" => "phic_form.tpl.php"
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
$mainBlock->assign('PageTitle','PHIC');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsPHIC = new clsPHIC($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign("type",$type);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['PHIC'] = 'reports.php?statpos=phic';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsPHIC->doValidateData($_POST)){
				$objClsPHIC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPHIC->Data);
//				printa($objClsPHIC->Data);
			}else {
				$objClsPHIC->doPopulateData($_POST);
				$objClsPHIC->doSaveAdd();
				header("Location: reports.php?statpos=phic");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['PHIC'] = 'reports.php?statpos=phic';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsPHIC->doValidateData($_POST)){
				$objClsPHIC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsPHIC->Data);
//				printa($objClsPHIC->Data);
			}else {
				$objClsPHIC->doPopulateData($_POST);
				$objClsPHIC->doSaveEdit();
				header("Location: reports.php?statpos=phic");
				exit;
			}
		}else{
			$oData = $objClsSSS->dbFetchContribution($_GET,1);
			$isLoc = $objClsSSS->getSettings($_GET['comp'],12);
			IF($isLoc && ($_GET['branchinfo_id'] != 0 || $_GET['branchinfo_id'] != "N/A")){
				$branch_details = $objClsSSS->getLocationInfo($_GET['branchinfo_id']);
		  		$compname = $branch_details['branchinfo_name'];
	        	$compadds = $branch_details['branchinfo_add'];
	        	$compphicno = $branch_details['branchinfo_phic'];
	        	$comptinno = $branch_details['branchinfo_tin'];
	        	$comptelno = $branch_details['branchinfo_tel1'];
	        	$compemail = $branch_details['branchinfo_email'];
		  	} else {
		  		$branch_details = $objClsSSS->dbfetchCompDetails($_GET['comp']);//get company info
	        	$compname = $branch_details['comp_name'];
	        	$compadds = $branch_details['comp_add'];
	        	$compzip = $branch_details['comp_zipcode'];
	        	$compphicno = $branch_details['comp_phic'];
	        	$comptinno = $branch_details['comp_tin'];
	        	$comptelno = $branch_details['comp_tel'];
	        	$compemail = $branch_details['comp_email'];
		  	}
		  	$oDataCompany = array(
		  		'comp_name' => $compname
		  		,'comp_phic' => $compphicno
		  		,'comp_add' => $compadds
		  		,'comp_email' => $compemail);
			if($_GET['rtype'] == "" || $_GET['rtype'] == '10'){
				IF($_GET['format'] == 'excel'){
					$objClsPHIC->generatePHIC_Premium_Report($_GET,$oData);
				}ELSE{
					$output = $objClsPHIC->getPDFResultRF1Payment($oData, $_GET);
					Misc::FileDownloadHeader("RF 1".date('Y-m-d').".pdf", "application/pdf", strlen($output));
					
				}
			}elseif($_GET['rtype'] == "" || $_GET['rtype'] == '20'){
				IF($_GET['type'] == 'Quarterly'){
					$output = $objClsPHIC->GenTxtFileRF1_Monthly($oData, $_GET);
					Misc::FileDownloadHeader("PH".date('Ym'), "application/text", strlen($output));
					echo ($output);
					exit;
				}ELSE{
					$qrtN = $objClsSSS->getQuarterPeriod($_GET['month']);
					$output = $objClsPHIC->generateTxtFileRF1($oData, $_GET);
					Misc::FileDownloadHeader("PH".$_GET['year'].$qrtN, "application/text", strlen($output));
					echo ($output);
					exit;
				}
			}elseif($_GET['rtype'] == "" || $_GET['rtype'] == '30'){
				//$output = header("Location: statutoryreport/PHIC ME-5 Report.PDF");
				if($_GET['format'] == 'excel'){
					$objClsPHIC->generatePHIC_Premium_Report($_GET,$oData);
				}else{
					//$output = $objClsPHIC->getPHICME5($_GET, $oDataCompany, $isLoc);
					$output = $objClsPHIC->generatePHICME5($_GET, $isLoc);
					Misc::FileDownloadHeader("PHIC ME-5 Report.PDF","application/pdf",strlen($output));
				}
			}else{
            	$output = $objClsPHIC->getPHICER2($_GET, $oDataCompany);
				Misc::FileDownloadHeader("PHIC Er-2 Report.PDF","application/pdf",strlen($output));
            }
		}
		break;
	case "delete":
		$objClsPHIC->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=phic");
		exit;		
		break;
	default:
		$arrbreadCrumbs['PHIC'] = "";
		if(count($_POST)>0){
            header("Location: reports.php?statpos=phic&edit&type=".$_POST['type']."&year=".$_POST['year']."&comp=".$_POST['comp_id']."&signatoryby=".$_POST['signatoryby']."&position=".$_POST['position']."&month=".$_POST['month']."&rtype=".$_POST['rtype']."&show=".$_POST['show']."&format=".$_POST['format']."&trasdate=".$_POST['trasdate']."&receiptno=".$_POST['receiptno']."&amountpaid=".$_POST['amountpaid']."&branchinfo_id=".$_POST['branchinfo_id']);
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