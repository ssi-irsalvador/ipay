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
	$("#jobpost").validate(
		{
			rules:
			{
				post_code:{
					required:true
				},
				post_name:{
					required:true
				},
				post_ord:{
					number:true
				}
			},
			messages:
			{
				post_code:"Please enter Job Code.",
				post_name:"Please enter Job Position.",
				post_ord:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<fieldset class="themeFieldset01">
<form id="jobpost" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Job Code &nbsp;&nbsp;</span></div></td>
      <td width="70%" class="divTblTH_"><input name="post_code" id="post_code" value="<?=trim($oData['post_code'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Job Position &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="post_name" id="post_name" value="<?=trim($oData['post_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Job Description  &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><textarea id="post_desc" name="post_desc" cols="50" rows="3"><?=trim($oData['post_desc'])?></textarea></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Order &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="post_ord" id="post_ord" value="<?=trim($oData['post_ord'])?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=jobpost'" /><?php } else{?>
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