<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/ytd_sumtotal.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');
require_once(SYSCONFIG_CLASS_PATH."util/PHPExcel.php");
require_once(SYSCONFIG_CLASS_PATH."util/PHPExcel/IOFactory.php");

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "ytd_sumtotal.tpl.php"
,"add" => "ytd_sumtotal_form.tpl.php"
,"edit" => "ytd_sumtotal_info.tpl.php"
,"view" => "ytd_sumtotal_form.tpl.php"
,"viewdetails" => "ytd_details.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => '',
'YTD Import' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;
$cmapKey = isset($_GET['view'])?"view":$cmapKey;
$cmapKey = isset($_GET['download'])?"download":$cmapKey;
$cmapKey = isset($_GET['deleteEmp'])?"deleteEmp":$cmapKey;
$cmapKey = isset($_GET['viewdetails'])?"viewdetails":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','YTD Summary Total');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsYTD_SumTotal = new clsYTD_SumTotal($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign("importTYPE",$importTYPE);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Import YTD Data'] = 'transaction.php?statpos=ytd_import';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsYTD_SumTotal->doValidateData($_POST)){
				$objClsYTD_SumTotal->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsYTD_SumTotal->Data);
//				printa($objClsYTD_SumTotal->Data);
			}else {
				$objClsYTD_SumTotal->doPopulateData($_POST);
				$objClsYTD_SumTotal->doSaveAdd();
				header("Location: transaction.php?statpos=ytd_import");
				exit;
			}
		}
		break;

	case 'view':
		$arrbreadCrumbs['Import YTD Data'] = 'transaction.php?statpos=ytd_import';
		$centerPanelBlock->assign('tblDataList',$objClsYTD_SumTotal->getImportInfo($_GET));
		$arrbreadCrumbs['Header'] = "";
		if (count($_POST)>0) {
			// update
			$postData = array_merge($_POST,$_FILES);
			if(!$objClsYTD_SumTotal->doValidateData($postData, $_GET)){
				$objClsYTD_SumTotal->doPopulateData($postData);
				$centerPanelBlock->assign("oData",$objClsYTD_SumTotal->Data);
//				printa($objClsYTD_SumTotal->Data);
			}else {
				if($postData['import_type']==1){
					$objClsYTD_SumTotal->doSummarySaveImport($postData, $_GET);
				} elseif($postData['import_type']==2) {
					$objClsYTD_SumTotal->doPESaveImport($postData, $_GET);
				}
//				$objClsYTD_SumTotal->doPopulateData($_POST);
//				$objClsYTD_SumTotal->doSaveEdit();
				header("Location: transaction.php?statpos=ytd_import&view&ppsid=".$_GET['ppsid']."&ppid=".$_GET['ppid']);
				exit;
			}
		}else{
			$oData = $objClsYTD_SumTotal->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsYTD_SumTotal->doDelete($_GET['ytdhead']);
		header("Location: transaction.php?statpos=ytd_import");
		exit;		
		break;
	
	case "deleteEmp":
		$objClsYTD_SumTotal->doDeleteEmp($_GET['ytdhead'], $_GET['emp_id']);
		header("Location: transaction.php?statpos=ytd_import&edit&ytdhead=".$_GET['ytdhead']."&ppsid=".$_GET['ppsid']."&ppid=".$_GET['ppid']);
		exit;		
		break;
		
	case "edit":
		$arrbreadCrumbs['Import YTD Data'] = 'transaction.php?statpos=ytd_import';
		$centerPanelBlock->assign('oData', $objClsYTD_SumTotal->getPPDetails($_GET['ppid']));
		$centerPanelBlock->assign('tblDataList',$objClsYTD_SumTotal->getEmployeeYTD($_GET));
		$arrbreadCrumbs['Header'] = "transaction.php?statpos=ytd_import&view&ppsid=".$_GET['ppsid']."&ppid=".$_GET['ppid'];
		$arrbreadCrumbs['Details'] = "";
		break;
	
	case "download":
		$objClsYTD_SumTotal->doDownloadTemplate();
		break;
	
	case "viewdetails":
		$arrbreadCrumbs['Import YTD Data'] = "transaction.php?statpos=ytd_import";
		$arrbreadCrumbs['Header'] = "transaction.php?statpos=ytd_import&view&ppsid=".$_GET['ppsid']."&ppid=".$_GET['ppid'];
		$arrbreadCrumbs['Details'] = "transaction.php?statpos=ytd_import&edit&ytdhead=".$_GET['ytdhead']."&ppsid=".$_GET['ppsid']."&ppid=".$_GET['ppid'];
		$arrbreadCrumbs['Employee Details'] = "";
		$oData = $objClsYTD_SumTotal->dbFetch($_GET);
		//printa($oData);
		$centerPanelBlock->assign("objClsMngeDecimal",$objClsMngeDecimal);
		$centerPanelBlock->assign('oData', $oData);
		
	default:
		$arrbreadCrumbs['Import YTD Data'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsYTD_SumTotal->getTableList());
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