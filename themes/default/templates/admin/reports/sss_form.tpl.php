<!--<style type="text/css">
 . {
	background-color:white;
 }
 @media print{
 	.hideOther{
		display:none; 	
	}
 }
.style4 {font-size: 12px}
.style6 {font-size: 12px; font-family: "Courier New", Courier, monospace; }
.style7 {font-family: "Courier New", Courier, monospace}
</style>
<script language="javascript">
	function goprint(){
		document.print.goprint();
	}
</script>
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
  <table width="750" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">  
    <tr>
      <td colspan="8" bgcolor="#FFFFFF" ><span class="style6"><strong>Social Security System</strong><br />
      <?=$oDataBranch['branch_sss']?>
      </span></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#FFFFFF" class="style6" ><strong>AZTROPEX, INC.</strong><br />
        <?=$oDataBranch['branch_address']?>
        <br />
Tel No.
<?=$oDataBranch['branch_trunklines']?></td>
	  <?php 
	  $m = $_GET['year'].'-'.$_GET['month'].'-'.'1'; 
	  ?>
      <td colspan="3" align="right" valign="bottom" bgcolor="#FFFFFF" class="" >
        <div align="center">
          <?php if($_GET['type'] == 'ytd'){ ?>
          <font size="+1">YTD Report<br />January 2009 to</font>
          <?php }elseif($_GET['type'] == 'month'){?>
          <font size="+1">Monthly Report<br />
          <?php }else{?>
          <font size="+1">Yearly Report<br />
          <?php }?>
            
           <font size="+1"><?php if($_GET['type'] != 'year'){?><?=date('F Y',dDate::parseDateTime($m))?><?php }else{?>for <?=$_GET['year']?><?php }?></font>
        </div></td>
    </tr>
    <tr>
      <td colspan="5" bgcolor="#FFFFFF" class="" ><div align="center" class="style6">Name of Employee</div></td>
      <td colspan="3" bgcolor="#FFFFFF" class="" ><div align="center" class="style6">Contribution</div></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF" class="style6" >&nbsp;</td>
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">SSS No. </div></td>
      <td bgcolor="#FFFFFF" class="style6" >Family Name</td>
      <td bgcolor="#FFFFFF" class="style6" >First Name</td>
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">Middle Name</div></td>
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style6">ER/EE Share</div>        </td>
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">EC</div></td>
      
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">Total</div></td>
    </tr>
   
	 <?php $no = 0; 
	 	   if(count($oData)>0){
		   foreach($oData as $key => $val){
	 	   $no++;	
	 ?>
    <tr>
      <td bgcolor="#FFFFFF" class="" ><span class="style6">
      <?=$no?>
      </span></td>
      <td bgcolor="#FFFFFF" class="style6" ><div align="center" class="style6"><?=$val['emp_info']['pi_sss']?></div></td>
      <td bgcolor="#FFFFFF" class="style6" ><span class="style6">
      <?=$val['emp_info']['pi_lastname']?>
      </span></td>
      <td bgcolor="#FFFFFF" class="style6" ><span class="style6">
      <?=$val['emp_info']['pi_firstname']?>
      </span></td>
      <td bgcolor="#FFFFFF" class="style6" >
        <div align="left" class="style1 style4 style7">

          <div align="left">
            <?=$val['emp_info']['pi_middlename']?>
          </div>
      </div></td>
      <td bgcolor="#FFFFFF" class="style6" ><div align="center">
	  <?=number_format($eree = $val['sss']['ppe_amount_employer']+$val['sss']['ppe_amount'],2)?>
     </div>        <div align="center" class="style1">
          
        </div></td>
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">
        <?=number_format($ec = $val['sss']['ppe_units'],2)?>
      </div></td>
     
      <td bgcolor="#FFFFFF" class="" ><div align="center" class="style1 style4 style7">
        <?=number_format($total = $eree+$ec,2)?>
      </div></td>
    </tr>
	<?php }
	}
	 ?>
	<?php
	if(count($oData)>0){
		foreach($oData as $key => $val){
			$eree_cont += $eree;
			$subtotal += $total;
			$total_ec += $ec;
			
		}
	}
	?>
      <tr>
        <td colspan="8" bgcolor="#FFFFFF" class="style6"  >&nbsp;</td>
</tr>
      <tr>
        <td colspan="4" rowspan="2" bgcolor="#FFFFFF" class="style6"  >No of Employees:<span class="" ><span class="style1"><?php echo count($oData);?></span></span></td>
        <td bgcolor="#FFFFFF" class="style6" ><div align="right">Total</div></td>
<td bgcolor="#FFFFFF" class="" ><div align="center" class="style6"><span class="style1">
          <?=number_format($eree_cont,2)?>
        </span></div></td>
  <td bgcolor="#FFFFFF" class="" ><div align="center" class="style6"><span class="style1">
          <?=number_format($total_ec,2)?>
        </span></div></td>
  <td bgcolor="#FFFFFF" class="" ><div align="center" class="style6"><span class="style1">
          <?=number_format($subtotal,2)?>
        </span></div></td>
    </tr>
      <tr>
        <td colspan="3" bgcolor="#FFFFFF" class="style6" >Grand Total</td>
<td bgcolor="#FFFFFF" class="" ><div align="center" class="style6"><span class="style1">
          <?=number_format($subtotal,2)?>
        </span></div></td>
    </tr>
  </table>
<table width="750" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><span class="style6">Preapared By:</span></td>
    <td width="25%"><span class="style6">Checked &amp; Verified By:</span></td>
    <td width="25%"><span class="style6">Certified Correct:</span></td>
    <td width="25%"><span class="style6">Approved By:</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style6">
      <?=$preparedby['name']?>
    </span></td>
    <td><span class="style6">
      <?=$checkedby['name']?>
    </span></td>
    <td><span class="style6">
      <?=$certifiedby['name']?>
    </span></td>
    <td><span class="style6">
      <?=$approvedby['name']?>
    </span></td>
  </tr>
  <tr>
    <td><span class="style6">
      <?=$preparedby['jobpos_name']?>
    </span></td>
    <td><span class="style6">
      <?=$checkedby['jobpos_name']?>
    </span></td>
    <td><span class="style6">
      <?=$certifiedby['jobpos_name']?>
    </span></td>
    <td><span class="style6">
      <?=$approvedby['jobpos_name']?>
    </span></td>
  </tr>
</table>

	-->