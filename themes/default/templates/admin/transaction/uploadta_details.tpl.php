<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">View Uploaded TA Summary</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">View Uploaded TA Summary</legend>-->

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

<div class="left">
<table border="0" cellpadding="2" cellspacing="1" width="500">
	<tr>
		<td width="150"><b>Date</b></td>
		<td><?=dDate::getDate(APPCONFIG_FORMAT_DATETIME,dDate::parseDateTime($uploadciheaderinfo['uptahead_addwhen']))?></td>
	</tr>
	<tr>
		<td><b>Description</b></td>
		<td><?=$uploadciheaderinfo['uptahead_desc']?></td>
	</tr>
	<?php
	if (strtolower($uploadciheaderinfo['uptahead_status']) == 'new') {
	?>		
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<?php
	}
	?>
	<!--<tr>
		<td><a href="?statpos=receiveci&transferfinalci=<?=$_GET['viewuptahead']?>">Transfer to Payroll as final</a></td>
		<td><a href="?statpos=receiveci&xlsexportupcidetail=<?=$_GET['viewuptahead']?><?=(isset($_GET['filterby'])?"&filterby=".$_GET['filterby']:"")?>">Export Result to Excel</a></td>
	</tr>-->
</table>
 </div>
<div class="right divTblList">
<table border="0" cellpadding="2" cellspacing="1">
	<tr class="divTblListTR">
		<td width="100" class="divTblListTH divTblList"><b>Valid Count</b></td>
		<td width="100" align="right" class="divTblListTD"><b><a href="?statpos=time_attend&viewuptahead=<?=$_GET['viewuptahead']?>&filterby=1"><?=$uploadciheaderinfo['uptahead_goodqty']?></a></b></td>
	</tr>
	<tr class="divTblListTR">
		<td class="divTblListTH divTblList"><b>Invalid Count</b></td>
		<td align="right" class="divTblListTD"><b><a href="?statpos=time_attend&viewuptahead=<?=$_GET['viewuptahead']?>&filterby=0"><?=$uploadciheaderinfo['uptahead_badqty']?></a></b></td>
	</tr>
	<tr class="divTblListTR">
		<td class="divTblListTH divTblList"><b>Total</b></td>
		<td align="right" class="divTblListTD"><b><a href="?statpos=time_attend&viewuptahead=<?=$_GET['viewuptahead']?>"><?=$uploadciheaderinfo['uptahead_goodqty']+$uploadciheaderinfo['uptahead_badqty']?></a></b></td>
	</tr>
</table>
</div>
</fieldset>
<?=$tblDataList?>
