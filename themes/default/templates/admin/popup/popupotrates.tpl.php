<!--<div class="popuptitle">Assign OT Rates</div>-->
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Assign OT Rates</h2></fieldset>
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
<table width="100%" border="0" cellpadding="1" cellspacing="2">	
	<tr >
	  <td colspan="99">
	  <div align="left"><i><span class="style3">&nbsp;&nbsp;Assign to <u>'<?=$_GET['tbl']?>'</u> Table</span></i></div>
	  <div align="left">
		<?=$tblDataList?>	  
	  </div></td>
	</tr>
	 <tr>
      <td ><input type='button' value='Apply changes' onclick="document.getElementById('form_tbl_list').submit();window.opener.location.reload();" class="buttonstyle"></td>
    </tr>
</table>
</fieldset>