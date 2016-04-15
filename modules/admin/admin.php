<?php
include_once(SYSCONFIG_CLASS_PATH."admin/application.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/appauth.class.php");
include_once(SYSCONFIG_CLASS_PATH."blocks/mainblock.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/homeadmin.class.php");

//Application::app_initialize(array("login_required"=> true));
Application::app_initialize();

$dbconn = Application::db_open();
//$dbconn->debug = true;
$authResult = true;
$_SESSION['admin_session_obj']['dtr_access'] = false;
if (count($_POST)>0 || (isset($_SESSION['admin_session_obj']['ipay_access']) && !$_SESSION['admin_session_obj']['ipay_access'])) {
	//echo "here";exit;
	$userAuth = new AppAuth($dbconn);
	$username = ((count($_POST)>0) ? $_POST['user_name'] : $_SESSION['admin_session_obj']['user_data']['user_name']);
	$password = ((count($_POST)>0) ? md5($_POST['user_password']) : $_SESSION['admin_session_obj']['user_data']['user_password']);;
	$authResult = $userAuth->doAuth($username,$password);
	if ($authResult) {
		$_SESSION['admin_session_obj']['user_id'] = $userAuth->userID;
		$_SESSION['admin_session_obj']['user_name'] = $userAuth->userName;
		$_SESSION['admin_session_obj']['user_type'] = $userAuth->userType;
		$_SESSION['admin_session_obj']['user_status'] = $userAuth->user_status;
		$_SESSION['admin_session_obj']['user_last_login'] = date("M d, Y");
		$_SESSION['admin_session_obj']['user_data'] = $userAuth->Data;
		$_SESSION['admin_session_obj']['JQUERY_PATH'] = SYSCONFIG_URL_PATH."includes/jquery";
		
		$sql = 
		"select * from app_modules dm 
		inner join app_userstypeaccess du on dm.mnu_id = du.mnu_id
		inner join app_users au on du.ud_id = au.ud_id 
		where du.user_type = ? and au.user_id=?
		and dm.mnu_parent not in (select mnu_id from app_modules) order by mnu_ord asc";
		$rsUserMenu = $dbconn->Execute($sql,array($_SESSION['admin_session_obj']['user_type'],$_SESSION['admin_session_obj']['user_id']));
		
	$arrMainMenu = array();
	while (!$rsUserMenu->EOF) {
		if(strtoupper($rsUserMenu->fields['mnu_name']) == 'HELP'){
				$arrMainMenu[] = array(
					"mnu_id" => null
					,"mnu_name" => 'DTR'
					,"mnu_icon" => null
					,"mnu_link" => SYSCONFIG_DTR_URL
				);
			}
		$arrMainMenu[] = $rsUserMenu->fields;
		$rsUserMenu->MoveNext();
	}
	$mnuArr = "";
	if(count($arrMainMenu)>0)
	$mnuArr = $userAuth->getModules($dbconn,$arrMainMenu);
	

	$mnuScript = "<script type='text/javascript'>\n";
	$mnuScript .= "var myMenu = [$mnuArr];\n";
	$mnuScript .= "cmDraw ('myMenuID', myMenu, 'hbr', '', 'ThemeOffice');\n";
	$mnuScript .= "</script>";
	
	$_SESSION['admin_session_obj']['user_menu'] = $mnuScript;	
	$_SESSION['admin_session_obj']['ipay_access'] = true;
	
	header("Location: index.php");
	exit;
	}
}

//print_r($userAuth);
$mainBlock = new MainBlock();
$mainBlock->templateDir .= "admin";

if (!isset($_SESSION['admin_session_obj']['user_id'])) {
  $centerPanelBlock = new BlockBasePHP();
  $centerPanelBlock->templateDir .= "admin";
  $centerPanelBlock->templateFile = "login.tpl.php";
	if (!$authResult) {
		$centerPanelBlock->assign("errMsg","Invalid username and password!");
	}
	$mainBlock->assign("centerPanel",$centerPanelBlock);
	$mainBlock->displayBlock();	
	
} else {
  	$centerPanelBlock = new BlockBasePHP();
  	$centerPanelBlock->templateDir .= "admin";
  	$centerPanelBlock->templateFile = "homeadmin.tpl.php";
  	
  	$objClsHomeAdmin = new clsHomeAdmin($dbconn);
	
  	$centerPanelBlock->assign('oDataSupervisor',$objClsHomeAdmin->getSupervisor());
  	$centerPanelBlock->assign('Total201',$objClsHomeAdmin->Total201());
  	$centerPanelBlock->assign('brachlist',$objClsHomeAdmin->sumEmpperLoc(1));
  	$centerPanelBlock->assign("oData_number_of_dependent",$objClsHomeAdmin->birthday_dependent());
  	
  	$mainBlock->assign('indexErrMsg',$indexErrMsg);
	$mainBlock->assign("centerPanel",$centerPanelBlock);
	$mainBlock->displayBlock();
}
?>