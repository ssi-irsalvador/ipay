<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">General Settings</h2></fieldset>
<form method="post" action="">
<fieldset class="themeFieldset01" style="background-color:#FDEEF4">
  <table border="0" cellpadding="0" cellspacing="1" width="100%">
      <tr>
        <td><em>Company Code</em></td>
        <td><b><?=$oDatacomp['comp_code']?>
            <input type="hidden" name="comp_id" id="comp_id" value="<?=$oDatacomp['comp_id']?>" />
        </b></td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td><em>Company Name</em></td>
        <td colspan="3"><b><?=$oDatacomp['comp_name']?>
        </b></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="41%" valign="top">&nbsp;</td>
      </tr>
      <tr>
      <td width="15%"><em>Primary Contact</em></td>
      <td width="31%"><strong><?=$oDatacomp['comp_prim_contc']?>
      </strong></td>
      <td width="13%"><em>Address</em></td>
      <td width="41%" rowspan="2" valign="top"><strong><?=$oDatacomp['comp_add']?>
      </strong></td>
      </tr>
    <tr>
      <td><em>Contact No.</em></td>
      <td><strong><?=$oDatacomp['comp_tel']?>
      </strong></td>
      <td width="13%">&nbsp;</td>
    </tr>
    <tr>
      <td><em>TIN No.</em></td>
      <td><b><?=$oDatacomp['comp_tin']?>
        </b></td>
      <td><em>Email</em></td>
      <td valign="top"><b><?=$oDatacomp['comp_email']?>
      </b></td>
    </tr>
    <tr>
      <td><em>SSS No.</em></td>
      <td><strong><?=$oDatacomp['comp_sss']?>
      </strong></td>
      <td width="13%">&nbsp;</td>
      <td width="41%" valign="top">&nbsp;</td>
    </tr>
  </table>
</fieldset>
<br />
<fieldset class="themeFieldset01">
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br>
	<?php		
	}
	?>
	</div>
<?php		
	}else {
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
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<?php for($c=0;$c<count($decimalVal);$c++){ 
		if($decimalVal[$c]['set_name']=='General Decimal Settings'){
?>
	 <tr>
	  <td><b>&nbsp;<em>Decimal Policy</em></b></td>
	  <td colspan="5">&nbsp;</td>
	 </tr>
	 <tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><input type="text" value="<?php echo $decimalVal[$c]['set_decimal_places']?>" style="width:30px; text-align:right; padding:1px;" name="<?php echo "val".$c;?>"></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Final Decimal Settings'){?>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><input type="text" value="<?php echo $decimalVal[$c]['set_decimal_places']?>" style="width:30px; text-align:right; padding:1px;" name="<?php echo "val".$c;?>"></td>
	</tr>
	 <?php }elseif($decimalVal[$c]['set_name']=='TAX'){?>
	 <tr>
	   <td colspan="6"><HR></td>
      </tr>
	 <tr>
	  <td><b>&nbsp;<em>Government Policy</em></b></td>
	  <td colspan="5">&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td width="14%"><b><em>&nbsp;Name</em></b></td>
	  <td width="13%"><b><em>&nbsp;Effective Date</em></b></td>
	  <td width="11%"><b><em>&nbsp;Base on</em></b></td>
	  <td width="20%"><em><strong>Subject to Statutory</strong></em></td>
	  <td width="28%"><em><strong>Deduction Type</strong></em></td>
	</tr>
	<tr>
	  <td>&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?> Table
	    <input type="hidden" value="<?php echo $decimalVal[$c]['set_id']?>" name="valtax" /></td>
	  <td><select name="tp_id" id="tp_id" class="longselect">
        <?=html_options_2d($getTaxTableList,'tp_id','tp_name', $decimalVal[$c]['tax']['tp_id'],false)?>
      </select></td>
	  <td><input type="text" name="tp_edate" id="tp_edate" value="<?php echo $decimalVal[$c]['tax']['tp_edate']?>" readonly=""/></td>
	  <td><select name="stype_tax" id="stype_tax">
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Gross Amount</option>
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
      </select></td>
	  <td><select name="isStat" id="isStat">
        <option value="0" <?php IF($decimalVal[$c]['set_order'] == '0') echo "selected=\"selected\"";?>>NO</option>
        <option value="1" <?php IF($decimalVal[$c]['set_order'] == '1') echo "selected=\"selected\"";?>>YES</option>
      </select></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='SSS'){?>
	<tr>
	  <td>&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?> Table
	    <input type="hidden" value="<?php echo $decimalVal[$c]['set_id']?>" name="valsss" /></td>
	  <td><select name="sc_id" id="sc_id" class="longselect">
	  		<?=html_options_2d($getStatSSSList,'sc_id','sc_code', $decimalVal[$c]['sss']['sc_id'],false)?>
		  </select></td>
	  <td><input type="text" name="sc_effectivedate" id="sc_effectivedate" value="<?php echo $decimalVal[$c]['sss']['sc_effectivedate']?>" readonly=""/></td>
	  <td><select name="stype_sss" id="stype_sss">
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Gross Amount</option>
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
      </select></td>
	  <td>&nbsp;</td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='PHIC'){?>
	<tr>
	  <td>&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?> Table
	    <input type="hidden" value="<?php echo $decimalVal[$c]['set_id']?>" name="valphic" /></td>
	  <td><select name="sc_id2" id="sc_id2" class="longselect">
	  		<?=html_options_2d($getStatPHICList,'sc_id','sc_code', $decimalVal[$c]['phic']['sc_id'],false)?>
		  </select></td>
	  <td><input type="text" name="sc_effectivedate_2" id="sc_effectivedate_2" value="<?php echo $decimalVal[$c]['phic']['sc_effectivedate']?>" readonly=""/></td>
	  <td><select name="stype_phic" id="stype_phic">
        <option value="1" <? IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Gross Amount</option>
        <option value="0" <? IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
      </select></td>
	  <td>&nbsp;</td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='HDMF'){?>
	<tr>
	  <td>&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?> Table
	    <input type="hidden" value="<?php echo $decimalVal[$c]['set_id']?>" name="valhdmf" /></td>
	  <td><select name="sc_id3" id="sc_id3" class="longselect">
	  		<?=html_options_2d($getStatHDMFList,'sc_id','sc_code', $decimalVal[$c]['hdmf']['sc_id'],false)?>
		  </select></td>
	  <td><input type="text" name="sc_effectivedate_3" id="sc_effectivedate_3" value="<?php echo $decimalVal[$c]['hdmf']['sc_effectivedate']?>" readonly=""/></td>
	  <td><select name="stype_hdmf" id="stype_hdmf">
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Gross Amount</option>
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
      </select></td>
      <td>&nbsp;</td>
	  <td><select name="hdmfType" id="hdmfType">
        <option value="0" <?php IF($decimalVal[$c]['set_order'] == '0') echo "selected=\"selected\"";?>>By Fixed Amount</option>
        <option value="1" <?php IF($decimalVal[$c]['set_order'] == '1') echo "selected=\"selected\"";?>>By Percentage</option>
      </select>
      </td>
	</tr>
	<tr>
	  <td colspan="6"><HR></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Overtime Computation'){?>
	<tr>
	  <td colspan="2"><b>&nbsp;<em>Payroll Computation Policy</em></b></td>
	  <td colspan="4">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="stype_ot" id="stype_ot">
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Basic Amount plus COLA</option>
      </select></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Leave Deduction'){?>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="stype_leave" id="stype_leave">
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>Basic Amount</option>
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Basic Amount plus COLA</option>
      </select></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Annualize Tax on Last Pay Period of the Year'){?>
	<tr>
		<td width="20%" style="padding-left:11px;"><?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="annualize" id="annualize">
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>No</option>
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>Yes</option>
      </select></td>
	</tr>
	<tr>
		<td width="20%" style="padding-left:11px;">Last Pay Date of the Year</td>
		<td colspan="5">
		<input name="last_paydate" type="text" class="txtfields" id="last_paydate" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" <? if($decimalVal[$c]['set_other_data']) print "value=".$decimalVal[$c]['set_other_data'].""; else print "disabled value='0000-00-00'";?> maxlength="10" value="" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');" readonly=""/>
		<a href="javascript:void(0);" class="option" onclick="return showCalendar('last_paydate');" id="cal_link" <? if($decimalVal[$c]['set_other_data']) print ""; else print "style=\"display:none;\"";?>><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a>
		</td>
	</tr>
	<tr>
	  <td colspan="6"><HR></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='TA Import Form'){?>
	<tr>
	  <td>&nbsp;<b>&nbsp;<em>Default FORMAT</em></b></td>
	  <td colspan="5">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="stype_taform" id="stype_taform" class="longselect">
        <option value="1" <?php /* NORMAL TA IMPORT*/ IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>TA FORM1 - NORMAL</option>
        <option value="2" <?php /* AGROTECH TA IMPORT*/ IF($decimalVal[$c]['set_stat_type'] == '2') echo "selected=\"selected\"";?>>TA FORM2 - AGROTECH</option>
		<option value="3" <?php /* FAS TA IMPORT*/ IF($decimalVal[$c]['set_stat_type'] == '3') echo "selected=\"selected\"";?>>TA FORM3 - FAS</option>
		<option value="4" <?php /* FEAP TA IMPORT*/ IF($decimalVal[$c]['set_stat_type'] == '4') echo "selected=\"selected\"";?>>TA FORM4 - FEAP</option>
		<option value="5" <?php /* FEAP TA IMPORT*/ IF($decimalVal[$c]['set_stat_type'] == '5') echo "selected=\"selected\"";?>>TA FORM5 - SIGMA</option></select></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Payslip FORM'){?>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="stype_payslip" id="stype_payslip" class="longselect">
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>PAYSLIP FORMAT1</option>
        <option value="2" <?php IF($decimalVal[$c]['set_stat_type'] == '2') echo "selected=\"selected\"";?>>PAYSLIP FORMAT2</option>
        <option value="3" <?php IF($decimalVal[$c]['set_stat_type'] == '3') echo "selected=\"selected\"";?>>PAYSLIP FORMAT3</option>
      </select></td>
	</tr>
	<tr>
	  <td colspan="6"><HR></td>
	</tr>
	<?php }elseif($decimalVal[$c]['set_name']=='Location as Company'){?>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><select name="stype_isLoc" id="stype_isLoc">
        <option value="0" <?php IF($decimalVal[$c]['set_stat_type'] == '0') echo "selected=\"selected\"";?>>NO</option>
        <option value="1" <?php IF($decimalVal[$c]['set_stat_type'] == '1') echo "selected=\"selected\"";?>>YES</option>
      </select></td>
	</tr>
	<?php }else{?>
	<tr>
		<td width="20%">&nbsp;&nbsp;&nbsp;<?php echo $decimalVal[$c]['set_name']?></td>
		<td colspan="5"><input type="text" value="<?php echo $decimalVal[$c]['set_decimal_places']?>" style="width:30px; text-align:right; padding:1px;" name="<?php echo "val".$c;?>"></td>
	</tr>
<?php } } ?>
<tr>
  <td colspan="6">&nbsp;</td>
</tr>
<tr><td colspan="6">
<input name="btnOk" id="btnOk" type="submit" value=" Update and Exit " class="themeInputButton" />
<input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=manage_decimal'" />
</td></tr>
</table>
</fieldset>
</form>
</div>
<script>
$("#annualize").click(function () {
    var js = "alert('B:' + this.id); return showCalendar('last_paydate');";
    // create a function from the "js" string
    var newclick = new Function(js);
	val = $(this).val();
	if(val == '0') {
  		$("#last_paydate").attr("disabled",true);
  		$("#cal_link").css("display","none");
	} else {
		$("#last_paydate").removeAttr("disabled");
		$("#cal_link").css("display","inline");
	}
});
</script>