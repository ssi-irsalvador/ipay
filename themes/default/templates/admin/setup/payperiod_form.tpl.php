<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Pay Period Form</legend>
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
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
<script language="javascript">
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
<script type="text/javascript">
function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}
</script>
<form name="payperiod" id="payperiod" method="post" action="">
  <table width="700" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td class="divTblTH_">Period</td>
      <td class="divTblTH_">: <select name="payperiod_period" id="payperiod_period" class="longselect">
		<?=html_options($month, $oData['payperiod_period'])?>
      </select>
        <input name="payperiod_period_year" type="text" id="payperiod_period_year" <? if($oData['payperiod_period_year']) print "value=".$oData['payperiod_period_year'].""; else print "value=".date('Y')."";?> size="6" maxlength="4" style="text-align:center"/></td>
    </tr>
    <tr>
      <td width="166" class="divTblTH_">Start Date</td>
      <td width="527" class="divTblTH_">
        :
        <input  name="payperiod_start_date" type="text" class="txtfields" id="payperiod_start_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_start_date']) print "value=".$oData['payperiod_start_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		<a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_start_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>
        <input type="hidden" name="pp_stat_id" id="pp_stat_id" value="<?=$oData['pp_stat_id']?>" /></td>
    </tr>
    <tr style="display:none">
      <td>Advance End Date</td>
      <td>:
          <input  name="payperiod_adv_end_date" type="text" class="txtfields" id="payperiod_adv_end_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_adv_end_date']) print "value=".$oData['payperiod_adv_end_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_adv_end_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr style="display:none">
      <td>Advance Pay Date</td>
      <td>:
          <input  name="payperiod_adv_trans_date" type="text" class="txtfields" id="payperiod_adv_trans_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_adv_trans_date']) print "value=".$oData['payperiod_adv_trans_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_adv_trans_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr>
      <td>End Date</td>
      <td>:
          <input  name="payperiod_end_date" type="text" class="txtfields" id="payperiod_end_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_end_date']) print "value=".$oData['payperiod_end_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_end_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>      </td>
    </tr>
    <tr>
      <td>Pay Date</td>
      <td>:
          <input  name="payperiod_trans_date" type="text" class="txtfields" id="payperiod_trans_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['payperiod_trans_date']) print "value=".$oData['payperiod_trans_date'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		  <a href="javascript:void(0);" class="option" onclick="return showCalendar('payperiod_trans_date');">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>     </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="submit" name="Submit" value=" Save & Exit " class="themeInputButton" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('payperiod')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg&ppsched=<?=$_GET['ppsched']?>'" /></td>
    </tr>
  </table>
</form>
</fieldset>
<?=$tblDataList?>
</div>