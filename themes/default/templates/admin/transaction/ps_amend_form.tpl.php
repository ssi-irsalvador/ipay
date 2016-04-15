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
alert('oi');
	//this is used to manipulate the type of amount
	if ( document.getElementById('psamend_type_id').value == 1 ) {
		document.getElementById('type_id-10').style.display = 'none';
		document.getElementById('type_id-20').className = '';
		document.getElementById('type_id-20').style.display = '';
	} else {
		document.getElementById('type_id-10').className = '';
		document.getElementById('type_id-10').style.display = '';
		document.getElementById('type_id-20').style.display = 'none';
	}
}

function calculate(){
	
rate = document.getElementById('rate').value;
hour = document.getElementById('hour').value;

x = rate*hour;
document.getElementById('psamend_amount').value = x;  

}
</script>

<script src="../includes/jscript/jquery.js"></script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;}
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
	$("#psamend").validate(
		{
			rules:
			{
				psamend_name:{
					required:true
				},
				psaid:{
					required:true
				},
				psamend_effect_date:{
					required:true
				}
			},
			messages:
			{
				psamend_name:"Please enter a Name.",
				psaid:"Please select Pay Slip Account.",
				psamend_effect_date:"Please enter Effective Date."
			}
		}
	);
});
</script>

<form method="post" action="" name="psamend" id="psamend">
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Payroll Amendments Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Pay Slip Amendments Form</legend>-->
  <table width="100%" border="0" cellpadding="1" cellspacing="2">
    
    <tr>
      <td class="divTblTH_">Status</td>
      <td class="divTblTH_"><select name="select">
        <option>Active</option>
      </select></td>
    </tr>
    <tr>
      <td class="divTblTH_">Name</td>
      <td class="divTblTH_"><input name="psamend_name" id="psamend_name" type="text" value="<?=trim($oData['psamend_name'])?>" class="txtfields" /></td>
    </tr>
    <tr class="divTblTH_">
      <td>Pay Slip Account</td>
      <td><select name="psaid" id="psaid">
	  	<option value="">Please select</option>
		<?=html_options_2d($getPSAccnt, 'psa_id', 'psatype', $oData['psaid'], false)?>
      </select>
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popup_employee', '201jobpos_code', '');">
        <input name="pps_id" type="hidden" id="pps_id" value="<?=$oData['pps_id']?>" />
        </a></td>
    </tr>
    <tr class="divTblTH_">
      <td>Payperiod</td>
      <td><select name="payperiod_id" id="payperiod_id">		  
      		<option value="0">Select Payperiod</option>
			<?=html_options($payperiod, $oData['payperiod_id'])?>
      </select>
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popup_employee', '201jobpos_code', '');">
        <input name="pps_id" type="hidden" id="pps_id" value="<?=$oData['pps_id']?>" />
        </a></td>
    </tr>
    <tr class="divTblTH_">
      <td>Effective Date</td>
      <td><input name="psamend_effect_date" type="text" class="txtfields" id="psamend_effect_date" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['psamend_effect_date']) print "value=".trim($oData['psamend_effect_date']).""; else print "value='0000-00-00'";?> onkeydown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/><a href="javascript:void(0);" class="option" onclick="return showCalendar('psamend_effect_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
    </tr>
    <tr class="divTblTH_">
      <td>Description</td>
      <td><textarea name="psamend_desc" cols="25" id="psamend_desc"><?=trim($oData['psamend_desc'])?></textarea></td>
    </tr>
	<?php /*?>
    <tr class="divTblTH_">
      <td><strong>Amount</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr class="divTblTH_">
      <td>&nbsp;</td>
      <td><table width="330" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="60">Rate</td>
          <td width="10">&nbsp;</td>
          <td width="60">Hour</td>
          <td width="200">&nbsp;</td>
        </tr>
        <tr>
          <td><input name="rate" type="text" id="rate" value="100" size="10" /></td>
          <td><div align="center">*</div></td>
          <td><input name="hour" type="text" id="hour" size="10" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" /></td>
          <td><input type="button" name="Calc" id="Calc" value="Calc" class="buttonstyle" onclick="calculate();" /></td>
        </tr>
      </table></td>
    </tr>
    <tr class="divTblTH_">
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Amount</td>
      <td><input name="psamend_amount" id="psamend_amount" value="<?php echo $var1 = (isset($_GET['add']))? $var * $var2 : $oData['psamend_amount']; ?>" type="text" size="15" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" /></td>
    </tr>
    <tr class="divTblTH_">
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Taxable</td>
      <td><select name="psamend_istaxable" id="psamend_istaxable">
          <?=html_options($psar_istaxable,$oData['psamend_istaxable'])?>
          </select></td>
    </tr>
    <tr class="divTblTH_">
      <td>&nbsp;&nbsp;&nbsp;&nbsp;Year to Date (YTD) Adjustment </td>
      <td><input type="checkbox" name="psamend_ytd_adj" id="psamend_ytd_adj" <?=(($oData['psamend_ytd_adj']=='1')?"checked":"")?> value="1" /></td>
    </tr><?php */?>
    <tr class="divTblTH_">
      <td>&nbsp;</td>
      <td><input type="submit" name="bntsave" id="bntsave" value=" Save &amp; Exit " class="buttonstyle" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('psamend')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='transaction.php?statpos=ps_amend'" />
		</td>
    </tr>
    <tr class="divTblTH_">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </table>
</fieldset>
<?php if($_GET['edit']) { ?>
<fieldset class="themeFieldset01_notopborder">
<div style="padding-top:5px;"><a href="transaction.php?statpos=ps_amend&edit=<?=$_GET['edit']?>&empinput_add">
<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'add2.png'?>" border="0" align="absbottom" title="Add" hspace="2px" border=0 width="16" height="16">&nbsp;Add Employee </a><!--<br /><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'add2.png'?>" border="0" align="absbottom">&nbsp;<a href="transaction.php?statpos=ps_amend&edit=<?=$_GET['edit']?>&empinput_add">Upload Amendments</a>-->
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center"><em><strong>Employee List </strong></em></div></td>
  </tr>
  <tr>
    <td><?=$tblDataList_?></td>
  </tr>
  <tr> 
    <td align="right"><input type="submit" name="bntsave" id="bntsave" value="Save Amount" class="buttonstyle"/>&nbsp;</td>
  </tr>
</table>
</fieldset>
<?php } ?>
</div>
</form>