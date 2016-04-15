<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=SYSCONFIG_TITLE?></title>
<style type="text/css">
<!--

@import url("<?=$themeCSSPath?>admin.css.php?thpath=<?=SYSCONFIG_THEME_URLPATH.SYSCONFIG_THEME?>");
@import url("../includes/jscript/ThemeOffice/theme.css");
/*
@import url("../css/default.css");
*/
-->
<!--Tab Menu -->
.indentmenu{
font: normal 12px Arial;
width: 100%; /*leave this value as is in most cases*/
}

.indentmenu ul{
margin: 0;
padding: 0;
float: left;
/* width: 80%; width of menu*/

background:#F6f6f6 url(images/inverted.png) center center repeat-x;
}

.indentmenu ul li{
display: inline;
}

.indentmenu ul li a{
float: left;
color: black; /*text color*/
padding: 5px 20px;
text-decoration: none;
border-right: 1px solid #CCCFD3;
border-top: 1px solid #CCCFD3;
border-left: 1px solid #CCCFD3;  /*navy divider between menu items*/
}

.indentmenu ul li a:visited{
color: black;
}

.indentmenu ul li a.selected{
color: black !important;
padding-top: 6px; /*shift text down 1px*/
padding-bottom: 4px;
background: white;
font-weight: bold;
}




.tabcontent{
float: left;
display:none;
font: normal 12px Arial;
width: 100%; /*leave this value as is in most cases*/
}

div#main_tab div
{
border:1px solid #F6F6F6;
text-align:left;
}

@media print {
.tabcontent {
display:block !important;
}
}


<!-- End for Tab Menu-->

.divLeftHeader{
align:left;
width:200px;
}
#divHeadRight{
margin-top:2px;
width:680px;
align:right;
}
#divHeadText{
font-size:8pt;
/*font-weight:bold;*/
padding:1px;
align:left;
width:680px;
font-family:Verdana, Arial, sans-serif, Helvetica;
}
#divHeader{
padding-top:5px;
background-color:#F5FBFF;
border-bottom:5px solid #D3D3D3;
height:85px;
}
#divHeadTitle{
margin-top:3px;
line-height:26px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-weight:bold;
font-size:20px;
width:550px;
color:#343497;
}
#divHeadTitle_{
margin-top:2px;
line-height:18px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-weight:bold;
font-size:15px;
width:550px;
color:#343497;
}
#divHeadAppTitle{
margin-top:1px;
font-family:trebuchet ms, arial, verdana;
font-weight:bold;
font-size:13pt;
color:#FF5A00;
}
#mnuContent{
height:25px;
background-color:#C1E6FC;
border-bottom:1px solid #79CCFE;
}
#divMainContent{
border-top:1px solid #F3F9FE;
padding:2px;
}

#myMenuID{
margin-top:0px;
margin-left:2px;
height:25px;
}
.left{
clear:none;
float:left;
}

.right{
clear:none;
float:right;
}

.breadCrumbs01{
font-size:10pt;
font-weight:bold;
color:#EF6B00;
}

.breadCrumbs01 a{
font-size:10pt;
font-weight:bold;
color:#EF6B00;
}
body{
width:100%;
height:100%;
}

label 
{
float: left;
clear: left;
width: 8em;
}

.noninput{
border:0px solid #CCC;
}

.red
{
color:#000000;
font-weight:bold;
font-size:9pt;
}

</style>
</head>
<noscript><meta http-equiv="refresh" content="0; url= nojavascript.html" /></noscript> 
<script type="text/javascript" src="../includes/jscript/JSCookMenu_mini.js"></script>
<script type="text/javascript" src="../includes/jscript/JSCookMenu.js"></script></head>
<script type="text/javascript" src="../includes/jscript/bbyscript.js"></script></head>
<script type="text/javascript" src="../includes/jscript/common.php"></script></head>

<body>
<div id='saving' name='saving' style='display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background-image:url(<?=$themeImagesPath?>saving.png);opacity:0.4;filter:alpha(opacity=80)'><!--<img src='<?//=$themeImagesPath?>loading.gif'  style='position:absolute;top:50%;left:50%;' >--></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php if(isset($_SESSION['admin_session_obj']['user_id'])){ ?>
  <tr>
    <td>
	  <div id="divHeader">
		<div  id="divHeadLeft" class="left">
		  <div class="left"><img src="<?=$themeImagesPath?>admin/sigma.png" alt="Logo" width="70" height="70" hspace="10" /></div>
		  <div id="divHeadTitle"><?=SYSCONFIG_COMPANY?></div>
		  <div id="divHeadTitle_"><?=SYSCONFIG_TITLE?></div>
		  <div id="divHeadAppTitle"><?=$_SESSION['admin_session_obj']['user_data']['ud_name']?></div>
		</div>

	<div id="divHeadRight" class="right">
		<div id="divHeadText"><b><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/user.png'?>" width="16" height="16" align="absmiddle" hspace="5" /><?=$_SESSION['admin_session_obj']['user_data']['user_fullname']?></b>&nbsp; <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/tool.PNG'?>" width="16" height="16" align="absmiddle" hspace="5" /><?=$_SESSION['admin_session_obj']['user_data']['user_type_name']?>
		  &nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/globe.PNG'?>" width="16" height="16" align="absmiddle" hspace="5" /><?=$_SESSION['admin_session_obj']['user_data']['ud_name']?>&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/time2.png'?>" width="16" height="16" align="absmiddle" hspace="5" />
		  <?= date('l,')?>
          <?=$_SESSION['admin_session_obj']['user_last_login']?>|<?=date('h:i A')?>&nbsp;
| <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/logout.PNG'?>" width="16" height="16" align="absmiddle" hspace="5" /><a href="index.php?statpos=logout" onclick="return confirm('Are you sure, you want to logout?');">Logout</a></div>
		<div id="divHeadText"></div>
		<div id="divHeadText"></div>
		<div id="divHeadText"></div>
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

	<?php
	if(!empty($breadCrumbs)){
	?>
	<div class="breadCrumbs01">
	<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'folder_yellow.ico'?>" width="16" height="16" align="absbottom" vspace="2" /> <?=$breadCrumbs;?>
	</div>
	<?php
	}
			if(is_object($centerPanel))
			print $centerPanel->fetchBlock();
	?>
	<div><?=$indexErrMsg?></div>
	</div>		</td>
  </tr>
</table>
</body>
</html>
