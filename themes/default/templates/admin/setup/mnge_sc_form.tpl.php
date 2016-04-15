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
<legend class="themeLegend01">Manage Statutory Contribution Form</legend>
<form method="post" action="">
 <table width="100%" border="0" cellspacing="1" cellpadding="2">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Contribution Type &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="dec_code" id="dec_code" value="<?=$oData['dec_code']?>" type="text" class="txtfields" />
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdectype', 'dec_code', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" />
        <input type="hidden" name="dec_id" id="dec_id" value="<?=$oData['dec_id']?>" />
        </a></td>
    </tr>
	
	  <tr>
	    <td class="divTblTH_"><div class="style3">Code &nbsp;&nbsp;</div></td>
	    <td class="divTblTH_"><input name="sc_code" type="text" id="sc_code" value="<?=$oData['sc_code']?>" size="35" maxlength="30" /></td>
      </tr>
	  <tr>
      <td class="divTblTH_"><div class="style3">Description &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="sc_desc" type="text" id="sc_desc" value="<?=$oData['sc_desc']?>" size="35" maxlength="30" /></td>
    </tr>
	
	 <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
</table>

</form>
</fieldset>
<?=$tblDataList?>
</div>