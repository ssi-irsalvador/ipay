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

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#mnge_ta").validate(
		{
			rules:
			{
				tatbl_name:{
					required:true
				}
			},
			messages:
			{
				tatbl_name:"Please enter a TA Name."
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage TA Form</legend>
<form id="mnge_ta" name="mnge_ta" method="post" action="">
  <table width="50%" cellpadding="2" cellspacing="2">
    <tr>
      <td>TA Name </td>
      <td><input name="tatbl_name" id="tatbl_name" value="<?=trim($oData['tatbl_name'])?>" type="text" /></td>
    </tr>
    
    <tr>
      <td>TA Rate</td>
      <td><span class="divTblListTROT">
        <select name="tatbl_rate" id="tatbl_rate">
          <option value="1"<?php if ($oData['tatbl_rate'] == '1') echo selected;?>>Hour</option>
          <option value="2"<?php if ($oData['tatbl_rate'] == '2') echo selected;?>>Day</option>
        </select>
      </span></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="red">
        <input name="btnOk" id="btnOk" type="submit" value=" Save and Exit " onclick="return checkForm();" class="themeInputButton" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('mnge_ta')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_ta'" />
        &nbsp;</span></td>
    </tr>
  </table>
</form>
</fieldset>
</div>