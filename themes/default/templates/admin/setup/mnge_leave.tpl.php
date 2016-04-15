<br>
<br>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?>
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
	$("#mnge_leave").validate(
		{
			rules:
			{
				leave_name:{
					required:true
				},
				leave_days:{
					required:true,
					number:true
				}
			},
			messages:
			{
				leave_name:"Please enter type of leave.",
				leave_days:{
					required:"Please enter leave day(s) per month.",
					number:"Please enter a valid Day(s) of Leave."
				}
			}
		}
	);
});
</script>



<script type="text/javascript">
function checkForm()
{
	var fn, mn;
	var msg="";
	var result = true;
	with(window.document.f1)
	{
		sn    = leave_name;
		so    = leave_daymonth;
	}
	
	if(trim(sn.value) == '')
	{
		msg+="Pls indicate Type of Leave!\n";
		so.focus();
		result = false;
	}
	
	if(trim(so.value) == '')
	{
		msg+="Pls indicate leave day(s) per month!\n";
		so.focus();
		result = false;
	}
	
	if(trim(so.value) == '0')
	{
		msg+="Invalid input!\n";
		so.select();
		result = false;
	}
	
	
	if(msg==""){
	return result;
	}{
	alert(msg)
	return result;
	}
}

function trim(str)
{
	return str.replace(/^\s+|\s+$/g,'');
}
</script>

<form id="mnge_leave" method="post" name="f1" action="">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="13%" class="divTblTH_">&nbsp;</td>
      <td width="87%" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">Leave Code</b></em><input name="leave_code" type="text" id="leave_code" value="<?=trim($oData['leave_code'])?>"/></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">Leave Name</b></em><input name="leave_name" id="leave_name" value="<?=trim($oData['leave_name'])?>" type="text"/></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">Day(s) of Leave</b></em><input name="leave_days" type="text" id="leave_days" value="<?=trim($oData['leave_days'])?>" size="6" maxlength="6" /></td>
    </tr>
    <tr >
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">With Pay</b></em><select name="leave_wpay" id="leave_wpay">
          <option value="Yes"<?php if ($oData['leave_wpay'] == 'Yes') echo selected;?>>Yes</option>
          <option value="No"<?php if ($oData['leave_wpay'] == 'No' || $oData['leave_wpay'] == NULL) echo selected;?>>No</option>
        </select></td> 
    </tr>
    	
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">Convert to Cash</b></em>
        <select name="leave_conv_cash" id="leave_conv_cash">
        <option value="Yes" <?php if ($oData['leave_conv_cash'] == 'Yes') echo selected;?>>Yes</option>
        <option value="No" <?php if ($oData['leave_conv_cash'] == 'No' || $oData['leave_conv_cash'] == NULL) echo selected;?>>No</option>
      </select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><em><b class="longlabel">Gender</b></em>
	  <select name="leave_gender" id="leave_gender">
        <option value="Male" <?php if ($oData['leave_gender'] == 'Male')echo selected;?>>Male</option>
        <option value="Female" <?php if ($oData['leave_gender'] == 'Female')echo selected;?>>Female</option>
        <option value="Both" <?php if ($oData['leave_gender'] == 'Both' || $oData['leave_conv_cash'] == NULL)echo selected;?>>Both</option>
      </select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=mnge_leave'" /><?php }else{?>
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