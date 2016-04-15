<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br>
	<?php		
	}
	?>
	</div>
<?php		
	}else {
?>
	<div class="tblListErrMsg">
	<?=$eMsg?>
	</div>
<?
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#popup.group").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
$(document).ready(function() {
	$("#position").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
$(document).ready(function() {
	$("#department").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
function CheckAll(count){
	var i;
	if(document.getElementById('chkAttendAll').checked==true){
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = true;
		}
	}else {
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = false;
		}
	}
}
function UncheckAll(count){
	var i;
	for(i=1; i<=count; i++){
		if(document.getElementById('chkAttend['+i+']').checked==false){
		   document.getElementById('chkAttendAll').checked=false;
			return;
		}
		document.getElementById('chkAttendAll').checked=true;
	}	
}
</script>
<form method="post" action="" name="jay" id="jay">
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Employee Selection Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Employee Selection Form</legend>-->
<table width="750" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="191">Job Position</td>
        <td width="543">:
          <input name="post_name" id="post_name" value="<?=$oData['post_name']?>" type="text" class="txtfields" />
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');"> -->
          <a id="position" href="popup.php?statpos=popupjobpost"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Job Position List"/></a>
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');">-->
          <input type="hidden" name="post_id" id="post_id" value="<?=$oData['post_id']?>" />
          </td>
      </tr>
      <tr>
        <td>Department</td>
        <td>:
          <input name="ud_name" id="ud_name" value="<?=$oData['ud_name']?>" type="text" class="txtfields" />
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');">-->
          <a id="department" href="popup.php?statpos=popupdepart"> <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Department List"/></a>
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');">-->
          <input type="hidden" name="ud_id" id="ud_id" value="<?=$oData['ud_id']?>" />
          </td>
      </tr>
      <tr>
        <td>Employee</td>
        <td>: <input type="text" name="emp_no" id="emp_no" value="<?=$oData['emp_no']?>" class="txtfields"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;&nbsp;<input type="submit" name="Submit" value="Go &raquo;"  class="themeInputButton" /></td>
      </tr>
</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Add Employee" class="themeInputButton" /><?=$tblDataList?>
      <input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Add Employee" class="themeInputButton" /></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</fieldset>
</div>
</form>