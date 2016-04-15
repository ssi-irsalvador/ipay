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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Factor Rate Form</legend>
<form method="post" action="">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
      </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Name &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_name" id="fr_name" value="<?=$oData['fr_name']?>" type="text" size="30"></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Hours per Day &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_hrperday" id="fr_hrperday" value="<?=$oData['fr_hrperday']?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Hours per Week &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_hrperweek" id="fr_hrperweek" value="<?=$oData['fr_hrperweek']?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Average Work Days per Week &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_dayperweek" id="fr_dayperweek" value="<?=$oData['fr_dayperweek']?>" type="text" size="10" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Days per Year &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_dayperyear" id="fr_dayperyear" value="<?=$oData['fr_dayperyear']?>" type="text" size="10" /></td>
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