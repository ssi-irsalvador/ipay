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
	$("#manage_dept").validate(
		{
			rules:
			{
				ud_name:{
					required:true
				},
				ud_desc:{
					required:true
				}
			},
			messages:
			{
				ud_name:"Please enter Department Name.",
				ud_desc:"Please enter Description."
			}
		}
	);
});
</script>

<fieldset class="themeFieldset01">
<form id="manage_dept" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Department Code</b><input name="ud_code" type="text" id="ud_code" value="<?=trim($oData['ud_code'])?>" size="15" maxlength="30" /></td>
    </tr>
    <tr>
      <td width="21%" class="divTblTH_">&nbsp;</td>
      <td width="79%" class="divTblTH_"><b class="longlabel">Department Name</b>
        <input name="ud_name" type="text" id="ud_name" value="<?=trim($oData['ud_name'])?>" size="35" maxlength="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Description</b><textarea name="ud_desc" cols="35" rows="3" id="ud_desc"><?=trim($oData['ud_desc'])?></textarea></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Parent</b>
	  	<select name="ud_parent" id="ud_parent">
			<?=$lstParents?>
		</select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">&nbsp;</b><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=managedept'" /><?php }else{?>
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