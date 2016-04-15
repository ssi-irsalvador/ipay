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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Log Details</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">ePayslip Form</legend>-->
<form method="post" action="">

<table>
  <tr>
    <td>Username:</td>
    <td>username<?php ?></td>
  </tr>
  <tr>
    <td>Date:</td>
    <td><?php echo $_SESSION['AuditTrail']['date'];?></td>
  </tr>
  <tr>
    <td>Time:</td>
    <td>time</td>
  </tr>
  <tr>
    <td>Subject:</td>
    <td>subject</td>
  </tr>
  <tr>
    <td>Listing of Employees</td>
  </tr>
</table>
<table>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td>Name</td>
    <td>Email</td>
    <td>Company</td>
  </tr>
</table>

</form>
</fieldset>
</div>