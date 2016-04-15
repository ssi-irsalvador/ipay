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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Add New Bank</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Bank Generation Report Form</legend>-->
<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
<!--<script src="../includes/jscript/jquery.js"></script>-->
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{ color: #E42217; float: none; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#bank_export_report").validate(
		{
			rules:
			{
				pps_name:{
					required:true
				},
				banklist_name:{
					required:true
				},
				bank_company_code:{
					required:true
				},
				bank_acct_no:{
					required:true,
					number:true
				},
				batch_no:{
					required:true,
					number:true
				}
			},
			messages:
			{
				pps_name:{
					required:" Please select Pay Group."
				},
				banklist_name:{
					required:" Please select Bank Name."
				},
				bank_company_code:{
					required:" Please enter Company Code."
				},
				bank_acct_no:{
					required:" Please enter Company Account No.",
					number:" Please enter a valid Company Account No."
				},
				batch_no:{
					required:" Please enter Batch No.",
					number:" Please enter a valid Batch No."
				}
			}
		}
	);
});
</script>

<form id="bank_export_report" name="bank_export_report" method="POST" action="">
  <table width="100%" border="0" >
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Pay Group</td>
      <td><input name="pps_name" type="text" id="pps_name" class="longselect" style="height: 15px;" value="<?php echo trim($oData['pps_name']); ?>" readonly="readonly" />
        <!-- <a href='javascript:void(0);' onclick="javascript: openwindow('popup.php?statpos=popup_paydetails', 'searchwindow', '');"> -->
        <a class="popup" href="popup.php?statpos=popup_paydetails">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" />
        <input name="pps_id" type="hidden" id="pps_id" />
        <input name="payperiod_id" type="hidden" id="payperiod_id" />
        </a></td>
    </tr>
    <tr>
      <td>Cut-Off Date</td>
      <td><input name="payperiod_start_date" type="text" id="payperiod_start_date" class="longselect" style="height: 15px;" value="<?php echo trim($oData['payperiod_start_date']); ?>" readonly="readonly" />&nbsp;to
        <input name="payperiod_end_date" type="text" id="payperiod_end_date" class="longselect" style="height: 15px;" value="<?php echo trim($oData['payperiod_end_date']); ?>" readonly="readonly" /></td>
    </tr>
    <tr>
      <td>Pay Date</td>
      <td><input name="payperiod_trans_date" type="text" id="payperiod_trans_date" class="longselect" style="height: 15px;" value="<?php echo trim($oData['payperiod_trans_date']); ?>" readonly="readonly" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
    </tr>
    <tr>
      <td width="22%">Bank Name</td>
      <td width="78%">
        <input name="banklist_name" type="text" id="banklist_name" class="longselect" style="height: 15px;" value="<?php echo trim($oData['banklist_name']); ?>" />
      <!-- <a href='javascript:void(0);' onclick="javascript: openwindow('popup.php?statpos=popup_bankinfo', 'searchwindow', '');"> -->
      <a class="popup" href="popup.php?statpos=popup_bankinfo">
      <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" />
      </a></td>
      </tr>
    <tr>
      <td>Presenting Office Code</td>
      <td>
        <input name="bank_routing_number" type="text" id="bank_routing_number" class="longselect" style="height:15px;" value="<?php echo trim($oData['bank_routing_number']); ?>" />
        <input name="bank_id" type="hidden" id="bank_id" /><input name="banklist_id" type="hidden" id="banklist_id" />
      <em style="font-size: 8pt; color: #7a7a7a;">(receiving BPI branch code)</em></td>
      </tr>
    <tr>
      <td>Company Code</td>
      <td>
        <input name="bank_company_code" type="text" id="bank_company_code" class="longselect" style="height:15px;" value="<?php echo trim($oData['bank_company_code']); ?>" />
      </td>
      </tr>
    <tr>
        <tr>
      <td>Company Account Name</td>
      <td>
        <input name="bank_acct_name" type="text" id="bank_acct_name" class="longselect" style="height:15px;" value="<?php echo trim($oData['bank_acct_name']); ?>" />
      </td>
      </tr>
    <tr>
      <td>Company Account No.</td>
      <td>
        <input name="bank_acct_no" type="text" id="bank_acct_no" class="longselect" style="height:15px;" value="<?php echo trim($oData['bank_acct_no']); ?>" />
      </td>
      </tr>
    <tr>
      <td>Default Ceiling Amount</td>
      <td><strong>
        <input name="bank_ceiling_amount" type="text" id="bank_ceiling_amount" class="longselect" style="height:15px;" value="<?php echo trim($oData['bank_ceiling_amount']); ?>" />
      </strong></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
    </tr>
    <tr>
      <td>Attention</td>
      <td>
      	<input name="attention" type="text" class="longselect" id="attention" style="height:15px;" />
      	&nbsp;&nbsp;Position <input name="att_pos" type="text" id="att_pos" class="longselect" style="height:15px;" />
      </td>
    </tr>
    <tr>
      <td>Batch Number (01-99)</td>
      <td><input name="batch_no" type="text" class="longselect" id="batch_no" style="height:15px;" maxlength="2" /></td>
    </tr>
    <tr>
      <td>Credit Date</td>
      <td><input name="pbr_credit_date" id="pbr_credit_date" maxlength="10" <? if($oData['emp_hiredate']) print "value=".$oData['pbr_credit_date'].""; else print "value='0000-00-00'";?> type="text" class="longselect" style="height:15px" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onkeydown="javascript:return dFilter(event.keyCode, this, '####-##-##');" />
      <a href="javascript:void(0);" class="option" onclick="return showCalendar('pbr_credit_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
    </tr>
     <tr>
      <td>Credit Time (HH:mm)</td>
      <td>
      	<input name="cred_time" type="text" class="longselect" id="cred_time" style="height:15px;" maxlength="5" />
      	<select name="am_pm">
      		<option value="AM">AM</option>
      		<option value="PM">PM</option>
      	</select>
      	</td>
    </tr>
    <tr>
      <td>Prepared by</td>
      <td>
        <input name="pbr_prepared_by" type="text" id="pbr_prepared_by" class="longselect" style="height:15px;" />
        &nbsp;&nbsp;Position <input name="pbr_prepared_pos" type="text" id="pbr_prepared_pos" class="longselect" style="height:15px;" />
      </td>
    </tr>
    <tr>
      <td>Approved by</td>
      <td>
        <input name="pbr_approved_by" type="text" id="pbr_approved_by" class="longselect" style="height:15px;" />
        &nbsp;&nbsp;Position <input name="pbr_approved_pos" type="text" id="pbr_approved_pos" class="longselect" style="height:15px;" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
      <td style="color: #CCFF66; border-top: 1px solid;">&nbsp;</td>
    </tr>
   	<tr>
      <td>Select a Report Format:</td>
      <td><div id="default" style="display:inline;"><input type="radio" name="format" id="radio4" value="default" checked="checked" />System Default</div>&nbsp;&nbsp;&nbsp;<div id="ibank" style="display:inline;"><input type="radio" name="format" id="radio5" value="ibank"/> iBank</div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      <input type="submit" name="Submit" value="Generate Bank" class="themeInputButton" />
      <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='reports.php?statpos=bank_export_report'">
      </td>
      </tr>
  </table>
  </form>
</fieldset>
</div>