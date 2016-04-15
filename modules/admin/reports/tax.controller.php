<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/tax.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/sss.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "tax.tpl.php"
,"add" => "tax_form.tpl.php"
,"edit" => "tax_form.tpl.php"
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
$mainBlock->assign('PageTitle','Tax');
$mainBlock->templateDir .= "admin";

// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsTAX = new clsTAX($dbconn);
$objClsSSS = new clsSSS($dbconn);

$centerPanelBlock->assign("month",$month);
$centerPanelBlock->assign("year",$year);
$centerPanelBlock->assign('comp',$objClsSSS->dbfetchBranchDetails());
$centerPanelBlock->assign('localinfo',$objClsSSS->dbfetchLocationDetails());
$centerPanelBlock->assign('empList',$objClsTAX->getEmployeeList());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Tax'] = 'reports.php?statpos=tax';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsTAX->doValidateData($_POST)){
				$objClsTAX->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTAX->Data);
//				printa($objClsTAX->Data);
			}else {
				$objClsTAX->doPopulateData($_POST);
				$objClsTAX->doSaveAdd();
				header("Location: reports.php?statpos=tax");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Tax'] = 'reports.php?statpos=tax';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsTAX->doValidateData($_POST)){
				$objClsTAX->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsTAX->Data);
//				printa($objClsTAX->Data);
			}else {
				$objClsTAX->doPopulateData($_POST);
				$objClsTAX->doSaveEdit();
				header("Location: reports.php?statpos=tax");
				exit;
			}
		}else{
//			$oData = $objClsTAX->dbFetch($_GET['edit']);
//			$centerPanelBlock->assign("oData",$oData);
			if($_GET['type'] == "" || $_GET['type'] == 10){				
				//$output = header("Location: statutoryreport/2316_FORM.pdf");
                $output = $objClsTAX->getForm2316($_GET);
				//Misc::FileDownloadHeader("BIR 2316 Form.pdf","application/pdf",strlen($output));
			}elseif($_GET['type'] == "" || $_GET['type'] == 20){
				if($_GET['format'] == 'excel'){
					$objClsTAX->get1601CExcel($_GET);
				} else {
					$objClsTAX->get1601CPDF1($_GET);
				//$output = header("Location: statutoryreport/BIR Form 1601C.PDF");
				//Misc::FileDownloadHeader("BIR Form 1601C.pdf","application/pdf",strlen($output));
				}
            }else{
            	$objClsTAX->getPDFMonthlyRemittance1($_GET);
            	//print_r($_GET);
           	}
		}
		break;
	case "delete":
		$objClsTAX->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=tax");
		exit;		
		break;
	default:
		$arrbreadCrumbs['Tax'] = "";
//		$centerPanelBlock->assign('tblDataList',$objClsTAX->getTableList());
//		break;
		if(count($_POST)>0){
			if($_POST['type'] == '30'){
            	header("Location: reports.php?statpos=tax&edit&type=".$_POST['type']."&comp=".$_POST['comp_id']."&month=".$_POST['month']."&year=".$_POST['year']."&rep=".$_POST['rep']."&pos_rep=".$_POST['pos_rep']."&tin_rep=".$_POST['tin_rep']."&treasurer=".$_POST['treasurer']."&issue_date=".$_POST['issue_date']."&exp_date=".$_POST['exp_date']."&pos_tre=".$_POST['pos_tre']."&tin_tre=".$_POST['tin_tre']."&acc=".$_POST['acc']."&branchinfo_id=".$_POST['branchinfo_id']);
        		exit;
			} elseif($_POST['type'] == '20') {
				header("Location: reports.php?statpos=tax&edit&type=".$_POST['type']."&comp=".$_POST['comp_id']."&month=".$_POST['month']."&year=".$_POST['year']."&format=".$_POST['format']."&branchinfo_id=".$_POST['branchinfo_id']);
        		exit;
			} else {
				header("Location: reports.php?statpos=tax&edit&type=".$_POST['type']."&comp=".$_POST['comp_id']."&emp=".$_POST['employee']."&year=".$_POST['year']."&rep=".$_POST['representative']);
        		exit;
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