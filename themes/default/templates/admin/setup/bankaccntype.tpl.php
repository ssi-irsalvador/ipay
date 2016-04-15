<br />
<br />
<div class="themeFieldsetDiv01">
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

<script src="../includes/jscript/jquery.js"></script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#bankaccntype").validate(
		{
			rules:
			{
				baccntype_name:{
					required:true
				}
			},
			messages:
			{
				baccntype_name:"Please enter Bank Account Type."
			}
		}
	);
});
</script>

<fieldset class="themeFieldset01">
<form id="bankaccntype" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Bank Account  Type </span> &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="baccntype_name" id="baccntype_name" value="<?=trim($oData['baccntype_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=bankaccntype'" /><?php }else{?>
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