<br />
<br />
<div class="themeFieldsetDiv01">
<?php 
if(isset($eMsg)){
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
	$("#201status").validate(
		{
			rules:
			{
				emp201status_name:{
					required:true
				},
				emp201status_ord:{
					number:true
				}
			},
			messages:
			{
				emp201status_name:"Please enter 201 Status.",
				emp201status_ord:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<fieldset class="themeFieldset01">
<form id="201status" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_"><div align="right"><span class="style3">201 Status </span> &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="emp201status_name" id="emp201status_name" value="<?=$oData['emp201status_name']?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Order</span> &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="emp201status_ord" id="emp201status_ord" value="<?=$oData['emp201status_ord']?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=201status'" /><?php }else{?>
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