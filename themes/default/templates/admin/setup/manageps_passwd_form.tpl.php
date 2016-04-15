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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Payslip Access Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Manage Payslip Access Form</legend>-->
<form method="post" action="" name="save_ps_passwd">
	<table width="100%" border="0" cellspacing="1" cellpadding="2">
		<tr style="background-color:#FAD163;">
	      	<td colspan="100%"><strong>Set Payslip Password For <?= $oData['fullname']?></strong></td>
	    </tr>
		<tr>
      		<td class="divTblTH_"><label for="user_password">Password</label>
        	<input name="ps_passwd_password" type="password" id="ps_passwd_password" size="20" class="txtfields" value="<?= $oData['ps_passwd_password']?>"/></td>
    	</tr>
    	<tr>
      		<td class="divTblTH_"><label for="user_password">Confirm Password</label>
        	<input name="cps_passwd_password" type="password" id="cps_passwd_password" size="20" class="txtfields" /></td>
    	</tr>
    	<tr>
    		<td class="divTblTH_">
    			<input type="submit" name="Submit" value="Save" class="buttonstyle">
    			<input type="reset" name="Clear" value="Clear" class="buttonstyle">
    		</td>
    	</tr>
	</table>
</form>
</fieldset>
</div>