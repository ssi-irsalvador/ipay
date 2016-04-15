<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"></script>

<script type="text/javascript" src="<?=$themeJQueryPath?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?=$themeJQueryPath?>ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('#tks_startdate').datepicker({
			changeMonth: true,
			changeYear: true,
            dateFormat: 'yy-mm-dd'
		});
	});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Tax Deduction</h2></fieldset>
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
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">TAX Deduction</legend>-->
<?=$tblDataList?>
<form method="post" target="_blank">
<table width="100%" border="0">
  <tr>
    <td>Report Type</td>
     <td><input type="radio" name="type" id="radio" value="20" checked="checked" />BIR Form 1601</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td width="20"><input type="radio" name="type" id="radio3" value="30" />BIR Form 1601-C</td>
  </tr>
<tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio2" value="10" />BIR 2316 Form</td>
  </tr>
   <tr>
   	  <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td style="color:#CCFF66; border-top: 1px solid" colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>Company</td>
      <td><select name="comp_id" id="comp_id" class="longselect">
          <?=html_options($comp,$oData['comp_id'])?>
      </select></td>
    </tr>
    <tr>
      <td>Location</td>
      <td><select name="branchinfo_id" id="branchinfo_id" class="longselect">
		<option value="0">SELECT ALL</option>
        <?=html_options($localinfo,$oData['branchinfo_id'])?>	
      </select></td>
    </tr>
    <tr id="month_select">
      <td width="100"><span id="label1">Month</span><span id="label2" style="display:none;">Employee</span></td>
      <td width="298"><select name="month" id="month" class="longselect">
          <?=html_options($month,$_POST['month'])?>
        </select>
        <select name="employee" id="employee" class="longselect" style="display:none;">
          <option value="0">SELECT ALL</option>
          <?=html_options($empList,$_POST['employee'])?>
        </select>
        </td>
    </tr>
    <tr>
      <td>Year</td>
      <td><select name="year" id="year" class="longselect">
          <?=html_options($year,$_POST['month'])?>
      </select></td>
    </tr>
    <tr>
      <td colspan="2"><div id="format_options" style="display:inline;">
      		<div style="float:left; padding-right:160px;">File Format:</div>
      		<div style="float:left;"><input type="radio" name="format" id="radio4" value="pdf" checked="checked" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File" /> PDF&nbsp;&nbsp;&nbsp;<input type="radio" name="format" id="radio5" value="excel" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /> Excel</div>
      	</div></td>
    </tr>
    <tr>
    	<td colspan="2"><div id="info" style="display: none;">
			<table width="100%" border="0">
			  <tr>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
		      </tr>
			  <tr>
				<td width="264">Authorized Representative:</td>
				<td width="810"><span style="float:left;">
				  <input type="text" name="rep" class="longselect" />
				</span></td>
			  </tr>
			  <tr>
				<td>Title/Position:</td>
				<td><span style="float:left;">
				  <input type="text" name="pos_rep" class="longselect" />
				</span></td>
			  </tr>
			  <tr>
				<td>TIN:</td>
				<td><span style="float:left;">
				  <input type="text" name="tin_rep" class="longselect" />
				</span></td>
			  </tr>
			  <tr>
				<td>Tax Agent Acc. No./Atty. Roll No.:</td>
				<td><span style="float:left;">
				  <input type="text" name="acc" class="longselect" />
				</span></td>
			  </tr>
			  <tr>
				<td>Date of Issuance:</td>
				<td><input name="issue_date" id="issue_date" onselect="return showCalendar('issue_date');" maxlength="10" value="<?= $oData['issue_date']?>" type="text" class="txtfields" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');" class="longselect"/>
          	<a href="javascript:void(0);" class="option" onclick="return showCalendar('issue_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
			  </tr>
			  <tr>
				<td>Date of Expiration:</td>
				<td><input name="exp_date" id="exp_date" onselect="return showCalendar('exp_date');" maxlength="10" value="<?= $oData['exp_date']?>" type="text" class="txtfields" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');" class="longselect"/>
          	<a href="javascript:void(0);" class="option" onclick="return showCalendar('exp_date');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
			  </tr>
			  
			  <tr>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
		      </tr>
			  <tr>
			    <td>Treasurer/Asst. Treasurer:</td>
			    <td><span style="float:left;">
			      <input type="text" name="treasurer" class="longselect"/>
			    </span></td>
		      </tr>
			  <tr>
			    <td>Title/Position:</td>
			    <td><span style="float:left;">
			      <input type="text" name="pos_tre" class="longselect"/>
			    </span></td>
		      </tr>
			  <tr>
			    <td>TIN:</td>
			    <td><span style="float:left;">
			      <input type="text" name="tin_tre" class="longselect"/>
			    </span></td>
		      </tr>
			</table>
    	</div>
    	<div id="signatory" style="display: none;">
			<table width="100%" border="0">
			  <tr>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
			    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
		      </tr>
			  <tr>
				<td width="264">Authorized Representative:</td>
				<td width="810"><span style="float:left;">
				  <input type="text" name="representative" class="longselect" />
				</span></td>
			  </tr></table></div>
    	    	</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Process" class="themeInputButton" /></td>
    </tr>
</table>
</form>	
</fieldset>
</div>
<script type="text/javascript" src="../includes/jquery/jquery-latest-min.js"></script>
<script type="text/javascript">
$("#radio").click(function(){
	  $("#format_options").css("display","inline");
	  $("#info").css("display","none");
	  $("#month").css("display","inline");
	  $("#employee").css("display","none");
	  $("#label1").css("display","inline");
	  $("#label2").css("display","none");
	  $("#signatory").css("display","none");
	});
$("#radio2").click(function(){
	  $("#format_options").css("display","none");
	  $("#info").css("display","none");
	  $("#month").css("display","none");
	  $("#employee").css("display","inline");
	  $("#label1").css("display","none");
	  $("#label2").css("display","inline");
	  $("#signatory").css("display","inline");
	});
$("#radio3").click(function(){
	  $("#format_options").css("display","none");
	  $("#info").css("display","inline");
	  $("#month").css("display","inline");
	  $("#employee").css("display","none");
	  $("#label1").css("display","inline");
	  $("#label2").css("display","none");
	  $("#signatory").css("display","none");
	});
</script>
