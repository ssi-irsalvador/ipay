<br>
<br>
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Branch Profile Form</legend>
<form id="manage_comp" name="manage_comp" method="post" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10%" class="divTblTH_">&nbsp;</td>
      <td width="45%" class="divTblTH_">&nbsp;</td>
      <td width="45%" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Company Name</b>
		  <select name="comp_id" id="comp_id" style="width:195px">
			<?=html_options($comp,$oData['comp_id'])?>	
		  </select></td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Branch Code</b><input name="branchinfo_code" type="text" id="branchinfo_code" value="<?=trim($oData['branchinfo_code'])?>" size="30" maxlength="50" /></td>
      <td rowspan="2" class="divTblTH_"><b class="longlabel">Address</b><textarea name="branchinfo_add" id="branchinfo_add" cols="30"><?=trim($oData['branchinfo_add'])?>
      </textarea></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Branch Name</b><input name="branchinfo_name" id="branchinfo_name" value="<?=trim($oData['branchinfo_name'])?>" type="text" size="30" /></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Primary Contact</b><input name="branchinfo_contact" id="branchinfo_contact" value="<?=trim($oData['branchinfo_contact'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">Site Location</b><input name="branchinfo_siteloc" id="branchinfo_siteloc" value="<?=trim($oData['branchinfo_siteloc'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><b class="longlabel">Tel No 1</b><input name="branchinfo_tel1" id="branchinfo_tel1" value="<?=trim($oData['branchinfo_tel1'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><b class="longlabel">Tel No 2</b><input name="branchinfo_tel2" id="branchinfo_tel2" value="<?=trim($oData['branchinfo_tel2'])?>" type="text" size="30" /></td>
    </tr>
    

    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" class="divTblTH_"><b class="longlabel">&nbsp;</b><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=branchpro'" /><?php }else{?>
		<input type="reset" name="Reset" value="Reset" class="buttonstyle" /><?php } ?></td>
      </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
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