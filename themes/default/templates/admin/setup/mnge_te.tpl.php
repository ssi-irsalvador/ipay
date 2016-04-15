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

<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{ color: #E42217; float: none; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#mnge_te").validate(
		{
			rules:
			{
				comp_name:{
					required:true
				},
				te_rdo:{
					required:true,
					number:true
				},
			},
			messages:
			{
				comp_name:"Please select Company Name.",
				te_rdo:{
					required:"Please enter Revenue District Office Code.",
					number:"Please enter a valid Revenue District Office Code."
				},
				te_atc:{
					number:"Please enter a valid Alphanumeric Tax Code."
				}
			}
		}
	);
});
$(document).ready(function() {
	$("a.popup").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Tax Employer</h2></fieldset>
<fieldset class="themeFieldset01">
<form method="post" name="mnge_te" id="mnge_te">
<table width="100%" border="0" cellpadding="1" cellspacing="0">
	<tr>
	  <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Registered Name&nbsp;&nbsp;</span></div></td>
	  <td width="70%" class="divTblTH_"><input size="50" id='comp_name' name='comp_name' value="<?=trim($oData['comp_name'])?>" readonly="readonly" />
		<span class="red">
			<!-- <a href='javascript:void(0);' onclick="javascript: openwindow('popup.php?statpos=popupcomp', 'searchwindow', '');"> -->
			<a class="popup" href="popup.php?statpos=popupcomp">
			<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" />
		</a>
		<input name="comp_id" type="hidden" id="comp_id" value="<?=$oData['comp_id']?>" />
		</span>
	  </td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Address&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><textarea name="comp_add" cols="35" rows="3" readonly="readonly" id="comp_add"><?=trim($oData['comp_add'])?>
	  </textarea></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Zip Code&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='comp_zipcode' name='comp_zipcode' value="<?=trim($oData['comp_zipcode'])?>"/></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Telephone No.&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='comp_tel' name='comp_tel' value="<?=trim($oData['comp_tel'])?>" readonly="readonly" /></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Tax Identification No.&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='comp_tin' name='comp_tin' value="<?=trim($oData['comp_tin'])?>" readonly="readonly" /></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Revenue District Office Code&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='te_rdo' name='te_rdo' value="<?=trim($oData['te_rdo'])?>" /></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Category of Withholding Agent&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='te_cat_agent' name='te_cat_agent' value="<?=trim($oData['te_cat_agent'])?>" /></td>
	</tr>
	<tr>
	  <td class="divTblTH_"><div align="right"><span class="style3">Alphanumeric Tax Code&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='te_atc' name='te_atc' value="<?=trim($oData['te_atc'])?>" /></td>
	</tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=mnge_te'" /><?php }else{?>
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