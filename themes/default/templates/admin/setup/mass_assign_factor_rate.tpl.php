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
<div class="tblListErrMsg"><?php echo $eMsg; ?></div>
		<?
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

<?php
if (!$_GET['fr_id']) {
	echo "

<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Factor Rate Mass Assign</h2></fieldset>
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</div>

	";
} elseif ($_GET['fr_id'] && !$_GET['select_employee']) {
	echo "

<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Assigned Employee</h2></fieldset>

<form method='POST' action=''>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='1.5' cellspacing='0' class='divTblTH_'>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Factor Rate Name</em></span><strong>{$oData['fr_name']}</strong></td>
      </tr>
      <tr>
        <td width='30'>&nbsp;</td>
        <td width='543'><span class='longlabel'><em>Hour/s per Day</em></span><strong>{$oData['fr_hrperday']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Hour/s per Week</em></span><strong>{$oData['fr_hrperweek']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Day Per Week</em></span><strong>{$oData['fr_dayperweek']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Day Per Year</em></span><strong>{$oData['fr_dayperyear']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>MWR</em></span><strong>{$oData['wrate_minwagerate']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Total No. of Employee</em></span><strong>{$getTotalEmployee}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type='button' name='btn_saveEmployee' id='btn_saveEmployee' value='Select Employee' class='themeInputButton' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET['fr_id']}&select_employee=1\"' style='margin-left: 118px;' />
		<input type='submit' name='btn_removeEmployee' id='btn_removeEmployee' value='Remove Selected' class='buttonstyle' onclick=\"
		if ( confirm('Are you sure, you want to Remove the Selected Employee/s from this Factor Rate?') ) {
			return true;
		} else {
			return false;
		}
		\" />
		<input type='button' name='Back' value='Back' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_factor_rate\"' />
        </td>
      </tr>
</table>


<table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</div>
</fieldset>
</form>

	";
} elseif (isset($_GET['select_employee'])) {
	echo "

<form method='POST' action=''>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Select Employee</h2></fieldset>
<fieldset class='themeFieldset01'>
<!--<legend class='themeLegend01'>Employee Mass Assign</legend>-->
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='divTblTH_'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input type='submit' name='btn_saveEmployee' id='btn_saveEmployee' value='Assign Employee' class='themeInputButton' style='margin-left: 50px;' onclick=\"
		if ( confirm('Are you sure, you want to Assign the Selected Employee/s to this Factor Rate?') ) {
			return true;
		} else {
			return false;
		}
		\" />
			<input type='button' name='Cancel' value='Cancel' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_factor_rate&fr_id={$_GET[fr_id]}\"' />
		</td>
	</tr>
	<tr>
		<td colspan='2'>{$tblDataList}</td>
	</tr>
</table>
</fieldset>
</div>
</form>

	";
}
?>