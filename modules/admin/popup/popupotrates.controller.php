<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/popupotrates.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "popupotrates.tpl.php"
,"assign" => "popupotrates.tpl.php"
,"edit" => ""
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Employee Type' => ''
);

$cmapKey = isset($_POST['assignrates'])?"assign":$cmapKey;

//print "<script>alert('".$cmapKey."');</script>";
// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','PopupType');
$mainBlock->templateDir .= "admin";
$mainBlock->templateFile = "index_popup.tpl.php";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/popup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objCls_addotrates = new clsEMPType($dbconn);

switch ($cmapKey) {
	case 'assign': 
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Add New'] = "";
//		echo "hisave";
//		exit;
		if (count($_POST)>0 AND !empty($_POST['otr_rate'])) {
			$rates = trim(implode(',',$_POST['otr_rate']));
		}else if(count($_POST)>0 AND empty($_POST['otr_rate'])){
		$rates = 0;
		}
		$objCls_addotrates->doSaveEdit($rates);
		$centerPanelBlock->assign('tblDataList',$objCls_addotrates->getTableList());
		break;

	case 'edit':
		$arrbreadCrumbs['PopupType'] = 'popup.php?statpos=popuptype';
		$arrbreadCrumbs['Edit'] = "";
		echo "hiedit";
		exit;
		if (count($_POST)>0) {
			// update
			if(!$objCls_addotrates->doValidateData($_POST)){
				$objCls_addotrates->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objCls_addotrates->Data);
//				printa($objCls_addotrates->Data);
			}else {
				$objCls_addotrates->doPopulateData($_POST);
				$objCls_addotrates->doSaveEdit();
				header("Location: popup.php?statpos=popuptype");
				exit;
			}
		}else{
			$oData = $objCls_addotrates->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objCls_addotrates->doDelete($_GET['delete']);
		header("Location: popup.php?statpos=popuptype");
		exit;		
		break;

	default:
		$arrbreadCrumbs['PopupType'] = "";
//		$centerPanelBlock->assign('tblDataList',$objCls_addotrates->getpopup_OTrate());
		$centerPanelBlock->assign('tblDataList',$objCls_addotrates->getTableList());
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