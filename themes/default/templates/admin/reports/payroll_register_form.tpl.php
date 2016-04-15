<style type="text/css">
<!--
.style1 {font-weight: bold}
.style2 {font-weight: bold}
-->
</style>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Payroll Register Report Criteria</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Payroll Register Report Criteria</legend>-->
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
<form method="post" action="">
<table width="532" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="43%">&nbsp;&nbsp;&nbsp;&nbsp;Pay Period </td>
    <td colspan="5"><span class="style1">
      <?=$oData['pps_name']?>
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;Cut-offs</td>
    <td width="57%"><strong>
      <?=date('M d',dDate::parseDateTime($oData['payperiod_start_date']))?> 
      - 
      <?=date('M d, Y',dDate::parseDateTime($oData['payperiod_end_date']))?>
    </strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;Pay Date</td>
    <td colspan="5"><span class="style2">
      <?=date('M d, Y',dDate::parseDateTime($oData['payperiod_trans_date']))?>
    </span></td>
  </tr>
  
  <tr>
    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
    <td colspan="2" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Company</em></b></td>
    <td colspan="5"><select name="comp_id" id="comp_id" class="longselect">
        <?=html_options($comp,$oData['comp_id'])?>	
      </select></td>
  </tr>
  <!--<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;Department</td>
    <td colspan="5"><select name="ud_id" id="ud_id" class="longselect">
      <option value="0">Select All</option>
      <?=html_options_2d($dept,'ud_id','ud_name',$_POST['ud_id'],false)?>
    </select></td>
  </tr>-->
  
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Location</em></b></td>
    <td colspan="5"><select name="branchinfo_id" id="branchinfo_id" class="longselect">
		<option value="0">SELECT ALL</option>
        <?=html_options($locinfo,$oData['branchinfo_id'])?>	
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Employee Status</em></b></td>
    <td colspan="5"><select name="emp_type" id="emp_type" class="longselect">
	  	<option value="0">SELECT ALL</option>
        <?=html_options_2d($empstat,'emp201status_id','emp201status_name',$_POST['emp201status_id'],false)?>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Category</em></b></td>
    <td colspan="5"><select name="category" id="category" class="longselect">
	  	<option value="0">SHOW ALL</option>
        <?=html_options($category,$_POST['category'])?>
      </select></td>
  </tr>
  <tr>
    <td style="display:none;" id="earn">&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Earnings</em></b></td>
    <td colspan="5" style="display:none;" id="earn_"><select name="earnings" id="earnings" class="longselect">
	  	<option value="0">SHOW ALL</option>
        <?=html_options($earnings,$_POST['earnings'])?>
      </select></td>
  </tr>
  <tr>
    <td style="display:none;" id="deduct">&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Deductions</em></b></td>
    <td colspan="5" style="display:none;" id="deduct_"><select name="deductions" id="deductions" class="longselect">
	  	<option value="0">SHOW ALL</option>
        <?=html_options($deductions,$_POST['deductions'])?>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Bonus Pay</em></b></td>
    <td colspan="5"><input type="checkbox" name="bonuspay" id="bonuspay" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show No. of Days</em></b></td>
    <td colspan="5"><input type="checkbox" name="nodays" id="nodays" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Cost Center</em></b> </td>
    <td colspan="5"><input type="checkbox" name="costcenter" id="costcenter" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Bank</em></b> </td>
    <td colspan="5"><input type="checkbox" name="bank" id="bank" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Account Number</em></b> </td>
    <td colspan="5"><input type="checkbox" name="acct_no" id="acct_no" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Taxable and Non-taxable</em></b> </td>
    <td colspan="5"><input type="checkbox" name="tnt" id="tnt" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Leaves</em></b> </td>
    <td colspan="5"><input type="checkbox" name="leaves" id="leaves" value="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Show Employer Share</em></b></td>
    <td colspan="5"><input type="checkbox" name="eer_share" id="eer_share" value="1" /></td>
  </tr>
  <?php if(count($haveLoc) > 1){?>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Group by Department</em></b> </td>
    <td colspan="5"><input type="checkbox" name="isdpart" id="isdpart" value="1" /></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>File Format</em></b></td>
    <td colspan="5"><div style="float:left;">
      <!-- <input type="radio" name="format" id="format" value="pdf" checked="checked"/>
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" />PDF&nbsp;&nbsp;&nbsp;
         -->
        <input type="radio" name="format" id="format" value="excel" checked="checked" />
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" />Excel</div></td>
  </tr>
  
  <tr>
    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
    <td style="color:#CCFF66; border-top: 1px solid"><input type="submit" class="themeInputButton" name="bnt_excel" id="bnt_excel" value="Process" /></td>
  </tr>
</table>
</form>
</fieldset>
</div>
<script>
$("#category").click(function () {
	val = $(this).val();
	if(val == '1') {
  		$("#earn").show("slow");
  		$("#earn_").show("slow");
  		$("#deduct").hide();
  		$("#deduct_").hide();
	}
	if(val == '2'){
		$("#earn").hide();
  		$("#earn_").hide();
  		$("#deduct").show("slow");
  		$("#deduct_").show("slow");
	}
	if(val == '0'){
		$("#earn").hide();
  		$("#earn_").hide();
  		$("#deduct").hide();
  		$("#deduct_").hide();
	}
});
</script>