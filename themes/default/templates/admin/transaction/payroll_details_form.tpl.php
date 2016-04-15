<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
		?>
<div class="tblListErrMsg"><strong>Check the following error(s) below:</strong><br />
		<?php
		foreach ($eMsg as $key => $value) {
			?> &nbsp;&nbsp;&bull;&nbsp;<?=$value?><br />
			<?php
		}
		?></div>
		<?php
	} else {
		?>
<div class="tblListErrMsg"><?=$eMsg?></div>
		<?php
	}
}
?>

<script type="text/javascript">
$(function () {
    $('#chkAttendAll').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Payroll Details Form</h2></fieldset>
<fieldset class="themeFieldset01">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group</em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pps_name']?>
      </strong></td>
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
      <td width="18%" class="divTblTH_"><em>Total No. of Employee </em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$get_totalEmp['totalemp']?>
      </strong></td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<form method="post" action="">
	<?php
	if ($_GET['ppstat_id']!='3') {
		echo "<input type='submit' name='btn_remove' id='btn_remove' value='Remove Selected' class='buttonstyle' onclick=\"
		if ( confirm('Are you sure, you want to Remove the Selected Employee/s from this Payroll Details Form?') ) {
			return true;
		} else {
			return false;
		}
		\" />";
	}
	?>
	<input type='button' value='Back' class='buttonstyle' onclick='javascript:window.location="transaction.php?statpos=payroll_details"' />
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td><?=$tblDataList?></td>
		</tr>
	</table>
	<?php
	if ($_GET['ppstat_id']!='3') {
		echo "<input type='submit' name='btn_remove' id='btn_remove' value='Remove Selected' class='buttonstyle' onclick=\"
		if ( confirm('Are you sure, you want to Remove the Selected Employee/s from this Payroll Details Form?') ) {
			return true;
		} else {
			return false;
		}
		\" />";
	}
	?>
</form>
</fieldset>
</div>