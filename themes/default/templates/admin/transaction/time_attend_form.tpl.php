<style type="text/css">
<!--
.style3 {font-size: 12px}
.style4 {color: #333333}
-->
</style>
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Time and Attendance Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Time and Attendance Form</legend>-->
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pps_name']?></strong></td>
      <td class="divTblTH_"><em>Type</em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$oData['salaryclass_id']?>
      </strong></td>
      </tr>
    <tr>
      <td class="divTblTH_"><em>Start Date </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['payperiod_start_date']?>
      </strong></td>
      <td class="divTblTH_"><em>End Date </em></td>
      <td width="16%" class="divTblTH_"><strong>
        <?=$oData['payperiod_end_date']?>
      </strong></td>
      <td width="12%" class="divTblTH_"><em>Pay Date </em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['payperiod_trans_date']?>
      </strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Status</em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['pp_stat_id']?>
      </strong></td>
      <td width="18%" class="divTblTH_">&nbsp;</td>
      <td colspan="3" class="divTblTH_">&nbsp;</td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<form method="post" enctype="multipart/form-data" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><strong>Upload TA Summary</strong><div align="left">&bull; <em>Sample XLS file:&nbsp;<a href="importtemplate/TASummaryFORM1-1.xls" target="_blank">Download</a></em></div></td>
	  </tr>
	<tr>
		<td width="110" class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">Select File</label><input type="file" name="uptahead_file" accept="application/vnd.ms-excel"></td>
	</tr>
	<tr>
		<td class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">Description</label>
	    <textarea rows="3" cols="35" name="uptahead_desc" id="uptahead_desc"><?=$oData['uptahead_desc']?></textarea></td>
	</tr>
	<tr>
		<td class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">&nbsp;</label><input type="submit" name="submit[save]" value="Upload File" class="themeInputButton"></td>
	</tr>
	
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	</tr>
</table>
</form>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<?=$tblDataList?>
</fieldset>
</div>