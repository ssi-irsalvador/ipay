<?php session_start();
if(isset($_SESSION['pData'])){
include_once(SYSCONFIG_CLASS_PATH."admin/application.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/appauth.class.php");
include_once(SYSCONFIG_CLASS_PATH."admin/sync.class.php");
include_once(SYSCONFIG_CLASS_PATH.'admin/reports/pslipr.class.php');
include_once(SYSCONFIG_CLASS_PATH.'admin/transaction/payroll_details.class.php');

Application::app_initialize();
$dbconn = Application::db_open();

$objClsPslipR = new clsPslipR($dbconn);
$objClsPayroll_Details = new clsPayroll_Details($dbconn);
$sendData = $_SESSION['pData'];
$oData = $objClsPslipR->dbFetch($_GET['send']);
$empList = $objClsPslipR->get_StatusEmp($sendData);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript" src="../includes/jscript/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="../includes/jscript/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="../includes/jscript/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="../includes/jscript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="../includes/jscript/autocomplete/jquery.autocomplete.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>OrangeHRM</title>
<link rel="stylesheet" href="../includes/jscript/autocomplete/jquery.autocomplete.css" type="text/css"/>
<link href="../themes/default/images/favicon.ico" rel="icon" type="image/gif" />

<script type="text/javascript">
$(document).ready(function() {
	$("a.popup").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});

	$("#various7").fancybox({
		'onStart'		:	function() {
			return window.confirm('This will update your 201 File with OrangeHRM. \n\n Are you sure you want to continue?');
		},
		'onCancel'	:	function() {
			alert('Data Synchronization Canceled!');
		},
		'hideOnOverlayClick' : false,
		'onClosed': function() {
			parent.location.reload(true);
		}
	});
});
</script>
<style type="text/css">
@import url("/orangeHRM_iPAY/admin/../themes/default/css/admin.css.php?thpath=/orangeHRM_iPAY/admin/../themes/default");
@import url("../includes/jscript/ThemeOffice/theme.css");

/*Tab Menu */
.indentmenu {
font: normal 12px Arial;
width: 100%; /*leave this value as is in most cases*/
}

.indentmenu ul {
margin: 0;
padding: 0;
float: left;
/* width: 80%; width of menu*/
background:#F6f6f6 url(images/inverted.png) center center repeat-x;
}

.indentmenu ul li {
display: inline;
}

.indentmenu ul li a {
float: left;
color: black; /*text color*/
padding: 5px 20px;
text-decoration: none;
border-right: 1px solid #CCCFD3;
border-top: 1px solid #CCCFD3;
border-left: 1px solid #CCCFD3;  /*navy divider between menu items*/
}

.indentmenu ul li a:visited {
color: black;
}

.indentmenu ul li a.selected {
color: black !important;
padding-top: 6px; /*shift text down 1px*/
padding-bottom: 4px;
background: white;
font-weight: bold;
}

.tabcontent {
float: left;
display:none;
font: normal 12px Arial;
width: 100%; /*leave this value as is in most cases*/
}

div#main_tab div {
border:1px solid #F6F6F6;
text-align:left;
}

@media print {
.tabcontent {
display:block !important;
}
}


<!-- End for Tab Menu-->

.divLeftHeader {
width:49%;
align:left;
}

#divHeadRight {
margin-top: 58px;
width:49%;
align:right;
}

#divHeadText {
font-size: 11px;
/*font-weight:bold;*/
padding:1px;
align:left;
width:100%;
font-family: Arial, Verdana, sans-serif, Helvetica;
font-weight: bold;
}

#divHeader {
/*padding-bottom:5px;*/
background-color: #FFFFF;
/*border-bottom:5px solid #AF7817;*/
height: 76px;
padding-left: 2px;
}

#divHeadTitle {
margin-top:3px;
line-height:26px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-weight:bold;
font-size:20px;
width:100%;
color:#343497;
}

#divHeadTitle_ {
line-height:8px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-weight:bold;
font-size:10px;
width:250px;
color:#343497;
}

#divHeadAppTitle {
margin-top:3px;
font-family:trebuchet ms, arial, verdana;
font-weight:bold;
font-size:14pt;
color:#FF5A00;
}

#mnuContent {
	background: none repeat scroll 0 0 #FCB334;
	border: 0 none;
	height: 25px;
	min-width: 75em;
	padding-left: 10px;
	position: relative;
	background-color: #FCB334;/*height:25px;
background-color:#C1E6FC;
border-bottom:1px solid #79CCFE;*/
}

#divMainContent {
border-top:0px solid #F3F9FE;
padding:0px;
}

#myMenuID {
margin-top:0px;
margin-left:2px;
height:25px;
}
.left {
clear:none;
float:left;
}

.right {
clear:none;
float:right;
}

.breadCrumbs01 {
font-size:8pt;
font-weight:bold;
color:#EF6B00;
}

.breadCrumbs01 a {
font-size:8pt;
font-weight:bold;
color:#EF6B00;
}
body {
width:100%;
height:100%;
}

label {
float: left;
clear: left;
width: 8em;
}

.noninput {
border:0px solid #CCCCCCC;
}

.red {
color:#000000;
font-weight:bold;
font-size:9pt;
}

.send_success{
color:green;
}
.send_failed{
color:red;
}
</style>
<noscript><meta http-equiv="refresh" content="0; url= nojavascript.html" /></noscript> 
<script type="text/javascript" src="../includes/jscript/JSCookMenu_mini.js"></script>
<script type="text/javascript" src="../includes/jscript/JSCookMenu.js"></script>
<script type="text/javascript" src="../includes/jscript/bbyscript.js"></script>
<script type="text/javascript" src="../includes/jscript/common.php"></script>
</head>
<body>
<div id='saving' name='saving' style='display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background-image:url(/orangeHRM_iPAY/admin/../themes/default/images/saving.png);opacity:0.4;filter:alpha(opacity=80)'><!--<img src='loading.gif'  style='position:absolute;top:50%;left:50%;' >--></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <?php if(isset($_SESSION['admin_session_obj']['user_id'])){ ?>
  <tr>
    <td>
	  <div id="divHeader">
		<div id="divLeftHeader" align="left" class="left">
		  <div class="left"><img src="<?php echo SYSCONFIG_DEFAULT_IMAGES; ?>admin/sigma.png" alt="Logo" width="337" height="62" hspace="8" /></div>
		  <div id="divHeadAppTitle"><?php //echo SYSCONFIG_COMPANY?></div>
		  <div id="divHeadTitle_"><?php //echo SYSCONFIG_TITLE?></div>
		</div>
	<div id="divHeadRight" class="right" align="right">
		<div id="divHeadText">Welcome&nbsp;&nbsp;<?=$_SESSION['admin_session_obj']['user_data']['user_fullname']?>&nbsp;&nbsp;<?php IF ($_SESSION['admin_session_obj']['user_type']!='ESS') { ?><a id="various7" href="<?php echo constant("BASE_URL");?>index.php?statpos=sync" style="color: #444; text-decoration: underline;">Synchronize Data</a><?php } ?>&nbsp;&nbsp;<!--<img src="<?php //echo $themeImagesPath?>admin/menu/man.png" width="16" height="16" align="absmiddle" hspace="5" />&nbsp;(<?php //$_SESSION['admin_session_obj']['user_data']['user_type_name']onclick="return confirm('This will update your 201 File with OrangeHRM. \n\n Are you sure you want to continue?');"?>)
		  &nbsp;<img src="<?php //$themeImagesPath?>admin/menu/calendar.png" width="16" height="16" align="absmiddle" hspace="5" /><?php //$_SESSION['admin_session_obj']['user_last_login']?>&nbsp;
| <img src="<?php //echo $themeImagesPath?>admin/menu/exit.png" width="16" height="16" align="absmiddle" hspace="5" />--><a href="index.php?statpos=logout" onclick="return confirm('Are you sure, you want to logout?');" style="color: #444; text-decoration: underline;">Logout</a>&nbsp;&nbsp;</div>
	</div>
</div></td>
  </tr>	
  <tr>
    <td>
	 <div id="mnuContent">
	<?php
	if(isset($_SESSION['admin_session_obj']['user_menu'])){
	?>
			<div id="myMenuID"></div>
			<?php echo $_SESSION['admin_session_obj']['user_menu'];?>
	<?php
	}
	?>
	  </div></td>
  </tr>
  <?php } ?>
    <tr>
    <td>
	<div id="divMainContent">
<div class="breadCrumbs01">
	<img src="/orangeHRM_iPAY/admin/../includes/jscript/ThemeOffice/folder_yellow.ico" width="16" height="16" align="absbottom" vspace="2"> <span class="breadCrumbs">Reports</span> &gt; <a href="reports.php?statpos=pslipr" class="breadCrumbs">Payslip Report</a> &gt; <span class="breadCrumbs">Send</span>	</div>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Send Email</h2></fieldset>
<fieldset class="themeFieldset01">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group</em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pps_name']?>
      </strong></td>
      <td class="divTblTH_"><em>Type</em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$oData['salaryclass_id']?>
      </strong></td>
      </tr>
    <tr>
      <td class="divTblTH_"><em>Start Date </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['payperiod_start_date']?>
      </strong></td>
      <td class="divTblTH_"><em>End Date </em></td>
      <td width="16%" class="divTblTH_"><strong>
        <?=$oData['payperiod_end_date']?>
      </strong></td>
      <td width="12%" class="divTblTH_"><em>Pay Date </em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['payperiod_trans_date']?>
      </strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Status</em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['pp_stat_id']?>
      </strong></td>
      <td width="18%" class="divTblTH_"><em>Total No. of Employee </em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=count($empList)?>
      </strong></td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01">
<div id="msg">&nbsp;</div>
<table width="100%" border="0" cellpadding="2" cellspacing="0" id="tbl_list" style="border: 1px inset #FAD163; -moz-border-radius: 1px;">
<tbody>
	<tr>
	    <td class="divTblListTH" width="25%">Full Name</td>
	    <td class="divTblListTH" width="15%">Status</td>
	    <td class="divTblListTH" width="60%">Message</td>
	</tr>
	<?php for($ctr=0;$ctr<count($empList);$ctr++){?>
	<tr class="divTblListTR2" id="<?= $empList[$ctr]['emp_id']?>">
	   	<td class="divTblListTD" id="fullname"><?= $empList[$ctr]['fullname']?></td>
	   	<td class="divTblListTD" id="sending_status<?= $empList[$ctr]['emp_id']?>">Sending</td>
	   	<td class="divTblListTD" id="sending_msg<?= $empList[$ctr]['emp_id']?>">&nbsp;</td>
	</tr>
	<?php } ?>
</tbody></table>
</fieldset>
</div>
<div></div>
	</div>		</td>
  </tr>
</table>
</body>
</html>
<?php flush();
    ob_flush();
    sleep(3);
    $payslipFORMAT_ = $objClsPayroll_Details->getGeneralSetup('Payslip FORM');
    $oData_ = $objClsPslipR->dbFetch_Payslip($_GET['send']);
 	$objClsPslipR->sendEmail($sendData,$oData_,$payslipFORMAT_);
} else {
	header("Location: reports.php?statpos=pslipr&email=".$_GET['send']);
}
?>