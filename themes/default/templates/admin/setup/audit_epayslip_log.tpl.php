<!--<div style="padding-top:5px;">-->
<!--&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="setup.php?statpos=audit_ePayslip&action=add">Add New</a><br />-->
<!--</div>-->
<br>
<br>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?>
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Log Details</h2></fieldset>
<fieldset class="themeFieldset01">
<div><font size="2" face="Tahoma" color=#222222>
<table cellpadding="5px" width=40%>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Username:</b></td>
    <td><?= $AuditTrail['user_name'];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Date:</b></td>
    <td><?= $AuditTrail['date'];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Time:</b></td>
    <td><?= $AuditTrail['time'];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Subject:</b></td>
    <td><?= $AuditTrail['subject'];?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Success:</b></td>
    <td><?= $AuditTrail['good_rec'];?></td>
  </tr>
    <tr>
    <td>&nbsp;&nbsp;</td>
    <td><b>Failed:</b></td>
    <td><?= $AuditTrail['bad_rec'];?></td>
  </tr>
  <tr></tr>
</table>
</font>
</div>
<?=$tblDataList?>
</fieldset>