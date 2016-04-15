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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Add New Pay Group</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Manage Pay Group Form</legend>-->
  <!-- import the calendar css -->
  <link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
  <!-- import the calendar script -->
  <script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/>
  </script>
  <!-- import the language module -->
  <script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/>
  </script>
<script type="text/javascript">

function filterUserCount() {
	total = countSelect(document.getElementById('filter_user'));
	writeLayer('filter_user_count', total);
}

function showType() {
	document.getElementById('type_id-10').style.display = 'none';
	document.getElementById('type_id-30').style.display = 'none';
	document.getElementById('type_id-50').style.display = 'none';

	//alert('Type ID: '+ document.getElementById('type_id').value );
	if ( document.getElementById('salaryclass_id').value == 4 ) {
		document.getElementById('type_id-30').className = '';
		document.getElementById('type_id-30').style.display = '';

		document.getElementById('type_id-50').className = '';
		document.getElementById('type_id-50').style.display = ''

	} else if ( document.getElementById('salaryclass_id').value == 3 || document.getElementById('salaryclass_id').value == 2) {
		document.getElementById('type_id-10').className = '';
		document.getElementById('type_id-10').style.display = '';

	} else if ( document.getElementById('salaryclass_id').value == 5 || document.getElementById('salaryclass_id').value == 6) {
		document.getElementById('type_id-50').className = '';
		document.getElementById('type_id-50').style.display = '';
	}
}

function changeDailyStartTime() {
	daily_start_time = document.getElementById('daily_start_time').value
	document.getElementById('start_day_of_week_start_time').innerHTML = daily_start_time;
	document.getElementById('primary_day_of_month_start_time').innerHTML = daily_start_time;
	document.getElementById('secondary_day_of_month_start_time').innerHTML = daily_start_time;
}
</script>
<body onload="showType()">
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{ color: #E42217; float: none; }
</style>
<script type="text/javascript">
function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}
$(document).ready(function() {
	$("#mnge_pg").validate(
		{
			rules:
			{
				pps_name:{
					required:true
				},
				fr_name:{
					required:true
				}
			},
			messages:
			{
				pps_name:"Please enter a Name.",
				fr_name:"Please select a Factor Rate."
			}
		}
	);
});
</script>
<form id="mnge_pg" name="mnge_pg" method="POST" action="">
  <table width="850" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>Company</td>
      <td><select name="comp_id" id="comp_id" class="longselect">
        <?=html_options($comp,$oData['comp_id'])?>
      </select></td>
    </tr>
    <tr>
      <td width="207">Name</td>
      <td width="636"><input type="text" name="pps_name" id="pps_name" class="txtfields" value="<?=trim($oData['pps_name'])?>" /></td>
      </tr>
    <tr>
      <td>Description</td>
      <td><textarea name="pps_desc" id="pps_desc" cols="25" rows="3" style="float:left"><?=trim($oData['pps_desc'])?></textarea></td>
    </tr>
    <tr>
      <td>Type</td>
      <td><select name="salaryclass_id" id="salaryclass_id" class="longselect" onChange="showType();">
		  <?=html_options($typePS,$oData['salaryclass_id'])?>
        </select></td>
    </tr>
	<tbody id="type_id-10" style="display:none">
    <tr>
      <td>Pay Period Starts On</td>
      <td><select name="pps_start_day_week" id="pps_start_day_week" class="longselect">
        <?=html_options($weekdays, $oData['pps_start_day_week']);?>
      </select>
        <span class="cellRightEditTable"> at <b><span id="primary_day_of_month_start_time">00:00</span></b> </span></td>
    </tr>
    <tr>
      <td>Pay Date</td>
      <td><select name="pps_trans_date" id="pps_trans_date" class="longselect">
	  	<?=html_options($transdate, $oData['pps_trans_date']);?>
      </select>
        (days after end of pay period) </td>
    </tr>
	</tbody>
	<tbody id="type_id-50" style="display:none">
   <tr>
      <td colspan="2"><strong>Primary</strong></td>
      </tr>
    <tr>
      <td><span>Pay Period Start Day Of Month</span></td>
      <td><select name="pps_pri_daymonth" id="pps_pri_daymonth" class="longselect">
	  <?=html_options($transdate_month, $oData['pps_pri_daymonth']);?>
      </select></td>
    </tr>
    <tr>
      <td>Pay Period End Day Of Month </td>
      <td><select name="pps_pri_trans_daymonth" id="pps_pri_trans_daymonth" class="longselect">
        <?=html_options($transdate_month, $oData['pps_pri_trans_daymonth']);?>
      </select></td>
    </tr>
	</tbody>
	<tbody id="type_id-30" style="display:none">
    <tr>
      <td height="24" colspan="2"><strong>Secondary</strong></td>
      </tr>
    <tr>
      <td><span>Pay Period Start Day Of Month</span></td>
      <td><select name="pps_secnd_daymonth" id="pps_secnd_daymonth" class="longselect">
        <?=html_options($transdate_month, $oData['pps_secnd_daymonth']);?>
      </select></td>
    </tr>
    <tr>
      <td>Pay Period End Day Of Month</td>
      <td><select name="pps_secnd_trans_daymonth" id="pps_secnd_trans_daymonth" class="longselect">
        <?=html_options($transdate_month, $oData['pps_secnd_trans_daymonth']);?>
      </select></td>
    </tr>
    </tbody>
    
    
    <tr>
      <td>Tax Table </td>
      <td><select name="tt_pay_group" id="tt_pay_group" class="longselect">
		  <?=html_options($paygroup,$oData['tt_pay_group']);?>
		  </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value=" Save &amp; Exit " class="themeInputButton" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('mnge_pg')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg'" />		</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>