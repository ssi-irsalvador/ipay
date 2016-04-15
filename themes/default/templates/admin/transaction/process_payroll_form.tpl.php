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
<script type="text/javascript">
$(function () {
    $('#chkAttendAll').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
});
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Process Payroll Form</h2></fieldset>
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
      <td class="divTblTH_"><em>Payroll Type</em></td>
      <td class="divTblTH_"><b><?=$oData['classification']?></b></td>
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
	<form method="post" action=""><input type="hidden" name="payperiod_type" id="payperiod_type" value="<?=$oData['classification']?>" />
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<?php IF($oData['classification']=='Bonus'){?>
			<tr>
			  <td>
			  <fieldset class="themeFieldset01">
			  <legend class="themeLegend01"><em>Bonus Setup</em></legend>
			  <table width="800" border="0" cellspacing="2" cellpadding="0">
                <tr>
                  <td width="171"><em><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Basic Salary </strong></em></td>
                  <td width="166"><select name="bonus_id" id="bonus_id" class="longselect">
                      <option value="0">Select Bonus Formula</option>
                      <?=html_options_2d($getALLBonusFormula,'bonus_id','bonus_code', $oData['bonus_id'],false)?>
                  </select></td>
                  <td colspan="2"><input type="checkbox" name="ishire" id="ishire" value="1" />
                    subject to hiredate if new hire within fiscal year</td>
                </tr>
                <tr>
                  <td><em><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Slip Account</strong></em></td>
                  <td><select name="psaid" id="psaid" class="longselect">
                      <option value="0">Select Pay Element</option>
                      <?=html_options_2d($getALLBonusPEAccnt,'psa_id','psatype', $oData['psaid'],false)?>
                  </select></td>
                  <td colspan="2"><input type="checkbox" name="wbonus" id="wbonus" value="1" />
                    without bonus computation</td>
                </tr>
                <tr>
                  <td><em><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Factor Rate</strong></em></td>
                  <td><select name="factor" id="factor" class="longselect">
                      <option value="1">Whole</option>
                      <option value="0.5">Half</option>
                  </select></td>
                  <td width="160" colspan="2"><input type="checkbox" name="leavededuct" id="leavededuct" value="1" />
                  w/ Leave Deduction</td>
                </tr>
              </table>
			  </fieldset></td>
		    </tr><?php } ?>
			<tr>
				<td><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Generate Payroll" class="themeInputButton" /><?=$tblDataList?><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Generate Payroll" class="themeInputButton" /></td>
			</tr>
		</table>
	</form>
</fieldset>
</div>

<script type="text/javascript">
$("#wbonus").click(function () {
    if ($("#wbonus").is(":checked")) {
        $("#factor").attr("disabled", "disabled")
        $("#leavededuct").attr("disabled", "disabled")
        $("#ishire").attr("disabled", "disabled")
        $("#bonus_id").attr("disabled", "disabled")
        $("#psaid").attr("disabled", "disabled")
    }
    else {
        $("#factor").removeAttr("disabled")
        $("#leavededuct").removeAttr("disabled")
        $("#ishire").removeAttr("disabled")
        $("#bonus_id").removeAttr("disabled")
        $("#psaid").removeAttr("disabled")
    }
});
</script>