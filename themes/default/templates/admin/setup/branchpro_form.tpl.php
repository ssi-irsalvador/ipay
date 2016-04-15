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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Branch Profile Form</legend>
<form id="manage_comp" name="manage_comp" method="post" action="">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
      </tr>
    
    
    <tr>
      <td class="divTblTH_"><div class="style3">Company Name &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><select name="comp_id" id="comp_id" class="longselect">
        <?=html_options($comp,$oData['comp_id'])?>	
      </select></td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Branch Code &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_code" id="branchinfo_code" value="<?=trim($oData['branchinfo_code'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Branch Name &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_name" id="branchinfo_name" value="<?=trim($oData['branchinfo_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Site Location  &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_siteloc" id="branchinfo_siteloc" value="<?=trim($oData['branchinfo_siteloc'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Address &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><textarea name="branchinfo_add" id="branchinfo_add" cols="30"><?=trim($oData['branchinfo_add'])?></textarea></td>
      </tr>
    
    <tr>
      <td class="divTblTH_"><div class="style3">Primary Contact &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_contact" id="branchinfo_contact" value="<?=trim($oData['branchinfo_contact'])?>" type="text" size="30" /></td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Tel No 1  &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_tel1" id="branchinfo_tel1" value="<?=trim($oData['branchinfo_tel1'])?>" type="text" size="30" /></td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Tel No 2 &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="branchinfo_tel2" id="branchinfo_tel2" value="<?=trim($oData['branchinfo_tel2'])?>" type="text" size="30" /></td>
      </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" />
        <input type="button" name="Reset" value="Reset" class="buttonstyle" onclick="jqResetForm('manage_comp')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=manage_comp'" /></td>
      </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>