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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">YTD Details</h2></fieldset>
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
      <td class="divTblTH_"><em><?=$oData['pps_name']?></em></td>
    </tr>
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
                  <?=number_format($oData['paystubdetails']['ytd_summary']['basicSalaryRate'],2)?>
                </span></b><span class="fontCOLOR"><?php if($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['totalDays']!=0){ echo "(".$oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['totalDays']."  days)";}?></span></td>
              </tr>
              <tr>
                <td class="divTblTH_">Basic PG  Rate </td>
                <td class="divTblTH_"><input type="text" name="basic" id="basic" value="<?=number_format($oData['paystubdetails']['ytd_summary']['basicPGRate'],2, '.', '')?>" class="txtfields" readonly=""/></td>
              </tr>
              <tr>
                <td class="divTblTH_">COLA</td>
                <td class="divTblTH_"><input type="text" name="cola" id="cola" value="<?=number_format($oData['paystubdetails']['ytd_summary']['COLA'],2, '.', '')?>" class="txtfields" readonly=""/></td>
              </tr>
              <tr>
                <td class="divTblTH_">OT Amount</td>
                <td class="divTblTH_"><input type="text" name="otamount" id="otamount" value="<?=number_format($oData['paystubdetails']['ytd_summary']['OTAmount'],2, '.', '')?>" readonly="readonly" class="txtfields"/></td>
              </tr>
              <!--<tr>
                <td class="divTblTH_"><span class="fontCOLOR">OT Back Pay </span></td>
                <td class="divTblTH_"><input type="text" name="otbackpay" id="otbackpay" value="<?//= number_format($oData['paystubdetails']['paystubdetail']['paystubaccount']['earning']['OT']['OTbackpay'],2, '.', '')?>" class="txtfields"/></td>
              </tr>-->
              <tr>
                <td class="divTblTH_">Leave Deduction Amount</td>
                <td class="divTblTH_"><input type="text" name="leavedec" id="leavedec" value="<?=number_format($oData['paystubdetails']['ytd_summary']['LeaveDedAmount'],2, '.', '')?>" readonly="readonly" class="txtfields"/></td>
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
                  <input type="text" name="gp" id="gp" value="<?=number_format($oData['paystubdetails']['ytd_summary']['grossPay'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Statutory Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp2" id="gp2" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherStatIncome'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Stat &amp; Tax Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp3" id="gp3" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherStatTaxIncome'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              
              <tr>
                <td class="divTblTH_">Other Stat &amp; Tax Deduction </td>
                <td class="divTblTH_">
                  <input type="text" name="sc2" id="sc2" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherStatTaxDed'],2)?>" readonly="readonly" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">Statutory Contribution</td>
                <td class="divTblTH_"><b><span class="style8"><b>
                  <input type="text" name="sc" id="sc" value="<?=number_format($oData['paystubdetails']['ytd_summary']['statIncome'],2)?>" readonly="readonly" class="txtfields"/>
                </b></span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Taxable Income</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="oti" id="oti" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherTaxIncome'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Taxable Deduction</td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="gp4" id="gp4" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherTaxDed'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Taxable Income Gross </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="tig" id="tig" value="<?=number_format($oData['paystubdetails']['ytd_summary']['taxableIncomeGross'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">W/H Tax </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="wht" id="wht" value="<?=number_format($oData['paystubdetails']['ytd_summary']['tax'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">NonTaxable Income </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="nti" id="nti" value="<?=number_format($oData['paystubdetails']['ytd_summary']['nonTaxIncome'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td class="divTblTH_">Other Deduction </td>
                <td class="divTblTH_"><b><span class="style8">
                  <input type="text" name="od" id="od" value="<?=number_format($oData['paystubdetails']['ytd_summary']['otherDeduction'],2)?>" readonly="readonly" class="txtfields"/>
                </span></b></td>
              </tr>
              <tr>
                <td style="background:#CCCCCC"><em><strong>Net Pay </strong></em></td>
                <td style="background:#CCCCCC"><b><span class="style8">
                  <input type="text" name="np" id="np" value="<?=number_format($oData['paystubdetails']['ytd_summary']['netPay'],2)?>" readonly="readonly" class="txtfields"/>
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
                <td class="divTblTH_"><input type="text" name="phicee" id="phicee" value="<?=number_format($oData['paystubdetails']['ytd_summary']['PHICee'],2, '.', '')?>" onclick="javascript: select_all('document.server.phicee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="phicer" id="phicer" value="<?=number_format($oData['paystubdetails']['ytd_summary']['PHICer'],2, '.', '')?>" onclick="javascript: select_all('document.server.phicer')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>SSS</strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employee Share </span></td>
                <td class="divTblTH_"><input type="text" name="sssee" id="sssee" value="<?=number_format($oData['paystubdetails']['ytd_summary']['SSSee'],2, '.', '')?>" onclick="javascript: select_all('document.server.sssee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="ssser" id="ssser" value="<?=number_format($oData['paystubdetails']['ytd_summary']['SSSer'],2,'.','')?>" onclick="javascript: select_all('document.server.ssser')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer EC</span></td>
                <td class="divTblTH_"><input type="text" name="sssec" id="sssec" value="<?=number_format($oData['paystubdetails']['ytd_summary']['SSSec'],2, '.', '')?>" onclick="javascript: select_all('document.server.sssec')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>HDMF</strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employee Share </span></td>
                <td class="divTblTH_"><input type="text" name="hdmfee" id="hdmfee" value="<?=number_format($oData['paystubdetails']['ytd_summary']['HDMFee'],2, '.', '')?>" onclick="javascript: select_all('document.server.hdmfee')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Employer Share </span></td>
                <td class="divTblTH_"><input type="text" name="hdmfer" id="hdmfer" value="<?=number_format($oData['paystubdetails']['ytd_summary']['HDMFer'],2)?>" onclick="javascript: select_all('document.server.hdmfer')" class="txtfields"/></td>
              </tr>
              <tr>
                <td class="divTblTH_"><em><strong>W/H Tax </strong></em></td>
                <td class="divTblTH_">&nbsp;</td>
              </tr>
              <tr>
                <td class="divTblTH_">&nbsp;&nbsp;&nbsp;<span class="fontCOLOR">Tax Amount </span></td>
                <td class="divTblTH_"><input type="text" name="tax" id="tax" value="<?=number_format($oData['paystubdetails']['ytd_summary']['tax'],2, '.', '')?>" class="txtfields"/></td>
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
                        <td><div align="center"><span class="fontCOLOR"><em><b>Earnings/Deductions</b></em></span></div></td>
                      </tr>
                      <tr>
                        <td><table width="100%" border="0" cellspacing="1" cellpadding="0" id='tbl_list'>
                            <tr>
                              <td class="divTblListTH">Type</td>
                              <td class="divTblListTH">Pay Element</td>
                              <td class="divTblListTH">Amount</td>
                              <!--<td class="divTblListTH" width="40" align="center"><a href="javascript:;" onclick="javascript: openwindow('transaction.php?statpos=ps_amend', 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom" title="Add New" />--></a></td>
                            </tr>
                            <?php 
								if(count($oData['paystubdetails']['Earnings'])>0){ $totalben = 0;
					  			foreach ($oData['paystubdetails']['Earnings'] as $clSIKey => $clSIValue){
								//printa($clSIValue); 
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD">Earning</td>
                              <td class="divTblListTD"><?=$clSIValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clSIValue['ben_payperday'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupbenpe&amp;popupadd=ben&amp;p_id_='+<?=$_GET['psdetails']?>, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16"/></a></td>-->
                            </tr>
                            <?php $totalben += $clSIValue['ben_payperday']; }
					  			if(count($oData['paystubdetails']['Deductions']>0)){ $totalamend = 0; 
					  			foreach ($oData['paystubdetails']['Deductions'] as $clAmendKey => $clAmendValue){ 
							?>
                            <tr class="divTblListTR">
                              <td class="divTblListTD">Deduction</td>
                              <td class="divTblListTD"><?=$clAmendValue['psa_name']?></td>
                              <td class="divTblListTD"><?=$objClsMngeDecimal->setFinalDecimalPlaces($clAmendValue['ben_payperday'])?></td>
                              <!--<td class="divTblListTD" align="center"><a href="javascript:;" onclick="javascript: openwindow('transaction.php?statpos=ps_amend&edit='+<?=$clAmendValue['psamend_id']?>, 'searchwindow', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/edit.png'?>" title="Edit" hspace="2px" border="0" width="16" height="16" /></a></td>-->
                            </tr>
                            <?php $totalamend += $clAmendValue['psamend_amount'];} } 
							}else{ ?>
                            <tr class="divTblListTR">
                              <td colspan="4" class="divTblListTD">No record found.</td>
                            </tr>
                            <?php } ?>
                        </table></td>
                      </tr>
                    </table>
                </div></td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
      </table>
	</form>
</fieldset>
</div>