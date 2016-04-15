<br>
<br>
<div class="popuptitle">Modify Pay Element </div>
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
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Benefit / Deduction</legend>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="156" class="divTblTH_">Pay Element </td>
    <td width="920" class="divTblTH_"><?=$oData['paystubdetails']['']?></td>
  </tr>
  <tr>
    <td class="divTblTH_">Date</td>
    <td class="divTblTH_">&nbsp;</td>
  </tr>
  <tr>
    <td class="divTblTH_">Amount</td>
    <td class="divTblTH_"><input type="text" name="textfield" /></td>
  </tr>
  <tr>
    <td class="divTblTH_">&nbsp;</td>
    <td class="divTblTH_"><input type="submit" name="Submit" value="&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;" class="buttonstyle" />
    <input type="submit" name="Submit2" value="&nbsp;&nbsp;&nbsp;Delete&nbsp;&nbsp;&nbsp;" class="buttonstyle" />
    <input type="submit" name="Submit22" value="&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;" class="buttonstyle" /></td>
  </tr>
</table>
</fieldset>
