<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage User Type Form</legend>
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

$.validator.addMethod('require-one', function (value) {
	return $('.require-one:checked').size() > 0;
}, 'Please choose atleast one Department.');

var checkboxes = $('.require-one');
var checkbox_names = $.map(checkboxes, function(e,i) { return $(e).attr("name")}).join(" ");

$(document).ready(function() {
	$("#manage_usertype").validate(
		{
			rules:
			{
				user_type:{
					required:true
				},
				user_type_name:{
					required:true
				},
				user_type_ord:{
					number:true
				},
				groups:{
					checks:checkbox_names
				},
				errorPlacement: function(error, element) {
				if (element.attr("type") === "checkbox")
					error.insertAfter(checkboxes.last());
				else
					error.insertAfter(element);
				}
			},
			messages:
			{
				user_type:"Please enter a User Type.",
				user_type_name:"Please enter a Name.",
				user_type_ord:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<form id="manage_usertype" name="manage_usertype" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="1">
    <tr>
      <td width="12%">&nbsp;</td>
      <td width="88%">&nbsp;</td>
    </tr>
    <tr>
      <td>User Type </td>
      <td style="float:left;">
		  <input name="user_type" type="text" id="user_type" value="<?=trim($oData['user_type'])?>" size="35" maxlength="30" />
	  </td>
    </tr>
     <tr>
      <td>Name </td>
      <td>
	  	<input name="user_type_name" type="text" id="user_type_name" value="<?=trim($oData['user_type_name'])?>" size="35" maxlength="30" />
	  </td>
    </tr>
     <tr>
      <td>Order </td>
      <td><input name="user_type_ord" type="text" id="user_type_ord" value="<?=trim($oData['user_type_ord'])?>" size="35" maxlength="30" /></td>
    </tr>
     <tr>
      <td>Status </td>
      <td>
	  <select name="user_type_status" id="user_type_status">
      <option value="0">Please select</option>
      <?=html_options($lstStatus,trim($oData['user_type_status']))?>
	  </select>
	  </td>
    </tr>    
     <tr>
       <td valign="top">&nbsp;</td>
       <td>&nbsp;</td>
     </tr>     
     <tr>
       <td valign="top">Department</td>
       <td>
	   <?php 
		foreach($lstUserDept as $Key => $Value){
			if(isset($oData) and is_array($oData)){
			if(count($oData['user_type_dept'])>0){
			$xKey = array_search($Value['ud_id'],$oData['user_type_dept']);
			}}
			$xKey = empty($xKey)?0:$xKey;
		?>
		<input name="user_type_dept[]" type="checkbox" id="user_type_dept[]" value="<?=$Value['ud_id']?>" <?=(($oData['user_type_dept'][$xKey]==$Value['ud_id'])?"checked":"")?> /><?=$Value['ud_name']?><br />
			</option>
		<?php }?>&nbsp;
		</td>
     </tr>
     <tr>
       <td valign="top">Users Access </td>
       <td><?=$UserAccessModules?>&nbsp;</td>
     </tr>
     <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Save & Exit" class="themeInputButton" />
        <input type="button" name="Reset" value="Reset" class="themeInputButton" onclick="jqResetForm('manage_usertype')" />
		<input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=manageusertype'" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	</table>
</form>
</fieldset>
</div>