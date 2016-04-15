<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">BIR Alphalist Report Criteria</h2></fieldset>
<fieldset class="themeFieldset01">
<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"></script>
<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
		?>
<div class="tblListErrMsg"><strong>Check the following error(s) below:</strong><br />
		<?php
		foreach ($eMsg as $key => $value) {
			?> &nbsp;&nbsp;&bull;&nbsp;<?=$value?><br />
			<?php
		}
		?></div>
		<?php
	} else {
		?>
<div class="tblListErrMsg"><?=$eMsg?></div>
		<?
	}
}
?>

<?=$tblDataList?>
<form method="post" target="_blank">
<table width="100%" border="0">
  <tr>
    <td>Report Type</td>
    <td><input type="radio" name="type" id="radio2" value="10" checked="checked" /></td>
    <td>1604-CF - SUMMARY</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio8" value="90" /></td>
    <td>1604CF Diskette</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio3" value="30" /></td>
    <td>SCHEDULE 7.1 - ALPHALIST OF EMPLOYEES TERMINATED BEFORE DEC. 31</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio4" value="40" /></td>
    <td>SCHEDULE 7.2 - ALPHALIST OF EMPLOYEES WHOSE COMPENSATION INCOME ARE EXCEMPT FROM TAX BUT SUBJECT TO TAX INCOME</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio5" value="50" /></td>
    <td>SCHEDULE 7.3 - ALPHALIST OF EMPLOYEES AS DEC. 31 WITH NO PREVIOUS EMPLOYER WITHIN THE YEAR </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="20"><input type="radio" name="type" id="radio" value="60" /></td>
    <td width="953">SCHEDULE 7.4 - ALPHALIST OF EMPLOYEES AS DEC. 31 WITH PREVIOUS EMPLOYER WITHIN THE YEAR</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="radio" name="type" id="radio6" value="70" /></td>
    <td>SCHEDULE 7.5 - ALPHALIST OF MINIMUM WAGE EARNERS</td>
  </tr>
  <tr>
  	<td>&nbsp;</td>
  	<td><input type="radio" name="type" id="radio7" value="80" /></td>
  	<td>TRANSMITTAL FORM</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
    <td colspan="2" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
	</tr>
  <tr>
    <td>
    	<div id="format_options" style="display:none;">
			Format
    	</div>
    </td>
    <td colspan="2" >
    	<div id="format_options_select" style="display:none;">
   			<input type="radio" name="format" id="excel" value="xls" checked="checked"/> Excel
   			<input type="radio" name="format" id="csv" value="csv" /> Diskette
    	</div>
    </td>
  </tr>
  <tr><td colspan="3"><div id="other_info" style="display:none;">
	  <table>
		  <tr>
		    <td width="90px">Branch Code</td>
		    <td><input type="text" name="branch_code" class="txtfields" ></td>
		  </tr>
		  <tr>
		      <td>Return Period</td>
		      <td><input name="return_period" type="text" class="txtfields" id="return_period" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['return_period']) print "value=".$oData['return_period'].""; else print "value='0000-00-00'";?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
				  <a href="javascript:void(0);" class="option" onclick="return showCalendar('return_period');">
		        <img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="16" height="16" border="0" align="absmiddle" title="Date" /></a></td>
		  </tr>
	  </table></div>
  </td></tr>
  <tr>
    <td>Company</td>
    <td colspan="2"><select name="comp_id" id="comp_id" class="longselect">
          <?=html_options($comp,$oData['comp_id'])?>
        </select></td>
    </tr>
  <tr>
    <td>Location</td>
    <td colspan="2"><select name="branchinfo_id" id="branchinfo_id" class="longselect">
		<option value="0">SELECT ALL</option>
        <?=html_options($localinfo,$oData['branchinfo_id'])?>	
      </select></td>
  </tr>
  <tr>
    <td>Year</td>
    <td colspan="2"><select name="year">
        <?=html_options($year,$_POST['year'])?>
    </select></td>
  </tr>
  <tr>
 	 <td>
    	<div id="representative" style="display:none;">
			Representative
    	</div>
     </td>
  	 <td colspan="2">
    	<div id="representative1" style="display:none;">
   			<input type="text" name="representative1" class="longselect"/>
    	</div>
    </td>
  </tr>
  
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="103">&nbsp;</td>
    <td colspan="2"><input type="submit" name="Submit" value="Process" class="themeInputButton" /></td>
    </tr>
</table>
</form>	
</fieldset>
</div>

<script type="text/javascript" src="../includes/jquery/jquery-latest-min.js"></script>
<script type="text/javascript">
$("#radio2").click(function(){
	  $("#format_options").css("display","none");
	  $("#format_options_select").css("display","none");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio8").click(function(){
	  $("#format_options").css("display","none");
	  $("#format_options_select").css("display","none");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","inline");
	});
$("#radio3").click(function(){
	  $("#format_options").css("display","inline");
	  $("#format_options_select").css("display","inline");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio4").click(function(){
	  $("#format_options").css("display","inline");
	  $("#format_options_select").css("display","inline");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio5").click(function(){
	  $("#format_options").css("display","inline");
	  $("#format_options_select").css("display","inline");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio").click(function(){
	  $("#format_options").css("display","inline");
	  $("#format_options_select").css("display","inline");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio6").click(function(){
	  $("#format_options").css("display","inline");
	  $("#format_options_select").css("display","inline");
	  $("#representative1").css("display","none");
	  $("#representative").css("display","none");
	  $("#other_info").css("display","none");
	});
$("#radio7").click(function(){
	$("#format_options").css("display", "none");
	$("#format_options_select").css("display", "none");
	$("#representative1").css("display","inline");
	$("#representative").css("display","inline");
	 $("#other_info").css("display","none");
});
$("#csv").click(function(){
	  $("#other_info").css("display","inline");
	});
$("#excel").click(function(){
	  $("#other_info").css("display","none");
	});
</script>