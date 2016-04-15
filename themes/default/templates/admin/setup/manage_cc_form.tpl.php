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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Cost Center Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Manage Cost Center Form</legend>-->
<form method="post" action="">
<table>
	<tr>
		<td>Cost Center Code:</td>
		<td><input type="text" name="cc_code"></td>
	</tr>
	<tr>
		<td>Cost Center Name:</td>
		<td><input type="text" name="cc_name"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="Submit" value=" Save &amp; Exit " class="themeInputButton">
			<input type="reset" name="reset" value=" Clear " class="themeInputButton">
		</td>
	</tr>
</table>

</form>
</fieldset>
</div>