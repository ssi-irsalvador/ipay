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
<script language="javascript">
$(function () {
    $('#chkAttendAll').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
});
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Process YTD Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Process Payroll Form</legend>-->
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pps_name']?>
      </strong></td>
      <td class="divTblTH_"><em>Type</em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['salaryclass_id']?>
      </strong></td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
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
      <td width="12%" class="divTblTH_">&nbsp;</td>
      <td width="21%" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Status</em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['pp_stat_id']?>
      </strong></td>
      <td width="18%" class="divTblTH_"><em>Total No. of Employee </em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$get_totalEmp['totalemp']?>
      </strong></td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
	<form method="post" action=""><input type="hidden" name="payperiod_type" id="payperiod_type" value="<?=$oData['classification']?>" />
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Process YTD" class="themeInputButton" /><?=$tblDataList?><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Process YTD" class="themeInputButton" /></td>
			</tr>
		</table>
	</form>
</fieldset>
</div>