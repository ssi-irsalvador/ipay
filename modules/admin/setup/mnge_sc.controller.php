<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_sc.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;
$cmap = array(
"default" => "mnge_sc.tpl.php"
,"sc_code" => "mnge_sc.tpl.php"
,"add" => "mnge_sc_form.tpl.php"
,"edit" => "mnge_sc.tpl.php"
,"deletesc" => "mnge_sc.tpl.php"
,"deletescrecords" => "mnge_sc.tpl.php"
,"updatescrecords" => "mnge_sc.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['deletesc'])?"deletesc":$cmapKey;
$cmapKey = isset($_GET['deletescrecords'])?"deletescrecords":$cmapKey;
$cmapKey = isset($_POST['updatescrecords'])?"updatescrecords":$cmapKey;
$cmapKey = isset($_POST['savescrecords'])?"savescrecords":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle', 'Manage Statutory Contribution');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_SC = new clsMnge_SC($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$currentPage =$_POST['dec_id']?"&dec_id=".$_POST['dec_id']."&edit=".$_POST['dec_id']:'';
$getPage =$_GET['dec_id']?"&dec_id=".$_GET['dec_id']."&edit=".$_GET['dec_id']:'';
switch ($cmapKey) {
	case 'add': 
	
		$arrbreadCrumbs['Manage Statutory Contribution'] = 'setup.php?statpos=mnge_sc';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMnge_SC->doValidateData($_POST)){
				$objClsMnge_SC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_SC->Data);
//				printa($objClsMnge_SC->Data);
			} else {
				$objClsMnge_SC->doPopulateData($_POST);
				$objClsMnge_SC->doSaveAdd();
				header("Location: setup.php?statpos=mnge_sc&dec_id=".mysql_insert_id()."&edit=".mysql_insert_id());
				exit;
			}
		}$centerPanelBlock->assign('tblDataList',$objClsMnge_SC->getTableList());
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Statutory Contribution'] = 'setup.php?statpos=mnge_sc';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMnge_SC->doValidateData($_POST)){
				$objClsMnge_SC->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_SC->Data);
//				printa($objClsMnge_SC->Data);
			}else if($_GET['sc_id'] AND !$_GET['scr_id']) {
				$objClsMnge_SC->doPopulateData($_POST);
				$objClsMnge_SC->doSaveEdit();
				header("Location: setup.php?statpos=mnge_sc".$currentPage."&sc_id=".$_GET['sc_id']);
				exit;
			} else {
				$objClsMnge_SC->doPopulateData($_POST);
				$objClsMnge_SC->doSaveAdd();
				header("Location: setup.php?statpos=mnge_sc".$currentPage."&sc_id=".mysql_insert_id());
				exit;
			}
		} else {
			if($_GET['sc_id'] AND $_GET['scr_id'])
			{
				$oData = $objClsMnge_SC->dbFetch($_GET['scr_id'],'scr_id');
				$centerPanelBlock->assign("scrData",$oData);
			}
		
			$oData = $objClsMnge_SC->dbFetch($_GET['sc_id']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_SC->getTableList());
			$centerPanelBlock->assign('scheme',$objClsMnge_SC->scheme());
			$centerPanelBlock->assign('statutory',$objClsMnge_SC->statutory());
			
		}
		break;
		
	case "updatescrecords";
	$objClsMnge_SC->doPopulateData($_POST,false,true);
	$objClsMnge_SC->doSaveEdit('sc_records');
	header("Location: setup.php?statpos=mnge_sc".$currentPage."&sc_id=".$_GET['sc_id']);
	exit;
	break;
		
	case "savescrecords";
	$objClsMnge_SC->doPopulateData($_POST,false,true);
	$objClsMnge_SC->doSaveAdd('sc_records');
	header("Location: setup.php?statpos=mnge_sc".$currentPage);
	exit;
	break;
		
	case "deletesc":
		$objClsMnge_SC->doDelete($_GET['sc_id'],'statutory_contribution');
		$objClsMnge_SC->doDelete($_GET['sc_id'],'sc_records');
		header("Location: setup.php?statpos=mnge_sc".$getPage);
		exit;		
		break;
		
	case "deletescrecords":
		$objClsMnge_SC->doDelete($_GET['scr_id'],'sc_records','scr_id');
		header("Location: setup.php?statpos=mnge_sc".$getPage);
		exit;		
		break;
		

	default:
		$arrbreadCrumbs['Manage Statutory Contribution'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_SC->getTableList());
		$centerPanelBlock->assign('scheme',$objClsMnge_SC->scheme());
		$centerPanelBlock->assign('statutory',$objClsMnge_SC->statutory());

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