<!--<div style="padding-top:5px;">
<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="reports.php?statpos=hdmf_collection&action=add">Add New</a>
</div>-->
<script type="text/javascript">
	$(function() {
		$('#tks_startdate').datepicker({
			changeMonth: true,
			changeYear: true,
            dateFormat: 'yy-mm-dd'
		});
	});
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

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">HDMF Collection List Criteria</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">HDMF Collection List Criteria</legend>-->
<form method="post" target="_blank">
<table width="484" border="0">
  <tr id="month">
    <td><input type="radio" name="rtype" id="radio" value="10" checked="checked" />
      HDMF-P2-4</td>
    <td><input type="radio" name="rtype" id="radio2" value="20" />
HDMF-MPL Disket</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#CCFF66; border-top:1px solid;">&nbsp;</td>
    <td style="color:#CCFF66; border-top:1px solid;">&nbsp;</td>
  </tr>
  <tr id="month">
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
    <td colspan="2">
	<div id="person_" style="display:inline;">
	<table width="100%" border="0">
  <tr>
    <td width="199">Prepared By</td>
    <td width="275"><input name="co_maker1_name" type="text" id="co_maker1_name" class="longselect" /></td>
  </tr>
  <tr>
    <td>Prepared By Position </td>
    <td><input name="co_maker1_job" type="text" id="co_maker1_job" class="longselect" /></td>
  </tr>
  <tr>
    <td colspan="2" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
  </tr>
  <tr>
    <td>Checked &amp; Verified</td>
    <td><input name="co_maker2_name" type="text" id="co_maker2_name" class="longselect" /></td>
  </tr>
  <tr>
    <td>Checked &amp; Verified Position </td>
    <td><input name="co_maker2_job" type="text" id="co_maker2_job" class="longselect" /></td>
  </tr>
  <tr>
    <td colspan="2" style="color:#CCFF66; border-top: 1px solid;">&nbsp;</td>
  </tr>
  <tr>
    <td>Approved By</td>
    <td><input name="co_maker3_name" type="text" id="co_maker3_name" class="longselect" /></td>
  </tr>
  <tr>
    <td>Approved By Position </td>
    <td><input name="co_maker3_job" type="text" id="co_maker3_job" class="longselect" /></td>
  </tr>
  <tr>
    <td>File Format</td>
    <td><input type="radio" name="format" id="radio4" value="pdf" checked="checked" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File" /> PDF&nbsp;&nbsp;&nbsp;<input type="radio" name="format" id="radio5" value="excel" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /> Excel</td>
  </tr>
</table>
	</div></td>
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
	});
$("#radio2").click(function(){
	  $("#info").css("display","none");
	  $("#person_").css("display","none");
	});
</script>