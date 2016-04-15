<?php if ($_GET['statpos']=='manage_comp'){ ?>
<div class="themeFieldsetDiv01">
<?php } ?>
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage Company Form</legend>
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
	$("#manage_comp").validate(
		{
			rules:
			{
				comp_code:{
					required:true
				},
				comp_name:{
					required:true
				},
				comp_add:{
					required:true
				},
				comp_zipcode:{
					required:true,
					number:true
				},
				comp_tel:{
					required:true
				},
				comp_email:{
					email:true
				},
				comp_tin:{
					required:true
				},
				comp_sss:{
					required:true
				},
				comp_phic:{
					required:true
				},
				comp_hdmf:{
					required:true
				},
				comp_priority:{
					number:true
				}
			},
			messages:
			{
				comp_code:"Please enter Company Code.",
				comp_name:"Please enter Company Name.",
				comp_add:"Please enter Company Address.",
				comp_zipcode:{
					required:"Please enter Zip Code.",
					number:"Please enter a valid Zip Code."
				},
				comp_tel:"Please enter Telephone Number.",
				comp_email:"Please enter a valid Email Address.",
				comp_tin:"Please enter TIN number.",
				comp_sss:"Please enter SSS number.",
				comp_phic:"Please enter PHIC number.",
				comp_hdmf:"Please enter HDMF number.",
				comp_priority:"Please enter a valid Priority number."
			}
		}
	);
});
</script>
<form id="manage_comp" name="manage_comp" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10%" class="divTblTH_">&nbsp;</td>
      <td width="39%" class="divTblTH_">&nbsp;</td>
      <td width="51%" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Company Type</b>
		  <select name="comptype_id" id="comptype_id">
			<?=html_options2($comptype,$_SESSION['compvalue'],'edit',$oData['comptype_id'])?>
		  </select></td>
      <td class="divTblTH_"><b class="longlabel">Priority</b>
        <input name="comp_priority" type="text" id="comp_priority" value="<?=trim($oData['comp_priority'])?>" size="10" maxlength="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Company Code</b><input name="comp_code" id="comp_code" value="<?=trim($oData['comp_code'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">TIN No.</b>
        <input name="comp_tin" id="comp_tin" value="<?=trim($oData['comp_tin'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Company Name</b><input name="comp_name" id="comp_name" value="<?=trim($oData['comp_name'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">SSS No.</b>
        <input name="comp_sss" id="comp_sss" value="<?=trim($oData['comp_sss'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td rowspan="2" class="divTblTH_"><b class="longlabel">Address</b><textarea name="comp_add" id="comp_add" cols="30"><?=trim($oData['comp_add'])?></textarea></td>
      <td class="divTblTH_"><b class="longlabel">PHIC No.</b>
        <input name="comp_phic" id="comp_phic" value="<?=trim($oData['comp_phic'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">HDMF No.</b>
        <input name="comp_hdmf" id="comp_hdmf" value="<?=trim($oData['comp_hdmf'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">ZIP Code</b>
        <input name="comp_zipcode" id="comp_zipcode" value="<?=trim($oData['comp_zipcode'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">Primary Contact</b>
        <input name="comp_prim_contc" id="comp_prim_contc" value="<?=trim($oData['comp_prim_contc'])?>" type="text" size="30" /></td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Tel No.</b>
        <input name="comp_tel" id="comp_tel" value="<?=trim($oData['comp_tel'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">Email Address</b>
        <input name="comp_email" id="comp_email" value="<?=trim($oData['comp_email'])?>" type="text" size="30" /></td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" class="divTblTH_"><b class="longlabel">Upload Logo</b>
        <input type="file" name="user_picture" id="user_picture" /></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" valign="baseline" class="divTblTH_"><b class="longlabel">Logo Position</b>
          <b class="longlabel"><em>
          <input name="radiobutton" type="radio" value="left" checked="checked" />
          Left &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="radiobutton" type="radio" value="middle" />
        Middle &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="radiobutton" type="radio" value="right" />
        Right</em></b>
        <img src="<?php if(isset($_GET['edit'])){ echo "setup.php?statpos=manageuser&amp;img=".$_GET['edit'];}else{echo SYSCONFIG_DEFAULT_IMAGES.'admin/samplelogo.gif';}?>" width="300" height="70" border="1" /></td>
    </tr>
    
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">&nbsp;</b><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" />
        <input type="button" name="Reset" value="Reset" class="buttonstyle" onclick="jqResetForm('manage_comp')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=manage_comp'" /></td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
  </table>
</form>
</fieldset>
</div>