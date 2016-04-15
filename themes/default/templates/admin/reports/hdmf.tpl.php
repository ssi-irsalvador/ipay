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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">HDMF Premium</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">HDMF Contribution</legend>-->

<?=$tblDataList?>
<form method="post" target="_blank">
<table width="484" border="0">
  <tr>
    <td><input type="radio" name="rtype" id="radio" value="10" checked="checked" />
      MCRF</td>
    <td><input type="radio" name="rtype" id="radio1" value="20" checked="checked" />
      HDMF Diskette </td>
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
      </select>      </td>
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
    <td>Signatory</td>
    <td><input name="signatoryby" type="text" id="signatoryby" class="longselect" style="height:15px;" /></td>
  </tr>
  <tr>
    <td>Position</td>
    <td><input name="position" type="text" id="position" class="longselect" style="height:15px;" /></td>
  </tr>
  <tr>
    <td colspan="2"><div id="typeFile" style="display:none;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="199">File Format</td>
        <td width="275"><input type="radio" name="format" id="radio4" value="pdf" checked="checked" /><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File" /> PDF&nbsp;&nbsp;&nbsp;<input type="radio" name="format" id="radio5" value="excel"/><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /> Excel</td>
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
	  $("#typeFile").css("display","inline");
	});
$("#radio1").click(function(){
	  $("#typeFile").css("display","none");
	});	
</script>