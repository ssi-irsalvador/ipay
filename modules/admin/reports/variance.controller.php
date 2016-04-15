 <?php
require_once(SYSCONFIG_CLASS_PATH.'blocks/mainblock.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/application.class.php');
require_once(SYSCONFIG_CLASS_PATH.'util/tablelist.class.php');
require_once(SYSCONFIG_CLASS_PATH.'admin/reports/variance.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$cmap = array(
"default" => "variance.tpl.php"
,"add" => "variance.tpl.php"
,"edit" => "variance.tpl.php"
);

$cmapKey = (isset($_GET['action']))?$_GET['action']:"default";
$arrbreadCrumbs = array(
'Reports' => ''
);

$cmapKey = isset($_GET['edit'])?"edit":$cmapKey;
$cmapKey = isset($_GET['delete'])?"delete":$cmapKey;

// Instantiate the MainBlock Class
$mainBlock = new MainBlock();
$mainBlock->assign('PageTitle','Variance Graph');
$mainBlock->templateDir .= "admin";



// Instantiate the BlockBasePHP for Center Panel Display
$centerPanelBlock = new BlockBasePHP();
$centerPanelBlock->templateDir  .= "admin/reports";
$centerPanelBlock->templateFile = $cmap[$cmapKey];

/*-!-!-!-!-!-!-!-!-*/
$objClsVariance = new clsVariance($dbconn);

//$connect = new clsV


$centerPanelBlock->assign('yeartake',$objClsVariance->getYear());

switch ($cmapKey) {
	case 'add': 
		$arrbreadCrumbs['Variance Graph'] = 'reports.php?statpos=variance';
		$arrbreadCrumbs['Add New'] = "";
		if (count($_POST)>0) {
			// save add new
			if(!$objClsVariance->doValidateData($_POST)){
				$objClsVariance->doPopulateData($_POST);
				$centerPanelBlock->assign("oData",$objClsVariance->Data);
//				printa($objClsVariance->Data);
			}else {
				$objClsVariance->doPopulateData($_POST);
				$objClsVariance->doSaveAdd();
				header("Location: reports.php?statpos=variance");
				exit;
			}
		}
		break;
	case 'edit':
		$arrbreadCrumbs['Variance Graph'] = 'reports.php?statpos=variance';
		$arrbreadCrumbs['Edit'] = "";
		$a=$_GET['year'];
		$centerPanelBlock->assign("graph",$list);
		//$centerPanelBlock->assign('barData',$objClsVariance->getBarData($month,$a));
		$exact = $objClsVariance->getExact($month,$a);
		$top = $objClsVariance->ceilingTop($month,$a);
		$barHeight = $objClsVariance->getBarHeight($exact,$top);
		$LValue = $objClsVariance->leftValues($month,$a);
		$centerPanelBlock->assign('barData',$barHeight);
		$centerPanelBlock->assign('exact',$exact);
		$centerPanelBlock->assign('tvalue',$objClsVariance->tvalue($barHeight));
		$centerPanelBlock->assign('top',$top);
		$centerPanelBlock->assign('LValue',$LValue);
		$centerPanelBlock->assign('LValueH',$objClsVariance->leftValuesH($LValue,$top));
		
		
		if(count($_POST)>0){
        	header("Location: reports.php?statpos=variance&edit&type="."&year=".$_POST['get']);
        }//if
		
		
		break;
	case "delete":
		$objClsVariance->doDelete($_GET['delete']);
		header("Location: reports.php?statpos=variance");
		exit;		
		break;

	default:
		$arrbreadCrumbs['Variance Graph'] = "";
		$centerPanelBlock->assign('tblDataList',$objClsVariance->getTableList());
		$centerPanelBlock->assign("graph",$BarMonth);
        $centerPanelBlock->assign("bar",$finalBar);
		$centerPanelBlock->assign("month",$month);
		if(count($_POST)>0){
        	header("Location: reports.php?statpos=variance&edit&type="."&year=".$_POST['get']);
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