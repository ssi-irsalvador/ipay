<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<strong>Check the following error(s) below:</strong><br />
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br />
	<?php
	}
	?>
	</div>
<?php
	} else {
?>
	<div class="tblListErrMsg">
	<?=$eMsg?>
	</div>
<?
	}
}
?>

<script language="javascript">
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

<form method="POST" action="" name="jay" id="jay">
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Employee Selection Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Employee Selection Form</legend>-->
<table width="750" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td><em>Company</em></td>
        <td>: <input name="comp_name" id="comp_name" value="<?=$oData['comp_name']?>" type="text" class="txtfields" readonly="readonly" />
		<a class="popup" href="popup.php?statpos=popupcomp&detect=mnge_pg"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a>
		<input type="hidden" name="comp_id" id="comp_id" value="<?=$oData['comp_id']?>" />
        </td>
      </tr>
<!--      <tr>
        <td><em>Branch</em></td>
        <td>: <input name="branchinfo_name" id="branchinfo_name" value="<?=$oData['branchinfo_name']?>" type="text" class="txtfields" readonly="readonly" />
		<a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'branchinfo_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" />
		<input type="hidden" name="branchinfo_id" id="branchinfo_id" value="<?=$oData['branchinfo_id']?>" /></a></td>
      </tr>-->
      <tr>
        <td width="191"><em>Job Position</em></td>
        <td width="543">: <input name="post_name" id="post_name" value="<?=$oData['post_name']?>" type="text" class="txtfields" readonly="readonly" />
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');">-->
          <a class="popup" href="popup.php?statpos=popupjobpost"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');">
          <input type="hidden" name="post_id" id="post_id" value="<?=$oData['post_id']?>" />
          </a></td>
      </tr>
      <tr>
        <td><em>Department</em></td>
        <td>: <input name="ud_name" id="ud_name" value="<?=$oData['ud_name']?>" type="text" class="txtfields" readonly="readonly" />
          <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');"> -->
          <a class="popup" href="popup.php?statpos=popupdepart"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');">
          <input type="hidden" name="ud_id" id="ud_id" value="<?=$oData['ud_id']?>" />
          </a></td>
      </tr>
      <tr>
        <td><em>Employee Number</em></td>
        <td>:
          <input type="text" name="emp_no" id="emp_no" class="txtfields" value="<?=$oData['emp_no']?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;&nbsp;<input type="submit" name="Submit" value="Search" class="themeInputButton" />		</td>
      </tr>
</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" style="background:#CCFF66"><em><strong>=== Employee List ===</strong></em></div></td>
  </tr>
  <tr>
    <td><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Select Employee" class="themeInputButton" />
	  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg&empinput=<?=$_GET['empinput']?>'" /></td>
  </tr>
  <tr>
    <td><?=$tblDataList?>
      <input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Select Employee" class="themeInputButton" />
	  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg&empinput=<?=$_GET['empinput']?>'" />&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</fieldset>
</div>
</form>