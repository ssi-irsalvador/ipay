<?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/setup/import201stat.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelreader.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/excelexporter.class.php');

Application::app_initialize();

$dbconn = Application::db_open();

$cmap = array(
"default" => "import201stat.tpl.php"
,"add" => "import201stat_form.tpl.php"
,"edit" => "import201stat_form.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Setup' => ''
,'Manage Import' => ''
,'Import Libraries' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Import 201 Status');
$mainBlock->templateDir .= "admin";


// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/setup";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/

$objClsImport201Stat = new clsImport201Stat($dbconn);

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Import 201 Status'] = 'setup.php?statpos=import201stat';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsImport201Stat->doValidateData($_POST)){
				$objClsImport201Stat->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsImport201Stat->Data);
//				printa($objClsImport201Stat->Data);
			}else {
				$objClsImport201Stat->doPopulateData($_POST);
				$objClsImport201Stat->doSaveAdd();
				header("Location: setup.php?statpos=import201stat");
				exit;
			}
		}
		break;

	case 'edit':
		$arrbreadCrumbs['Import 201 Status'] = 'setup.php?statpos=import201stat';
		$arrbreadCrumbs['Edit'] = "";
		if (count($_POST)>0) {
			// update
			if(!$objClsImport201Stat->doValidateData($_POST)){
				$objClsImport201Stat->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsImport201Stat->Data);
//				printa($objClsImport201Stat->Data);
			}else {
				$objClsImport201Stat->doPopulateData($_POST);
				$objClsImport201Stat->doSaveEdit();
				header("Location: setup.php?statpos=import201stat");
				exit;
			}
		}else{
			$oData = $objClsImport201Stat->dbFetch($_GET['edit']);
			$centerPanelBlock->assign("oData",$oData);
		}
		break;
		
	case "delete":
		$objClsImport201Stat->doDelete($_GET['delete']);
		header("Location: setup.php?statpos=import201stat");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Import 201 Status'] = "";
		if (count($_POST) > 0) {
			$postData = array_merge($_POST,$_FILES);
			if(!$objClsImport201Stat->doValidateData($postData)){
				$centerPanelBlock->assign("oData",$postData);
			}else { // do save
				$uptahead_id_=$objClsImport201Stat->doSaveImport201Stat($postData);
				header("Location: setup.php?statpos=import201stat");
				exit;
			}
		}
		$centerPanelBlock->assign('tblDataList',$objClsImport201Stat->getTableList());
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