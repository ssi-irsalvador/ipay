<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
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
<!--<div class="popuptitle">Assign TA Rates</div>-->
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Assign TA Rates</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01"> TA Forms </legend>-->
<form method="post" action="">
<table width="350" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td class="divTblListTH"><b>TA ID</b></td>
    <td class="divTblListTH"><b>Rate</b></td>
    <td class="divTblListTH"><b>Amt</b></td>
    <td class="divTblListTH"><b>Total Hrs</b></td>
    <td class="divTblListTH"><b>Sub Total</b></td>
  </tr>
  <?php
		if(count($tblDataListTA)>0){ $totalben = 0; $ctr_ = 0; $grandtotal = 0;
		foreach ($tblDataListTA as  $clKey => $clValue) {
		//popupotrates
   ?>
  <tr>
    <td class="divTblTH_"><b>
      <input name="TA[<?=$ctr_;?>][tatbl_name]" type="text" id="TA[<?=$ctr_;?>][tatbl_name]" value="<?=$clValue['tatbl_name']?>" size="20" readonly  style="background:#666666; color:#FFFFFF"/>
    </b></td>
    <td class="divTblTH_"><span class="divTblListTROT">
      <input name="TA[<?=$ctr_;?>][tatbl_rate]" id="TA[<?=$ctr_;?>][tatbl_rate]" type="text" value="<?=$clValue['tatbl_rate']?>" size="4" readonly style="background:#666666; color:#FFFFFF"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
      <input name="TA[<?=$ctr_;?>][rateAmount]" type="text" id="TA[<?=$ctr_;?>][rateAmount]" value="<?=$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['rateAmount'])?>" size="7" readonly="readonly" style="background:#666666; color:#FFFFFF; text-align:right"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
      <input class="dec" name="TA[<?=$ctr_;?>][emp_tarec_nohrday]" id="TA[<?=$ctr_;?>][emp_tarec_nohrday]" type="text" size="7" <?php if($clValue['emp_tarec_nohrday']) print "value=".$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['emp_tarec_nohrday']).""; else print "value='".$objClsMngeDecimal->setGeneralDecimalPlaces(0)."'";?>>
      <input type="hidden" name="TA[<?=$ctr_;?>][tatbl_id]" id="TA[<?=$ctr_;?>][tatbl_id]" value="<?=$clValue['tatbl_id']?>" />
      <input type="hidden" name="TA[<?=$ctr_;?>][emp_tarec_id]" id="TA[<?=$ctr_;?>][emp_tarec_id]" value="<?=$clValue['emp_tarec_id']?>"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
			     <input name="subtotal[<?=$clValue['otr_id']?>]" type="text" id="subtotal[<?=$clValue['otr_id']?>]" size="10" readonly="readonly" style="background:#666666; color:#FFFFFF; text-align:right" value="<?=$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['subtotal'])?>"/>
			  </span></td>
  </tr>
 <?php if($clValue['tatbl_id'] != 6 or $clValue['tatbl_id'] != 5){ $grandtotal+= $clValue['subtotal']; $ctr_++; } }?>
  <tr class="divTblListTR">
    <td colspan="4" class="divTblListTD style1"><div align="right"><strong><em>Grand Total TA Amount</em></strong> : </div></td>
    <td class="divTblListTD style1"><span class="divTblListTROT">
      <input name="grandtotal[<?=$clValue['otr_id']?>]" type="text" id="grandtotal[<?=$clValue['otr_id']?>]" size="12" readonly style="background:#666666; color:#FFFFFF;text-align:right" value="<?php echo number_format($grandtotal,$finalDecimal);?>"/>
    </span></td>
  </tr>
  <?php } else { ?>
  <tr class="divTblListTR">
    <td colspan="5" class="divTblListTD style1">No record found.</td>
  </tr>
  <?php } ?>
  <tr class="divTblListTR">
    <td colspan="5" ><input type="submit" name="Submit" value="Apply changes" class="themeInputButton"/>
       <input name="grandtotal[<?=$clValue['otr_id']?>]" type="text" id="grandtotal[<?=$clValue['otr_id']?>]" size="10" readonly="readonly" style="background:#666666; color:#FFFFFF;text-align:right" value="<?php echo $objClsMngeDecimal->setFinalDecimalPlaces($grandtotal);?>"/>
  </tr>
</table>
</form>
</fieldset>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?>
	<?php		
	}
	?>
	</div>
<?php		
	}else {
?>
<body onLoad="window.parent.document.getElementById('leavedec').value='<?php echo number_format($grandtotal,2);?>';parent.$.fancybox.close();">
<div class="tblListErrMsg">
<?=$eMsg?>
</div>
</body>
<? } } ?>