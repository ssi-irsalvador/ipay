<style type="text/css">
<!--
.style2 {font-size: 12px}
.style3 {color: #FF0000}
-->
</style>
<div class="themeFieldsetDiv01">
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
  <!-- import the calendar css -->
  <link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
  <!-- import the calendar script -->
  <script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/>
  </script>
  <!-- import the language module -->
  <script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/>
  </script>
<script language="javascript">
function acceptValidNumbersOnly(obj,e) {
			var key='';
			var strcheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+=-`{}[]:\";'\|/?,><\\ ";
			var whichcode = (window.Event) ? e.which : e.keyCode;
			try{
			if(whichcode == 13 || whichcode == 8)return true;
			key = String.fromCharCode(whichcode);
			if(strcheck.indexOf(key) != -1)return false;
			return true;
			}catch(e){;}
}

function amounttype(){
//this is used to manipulate the type of amount
			
	if ( document.getElementById('amountype').value == 1 ) {
		document.getElementById('type_id-10').style.display = 'none';

		document.getElementById('type_id-20').className = '';
		document.getElementById('type_id-20').style.display = '';
	} else {
		document.getElementById('type_id-20').style.display = 'none';

		document.getElementById('type_id-10').className = '';
		document.getElementById('type_id-10').style.display = '';
	}
}

</script>
<form method="post" action="">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Pay Period Form</legend>
   <table width="700" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td>Status</td>
      <td>:
        <select name="pp_stat_id" id="pp_stat_id">
		<?=html_options($stat, $oData['pp_stat_id'])?>
      </select></td>
    </tr>
    <tr>
      <td width="177">Start Date</td>
      <td width="516">
        :       <strong><?=$oData['payperiod_start_date']?></strong></td>
    </tr>
    
    <tr>
      <td>End Date</td>
      <td>:       <strong><?=$oData['payperiod_end_date']?></strong></td>
    </tr>
    <tr>
      <td>Pay Date</td>
      <td>:       <strong><?=$oData['payperiod_trans_date']?></strong></td>
    </tr>
    <tr>
      <td>Total Employee </td>
      <td>: <strong><?=$get_totalEmp['totalemp']?></strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;<input type="submit" name="btnSave" id="btnSave" onclick="return confirm('Are you sure you want to update the status of this Pay Period?');" value="Update" class="themeInputButton" /></td>
    </tr>
	</table>
	</fieldset>
  <?php /*?><table width="200" border="0" cellpadding="0" cellspacing="0"  class="style2">
    <tr>
      <td colspan="3"><span class="style2"><span class="style3">**</span>Legend</span></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="34">Black  </td>
      <td width="145">= Low</td>
    </tr>
    <tr>
      <td width="11">&nbsp;</td>
      <td>Blue  </td>
      <td>= Medium</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Red  </td>
      <td>= High</td>
    </tr>
  </table><?php */?>
  <?php /* if($oData['pp_stat_id'] != 3) {?>
  	<fieldset class="themeFieldset01_notopborder">
  	<table width="700" border="0" cellpadding="1" cellspacing="1">
      <tr>
        <td width="177">Action</td>
        <td width="516">:
          <input type="submit" name="btnGeneratePayStubs" id="btnGeneratePayStubs" value="Generate Paystubs" class="themeInputButton" />
		  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pg&ppsched=1'" />
		  </td>
      </tr>
    </table>
  	</fieldset>
<?php } */ ?>
  </form>

</div>