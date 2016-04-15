<div class="themeFieldsetDiv01_pop">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage Department Form</legend>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?>
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
<form method="post" action="">

<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="30%" class="divTblTH_">&nbsp;</td>
    <td width="70%" class="divTblTH_">&nbsp;</td>
  </tr>
  <tr>
    <td class="divTblTH_"><div class="style3">Department Name &nbsp;&nbsp;</div></td>
    <td class="divTblTH_"><input name="ud_name" type="text" id="ud_name" value="<?=$oData['ud_name']?>" size="35" maxlength="30" /></td>
  </tr>
  <tr>
    <td class="divTblTH_"><div class="style3">Description &nbsp;&nbsp;</div></td>
    <td class="divTblTH_"><textarea name="ud_desc" cols="30" rows="3" id="ud_desc"><?=$oData['ud_desc']?>
    </textarea></td>
  </tr>
  <tr>
    <td class="divTblTH_">&nbsp;</td>
    <td class="divTblTH_">&nbsp;</td>
  </tr>
  <tr>
    <td class="divTblTH_">&nbsp;</td>
    <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" />
      <input type="reset" name="Submit2" value="Back" class="buttonstyle" onclick="javascript:history.back(0);" /></td>
  </tr>
  <tr>
    <td class="divTblTH_">&nbsp;</td>
    <td class="divTblTH_">&nbsp;</td>
  </tr>
</table>

</form>
</fieldset>
</div>