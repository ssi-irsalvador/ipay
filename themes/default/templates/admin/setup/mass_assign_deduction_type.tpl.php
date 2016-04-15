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
if (!$_GET['dec_id']) {
	echo "

<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Deduction Type Mass Assign</h2></fieldset>
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</div>

	";

} elseif ( ($_GET['dec_id'] && !$_GET['select_employee']) && ($_GET['dec_id'] && !$_GET['select_pay_period']) ) {
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
        <td><span class='longlabel'><em>Deduction Code</em></span><strong>{$oData['dec_code']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Deduction Name</em></span><strong>{$oData['dec_name']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type='button' name='btn_selectEmployee' id='btn_selectEmployee' value='Select "; if ($_GET['dec_id'] == 5) { echo "Employee"; } else { echo "Pay Period"; } echo "' class='themeInputButton' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET['dec_id']}"; if ($_GET['dec_id'] == 5) { echo "&select_employee=1"; } else { echo "&select_pay_period=1"; } echo "\"' style='margin-left: 118px;' />
		<input type='submit' name='btn_removeEmployee' id='btn_removeEmployee' value='Remove Selected' class='buttonstyle' onclick=\"
		if ( confirm('Are you sure, you want to Remove the Selected Employee/s from this Deduction Type?') ) {
			return true;
		} else {
			return false;
		}
		\" />
		<input type='button' name='Back' value='Back' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type\"' />
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</fieldset>
</form>
</div>

	";
} elseif ($_GET['select_employee']) {
	echo "

<form method='POST' action=''>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Select Employee</h2></fieldset>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='divTblTH_'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input type='submit' name='btn_assignEmployee' id='btn_assignEmployee' value='Assign Employee' class='themeInputButton' style='margin-left: 50px;' onclick=\"
		if ( confirm('Are you sure, you want to Assign the Selected Employee/s to this Deduction Type?') ) {
			return true;
		} else {
			return false;
		}
		\" />
			<input type='button' name='Cancel' value='Cancel' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}\"' />
			";
	
	if ($_GET['dec_id'] == 5) {
		echo "
			<ul style='list-style: none; margin-left: 30px;'>
				<li><input class='noninput' name='tax' id='tax' value='1' type='radio' checked>TAX</li>
				<li><input class='noninput' name='tax' id='tax' value='2' type='radio'>MWE</li>
				<li><input class='noninput' name='tax' id='tax' value='3' type='radio'>Others</li>
			</ul>
		";
	}
	
			echo "
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
} elseif ($_GET['select_pay_period'] && !$_GET['pay_period']) {
	echo "
	
<form method='POST' action=''>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Select Pay Period</h2></fieldset>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='divTblTH_'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input value='1st Pay Period' class='themeInputButton' style='margin-left: 50px; width: 80px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1&pay_period=1\"' /><br />
			<input value='2nd Pay Period' class='themeInputButton' style='margin-left: 50px; width: 80px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1&pay_period=2\"' /><br />
			<input value='3rd Pay Period' class='themeInputButton' style='margin-left: 50px; width: 80px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1&pay_period=3\"' />
			<input type='button' value='Back' class='buttonstyle' style='margin-left: 50px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}\"' /><br />
			<input value='4th Pay Period' class='themeInputButton' style='margin-left: 50px; width: 80px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1&pay_period=4\"' /><br />
			<input value='5th Pay Period' class='themeInputButton' style='margin-left: 50px; width: 80px;' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1&pay_period=5\"' /><br /><br />
		</td>
	</tr>
</table>
</fieldset>
</div>
</form>
	
	";
} elseif (($_GET['pay_period'])) {
	echo "

<form method='POST' action=''>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Select Employee</h2></fieldset>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='divTblTH_'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input type='submit' name='btn_assignEmployee' id='btn_assignEmployee' value='Assign Employee' class='themeInputButton' style='margin-left: 50px;' onclick=\"
		if ( confirm('Are you sure, you want to Assign the Selected Employee/s to this Deduction Type and Pay Period?') ) {
			return true;
		} else {
			return false;
		}
		\" />
			<input type='button' name='Cancel' value='Cancel' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_deduction_type&dec_id={$_GET[dec_id]}&select_pay_period=1\"' />
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