<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style3 {font-weight: bold}
-->
</style>

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
<script language="javascript">
function CheckAll(count){
	var i;
	if(document.getElementById('chkAttendAll').checked==true){
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = true;
		}
	} else {
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = false;
		}
	}
}
function UncheckAll(count){
	var i;
	for(i=1; i<=count; i++){
		if(document.getElementById('chkAttend['+i+']').checked==false){
		   document.getElementById('chkAttendAll').checked=false;
			return;
		}
		document.getElementById('chkAttendAll').checked=true;
	}	
}
</script>
<script type="text/javascript" src="../includes/jquery/jquery1.7.2.min.js"></script>
<script language="javascript" type="text/javascript">
        $(function(){$('.dec').on('keyup', function(e) {    
    		var maxPlaces = <?= $genDecimal?>,        
    		integer = e.target.value.split('.')[0],        
    		mantissa = e.target.value.split('.')[1];        
    		if (typeof mantissa === 'undefined') {        
        		mantissa = '';    
        	}        
        	if (mantissa.length > maxPlaces) {        
            	e.target.value = integer + '.' + mantissa.substring(0, maxPlaces);    
            }});
		});
    </script>
<div class="themeFieldsetDivOT" style="width: 415px;">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">TA Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">TA Form</legend>-->
  <table width="380px" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="33%" class="divTblTH_"><em>Pay Group </em></td>
      <td width="67%" class="divTblTH_"><strong>
        <?=$oData['pps_name']?>
      </strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Employee Name </em></td>
      <td class="divTblTH_"><strong><?=$oData['empname']?></strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Payroll Date </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pdate']?>
      </strong></td>
    </tr>
    
    <tr>
      <td class="divTblTH_"><em>Pay Date </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['payperiod_trans_date']?>
      </strong></td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
	<form method="post" action="">
		<table border="0" cellspacing="0" cellpadding="0" width="380px">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr style="background-color:#FCB334">
      		<td colspan="100%"><i><strong>&nbsp;Timekeeping Form</strong></i></td>
    	  </tr>
          <tr>
            <td valign="top">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="divTblListTH"><strong>&nbsp;TA ID</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Rate</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Amt</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Total Hrs </strong></td>
                  <!--<td class="divTblListTH"><strong>Sub Total</strong></td>-->
                </tr>
                <?php
					if (count($tblDataListTA)>0) { $totalleave = 0; $ctr_ = 0;
					foreach ($tblDataListTA as $clKey => $clValue) {
					//popupotrates
				?>
                <tr>
                  <td class="divTblTH_"><span class="divTblListTROT style3">
                   <strong> <input name="TA[<?=$ctr_;?>][tatbl_name]" type="text" id="TA[<?=$ctr_;?>][tatbl_name]" value="<?=$clValue['tatbl_name']?>" size="28" readonly="readonly"  style="background:#666666; color:#FFFFFF"/>
                   </strong>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="TA[<?=$ctr_;?>][tatbl_rate]" id="TA[<?=$ctr_;?>][tatbl_rate]" type="text" value="<?=$clValue['tatbl_rate']?>" size="5" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="TA[<?=$ctr_;?>][rateAmount]" type="text" id="TA[<?=$ctr_;?>][rateAmount]" value="<?=number_format($clValue['rateAmount'],$genDecimal,'.','')?>" size="12" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input class="dec" name="TA[<?=$ctr_;?>][emp_tarec_nohrday]" id="TA[<?=$ctr_;?>][emp_tarec_nohrday]" type="text" size="7" <?php if($clValue['emp_tarec_nohrday']) print "value=".number_format($clValue['emp_tarec_nohrday'],$genDecimal,'.','').""; else print "value='".number_format(0,$genDecimal,'.','')."'";?> />
                    <input type="hidden" name="TA[<?=$ctr_;?>][tatbl_id]" id="TA[<?=$ctr_;?>][tatbl_id]" value="<?=$clValue['tatbl_id']?>" />
                    <input type="hidden" name="TA[<?=$ctr_;?>][emp_tarec_id]" id="TA[<?=$ctr_;?>][emp_tarec_id]" value="<?=$clValue['emp_tarec_id']?>" />
                  </span></td>
                </tr>
                <tr>
                  <!--<td class="divTblTH_"><span class="divTblListTROT">
			    <input type="text" name="subtotal[<?=$clValue['otr_id']?>]" id="subtotal[<?=$clValue['otr_id']?>]" readonly="readonly" />
			  </span></td>-->
                </tr>
                <?php $ctr_++; }} else { ?>
                <tr class="divTblListTR">
                  <td colspan="4" class="divTblListTD style1">No record found.</td>
                </tr>
                <?php } ?>
                <!--<tr>
			  <td colspan="4" class="divTblTH_" align="right"><strong><em>Grand Total OT Amount</em></strong> : </td>
		      <td class="divTblTH_"><span class="divTblListTROT">
		        <input type="text" name="textfield34" readonly="readonly" />
		      </span></td>
		  </tr>-->
            </table>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr style="background-color:#FCB334">
            <td colspan="100%"><i><strong>&nbsp;OT Form</strong></i></td>
          </tr>
          <tr>
            <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="divTblListTH"><strong>&nbsp;OT ID</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Rate</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Amt/Hr</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Total Hrs</strong></td>
                  <!--<td class="divTblListTH"><strong>Sub Total</strong></td>-->
                </tr>
                <?php
			if(count($tblDataList)>0){ $totalben = 0; $ctr = 0;
			foreach ($tblDataList as  $clKey => $clValue) {
			//popupotrates
			?>
                <tr>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="ot[<?=$ctr;?>][otr_name]" type="text" id="otr_name[]" value="<?=$clValue['otr_name']?>" size="28" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="ot[<?=$ctr;?>][otr_factor]" type="text" id="otr_factor[]" value="<?=number_format($clValue['otr_factor'],$genDecimal,'.','')?>" size="5" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="ot[<?=$ctr;?>][hrsrate]" type="text" id="hrsrate[]" value="<?=number_format($clValue['rateAmount'],$genDecimal,'.','')?>" size="12" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input class="dec" name="ot[<?=$ctr;?>][numhrs]" id="numhrs[]" type="text" size="7" onchange="subtotal[<?=$clValue['otr_id']?>].value = this.value;" <?php if($clValue['numhrs']) print "value=".number_format($clValue['numhrs'],$genDecimal,'.','').""; else print "value='".number_format(0,$genDecimal,'.','')."'";?> />
                    <input type="hidden" name="ot[<?=$ctr;?>][otr_id]" id="ot[<?=$ctr;?>][otr_id]" value="<?=$clValue['otr_id']?>" />
                    <input type="hidden" name="ot[<?=$ctr;?>][otrec_id]" id="ot[<?=$ctr;?>][otrec_id]" value="<?=$clValue['otrec_id']?>"/>
                  </span></td>
                  <!--<td class="divTblTH_"><span class="divTblListTROT">
			    <input type="text" name="subtotal[<?=$clValue['otr_id']?>]" id="subtotal[<?=$clValue['otr_id']?>]" readonly="readonly" />
			  </span></td>-->
                </tr>
                <?php $ctr++; }} else { ?>
                <tr class="divTblListTR">
                  <td colspan="4" class="divTblListTD style1">No record found.</td>
                </tr>
                <?php } ?>
                <!--<tr>
			  <td colspan="4" class="divTblTH_" align="right"><strong><em>Grand Total OT Amount</em></strong> : </td>
		      <td class="divTblTH_"><span class="divTblListTROT">
		        <input type="text" name="textfield34" readonly="readonly" />
		      </span></td>
		  </tr>-->
            </table>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr style="background-color:#FCB334">
            <td colspan="100%"><i><strong>&nbsp;Leave Form</strong></i></td>
          </tr>
          <tr>
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="divTblListTH"><strong>&nbsp;Leave ID</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Balance</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Credit</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Taken</strong></td>
                  <!--<td class="divTblListTH"><strong>Sub Total</strong></td>-->
                </tr>
                <?php
			if(count($tblDataListLeave)>0){ $totalleave = 0; $ctr_ = 0;
			foreach ($tblDataListLeave as  $clKey => $clValue) {
			//popupotrates
			?>
                <tr>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="leave[<?=$ctr_;?>][leave_name]" type="text" id="leave[<?=$ctr_;?>][leave_name]" value="<?=$clValue['leave_name']?>" size="28" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="leave[<?=$ctr_;?>][empleave_available_day]" type="text" id="leave[<?=$ctr_;?>][empleave_available_day]" value="<?=number_format($clValue['empleave_available_day'],$genDecimal)?>" size="8" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="leave[<?=$ctr_;?>][empleave_creadit]" type="text" id="leave[<?=$ctr_;?>][empleave_creadit]" value="<?=number_format($clValue['empleave_creadit'],$genDecimal)?>" size="8" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="leave[<?=$ctr_;?>][empleave_used_day]" id="leave[<?=$ctr_;?>][empleave_used_day]" type="text" size="7" class="dec" onchange="subtotal[<?=$clValue['otr_id']?>].value = this.value;" value="<?=$clValue['empleave_used_day']?>" />
                    <input type="hidden" name="leave[<?=$ctr_;?>][empleave_id]" id="leave[<?=$ctr_;?>][empleave_id]" value="<?=$clValue['empleave_id']?>" />
                  </span></td>
                  <!--<td class="divTblTH_"><span class="divTblListTROT">
			    <input type="text" name="subtotal[<?=$clValue['otr_id']?>]" id="subtotal[<?=$clValue['otr_id']?>]" readonly="readonly" />
			  </span></td>-->
                </tr>
                <?php $ctr_++; }} else { ?>
                <tr class="divTblListTR">
                  <td colspan="4" class="divTblListTD style1">No record found.</td>
                </tr>
                <?php } ?>
                <!--<tr>
			  <td colspan="4" class="divTblTH_" align="right"><strong><em>Grand Total OT Amount</em></strong> : </td>
		      <td class="divTblTH_"><span class="divTblListTROT">
		        <input type="text" name="textfield34" readonly="readonly" />
		      </span></td>
		  </tr>-->
            </table>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr style="background-color:#FCB334">
            <td colspan="100%"><i><strong>&nbsp;Custom Fields</strong></i></td>
          </tr>
          <tr>
            <td>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="divTblListTH"><strong>&nbsp;Custom Field Name</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Type</strong></td>
                  <td class="divTblListTH"><strong>&nbsp;Value</strong></td>
                </tr>
                <?php if(count($tblDataListCF)>0){ $ctrCF_ = 0;
                foreach ($tblDataListCF as  $cFKey => $cFValue) { ?>
                <tr>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="cf[<?=$ctrCF_?>][cfhead_name]" type="text" id="cf[<?=$ctrCF_?>][cfhead_name]?>" value="<?=$cFValue['cfhead_name']?>" size="28" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="cf[<?=$ctrCF_?>][cfhead_type]" type="text" id="cf[<?=$ctrCF_?>][cfhead_type]" value="<?=$cFValue['cfhead_type']?>" size="18" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
                  </span></td>
                  <td class="divTblTH_"><span class="divTblListTROT">
                    <input name="cf[<?=$ctrCF_?>][cfdetail_rec]" type="text" id="cf[<?=$ctrCF_?>][cfdetail_rec]" value="<?=number_format($cFValue['cfdetail_rec'],$genDecimal)?>" size="8"/>
                  	<input type="hidden" name="cf[<?=$ctrCF_;?>][cfdetail_id]" id="cf[<?=$ctrCF_;?>][cfdetail_id]" value="<?=$cFValue['cfdetail_id']?>" />
                  	<input type="hidden" name="cf[<?=$ctrCF_;?>][cfhead_id]" id="cf[<?=$ctrCF_;?>][cfhead_id]" value="<?=$cFValue['cfhead_id']?>" />
                  </span></td>
                </tr>
                <?php $ctrCF_++;}} else {?>
                 <tr class="divTblListTR">
                  <td colspan="3" class="divTblListTD style1">No record found.</td>
                </tr>
                <?php } ?>
              </table>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Save & Exit" class="themeInputButton" />
              <input type="reset" name="Reset" value="&nbsp;&nbsp;Reset&nbsp;&nbsp;" class="themeInputButton"/>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
      </table>
  </form>
</fieldset>
</div>
