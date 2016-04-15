<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">SSS Collection List Criteria</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">SSS Collection List Criteria</legend>-->
<form method="post">
<table width="484" border="0">
  <tr>
    <td><input type="radio" name="rtype" id="radio" value="10" <?if($postData['rtype'] == 10 || $postData['rtype'] == ''){ echo "checked";}?>/>
      SSS Loan Summary </td>
    <td><input type="radio" name="rtype" id="radio2" value="20" <?if($postData['rtype'] == 20){ echo "checked";}?>/>
      SSS-LCL Disket</td>
  </tr>
  <tr>
    <td><input type="radio" name="rtype" id="radio4" value="40" <?if($postData['rtype'] == 40){ echo "checked";}?>/>
      SSS Loan Transmittal </td>
    <td><!-- <input type="radio" name="rtype" id="radio3" value="30"/>
SSS ML-1 -->&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td>Company</td>
    <td><select name="comp_id" id="comp_id" class="longselect">
      <?=html_options($comp,$oData['comp_id'])?>
    </select></td>
  </tr>
    <tr>
    <td>Branch</td>
    <td><select name="branchinfo_id" id="branchinfo_id" class="longselect">
		  <option value="0">SELECT ALL</option>
		   <?=html_options($branch,$_POST['branchinfo_id'])?>
		</select></td>
  </tr>
  <tr id="month">
    <td width="199">Month <span id="from" style="display:none">To</span></td>
    <td width="275"><select name="month" class="longselect">
	  <?=html_options($month,$_POST['month'])?>
    </select>    </td>
  </tr>
  <tr>
    <td>Year</td>
    <td><select name="year" class="longselect">
        <?=html_options($year,$_POST['month'])?>
          </select></td>
  </tr>
  <tr>
    <td colspan="2"><div id="person_" style="display:<? if($postData['rtype'] == 10 || $postData['rtype'] == '') echo "inline"; ELSE echo "none";?>;">
	<table width="100%" border="0">
  <tr>
    <td width="199">Certified By</td>
    <td width="275"><input name="co_maker1_name" type="text" id="co_maker1_name" class="longselect"/></td>
  </tr>
  <tr>
    <td>Position </td>
    <td><input name="co_maker1_job" type="text" id="co_maker1_job" class="longselect"/></td>
  </tr>
  <tr>
    <td>File Format</td>
    <td><!--<input type="radio" name="format" id="radio4" value="pdf" checked="checked"/><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" /> PDF&nbsp;&nbsp;&nbsp;--><input type="radio" name="format" id="radio5" value="excel" checked="checked"/><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" /> Excel</td>
  </tr>
</table>
    </div></td>
    </tr>
  <tr>
    <td colspan="2"><div id="ml1" style="display:<? if($postData['rtype'] == 40) echo "inline"; ELSE echo "none";?>;">
	<table width="100%" border="0">
      <tr>
        <td width="199">Certified By</td>
        <td width="275"><input name="co_maker4_name" type="text" id="co_maker4_name" class="longselect"/></td>
      </tr>
      <tr>
        <td>Position</td>
        <td><input name="co_maker4_job" type="text" id="co_maker4_job" class="longselect"/></td>
      </tr>
      <tr>
        <td>SBR No.</td>
        <td><input name="sbr_no" type="text" id="sbr_no" class="longselect"/></td>
      </tr>
      <tr>
      <td>Date Paid</td>
      <td><input name="date_paid" type="text" class="txtfields" id="date_paid" maxlength="10" value='0000-00-00' />
	   <img onclick="return showCalendar('date_paid','','date_paid','pi_age');" src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" style="cursor:pointer;" /></td>
    </tr>
      <tr>
        <td>File Format</td>
        <td><input type="radio" name="radio6" id="radio6" value="pdf_ml1" checked="checked"/>
          <img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" /> PDF</td>
      </tr>
    </table></div></td>
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
	  $("#info").css("display","inline");
	  $("#person_").css("display","inline");
	  $("#ml1").css("display","none");
	});
$("#radio2").click(function(){
	  $("#info").css("display","none");
	  $("#person_").css("display","none");
	  $("#ml1").css("display","none");
	});
$("#radio3").click(function(){
	  $("#info").css("display","inline");
	  $("#person_").css("display","none");
	  $("#ml1").css("display","inline");
	});
$("#radio4").click(function(){
	  $("#info").css("display","none");
	  $("#person_").css("display","none");
	  $("#ml1").css("display","inline");
	});
</script>