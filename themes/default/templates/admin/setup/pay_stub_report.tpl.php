<script language="javascript">
	function goprint(){
		document.print.goprint();
	}
</script>

<style type="text/css">
 .tdbgwhite {
	background-color:white;
 }
 
 @media print{
 .hideOther {
 	display:none;
 }
 }
.style4 {font-size: 14; font-weight: bold; }
.style6 {font-size: 9; font-weight: bold; font-style: italic; }
.style7 {font-weight: bold}
</style>
<?php
//printa($oData[0]);

for ($i=0;$i<count($oData);$i++) {
//printa ($oData[$i]);

echo str_repeat("=",61);
?>
<p>
<form method="post" action="" name="print">
<table width="780" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15">&nbsp;</td>
    <td width="765" class="hideOther"><a href="javascript:void(0);" onclick="javascript:history.back(0);">Back</a> | <a href="javascript:void(0);" onclick="javascript:window.print();goprint();">Print</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="1" cellspacing="1">
      <tr style="font-size:12px">
        <td width="17%">&nbsp;<strong>COMPANY NAME</strong></td>
        <td width="60%" style="font-size:14px">: <strong>
          <?=$oData_comp['comp_name']?>
        </strong></td>
        <td width="23%" rowspan="3"><span class="style6">PAY DATE</span><br />
            <span class="style7">
            <?=date("Y-m-d",strtotime($oData[$i]['paystubdetails']['paystubdetail']['paystubsched']['payperiod_trans_date']));?>
            </span><br />
            <?=date("Y-m-d",strtotime($oData[$i]['paystubdetails']['paystubdetail']['paystubsched']['payperiod_start_date']));?>
          -
          <?=date("Y-m-d",strtotime($oData[$i]['paystubdetails']['paystubdetail']['paystubsched']['payperiod_end_date']));?></td>
      </tr>
      <tr style="font-size:12px">
        <td><em>&nbsp;NAME / ID NO.</em></td>
        <td>: <strong><u>
          <?=$oData[$i]['paystubdetails']['empinfo']['fullname']?>
          (
          <?=$oData[$i]['paystubdetails']['empinfo']['emp_no']?>
          )</u></strong></td>
      </tr>
      <tr style="font-size:12px">
        <td><em>&nbsp;POSITION</em></td>
        <td>:
          <?=$oData[$i]['paystubdetails']['empinfo']['jobpos_name']?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><hr /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tdbgwhite"  style="font-size:12px">
	  
	  <tr style="font-size:12px">
	    <td>Basic Salary</td>
	    <td><div align="right">
	      <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['earning']['Regulartime'],2)?><?php //$oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['earning']['Regulartime']?>&nbsp;&nbsp;
	      </div></td>
	    <td>&nbsp;</td>
	    <td width="32%" rowspan="21" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr style="font-size:12px">
            <td colspan="3"><strong>Other Tax Income Detail </strong></td>
          </tr>
          <tr>
            <td colspan="3"><?php 
		$psa_amendment = $oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0];
		for($a=0;$a<count($psa_amendment) ;$a++){
		if ($psa_amendment[$a]['psa_type']==1 && $psa_amendment[$a]['psamend_istaxable']==1) {		
		?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr style="font-size:12px">
                    <td width="5%">&nbsp;</td>
                    <td width="54%"><?=$psa_amendment[$a]['psa_name']?></td>
                    <td width="29%" align="right"><?=$psa_amendment[$a]['psamend_amount']?></td>
                    <td width="12%" align="right">&nbsp;</td>
                  </tr>
                </table>
              <?php } } ?></td>
          </tr>
          <tr style="font-size:12px">
            <td width="59%" align="right">&nbsp;</td>
            <td width="29%" align="right"><hr size="1"/><?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_TEarning'],2)?></td>
            <td width="12%" align="right">&nbsp;</td>
          </tr>
        </table>
	      <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr style="font-size:12px">
              <td colspan="3"><strong>Other Deductions</strong></td>
            </tr>
            <tr>
              <td colspan="3"><?php 
		$psa_amendment = $oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0];
		for($a=0;$a<count($psa_amendment) ;$a++){
		if ($psa_amendment[$a]['psa_type']==2) {		
		?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr style="font-size:12px">
                    <td width="5%">&nbsp;</td>
                    <td width="56%"><?=$psa_amendment[$a]['psa_name']?></td>
                    <td width="28%" align="right"><?=$psa_amendment[$a]['psamend_amount']?></td>
                    <td width="12%" align="right">&nbsp;</td>
                  </tr>
                </table>
                <?php } } ?></td>
            </tr>
            <tr style="font-size:12px">
              <td width="59%">&nbsp;</td>
              <td width="27%" align="right"><hr size="1" /><?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_NTDeduction'],2)?></td>
              <td width="12%" align="right">&nbsp;</td>
            </tr>
            </table></td>
	    <td width="32%" rowspan="21" valign="top"><!--Year-To-Date -->
	      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr style="font-size:12px">
                  <td colspan="2"><strong>Non-Taxable Income/(Payments)</strong></td>
                </tr>
                <tr>
                  <td colspan="2"><?php 
		$psa_amendment = $oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0];
		for($a=0;$a<count($psa_amendment) ;$a++){
		if ($psa_amendment[$a]['psa_type']==1 && $psa_amendment[$a]['psamend_istaxable']==0) {		
		?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr style="font-size:12px">
                          <td width="5%">&nbsp;</td>
                          <td width="56%"><?=$psa_amendment[$a]['psa_name']?></td>
                          <td width="39%" align="right"><?=$psa_amendment[$a]['psamend_amount']?></td>
                        </tr>
                      </table>
                    <?php } } ?></td>
                </tr>
                <tr style="font-size:12px">
                  <td width="60%">&nbsp;</td>
                  <td width="40%" align="right"><hr size="1" /><?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_NTEarning'],2)?></td>
                </tr>
              </table>
	      <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr style="font-size:12px">
              <td colspan="2"><strong>Overtime</strong></td>
            </tr>
            <tr>
              <td colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr style="font-size:12px">
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>Rate </td>
                      <td># of Hr </td>
                      <td align="right">&nbsp;</td>
                    </tr>
					   <?php 
		$psa_ot = $oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT'][0];
//		printa($oData);
		for($a=0;$a<count($psa_ot);$a++){	
//		printa ($psa_ot[$a]);		
		?>
                    <tr style="font-size:12px">
                      <td width="5%">&nbsp;</td>
                      <td width="56%"><?=$psa_ot[$a]['psa_name']?></td>
                      <td width="39%"><?=$psa_ot[$a]['rate']?></td>
                      <td width="39%"><?=$psa_ot[$a]['totaltimehr']?></td>
					  <td width="39%" align="right"><?=number_format($psa_ot[$a]['otamount'],2)?></td>
                    </tr><?php }  ?>
                  </table>                </td>
            </tr>
            <tr style="font-size:12px">
              <td width="60%">&nbsp;</td>
              <td width="40%" align="right"><hr size="1" />
                  <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT']['SumAllOTRate'],2)?></td>
            </tr>
          </table></td>
	    </tr>
	  <tr>
	    <td>Adjustments</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Overtime</td>
	    <td><div align="right">
	      <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT']['SumAllOTRate'],2)?>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Other Tx Inc.</td>
	    <td><div align="right">
	      <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_TEarning'],2)?>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Others</td>
	    <td style="border-bottom:thin">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Gross Taxable</td>
	    <td><div align="right">
	      <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['taxable_Gross'],2)?>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Less: W/H Tax</td>
	    <td style="border-bottom:thin"><div align="right">
	      <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['W/H Tax'],2)?>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><strong>Gross after Tax</strong></td>
	    <td style="border-bottom:thin"><div align="right">
	      <?php  $varTotalGross = $oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['aftertaxgross'];
		  			  echo number_format($varTotalGross,2) ; 
//		  			  echo substr_compare($varTotalGross,'.',10) . ' hello world '; 
		  			  ?>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Other Non-Taxable Income </td>
	    <td align="right"><?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_NTEarning'],2)?>&nbsp;&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Less:</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;&nbsp;SSS</td>
	    <td>
	      <div align="right">
	        <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSS'],2)?>&nbsp;&nbsp;	      </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;&nbsp;Philhealth</td>
	    <td>
	      <div align="right">
	        <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['PhilHealth'],2)?>&nbsp;&nbsp;	      </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;&nbsp;Pag-ibig</td>
	    <td>
	      <div align="right">
	        <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['Pag-ibig'],2)?>&nbsp;&nbsp;	      </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  
	  <tr>
	    <td>&nbsp;&nbsp;Other Deductions</td>
	    <td align="right"> <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['amendments']['total_NTDeduction'],2)?>&nbsp;&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	<!--  <tr>
	    <td>Loan (pmts)</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Other </td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>Add:</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>-->
	
	  <tr>
	    <td><strong>Net Pay</strong></td>
	    <td style="border-bottom:thin"><div align="right">
	      <strong><u><?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Net Pay'],2)?></u></strong>&nbsp;&nbsp;
	    </div></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="22%">TAX STATUS</td>
	    <td width="12%">&nbsp;</td>
	    <td width="2%">&nbsp;</td>
	    </tr>
	  <tr>
      	<td colspan="5">&nbsp;</td>
	  </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <tr style="font-size:12px">
        <td width="77%" valign="top"><div align="center"><strong>
          <u><?=$oData_comp['comp_name']?></u>
        </strong><br />Acknowledge receipt of <strong><u>
          <?=number_format($oData[$i]['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Net Pay'],2)?>
          </u></strong><br /> 
          as payment for the salary covering from 
          <u><?=date("Y-m-d",strtotime($oData[$i]['paystubdetails']['paystubdetail']['paystubsched']['payperiod_start_date']));?></u>
          to 
          <u><?=date("Y-m-d",strtotime($oData[$i]['paystubdetails']['paystubdetail']['paystubsched']['payperiod_end_date']));?></u>
          <br /><br /><?php  echo str_repeat("_",35); ?>
          <br />
          <strong>
            <?=$oData[$i]['paystubdetails']['empinfo']['fullname']?>
            (
  <?=$oData[$i]['paystubdetails']['empinfo']['emp_no']?>
            )</strong></div></td>
        <td width="23%" rowspan="2" align="center" valign="middle"  style="font-size:14px"><div align="center"><strong>PAY SLIP</strong><br />
                <span class="style4">STRICTLY CONFIDENTIAL</span></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</form>
<p>
<?php } ?>