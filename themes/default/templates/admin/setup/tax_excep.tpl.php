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
	$("#tax_excep").validate(
		{
			rules:
			{
				taxep_code:{
					required:true
				},
				taxep_name:{
					required:true
				},
				taxep_order:{
					number:true
				}
			},
			messages:
			{
				taxep_code:"Please enter Code.",
				taxep_name:"Please enter Tax Exception.",
				taxep_order:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<fieldset class="themeFieldset01">
<form id="tax_excep" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Code</span> &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="taxep_code" id="taxep_code" value="<?=trim($oData['taxep_code'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Tax Exception</span> &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="taxep_name" id="taxep_name" value="<?=trim($oData['taxep_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Order</span> &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="taxep_order" id="taxep_order" value="<?=trim($oData['taxep_order'])?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=tax_excep'" /><?php }else{?>
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