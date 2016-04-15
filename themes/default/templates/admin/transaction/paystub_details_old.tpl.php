<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
<style type="text/css">
<!--
.style7 {font-weight: bold}
.style8 {color: #0000FF}
-->
</style>

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
<!--<div class="themeFieldsetDiv01">-->
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Payroll Details </legend>
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td class="divTblTH_"><em>Employee No. </em></td>
      <td colspan="5" class="divTblTH_"><strong><?=$oData['paystubdetails']['empinfo']['emp_no']?></strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Employee Name </em></td>
      <td colspan="5" class="divTblTH_"><strong><?=$oData['paystubdetails']['empinfo']['fullname']?></strong></td>
    </tr>
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group </em></td>
      <td class="divTblTH_" ><b>
        <span class="style8"><?=$oData['paystubdetails']['paystubdetail']['paystubsched']['pps_name']?></span></b></td>
      <td class="divTblTH_">&nbsp;</td>
      <td colspan="3" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Start Date </em></td>
      <td class="divTblTH_"><strong><?=date("Y-m-d",strtotime($oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_start_date']));?></strong></td>
      <td class="divTblTH_"><em>End Date </em></td>
      <td width="12%" class="divTblTH_"><strong><?=date("Y-m-d",strtotime($oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_end_date']));?></strong></td>
      <td width="8%" class="divTblTH_"><em>Pay Date </em></td>
      <td width="39%" class="divTblTH_"><span class="style7"><strong>
        <?=date("Y-m-d",strtotime($oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_trans_date']));?></strong>
      </span></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Tax Status</em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['paystubdetails']['empinfo']['tax_ex_name']?></strong></td>
      <td width="8%" class="divTblTH_">&nbsp;</td>
      <td colspan="3" class="divTblTH_">&nbsp;</td>
    </tr>
  </table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
	<form method="post" action="">
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
			<tr>
			  <td colspan="2">
			   <fieldset class="themeFieldset01">
			   <legend class="themeLegend01">Pay Record</legend>
			    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                  <tr>
                    <td width="40%" class="divTblTH_">Basic Salary Rate </td>
                    <td width="60%" class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Basic Salary'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Basic PG  Rate </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['Regulartime'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">OT Amount </td>
                    <td class="divTblTH_"><strong>0.00</strong></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">OT Back Pay </td>
                    <td class="divTblTH_"><strong>0.00</strong></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Leave Deduction Amount </td>
                    <td class="divTblTH_"><strong>0.00</strong></td>
                  </tr>
                </table></fieldset></td>
			  <td width="50%" rowspan="2" valign="top">
			    <fieldset class="themeFieldset01">
				<legend class="themeLegend01">Contribution / Tax</legend>
			    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                  <tr>
                    <td width="42%" class="divTblTH_"><strong>PHIC</strong></td>
                    <td width="58%" class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employee Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['PhilHealth'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employer Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                    <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['PhilHealthER'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_"><strong>SSS</strong></td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employee Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSS'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employer Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSSER'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employer EC</td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSSEC'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_"><strong>HDMF</strong></td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employee Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['Pag-ibig'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Employer Share </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['Pag-ibigER'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_"><strong>W/H Tax </strong></td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;&nbsp;&nbsp;Tax Amount </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['W/H Tax'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;</td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;</td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;</td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;</td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
              </table>
			    </fieldset></td>
		  </tr>
			<tr>
			  <td colspan="2"><fieldset class="themeFieldset01">
				<legend class="themeLegend01">Summary</legend>
			    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                  <tr>
                    <td width="40%" class="divTblTH_">Gross Pay </td>
                    <td width="60%" class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['gross'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Other Taxable Income </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['other_taxable_income'],2)?>
                    </span></b></td>
                  </tr>
                  
                  <tr>
                    <td class="divTblTH_">Statutory Contribution </td>
                    <td class="divTblTH_"><b><span class="style8"><b>
                    <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SatutoryDeduction'],2)?>
                    </b></span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Taxable Income Gross </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['taxable_Gross'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">W/H Tax </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['W/H Tax'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">NonTaxable Income </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['gross_nontaxable_income'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Other Deduction </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['other_deduction'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">Net Pay </td>
                    <td class="divTblTH_"><b><span class="style8">
                      <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Net Pay'],2)?>
                    </span></b></td>
                  </tr>
                  <tr>
                    <td class="divTblTH_">&nbsp;</td>
                    <td class="divTblTH_">&nbsp;</td>
                  </tr>
              </table>
			  </fieldset></td>
		  </tr>
			<tr>
			  <td colspan="4"><fieldset class="themeFieldset01">
				<legend class="themeLegend01">Pay Element </legend>
			    <table width="100%" border="0" cellpadding="1" cellspacing="1">
                  <tr>
                    <td colspan="2" class="divTblTH_">
					<div class="divTblList"  id="update_tbl_list">
					<table width="100%" border="0" cellspacing="1" cellpadding="0" id='tbl_list'>
                      <tr>
                        <td class="divTblListTH">Pay Element</td>
                        <td class="divTblListTH">Effective Date </td>
                        <td class="divTblListTH">Amount</td>
                      </tr>
					  <?php if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['benefits'])>0){ 
					  		foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['benefits'] as $clSIKey => $clSIValue){
							//printa($clSIValue);
					  ?>
                      <tr class="divTblListTR">
                        <td class="divTblListTD"><?=$clSIValue['psa_name']?></td>
                        <td class="divTblListTD"><?=$clSIValue['startdate']?></td>
                        <td class="divTblListTD"><?=$clSIValue['ben_payperday']?></td>
                      </tr>
					  <?php } 
					  
					  if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0])>0){ 
					  		foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0] as $clAmendKey => $clAmendValue){
							//printa($clAmendValue);
					  ?>
                      <tr class="divTblListTR">
                        <td class="divTblListTD"><?=$clAmendValue['psa_name']?></td>
                        <td class="divTblListTD"><?=$clAmendValue['psamend_effect_date']?></td>
                        <td class="divTblListTD"><?=$clAmendValue['psamend_amount']?></td>
                      </tr>
                      
                      <?php } } if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'])>0){ 
					  		foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'] as $clLoanKey => $clLoanValue){
							//printa($clLoanValue);
					  ?>
                      <tr class="divTblListTR">
                        <td class="divTblListTD"><?=$clLoanValue['psa_name']?></td>
                        <td class="divTblListTD"><?=$clLoanValue['loan_dategrant']?></td>
                        <td class="divTblListTD"><?=$clLoanValue['loan_payperperiod']?></td>
                      </tr>
					  
					 <?php } } } elseif(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0])>0){ 
					  		foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0] as $clAmendKey => $clAmendValue){
							//printa($clAmendValue);
					  ?>
                      <tr class="divTblListTR">
                        <td class="divTblListTD"><?=$clAmendValue['psa_name']?></td>
                        <td class="divTblListTD"><?=$clAmendValue['psamend_effect_date']?></td>
                        <td class="divTblListTD"><?=$clAmendValue['psamend_amount']?></td>
                      </tr>
                      
                      <?php } if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'])>0){ 
					  		foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'] as $clLoanKey => $clLoanValue){
							//printa($clLoanValue);
					  ?>
                      <tr class="divTblListTR">
                        <td class="divTblListTD"><?=$clLoanValue['psa_name']?></td>
                        <td class="divTblListTD"><?=$clLoanValue['loan_dategrant']?></td>
                        <td class="divTblListTD"><?=$clLoanValue['loan_payperperiod']?></td>
                      </tr>
					  <?php }}}else{ ?>
                      <tr class="divTblListTR">
                        <td colspan="3" class="divTblListTD">No record found.</td>
                      </tr>
					  <?php } ?>
                    </table></div></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="divTblTH_"><?=$tblDataList?></td>
                  </tr>
              </table>
			  </fieldset></td>
		  </tr>
			<tr>
			  <td width="11%" bgcolor="#CCFF99">&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="20" width="20" /><strong>&nbsp;&nbsp;<a href="transaction.php?statpos=payroll_details&amp;pdfrep=<?=$_GET['psdetails'];?>" target="_blank">Preview</a></strong></td>
			  <td width="39%"><!--<input type="button" name="Submit" value="&nbsp;&nbsp;Preview&nbsp;&nbsp;" class="themeInputButton" style=""/>--></td>
			  <td colspan="2"><div align="right">
			    <input type="submit" name="Submit2" value="&nbsp;&nbsp;Save&nbsp;&nbsp;" class="themeInputButton" disabled="disabled"/>
			    <input type="submit" name="Submit3" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" class="themeInputButton" disabled="disabled"/>
			    <input type="submit" name="Submit4" value="&nbsp;&nbsp;Recalculate&nbsp;&nbsp;" class="themeInputButton" />
		      </div></td>
		  </tr>
		</table>
	</form>
</fieldset>
<!--</div>-->