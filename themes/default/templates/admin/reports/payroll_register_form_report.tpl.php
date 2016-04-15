<style type="text/css">
<!--
@media print{
 .hideOther {
 	display:none;
 }
 }
 
 .tblclass{
 	font-family: "Courier New", Courier, monospace;
	border:solid 1px #000000;
	font-size: 13px;
 }
span.tclass {
	font-family: "Courier New", Courier, monospace;
	font-size: 13px;
}

.alignright {
	text-align:right;
	
}

.bortop {border-top:solid 1px #000000;}
.borleft {border-left:solid 1px #000000;}
.borright {border-right:solid 1px #000000;}
.borbottom {border-bottom:solid 1px #000000;}
.style1 {font-weight: bold}
.style2 {font-weight: bold}
.style3 {text-align: right; font-weight: bold; }
.style4 {font-weight: bold}
.style5 {font-weight: bold}
.style6 {border-left: solid 1px #000000; font-weight: bold; }
.style7 {border-top: solid 1px #000000; font-weight: bold; }
-->
</style><a class="hideOther" href="javascript:void(0);" onclick="javascript:history.back(0);">Back |</a>  <a class="hideOther" href="javascript:void(0);" onclick="javascript:window.print();goprint();">Print</a>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><br /><div align="center"><span class="tclass">
      <b><?=$branch_details['comp_name']?></b>
      <br />
      <?=$branch_details['comp_add']?>
      <br />
      PAYROLL REGISTER<br />
  <?php if($_GET['type'] == 1){?>
      OFFICERS
  <?php }else{ echo strtoupper($empdept_type); }?>
  <br />
      FOR THE PERIOD :
  <?=date('F d, Y',dDate::parseDateTime($payperiodstatus[0]['payperiod_trans_date']))?>
    </span></div></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="1" class="tblclass" width="100%" >
     <tbody>
      <tr>
        <td class="style1" width="25">&nbsp;</td>
        <td class="borleft">&nbsp;</td>
        <td class="borleft" width="85">&nbsp;</td>
        <td class="borleft">&nbsp;</td>
        <td class="borleft">&nbsp;</td>
        <td class="borleft">&nbsp;</td>
        <td colspan="3" class="borleft"><div align="center">SEMI-MONTHLY DEDUCTIONS</div></td>
        <td class="borleft" width="85">&nbsp;</td>
        <td colspan="5" class="borleft">SEMI-MONTHLY LOAN AMORTIZATION</td>
        <td class="borleft">DEDUCTIONS</td>
        <td class="borleft">BENEFITS</td>
        <td class="borleft" width="85">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="3" class="style1">&nbsp;</td>
        <td rowspan="3" valign="top" class="borleft">EMPLOYEE NAME</td>
        <td rowspan="3" valign="top" class="borleft">BASIC</td>
        <td rowspan="3" valign="top" class="borleft">BASIC SEMI</td>
        <td rowspan="3" valign="top" class="borleft">HOLIDAY</td>
        <td rowspan="3" valign="top" class="borleft">OT</td>
        <td class="borleft bortop"> TAX</td>
        <td class="borleft bortop"> PERAA         </td>
        <td class="borleft bortop">UNION <br /></td>
        <td rowspan="3" valign="top" class="borleft">NET SEMI</td>
        <td valign="top" class="borleft bortop">SSS<br /></td>
        <td valign="top" class="borleft bortop">PERAA</td>
        <td valign="top" class="borleft bortop">NHMFC<br /></td>
        <td valign="top" class="borleft bortop">INSURANCE<br /></td>
        <td valign="top" class="borleft bortop">COOP</td>
        <td valign="top" class="borleft bortop">TUA</td>
        <td valign="top" class="borleft bortop">TRANSPO</td>
        <td rowspan="3" valign="top" class="borleft">NET </td>
      </tr>
      <tr>
        <td class="borleft bortop">SSS</td>
        <td class="borleft bortop">HDMF</td>
        <td class="borleft  bortop">COOP</td>
        <td valign="top" class="borleft bortop">HOUSING</td>
        <td valign="top" class="borleft bortop">PROVIDENT</td>
        <td valign="top" class="borleft bortop">UNION</td>
        <td valign="top" class="borleft bortop">A/ROTHERS</td>
        <td valign="top" class="borleft bortop">&nbsp;</td>
        <td valign="top" class="borleft bortop">OTHERS</td>
        <td valign="top" class="borleft bortop">OTHERS</td>
        </tr>
      <tr>
        <td class="borleft bortop">PHIC</td>
        <td class="borleft bortop">PROVIDENT</td>
        <td class="borleft">&nbsp;</td>
        <td valign="top" class="borleft bortop">PAGIBIG</td>
        <td valign="top" class="borleft bortop">PERSONAL</td>
        <td valign="top" class="borleft bortop">A/RLEDONNE</td>
        <td valign="top" class="borleft bortop">ADV CHILD</td>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="borleft bortop">SUBST.</td>
        </tr>
     </tbody>
     <tbody>
      <?php 
  $ctr = 0;
  if(count($oData)>0){
  foreach($oData as $key => $val){
  $ctr++;
  
  $basic += $val['compensation_basic_salary'];
  $advisory += $val['advisory'];
  $gross +=$val['gross_salary'];
  $tax +=$val['cont']['tax'];
  $sss +=$val['cont']['sss'];
  $phic +=$val['cont']['phic'];
  $peraa +=$val['cont']['peraa'];
  $hdmf += $val['cont']['hdmf'];
  $coop += $val['cont']['coop'];
  $prov +=$val['cont']['provident'];
  $union += $val['cont']['uniondues'];
  $sss_loan +=$val['bimonthly_deduction_loans']['sss_loan'];
  $personal_loan +=$val['bimonthly_deduction_loans']['personal_loan'];
  $nhmfc_loan +=$val['bimonthly_deduction_loans']['nhmfc_loan'];
  $union_loan +=$val['bimonthly_deduction_loans']['union_loan'];
  $housing_loan +=$val['bimonthly_deduction_loans']['housing_loan'];
  $pagibig_loan +=$val['bimonthly_deduction_loans']['hdmf_loan'];
  $peraa_loan +=$val['bimonthly_deduction_loans']['peraa_loan'];
  $prov_loan +=$val['bimonthly_deduction_loans']['provident'];
  $ar_ledon +=$val['bimonthly_deduction_loans']['a/r_ledon'];
  $insurance +=$val['bimonthly_deduction_loans']['insurance'];
  $ar_others +=$val['bimonthly_deduction_loans']['a/r_others'];
  $advchild +=$val['bimonthly_deduction_loans']['adv_child'];
  $coop_loan +=$val['bimonthly_deduction_loans']['coop'];
  $tua +=$val['other_duductions']['tua'];
  $other_ded +=$val['other_duductions']['others'];
  $trans +=$val['other_income']['transpo'];
  $othe_income +=$val['other_income']['other']+$val['other_income']['glc'];
  $ot +=$val['ot'];
  $net +=$val['net'];
  $gross_semi +=$val['gross_semi'];
  $substitution +=$val['other_income']['substitution'];
  $holiday +=$val['holiday'];
  $nettotal += $val['net_semi'];

  ?>
      <tr>
        <td rowspan="3" valign="top" class=" alignright">              <?=$ctr?>            </td>
        <td rowspan="3" valign="top" class="borleft bortop">              <?=strtoupper($val['fullname'])?>            </td>
        <td valign="top" class="borleft bortop alignright">              <?=number_format($val['compensation_basic_salary'],2)?>            </td>
        <td valign="top" class="alignright bortop">              <?=number_format($val['gross_semi'],2)?>            </td>
        <td valign="top" class="alignright bortop">              <?=number_format($val['holiday'],2)?>            </td>
        <td valign="top" class="alignright bortop">              <?=number_format($val['ot'],2)?>            </td>
        <td valign="top" class="borleft bortop alignright">              <?=number_format($val['cont']['tax'],2)?>            </td>
        <td valign="top" class="alignright bortop"><?=number_format($val['cont']['peraa'],2)?>        </td>
        <td valign="top" class="alignright bortop">              <?=number_format($val['cont']['uniondues'],2)?></td>
        <td rowspan="3" valign="top" class="borleft bortop alignright">              <?=number_format($val['net_semi'],2)?>            </td>
        <td valign="top" class="alignright bortop borleft">
              <?=number_format($val['bimonthly_deduction_loans']['sss_loan'],2)?>            </td>
        <td valign="top" class="alignright bortop"><?=number_format($val['bimonthly_deduction_loans']['peraa_loan'],2)?>            </td>
        <td valign="top" class="alignright bortop"><?=number_format($val['bimonthly_deduction_loans']['nhmfc_loan'],2)?>          </td>
        <td valign="top" class="alignright bortop"><?=number_format($val['bimonthly_deduction_loans']['insurance'],2)?>          </td>
        <td valign="top" class="alignright bortop"><?=number_format($val['bimonthly_deduction_loans']['coop'],2)?>          </td>
        <td valign="top" class="borleft bortop alignright">
              <?=number_format($val['other_duductions']['tua'],2)?></td>
        <td valign="top" class="alignright bortop">
              <?=number_format($val['other_income']['transpo'],2)?></td>
        <td rowspan="3" valign="top" class="borleft bortop alignright">              <?=number_format($val['net'],2)?>            </td>
      </tr>
      <tr>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="borleft alignright">              <?=number_format($val['cont']['sss'],2)?>            </td>
        <td valign="top" class="alignright"><?=number_format($val['cont']['hdmf'],2)?></td>
        <td valign="top" class="alignright"><span class="alignright">
          <?=number_format($val['cont']['coop'],2)?>
        </span></td>
        <td valign="top" class="alignright borleft"><?=number_format($val['bimonthly_deduction_loans']['housing_loan'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['provident'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['union_loan'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['a/r_others'],2)?></td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="borleft alignright"><?=number_format($val['other_duductions']['others'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['other_income']['other']+$val['other_income']['glc'],2)?></td>
      </tr>
      <tr>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="style2">&nbsp;</td>
        <td valign="top" class="borleft alignright">              <?=number_format($val['cont']['phic'],2)?>            </td>
        <td valign="top" class="alignright"><?=number_format($val['cont']['provident'],2)?></td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="alignright borleft"><?=number_format($val['bimonthly_deduction_loans']['hdmf_loan'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['personal_loan'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['a/r_ledon'],2)?></td>
        <td valign="top" class="alignright"><?=number_format($val['bimonthly_deduction_loans']['adv_child'],2)?></td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="alignright"><span class="alignright">
          <?=number_format($val['other_income']['substitution'],2)?>
        </span></td>
      </tr>
      <?php } }?>
      </tbody>
      <tbody>
      <tr>
        <td colspan="2" rowspan="3" class="style7">Grand Total</td>
        <td valign="top" class="borleft bortop alignright"><strong>
          <?=number_format($basic,2)?>
        </strong></td>
        <td valign="top" class="alignright bortop">
          <strong>
          <?=number_format($gross_semi,2)?>
          </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($holiday,2)?>
        </strong></td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($ot,2)?>
        </strong></td>
        <td valign="top" class="borleft bortop alignright">            <strong>
          <?=number_format($tax,2)?>
        </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($peraa,2)?>
        </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($union,2)?>
        </strong> </td>
        <td rowspan="3" valign="top" class="borleft bortop alignright">            <span class="style4">
          <?=number_format($nettotal,2)?>
        </span> </td>
        <td valign="top" class="alignright bortop borleft">
            <strong>
            <?=number_format($sss_loan,2)?>
            </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($peraa_loan,2)?>
        </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($nhmfc_loan,2)?>
        </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($insurance,2)?>
        </strong> </td>
        <td valign="top" class="alignright bortop"><strong>
          <?=number_format($coop_loan,2)?>
        </strong> </td>
        <td valign="top" class="borleft bortop alignright">
              <strong>
              <?=number_format($tua,2)?>
              </strong></td>
        <td valign="top" class="alignright bortop">
              <strong>
              <?=number_format($trans,2)?>
              </strong></td>
        <td rowspan="3" valign="top" class="borleft bortop alignright style5">
            <?=number_format($net,2)?>
          <div align="right"></div></td>
      </tr>
      <tr>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="borleft alignright"><strong>
          <?=number_format($sss,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($hdmf,2)?>
        </strong></td>
        <td valign="top" class="style3"><strong>
          <?=number_format($coop,2)?>
        </strong></td>
        <td valign="top" class="alignright borleft"><strong>
          <?=number_format($housing_loan,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($prov_loan,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($union_loan,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($ar_others,2)?>
        </strong></td>
        <td valign="top" class="style3">&nbsp;</td>
        <td valign="top" class="borleft alignright"><strong>
          <?=number_format($other_ded,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($othe_income,2)?>
        </strong></td>
      </tr>
      <tr>
        <td valign="top" class="borleft">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="alignright">&nbsp;</td>
        <td valign="top" class="borleft alignright"><strong>
          <?=number_format($phic,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($prov,2)?>
        </strong></td>
        <td valign="top" class="style3">&nbsp;</td>
        <td valign="top" class="alignright borleft"><strong>
          <?=number_format($pagibig_loan,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($personal_loan,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($ar_ledon,2)?>
        </strong></td>
        <td valign="top" class="alignright"><strong>
          <?=number_format($advchild,2)?>
        </strong></td>
        <td valign="top" class="style3">&nbsp;</td>
        <td valign="top" class="style6">&nbsp;</td>
        <td valign="top" class="alignright"><span class="style3">
          <?=number_format($substitution,2)?>
        </span></td>
      </tr>
      </tbody>
    </table></td>
  </tr>
</table>
<span class="tclass">
Date Printed: <?=date('M/d/Y g:i A')?>
</span>
