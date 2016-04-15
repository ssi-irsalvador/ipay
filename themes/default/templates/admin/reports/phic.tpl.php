<div class="themeFieldsetDiv01">
<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">PHIC Premium</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">PHIC Contribution</legend>-->
<?=$tblDataList?>
<form method="post" target="_blank">
<table width="484" border="0">
  <tr>
    <td><input type="radio" name="rtype" id="radio1" value="10" checked="checked" />PHIC RF-1</td>
    <td><input type="radio" name="rtype" id="radio" value="20" checked="checked" />
      PHIC RF-1 Disket</td>
  </tr>
  <tr>
    <td><input name="rtype" type="radio" id="radio2" value="30" />PHIC ME-5</td>
    <td><input name="rtype" type="radio" id="radio3" value="40" />
      PHIC Er-2 </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td style="color:#CCFF66; border-top:1px solid;">&nbsp;</td>
    <td style="color:#CCFF66; border-top:1px solid;">&nbsp;</td>
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
  <tr>
    <td>Report Type </td>
    <td><select name="type" id="type" onchange="showType();" class="longselect">
      <?=html_options($type,$_POST['type'])?>
      </select></td>
  </tr>
  <tr id="month">
    <td width="177">Month <span id="from" style="display:none;">To</span></td>
    <td width="297"><select name="month" class="longselect">
	  <?=html_options($month,$_POST['month'])?>
    </select></td>
  </tr>
  <tr>
    <td>Year</td>
    <td><select name="year" class="longselect">
        <?=html_options($year,$_POST['year'])?>
          </select></td>
  </tr>
  <tr>
    <td>ME-5 # / OR # </td>
    <td><input name="receiptno" type="text" class="longselect" id="receiptno" style="height:15px;" maxlength="15" /></td>
  </tr>
  <tr>
    <td>Date Paid</td>
    <td><input name="trasdate" type="text" class="txtfields" id="trasdate" maxlength="10" value='0000-00-00' />
	   <img onclick="return showCalendar('trasdate','','trasdate','pi_age');" src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" style="cursor:pointer;" /></td>
  </tr>
  <tr>
    <td>Amount Paid</td>
    <td><input name="amountpaid" type="text" id="amountpaid" class="longselect" style="height:15px;" /></td>
  </tr>
  <tr>
    <td>Signatory</td>
    <td><input name="signatoryby" type="text" id="signatoryby" class="longselect" style="height:15px;" /></td>
  </tr>
  <tr>
    <td>Position</td>
    <td><input name="position" type="text" id="position" class="longselect" style="height:15px;" /></td>
  </tr>
    <tr>
    <td colspan="2"><div id="show" style="display:none;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2"><div id="basic" style="display:inline;">
      Show Monthly Compensation&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="show" value="1" checked="checked"></div></td>
          </tr>
        <tr>
          <td width="177">File Format</td>
          <td width="297"><div id="pdf" style="display:inline;"><input type="radio" name="format" id="radio4" value="pdf" checked="checked" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File" /> PDF</div>&nbsp;&nbsp;&nbsp;<div id="excel" style="display:inline;"><input type="radio" name="format" id="radio5" value="excel"/><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /> Excel</div></td>
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
<script type="text/javascript">
function showType() {
	if (document.getElementById('type').value == 'month' ) {
		document.getElementById('month').style.display = '';
		document.getElementById('from').style.display = 'none';	
	} else if ( document.getElementById('type').value == 'year' ) {
		document.getElementById('month').style.display = 'none';
		document.getElementById('from').style.display = 'none';	
	} else {
		document.getElementById('month').style.display = '';
		document.getElementById('from').style.display = '';			
	}
}
</script>
<script type="text/javascript" src="../includes/jquery/jquery-latest-min.js"></script>
<script type="text/javascript">
$("#radio").click(function(){
	  $("#show").css("display","none");
	});
$("#radio1").click(function(){
	  $("#show").css("display","inline");
	  $("#basic").css("display","none");
	  $("#excel").css("display","inline");
	});	
$("#radio2").click(function(){
	  $("#show").css("display","inline");
	  $("#basic").css("display","inline");
	  $("#excel").css("display","none");
	});
$("#radio3").click(function(){
	  $("#show").css("display","inline");
	  $("#basic").css("display","none");
	  $("#excel").css("display","none");
	});
</script>