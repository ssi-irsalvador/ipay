<div class="themeFieldsetDiv01">
<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
		?>
<div class="tblListErr2Msg">
		<?php
		foreach ($eMsg as $key => $value) {
			echo $value; ?><br />
			<?php
		}
		?></div>
		<?php
	} else {
		?>
<div class="tblListErrMsg"><?php echo $eMsg; ?></div>
		<?php
	}
}
?>
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">OT Record Report</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Payroll Register</legend>-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><b><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Pay Period</em></b></td>
    <td width="80%"><select name="pps_id" id="pps_id" onchange="javascript:window.location='reports.php?statpos=<?=$_GET['statpos'];?>&pps_id='+document.getElementById('pps_id').value;">
      <option value="0">Please select</option>
      <?=html_options_2d($payperiod,'pps_id','pps_name',$_GET['pps_id'],true)?>
    </select></td>
  </tr>
</table>
</fieldset>
<?=$tblDataList?>
</div>