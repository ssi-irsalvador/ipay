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
<div class="themeFieldsetDiv01_pop">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Employee Type Form</legend>
<form method="post" action="">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Tax Exception &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="taxep_name" id="taxep_name" value="<?=$oData['taxep_name']?>" type="text" size="30"></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Order &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="taxep_order" id="taxep_order" value="<?=$oData['taxep_order']?>" type="text" size="10"></td>
      </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle">
        <input type="reset" name="Submit2" value="Back" class="buttonstyle" onclick="javascript:history.back(0);"></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>