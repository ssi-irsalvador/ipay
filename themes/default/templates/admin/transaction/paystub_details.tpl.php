<?php 
if (isset($eMsg)) {
	if (is_array($eMsg)) {
?>
<style type="text/css">
<!--
.style8 {color: #0000FF}
.fontCOLOR {color: #FF0000} 
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
<br />
<script type="text/javascript">
$(document).ready(function() {
	$("#ot").fancybox({
		'width'				: '36.5%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
$(document).ready(function() {
	$("#leave").fancybox({
		'width'				: '34.5%',
		'height'			: '55%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Payroll Details</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Payroll Details</legend>-->
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="10%" class="divTblTH_">Employee</td>
      <td width="52%" class="divTblTH_"><u><strong><em><?=$oData['paystubdetails']['empinfo']['fullname']?>&nbsp;&nbsp;(<?=$oData['paystubdetails']['empinfo']['emp_no']?>)</em></strong></u></td>
      <td width="13%" class="divTblTH_">Tax Status</td>
      <td width="25%" class="divTblTH_"><em>
        <?=$oData['paystubdetails']['empinfo']['tax_ex_name']?>
      </em></td>
    </tr>
    <tr>
      <td class="divTblTH_">Pay Period</td>
      <td class="divTblTH_" ><em>
      <?=$oData['start_date']?> 
      - 
      <?=$oData['end_date']?>
      </em></td>
      <td class="divTblTH_">Pay Group</td>
      <td class="divTblTH_"><em><?=$oData['paystubdetails']['paystubdetail']['paystubsched']['pps_name']?></em></td>
    </tr>
    <?php if($oData['payperiod_type'] != '2'){?>
    <tr>
      <td class="divTblTH_">Pay Date</td>
      <td class="divTblTH_"><em><?=date("d M Y",strtotime($oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_trans_date']));?></em></td>
      <td class="divTblTH_"><span class="fontCOLOR"><b>Preview Payslip</b></span></td>
      <td class="divTblTH_"><a href="transaction.php?statpos=payroll_details&amp;pdfrep=<?=$_GET['psdetails'];?>" target="_blank"><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" /></a></td>
    </tr>
    <?php } ?>
  </table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
	<form method="post" action="" name="server">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" valign="top"><fieldset class="themeFieldset01">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr bgcolor="#FAD163">
                <td colspan="2" style="height:19px"><b>Pay Record</b></td>
              </tr>
              <tr>
                <td width="40%" class="divTblTH_">Basic Salary Rate </td>
                <td width="60%" class="divTblTH_"><b><span class="style8">
                  <?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Basic Salary'],2)?>
                </span></b><span class="fontCOLOR"><?php if($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['totalDays']!=0){ echo "(".$oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['totalDays']."  days)";}?></span></td>
              </tr>
              <tr>
                <td class="divTblTH_">Basic PG  Rate </td>
                <td class="divTblTH_"><input type="text" name="basic" id="basic" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['Regulartime'],2, '.', '')?>" class="txtfields" readonly=""/></td>
              </tr>
              <tr>
                <td class="divTblTH_">COLA</td>
                <td class="divTblTH_"><input type="text" name="cola" id="cola" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['COLA'],2, '.', '')?>" class="txtfields" readonly=""/></td>
              </tr>
              <tr>
                <td class="divTblTH_">OT Amount</td>
                <td class="divTblTH_"><input type="text" name="otamount" id="otamount" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT']['TotalallOT'],2, '.', '')?>" readonly="readonly" class="txtfields"/>
                    <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popuppayslip_ot&emp_id=<?=$_GET['emp']?>&psdetail=<?=$oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_id']?>', 'searchwindow', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=425,height=350,left = 450,top = 100');"> -->
                    <?php if($oData['payperiod_type'] != 2){?><a id="ot" href="popup.php?statpos=popuppayslip_ot&emp_id=<?=$_GET['emp']?>&psdetail=<?=$oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_id']?>">
                    <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="18" height="18" hspace="1" border="0" align="absbottom" />
                    <input type="hidden" name="p_id" id="p_id" value="<?=$oData['p_id']?>"/>
                  </a><?php } ?></td>
              </tr>
              <!--<tr>
                <td class="divTblTH_"><span class="fontCOLOR">OT Back Pay </span></td>
                <td class="divTblTH_"><input type="text" name="otbackpay" id="otbackpay" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT']['OTbackpay'],2, '.', '')?>" class="txtfields"/></td>
              </tr>-->
              <tr>
                <td class="divTblTH_">Leave Deduction Amount</td>
                <td class="divTblTH_"><input type="text" name="leavedec" id="leavedec" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['TUA']['TotalLeave'],2, '.', '')?>" readonly="readonly" class="txtfields"/>
                    <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popuppayslip_ta&emp_id=<?=$_GET['emp']?>&psdetail=<?=$oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_id']?>', 'searchwindow', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=425,height=350,left = 450,top = 100');"> -->
                    <?php if($oData['payperiod_type'] != 2){?><a id="leave" href="popup.php?statpos=popuppayslip_ta&emp_id=<?=$_GET['emp']?>&psdetail=<?=$oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_id']?>">
                    <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="18" height="18" hspace="1" border="0" align="absbottom" />
                    <input type="hidden" name="p_id2" id="p_id2" value="<?=$oData['p_id']?>"/>
                  </a><?php } ?></td>
              </tr>
			  <?php IF($oData['paystubdetails']['paystubdetail']['paystubsched']['payperiod_type']=='3'){?>
			  <tr>
                <td class="divTblTH_">Bonus Pay</td>
                <td class="divTblTH_"><input type="text" name="bonuspay" id="bonuspay" value="<?=$objClsMngeDecimal->setFinalDecimalPlaces($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Bonus Pay'])?>" class="txtfields" readonly=""/></td>
              </tr>
			  <?php } ?>
              <tr bgcolor="#FAD163">
                <td colspan="2" style="height:19px"><b>Summary</b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Gross Pay </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp" id="gp" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['PGsalary'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Statutory Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp2" id="gp2" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SumSABEarning'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Stat &amp; Tax Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp3" id="gp3" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SumTSABEarning'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              
              <tr>
                <td class="divTblTH_">Other Stat &amp; Tax Deduction </td>
                <td class="divTblTH_">
                  <input type="text" name="sc2" id="sc2" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SumTSABDeduction'],2)?>" readonly="readonly" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">Statutory Contribution</td>
                <td class="divTblTH_"><b><span class="style8"><b>
                  <input type="text" name="sc" id="sc" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SatutoryDeduction'],2)?>" readonly="readonly" class="txtfields"/>
                </b></span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Taxable Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="oti" id="oti" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SumTABEarning'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Taxable Deduction</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp4" id="gp4" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['SumTABDeduction'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Taxable Income Gross </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="tig" id="tig" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['taxable_Gross'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">W/H Tax </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="wht" id="wht" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['W/H Tax'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">NonTaxable Income </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="nti" id="nti" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['gross_nontaxable_income'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Deduction </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="od" id="od" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['other_deduction'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td style="background:#CCCCCC"><em><strong>Net Pay </strong></em></td>
                <td style="background:#CCCCCC"><b><span class="style8">
                  <input type="text" name="np" id="np" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['Net Pay'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
            </table>
          </fieldset></td>
          <td width="50%" valign="top"><fieldset class="themeFieldset01">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr bgcolor="#FAD163">
                <td colspan="2" style="height:19px"><b>Statutory & Tax</b></td>
              </tr>
              <!--<tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<em>Statutory Base Wage</em></td>
                <td class="divTblTH_"><span class="fontCOLOR"><b><?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['BaseSTATGross'],2)?></b></span></td>
              </tr>-->
              <tr>
                <td width="42%" class="divTblTH_"><em><strong>PHIC</strong></em></td>
                <td width="58%" class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employee Share </span></td>
                <td class="divTblTH_"><input type="text" name="phicee" id="phicee" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['PhilHealth'],2, '.', '')?>" onclick="javascript: select_all('document.server.phicee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="phicer" id="phicer" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['PhilHealthER'],2, '.', '')?>" onclick="javascript: select_all('document.server.phicer')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>SSS</strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employee Share </span></td>
                <td class="divTblTH_"><input type="text" name="sssee" id="sssee" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSS'],2, '.', '')?>" onclick="javascript: select_all('document.server.sssee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="ssser" id="ssser" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSSER'],2,'.','')?>" onclick="javascript: select_all('document.server.ssser')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer EC</span></td>
                <td class="divTblTH_"><input type="text" name="sssec" id="sssec" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['SSSEC'],2, '.', '')?>" onclick="javascript: select_all('document.server.sssec')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>HDMF</strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employee Share </span></td>
                <td class="divTblTH_"><input type="text" name="hdmfee" id="hdmfee" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['Pag-ibig'],2, '.', '')?>" onclick="javascript: select_all('document.server.hdmfee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="hdmfer" id="hdmfer" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['deduction']['Pag-ibigER'],2)?>" onclick="javascript: select_all('document.server.hdmfer')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>W/H Tax </strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Tax Amount </span></td>
                <td class="divTblTH_"><input type="text" name="tax" id="tax" value="<?=number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['pstotal']['W/H Tax'],2, '.', '')?>" class="txtfields"/></td>
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
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td class="divTblTH_"><div class="divTblList"  id="update_tbl_list">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#FAD163">
                        <td><div align="center"><span class="fontCOLOR"><em><b>Payslip Amendments</b></em></span></div></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" id='tbl_list'>
                            <tr>
                              <td class="divTblListTH">Pay Element</td>
                              <td class="divTblListTH">Effective Date</td>
                              <td class="divTblListTH">Amount</td>
                              <!--<td class="divTblListTH" width="40" align="center"><a href="javascript:;" onclick="javascript: openwindow('transaction.php?statpos=ps_amend', 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom" title="Add New" />--></a></td>
                            </tr>
                            <?php 
								if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['benefits'])>0){ $totalben = 0;
					  			foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['benefits'] as $clSIKey => $clSIValue){
								//printa($clSIValue); 
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clSIValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clSIValue['ben_startdate']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clSIValue['ben_payperday'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupbenpe&amp;popupadd=ben&amp;p_id_='+<?=$_GET['psdetails']?>, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16"/></a></td>-->
                            </tr>
                            <?php $totalben += $clSIValue['ben_payperday']; }
					  			if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0])>0){ $totalamend = 0; 
					  			foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0] as $clAmendKey => $clAmendValue){ 
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clAmendValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clAmendValue['psamend_effect_date']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clAmendValue['amendemp_amount'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('transaction.php?statpos=ps_amend&edit='+<?=$clAmendValue['psamend_id']?>, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php $totalamend += $clAmendValue['psamend_amount'];} } 
								if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'])>0){ 
					  			foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'] as $clLoanKey => $clLoanValue){ 
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clLoanValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clLoanValue['loan_dategrant']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clLoanValue['loan_payperperiod'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupzipcode&amp;popupadd=permaddress&amp;p_id_=', 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php }}}elseif(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0])>0){ 
					  			foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['amendments'][0] as $clAmendKey => $clAmendValue){
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clAmendValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clAmendValue['psamend_effect_date']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clAmendValue['amendemp_amount'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('transaction.php?statpos=ps_amend&edit='+<?=$clAmendValue['psamend_id']?>, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php $totalamend += $clAmendValue['psamend_amount']; } 
								if(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'])>0){ 
					  			foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'] as $clLoanKey => $clLoanValue){
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clLoanValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clLoanValue['loan_dategrant']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clLoanValue['loan_payperperiod'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupzipcode&amp;popupadd=permaddress&amp;p_id_='+ document.getElementById('p_id').value, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php }}}elseif(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'])>0){ 
                            	foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['government_regular'] as $clLoanKey => $clLoanValue){
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clLoanValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clLoanValue['loan_dategrant']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clLoanValue['loan_payperperiod'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupzipcode&amp;popupadd=permaddress&amp;p_id_='+ document.getElementById('p_id').value, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php }}
                            	elseif(count($oData['paystubdetails']['paystubdetail']['paystubaccount']['convert_leave'])>0){
                            	foreach ($oData['paystubdetails']['paystubdetail']['paystubaccount']['convert_leave'] as $clLeaveConvKey => $clLeaveConvValue){
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD"><?=$clLeaveConvValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$clLeaveConvValue['effective_date']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clLeaveConvValue['amount'])?></td>
                            </tr>
                            <?php }}else{ ?>
                            <tr class="divTblListTR">
                              <td colspan="4" class="divTblListTD">No record found.</td>
                            </tr>
                            <?php } ?>
                            <?php $totalotherpay = $totalamend + $totalben;?>
                        </table></td>
                      </tr>
                    </table>
                </div></td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
        <tr>
          <td colspan="2"><div align="right">
              <!--<input type="submit" name="Submit2" value="&nbsp;&nbsp;Save&nbsp;&nbsp;" class="themeInputButton" disabled="disabled"/>
			  <input type="submit" name="Submit3" value="Reprocess" class="themeInputButton"/>-->
              <?php if($oData['pp_stat_id'] != '3' AND $oData['payperiod_type'] == 1){?>
			  <input type="submit" name="Submit4" value="Recalculate" class="themeInputButton" onclick="return confirm('Are you sure, you want to Recalculate?');"/><?php }?></div></td>
        </tr>
      </table>
	</form>
</fieldset>
</div>