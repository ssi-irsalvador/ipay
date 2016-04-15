<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<strong>Check the following error(s) below:</strong><br>
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

<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{ color: #E42217; float: none; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#manage_dept").validate(
		{
			rules:
			{
				loantype_code:{
					required:true
				},
				loantype_desc:{
					required:true
				}
			},
			messages:
			{
				loantype_code:{
					required:"Please enter Loan Code."
				},
				loantype_desc:{
					required:"Please enter Description."
				}
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Loan Type</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="manage_dept" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Loan Code  &nbsp;&nbsp;</span></div></td>
      <td width="70%" class="divTblTH_"><input name="loantype_code" type="text" id="loantype_code" value="<?=trim($oData['loantype_code'])?>" size="35" maxlength="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Description&nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><textarea name="loantype_desc" cols="35" rows="3" id="loantype_desc"><?=trim($oData['loantype_desc'])?></textarea></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=loantype'" /><?php }else{?>
		<input type="reset" name="Reset" value="Reset" class="buttonstyle" /><?php } ?></td>
    </tr>
</table>
</form>
</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><?=$tblDataList?></td>
    </tr>
</table>
</div>