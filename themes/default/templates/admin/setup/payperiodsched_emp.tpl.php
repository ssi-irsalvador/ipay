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
<div style="padding-top:5px;">
<!--<br />
&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" name="Back" value=" Back " class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg'" />
<br />-->
</div>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Employee Mass Assign</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Employee Mass Assign</legend>-->
<table width="100%" border="0" cellpadding="1.5" cellspacing="0" class="divTblTH_">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Company</em></span><strong><?=$oData['comp_name']?></strong></td>
      </tr>
      <tr>
        <td width="30">&nbsp;</td>
        <td width="543"><span class="longlabel"><em>Name</em></span><strong><?=$oData['pps_name']?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Description</em></span><strong><?=$oData['pps_desc']?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Type</em></span><strong><?=$oData['salaryclass']?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Select Employee" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=mnge_pg&empinput=<?php echo $_GET['empinput']; ?>&empinput_add'" style="margin-left: 118px;" />
        <input type="button" name="Back" value="Back" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg'" />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>
</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td><div align="center" style="background-color:#FFCC66"><em><strong>=== Employee List ===</strong></em></div></td>
  </tr>
  <tr>
    <td><?=$tblDataList?></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</div>
