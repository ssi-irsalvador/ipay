<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage Bank Form</legend>
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
<form method="post" action="">

<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
      </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Bank Name &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="banklist_name" id="banklist_name" value="<?=$oData['banklist_name']?>" type="text" size="30"></td>
      </tr>
    
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Status &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><select name="banklist_isactive" id="banklist_isactive">
			<?=html_options($lstStatus,$oData['banklist_isactive'])?>
		</select></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle">
        <input type="reset" name="Submit2" value="Reset" class="buttonstyle"></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>