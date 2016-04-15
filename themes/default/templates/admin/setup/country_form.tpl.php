<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Country Form</legend>
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

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#country").validate(
		{
			rules:
			{
				cou_code:{
					required:true
				},
				cou_description:{
					required:true
				}
			},
			messages:
			{
				cou_code:"Please enter Country Code.",
				cou_description:"Please enter Country."
			}
		}
	);
});
</script>

<form id="country" name="country" method="post" action="">
  <table border="0" width="100%">
    <tbody>
      <tr>
        <td width="16%">Country Code</td>
        <td width="84%"><input name="cou_code" id="cou_code" size="35" type="text" value="<?=trim($oData['cou_code'])?>" /></td>
      </tr>
      <tr>
        <td>Country</td>
        <td><input name="cou_description" id="cou_description" size="35" type="text" value="<?=trim($oData['cou_description'])?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="red">
          <input name="btnOk" id="btnOk" type="submit" value=" Save and Exit " class="themeInputButton" />
          <input type="hidden" name="sta_dateadded" value="<?=date('Y-m-d H:i:s',time())?>" />
		  <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('country')" />
		  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=country'" />
          &nbsp;</span></td>
      </tr>
    </tbody>
  </table>
</form>
</fieldset>
</div>