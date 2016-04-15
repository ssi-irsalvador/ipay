<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/mnge_tt.class.php');

Application::app_initialize();

$dbconn = Application::db_open();
$dbconn->debug=0;
$cmap = array(
"default" => "mnge_tt.tpl.php"
,"add" => "mnge_tt.tpl.php"
,"edit" => "mnge_tt.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Admin' => '',
'Libraries' => '',
'Manage Income Tax' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
//$cmapKey = isset($_GET['editt'])?"editt":$cmapKey;
$cmapKey = isset($_GET['deletett'])?"deletett":$cmapKey;
$cmapKey = isset($_GET['deletetp'])?"deletetp":$cmapKey;
$cmapKey = (isset($_POST['tp_add']) AND !isset($_GET['edit']))?"add":$cmapKey;

$cmapKey = isset($_POST['tt_add'])?"tt_add":$cmapKey;
$cmapKey = isset($_POST['tt_update'])?"tt_update":$cmapKey;



// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage Tax Table');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];


/*-!-!-!-!-!-!-!-!-*/

$objClsMnge_TT = new clsMnge_TT($dbconn);
$objClsMngeDecimal = new Application();
$centerPanelBlock->assign('genDecimal',$objClsMngeDecimal->getGeneralDecimalSettings());
$centerPanelBlock->assign('paygroup',$objClsMnge_TT->paygroup);
switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage Tax Table'] = 'setup.php?statpos=mnge_tt';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
				$objClsMnge_TT->doPopulateData($_POST);
				$objClsMnge_TT->doSaveAdd();
				header("Location: setup.php?statpos=mnge_tt&tp_id=".mysql_insert_id()."&edit=".mysql_insert_id());
//				header("Location: setup.php?statpos=mnge_tt");
				exit;
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage Tax Table'] = 'setup.php?statpos=mnge_tt';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
	
			// update
			if(!$objClsMnge_TT->doValidateData($_POST)){
				$objClsMnge_TT->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMnge_TT->Data);
				header("Location: setup.php?statpos=mnge_tt");
				//printa($objClsMnge_TT->Data);
			}else {
				$objClsMnge_TT->doPopulateData($_POST);
				$objClsMnge_TT->doSaveEdit();
				header("Location: setup.php?statpos=mnge_tt&tp_id=".$_GET['tp_id']."&edit=".$_GET['edit']);
			}
		}else{
			$oData = $objClsMnge_TT->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList',$objClsMnge_TT->getTableList());
			$centerPanelBlock->assign('scheme',$objClsMnge_TT->scheme());
			$centerPanelBlock->assign('exemption',$objClsMnge_TT->exemption());
			$centerPanelBlock->assign('policy',$objClsMnge_TT->policy());
			$centerPanelBlock->assign('tt',$objClsMnge_TT->tax_table());
			$centerPanelBlock->assign('tax_policy',$objClsMnge_TT->getTaxPolicy($_GET['tp_id']));
		}
		break;
		
	case "tt_update"://tax table
		$objClsMnge_TT->tt_update();
		header("Location: setup.php?statpos=mnge_tt&tp_id=".$_GET['tp_id']."&edit=".$_GET['edit']."&paygroup=".$_GET['paygroup']."&exemption=".$_GET['exemption']."&editt=".$_GET['editt']);
		break;
		
	case "deletett":
		$objClsMnge_TT->doDelete($_GET['deletett'],'tax_table','tt_id');
		header("Location: setup.php?statpos=mnge_tt&tp_id=".$_GET['tp_id']."&edit=".$_GET['edit']."&paygroup=".$_GET['paygroup']."&exemption=".$_GET['exemption']."");
		exit;		
		break;
		
	case "deletetp":
		$objClsMnge_TT->doDelete($_GET['tp_id'],'tax_policy');
		header("Location: setup.php?statpos=mnge_tt");
		exit;		
		break;
		
	case 'tt_add':
	if($_POST['tp_id']){
	$objClsMnge_TT->doPopulateData($_POST,false,true);
	if($objClsMnge_TT->doSaveAdd('tax_table')){
	$_SESSION['eMsg']="Successfully addded.";
	header("Location: setup.php?statpos=mnge_tt");
	}
	else{
	header("Location: setup.php?statpos=mnge_tt&tp_id=".$_GET['tp_id']."&edit=".$_GET['edit']."&paygroup=".$_GET['paygroup']."&exemption=".$_GET['exemption']."");
	}
	
	}else{
	header("Location: setup.php?statpos=mnge_tt");
	$_SESSION['eMsg']="Please specify the tax table.";
	}
	exit;
	break;
	

	default:
		$arrbreadCrumbs['Manage Tax Table'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsMnge_TT->getTableList());
		$centerPanelBlock->assign('scheme',$objClsMnge_TT->scheme());
		$centerPanelBlock->assign('exemption',$objClsMnge_TT->exemption());
		$centerPanelBlock->assign('policy',$objClsMnge_TT->policy());
		//$centerPanelBlock->assign('param',$objClsMnge_TE->js_param());
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