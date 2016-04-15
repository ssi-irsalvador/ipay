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
<!--<div class="popuptitle">Assign OT Rates</div>-->
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Assign OT Rates</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">OT Forms</legend>-->
<form method="post" action="" name="server">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td class="divTblListTH"><b>OT ID</b></td>
    <td class="divTblListTH"><b>Rate</b></td>
    <td class="divTblListTH"><b>Amt/Hr</b></td>
    <td class="divTblListTH"><b>Total Hrs</b></td>
    <td class="divTblListTH"><b>Sub Total</b></td>
  </tr>
  <?php
		if (count($tblDataList)>0) { $totalben = 0; $ctr = 0; $grandtotal = 0;
		foreach ($tblDataList as  $clKey => $clValue) {
		//popupotrates
  ?>
  <tr>
    <td class="divTblTH_"><span class="divTblListTROT">
      <input name="ot[<?=$ctr;?>][otr_name]" type="text" id="otr_name[]" value="<?=$clValue['otr_name']?>" size="20" readonly style="background:#666666; color:#FFFFFF"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
      <input name="ot[<?=$ctr;?>][otr_factor]" type="text" id="otr_factor[]" value="<?=$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['otr_factor'])?>" size="7" readonly="readonly" style="background:#666666; color:#FFFFFF"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
       <input name="ot[<?=$ctr;?>][hrsrate]" type="text" id="hrsrate[]" value="<?=$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['rateAmount'])?>" size="7" readonly="readonly" style="background:#666666; color:#FFFFFF; text-align:right"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
       <input class="dec" name="ot[<?=$ctr;?>][numhrs]" id="ot[<?=$ctr;?>][numhrs]" type="text" size="7" maxlength="5" onChange="subtotal[<?=$clValue['otr_id']?>].value = this.value;" <?php if($clValue['numhrs']) print "value=".$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['numhrs']).""; else print "value='".$objClsMngeDecimal->setGeneralDecimalPlaces(0)."'";?> onClick="javascript: select_all('document.server.ot[<?=$ctr;?>][numhrs]')"/>
      <input type="hidden" name="ot[<?=$ctr;?>][otr_id]" id="ot[<?=$ctr;?>][otr_id]" value="<?=$clValue['otr_id']?>" />
      <input type="hidden" name="ot[<?=$ctr;?>][otrec_id]" id="ot[<?=$ctr;?>][otrec_id]" value="<?=$clValue['otrec_id']?>"/>
    </span></td>
    <td class="divTblTH_"><span class="divTblListTROT">
			    <input name="subtotal[<?=$clValue['otr_id']?>]" type="text" id="subtotal[<?=$clValue['otr_id']?>]" size="10" readonly="readonly" style="background:#666666; color:#FFFFFF; text-align:right" value="<?=$objClsMngeDecimal->setGeneralDecimalPlaces($clValue['subtotal'])?>"/>
			  </span></td>
  </tr>
  <?php $grandtotal += $clValue['subtotal']; $ctr++; } ?>
  <tr class="divTblListTR">
    <td colspan="4" class="divTblListTD style1"><div align="right"><strong><em>Grand Total OT Amount</em></strong> : </div></td>
    <td class="divTblListTD style1"><span class="divTblListTROT">
       <input name="grandtotal[<?=$clValue['otr_id']?>]" type="text" id="grandtotal[<?=$clValue['otr_id']?>]" size="10" readonly="readonly" style="background:#666666; color:#FFFFFF;text-align:right" value="<?= $objClsMngeDecimal->setFinalDecimalPlaces($grandtotal);?>"/>
    </span></td>
  </tr>
  <?php } else { ?>
  <tr class="divTblListTR">
    <td colspan="5" class="divTblListTD style1">No record found.</td>
  </tr>
  <?php } ?>
  <tr class="divTblListTR">
    <td colspan="5" ><input type="submit" name="Submit" value="Apply changes" class="themeInputButton"/>
    <input name="button2" type='button' onClick="parent.$.fancybox.close();" value='&nbsp;&nbsp;&nbsp;&nbsp; Cancel &nbsp;&nbsp;&nbsp;&nbsp;' class="themeInputButton"/></td>
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
<body onLoad="window.parent.document.getElementById('otamount').value='<?php echo number_format($grandtotal,2);?>';parent.$.fancybox.close();">
<div class="tblListErrMsg">
<?=$eMsg?>
</div>
</body>
<? } } ?>