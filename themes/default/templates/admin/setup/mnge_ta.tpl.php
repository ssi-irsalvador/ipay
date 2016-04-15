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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage TA</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="mnge_ta" name="mnge_ta" method="POST" action="">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="15%">&nbsp;</td>
      <td width="85%"><em><b class="longlabel">TA Name</b></em>
        <input name="tatbl_name" type="text" id="tatbl_name" value="<?=trim($oData['tatbl_name'])?>" size="30" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><em><b class="longlabel">TA Rate</b></em>
        <select name="tatbl_rate" id="tatbl_rate">
          <option value="1"<?php if ($oData['tatbl_rate'] == '1') echo selected;?>>Hour</option>
          <option value="2"<?php if ($oData['tatbl_rate'] == '2') echo selected;?>>Day</option>
        </select></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><b class="longlabel">&nbsp;</b><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=mnge_ta'" /><?php }else{?>
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