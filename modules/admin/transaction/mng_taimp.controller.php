<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/transaction/mng_taimp.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "mng_taimp.tpl.php"
,"add" => "mng_taimp_form.tpl.php"
,"edit" => "mng_taimp_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Transaction' => ''
,'TA Import' => 'transaction.php?statpos=time_attend'
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Manage TA Import');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/transaction";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

$objClsMng_TAImp = new clsMng_TAImp($dbconn);
/*-!-!-!-!-!-!-!-!-*/
$centerPanelBlock->assign("TAlist",$objClsMng_TAImp->getTAlist());
$centerPanelBlock->assign("OTlist",$objClsMng_TAImp->getOTlist());
$centerPanelBlock->assign("Customlist",$objClsMng_TAImp->getCustomlist());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Manage TA Import'] = 'transaction.php?statpos=mng_taimp';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsMng_TAImp->doValidateData($_POST)){
				$objClsMng_TAImp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_TAImp->Data);
//				printa($objClsMng_TAImp->Data);
			}else{
				$objClsMng_TAImp->doPopulateData($_POST);
				$objClsMng_TAImp->doSaveAdd();
				header("Location: transaction.php?statpos=mng_taimp");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Manage TA Import'] = 'transaction.php?statpos=mng_taimp';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsMng_TAImp->doValidateData($_POST)){
				$objClsMng_TAImp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_TAImp->Data);
//				printa($objClsMng_TAImp->Data);
			}else {
				$objClsMng_TAImp->doPopulateData($_POST);
				$objClsMng_TAImp->doSaveEdit();
				header("Location: transaction.php?statpos=mng_taimp");
				exit;
			}
		}else{
			$oData = $objClsMng_TAImp->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsMng_TAImp->doDelete($_GET['delete']);
		header("Location: transaction.php?statpos=mng_taimp");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Manage TA Import'] = "";
		IF(count($_POST)>0) {
			// save add new
			IF(!$objClsMng_TAImp->doValidateData($_POST)){
				$objClsMng_TAImp->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsMng_TAImp->Data);
//				printa($objClsMng_TAImp->Data);
			}ELSE{
				$objClsMng_TAImp->doPopulateData($_POST);
				IF($_POST['bnt_ta']=='TA Save'){
					$objClsMng_TAImp->doSaveAdd(1,$_POST);
				}ELSEIF($_POST['bnt_ot']=='OT Save'){
					$objClsMng_TAImp->doSaveAdd(2);
				}ELSE{
					$objClsMng_TAImp->doSaveEdit(1);
				}
				header("Location: transaction.php?statpos=mng_taimp");
				exit;
			}
		}ELSE{
			$oData = $objClsMng_TAImp->dbFetch();
			$centerPanelBlock->assign("oData",$oData);
			$centerPanelBlock->assign('tblDataList_TA',$objClsMng_TAImp->getTableList(1));
			$centerPanelBlock->assign('tblDataList_OT',$objClsMng_TAImp->getTableList(2));
			$centerPanelBlock->assign('tblDataList_Custom',$objClsMng_TAImp->getTableList());
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