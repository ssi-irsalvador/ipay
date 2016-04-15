<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Pay Period Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Pay Period Form</legend>-->
<table width="100%" border="0" cellpadding="1.5" cellspacing="0" class="divTblTH_">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Company</em></span><strong><?=$oData_['comp_name']?></strong></td>
      </tr>
      <tr>
        <td width="30">&nbsp;</td>
        <td width="543"><span class="longlabel"><em>Name</em></span><strong><?=$oData_['pps_name']?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Description</em></span><strong><?=$oData_['pps_desc']?></strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="longlabel"><em>Type</em></span><strong><?=$oData_['salaryclass']?>
          <input name="salaryclass_id" type="hidden" id="salaryclass_id" value="<?=$oData_['salaryclass_id']?>" size="4" maxlength="10" />
        </strong></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
</table>
</fieldset>
<fieldset class="themeFieldset01">
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
<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"></script>

<script type="text/javascript">
function acceptValidNumbersOnly(obj,e) {
			var key='';
			var strcheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+=-`{}[]:\";'\|/?,><\\ ";
			var whichcode = (window.Event) ? e.which : e.keyCode;
			try{
			if(whichcode == 13 || whichcode == 8)return true;
			key = String.fromCharCode(whichcode);
			if(strcheck.indexOf(key) != -1)return false;
			return true;
			}catch(e){;}
}

function amounttype(){
//this is used to manipulate the type of amount
			
	if ( document.getElementById('amountype').value == 1 ) {
		document.getElementById('type_id-10').style.display = 'none';

		document.getElementById('type_id-20').className = '';
		document.getElementById('type_id-20').style.display = '';
	} else {
		document.getElementById('type_id-20').style.display = 'none';

		document.getElementById('type_id-10').className = '';
		document.getElementById('type_id-10').style.display = '';
	}
}
</script>

<script src="../includes/jscript/jquery.js"></script>
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
	$("#payperiod").validate(
		{
			rules:
			{
				payperiod_start_date:{
					required:true
				},
				payperiod_end_date:{
					required:true
				},
				payperiod_trans_date:{
					required:true
				}
			},
			messages:
			{
				payperiod_start_date:"Please enter or select Start Date.",
				payperiod_end_date:"Please enter or select End Date.",
				payperiod_trans_date:"Please enter or select Pay Date."
			}
		}
	);
});
$(document).ready(function() {
	var bindClickToToggle = function(element){
	    element.click(function(){
	        $(this).parents('.dropdown').find('dd ul').toggle();
	    });
	};
	
	$('#type').change(function () {
	    if ($('#type option:selected').text() == "Normal"){
	        $('#all_freq').hide();
	        $('#from').hide();
	        $('#daterange').hide();
	        $('#dateper').show();
	    } else if ($('#type option:selected').text() == "Bonus"){
		 	$('#all_freq').hide();
	        $('#from').hide();
	        $('#daterange').hide();
	        $('#dateper').show();
		} else if($('#type option:selected').text() == "Others"){
	    	 $('#all_freq').show();
	    	 $('#from').show();
	    	 $('#daterange').show();
	    	 $('#dateper').hide();
		} else if($('#type option:selected').text() == "Last Pay"){
	        $('#all_freq').hide();
	        $('#from').hide();
	        $('#daterange').hide();
	        $('#dateper').show();
		}else {
	    	 $('#all_freq').show();
	    	 $('#from').show();
	    	 $('#daterange').show();
	    	 $('#dateper').hide();
	    } });
});
</script>
<form name="payperiod" id="payperiod" method="POST" action="">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
  		<td>&nbsp;</td>
  		<td><span class="longlabel"><em>Payperiod Name</em></span>
			<input name="payperiod_name" type="text" id="payperiod_name" <? if($oData['payperiod_name']) print "value='".$oData['payperiod_name']."'"; else print "value='".$oData['pps_name']."'";?> size="50" maxlength="50"/>
  		</td>
  	</tr>
  	<tr>
  		<td>&nbsp;</td>
  		<td><span class="longlabel"><em>Type</em></span>
		<select name="type" id="type">
			<?=html_options($processTYPE, $oData['payperiod_type'])?>
      	</select>
  		</td>
  	</tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Period</em></span>
	  	<?php 
			IF($oData_['salaryclass_id']=='2'){ 
					$weekly = 'inline';
					$semi = 'inline';
			}ELSEIF($oData_['salaryclass_id']=='4' || $oData_['salaryclass_id']=='3'){
					$semi = 'inline';
					$weekly = 'none';
			}ELSE{
					$weekly = 'none';
					$semi = 'none';
			}
		?>
	  	<div><div style="width:50px; float:left">
        <input type="radio" name="payperiod_freq" id="payperiod_freq" <? IF($oData['payperiod_freq'] == '1') echo "checked";?> value="1"  checked="checked"/>
      1st </div><div id="semi_" style="widows:50px; float:left; display:<?php echo $semi; ?>">
        <input type="radio" name="payperiod_freq" id="payperiod_freq" <? IF($oData['payperiod_freq'] == '2') echo "checked";?> value="2" />
      2nd&nbsp;  </div><div id="weekly_" style="widows:150px; float:left; display:<?php echo $weekly; ?>">
	  	<input type="radio" name="payperiod_freq" id="payperiod_freq" <? IF($oData['payperiod_freq'] == '3') echo "checked";?> value="3" />
      3rd
      <input type="radio" name="payperiod_freq" id="payperiod_freq" <? IF($oData['payperiod_freq'] == '4') echo "checked";?> value="4" />
      4th
	  	<input type="radio" name="payperiod_freq" id="payperiod_freq" <? IF($oData['payperiod_freq'] == '5') echo "checked";?> value="5" />
      5th </div></div>
      <div <? if($oData['payperiod_type']==2) print "style=\"display:inline;\""; else print print "style=\"display:none;\"";?> id="all_freq"><input type="radio" name="payperiod_freq" id="payperiod_freq" value="0"  <? IF($oData['payperiod_freq'] == '0') echo "checked";?>/>All</div>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div id="daterange" <? if($oData['payperiod_type']==2) print "style=\"display:inline;\""; else print print "style=\"display:none;\"";?>>
      	<span class="longlabel"><em>From</em></span><select name="from_month" id="from_month">
		<?=html_options($month, $oData['payperiod_period'])?>
      </select>
	  <input name="from_year" type="text" id="from_year" <? if($oData['payperiod_period_year']) print "value=".$oData['payperiod_period_year'].""; else print "value=".date('Y')."";?> size="6" maxlength="4" style="text-align:center"/>
    	<br>
    	<span class="longlabel"><em>To</em></span><select name="to_month" id="to_month">
		<?=html_options($month, $oData['payperiod_period_to'])?>
      </select>
	  <input name="to_year" type="text" id="to_year" <? if($oData['payperiod_period_year_to']) print "value=".$oData['payperiod_period_year_to'].""; else print "value=".date('Y')."";?> size="6" maxlength="4" style="text-align:center"/>
	  </div>
	  
	  <div id="dateper" <? if($oData['payperiod_type']==2) print "style=\"display:none;\""; else print print "style=\"display:inline;\"";?>>
      	<span class="longlabel"><em>&nbsp;</em></span><select name="payperiod_period" id="payperiod_period">
		<?=html_options($month, $oData['payperiod_period'])?>
      </select>
	  <input name="payperiod_period_year" type="text" id="payperiod_period_year" <? if($oData['payperiod_period_year']) print "value=".$oData['payperiod_period_year'].""; else print "value=".date('Y')."";?> size="6" maxlength="4" style="text-align:center"/>
	  </div>
	  </td>
    </tr>
	<?php if ($_GET['ppsched_edit']) {?>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Status</em></span><select name="pp_stat_id" id="pp_stat_id">
		<?=html_options($stat, $oData['pp_stat_id'])?>
      </select></td>
    </tr>
	<? } ?>
    <tr>
      <td width="30">&nbsp;</td>
      <td width="527"><span class="longlabel"><em>Start Date</em></span><input  name="payperiod_start_date" type="text" class="txtfields" id="payperiod_start_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_start_date']) print "value=".$oData['payperiod_start_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		<a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_start_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a></td>
    </tr>
    <tr style="display:none">
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Advance End Date</em></span><input  name="payperiod_adv_end_date" type="text" class="txtfields" id="payperiod_adv_end_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_adv_end_date']) print "value=".$oData['payperiod_adv_end_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_adv_end_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr style="display:none">
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Advance Pay Date</em></span><input  name="payperiod_adv_trans_date" type="text" class="txtfields" id="payperiod_adv_trans_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_adv_trans_date']) print "value=".$oData['payperiod_adv_trans_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_adv_trans_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>End Date</em></span><input  name="payperiod_end_date" type="text" class="txtfields" id="payperiod_end_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_end_date']) print "value=".$oData['payperiod_end_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_end_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Pay Date</em></span><input  name="payperiod_trans_date" type="text" class="txtfields" id="payperiod_trans_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_trans_date']) print "value=".$oData['payperiod_trans_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_trans_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>View ESS Payslip</em></span><input name="ess_payslip" type="checkbox" id="ess_payslip" value="1" <? if($oData['is_payslip_viewable']) print "checked"; else print "";?>/>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>Convert Leaves</em></span><input name="convert_leave" type="checkbox" id="convert_leave" value="1" <? if($oData['convert_leave']) print "checked"; else print "";?>/>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="longlabel"><em>&nbsp;</em></span><input type="submit" name="Submit" <?php if ($_GET['ppsched_edit']) { ?> value="Update" onclick="return confirm('Are you sure you want to update this Pay Period?');" <?php } else { ?> value="Save" <?php } ?> class="themeInputButton" />
	  	<?php if (!$_GET['ppsched_edit']) {?>
        <input type="button" name="Reset" value="Reset" class="themeInputButton" onclick="jqResetForm('payperiod')" />
        <input type="button" name="Back" value="Back" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg'" />
		<?php }else{ ?>
		<input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=mnge_pg&ppsched=<?=$_GET['ppsched']?>'" /><?php } ?></td>
    </tr>
  </table>
</form>
</fieldset>
<?=$tblDataList?>
</div>