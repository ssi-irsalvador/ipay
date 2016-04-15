<style type="text/css">
<!--
.style3 {font-size: 12px}
.style4 {color: #333333}
.style5 {color: #FF0000}
-->
</style>
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Import YTD Details</h2></fieldset>
<fieldset class="themeFieldset01_notopborder">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	</tr>
	<tr>
		<td width="110" class="divTblTH_">Pay Group: </td>
		<td class="divTblTH_"><strong><?= $oData['pps_name']?></strong></td>
	</tr>
	<tr>
		<td width="110" class="divTblTH_">Cut-off Start: </td>
		<td class="divTblTH_"><strong><?= $oData['pp_start']?></strong></td>
	</tr>	
	<tr>
		<td width="110" class="divTblTH_">Cut-off End: </td>
		<td class="divTblTH_"><strong><?= $oData['pp_end']?></strong></td>
	</tr>
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	</tr>
</table>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<?=$tblDataList?>
</fieldset>
</div>