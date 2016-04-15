<br>
<br>
<div class="themeFieldsetDiv01">
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?>
	<?php		
	}
	?>
	</div>
<?php		
	}else {
?>
	<div class="tblListErrMsg">
	<?=$eMsg?>
	</div>
<?
	}
}
?>
<fieldset class="themeFieldset01"> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  
  <tr>
    <td width="20%">Select Pay Period</td>
    <td width="80%"><select name="pps_id" id="pps_id" onchange="javascript:window.location='reports.php?statpos=<?=$_GET['statpos'];?>&pps_id='+document.getElementById('pps_id').value;">
		 <option value="0">Please select</option>
		 <?=html_options_2d($payperiod,'pps_id','pps_name',$_GET['pps_id'],true)?>
    </select></td>
  </tr>
</table>
</fieldset>
<?=$tblDataList?>
</div>