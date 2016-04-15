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

<script src="../includes/jscript/jquery.js"></script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#emptype").validate(
		{
			rules:
			{
				emptype_name:{
					required:true
				},
				emptype_ord:{
					number:true
				}
			},
			messages:
			{
				emptype_name:"Please enter Employee Type.",
				emptype_ord:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01_pop">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Employee Type Form</legend>
<form id="emptype" method="post" action="">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Employee Type &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="emptype_name" id="emptype_name" value="<?=$oData['emptype_name']?>" type="text" size="30"></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Order &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="emptype_ord" id="emptype_ord" value="<?=$oData['emptype_ord']?>" type="text" size="10"></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" />
        <input type="reset" name="Back" value="Back" class="buttonstyle" onclick="javascript:history.back(0);" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>