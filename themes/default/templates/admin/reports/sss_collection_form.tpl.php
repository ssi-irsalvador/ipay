<style type="text/css">
 . {
	background-color:white;
 }
 
 @media print{
 	.hideOther{
		display:none; 	
	}
 }
.style6 {font-size: 12px; font-family: "Courier New", Courier, monospace; }
.style8 {font-weight: bold}
.style9 {font-weight: bold}
</style>
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
<table width="200" border="0">
  <tr>
    <td class="hideOther"><a href="javascript:void(0);" onclick="javascript:history.back(0);">Back</a> | <a href="javascript:void(0);" onclick="javascript:window.print();goprint();">Print</a></td>
  </tr>
</table>
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">Republic of the Philippines</div></td>
    </tr>
    <tr>
      <td><div align="center"><strong>Social Security System</strong></div></td>
    </tr>
    <tr>
      <td><div align="center">Quezon City</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <h3>Collection List</h3>
      </div></td>
    </tr>
  </table>
<br />
  <table width="800" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="50%" bgcolor="#FFFFFF"><strong><?=$oDataBranch['1']?><BR />
       
          <?=$oDataBranch['branch_sss']?>
       
      </strong></td>
      <td width="50%" bgcolor="#FFFFFF"><div align="center">
        <span class="style8">
        <?php $m = $_GET['year'].'-'.$_GET['month'].'-'.'1'; echo $date = date('F Y',dDate::parseDateTime($m))?>
      </span>      </div></td>
    </tr>
  </table>
  <br />
  <table width="800" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="3%" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="12%" bgcolor="#FFFFFF">
          <div align="center">SSS No.      </div></td>
      <td width="24%" bgcolor="#FFFFFF"><div align="center">Name of Borrower</div></td>
      <td width="17%" bgcolor="#FFFFFF"><div align="center">Date Granted</div></td>
      <td width="13%" bgcolor="#FFFFFF"><div align="center">Amt Paid </div></td>
      <td width="10%" bgcolor="#FFFFFF"><div align="center">Total Loan </div></td>
      <td width="12%" bgcolor="#FFFFFF"><div align="center">YTD Payment </div></td>
      <td width="9%" bgcolor="#FFFFFF"><div align="center">Balance</div></td>
    </tr>
    <?php $i = 0; 
	if(count($oData)>0){
	foreach($oData as $key => $val){
		$i++;
		$totalpayment += $val['collection']['payment'];
		$loan_total += $val['emp_info']['loan_total'];
		$totalloan_ytd += $val['emp_info']['loan_ytd'];
		$totalloan_balance += $val['emp_info']['loan_balance'];
	?>
    <tr>
      <td bgcolor="#FFFFFF"><?=$i?></td>
      <td bgcolor="#FFFFFF"><?=$val['emp_info']['pi_sss']?></td>
      <td bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;<?=$val['emp_info']['pi_lname']?>, 
      <?=$val['emp_info']['pi_fname']?> <?=$val['emp_info']['pi_mname']?>.</td>
      <td bgcolor="#FFFFFF"><?=$val['emp_info']['rh_date_granted']?></td>
      <td align="right" bgcolor="#FFFFFF"><?=number_format($val['collection']['payment'], 2, '.', '')?></td>
      <td align="right" bgcolor="#FFFFFF"><?=$val['emp_info']['loan_total']?></td>
      <td align="right" bgcolor="#FFFFFF"><?=$val['emp_info']['loan_ytd']?></td>
      <td align="right" bgcolor="#FFFFFF"><?=$val['emp_info']['loan_balance']?></td>
    </tr><?php } }?>
    <tr>
      <td colspan="4" bgcolor="#FFFFFF"><div align="right"><em><strong>Total:</strong></em></div></td>
      <td align="right" bgcolor="#FFFFFF"><span class="style9"><?=number_format($totalpayment, 2, '.', '')?>
      </span></td>
      <td align="right" bgcolor="#FFFFFF"><span class="style9">
        <?=number_format($loan_total, 2, '.', '')?>
      </span></td>
      <td align="right" bgcolor="#FFFFFF"><span class="style9">
        <?=number_format($totalloan_ytd, 2, '.', '')?>
      </span></td>
      <td align="right" bgcolor="#FFFFFF"><span class="style9">
        <?=number_format($totalloan_balance, 2, '.', '')?>
      </span></td>
    </tr>
  </table>
<br />
  <table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><span class="style6">Preapared By:</span></td>
    <td width="25%"><span class="style6">Checked &amp; Verified By:</span></td>
    <td width="25%"><span class="style6">Approved By:</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style6">
      <?=$_GET['emp_name1']?>
    </span></td>
    <td><span class="style6">
      <?=$_GET['emp_name2']?>
    </span></td>
    <td><span class="style6">
      <?=$_GET['emp_name3']?>
    </span></td>
  </tr>
  <tr>
    <td><span class="style6">
      <?=$_GET['emp_job1']?>
    </span></td>
    <td><span class="style6">
      <?=$_GET['emp_job2']?>
    </span></td>
    <td><span class="style6">
      <?=$_GET['emp_job3']?>
    </span></td>
  </tr>
</table>

	