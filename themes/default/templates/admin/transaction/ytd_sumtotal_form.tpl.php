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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Import YTD</h2></fieldset>
<fieldset class="themeFieldset01_notopborder">
<form method="post" enctype="multipart/form-data" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><strong>Upload YTD</strong>
	  	<div align="left">&bull; <em>Sample XLS file for YTD Summary:&nbsp;<a href="importtemplate/YTDSummaryAndPolicyTemplate.xls" target="_blank">Download</a></em></div>
	  	<div align="left">&bull; <em>Sample XLS file for Pay Element:&nbsp;<a href="?statpos=ytd_import&download=YTDPayElement" target="_blank">Download</a></em></div>
	  </td>
	  </tr>
	<tr>
		<td width="110" class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">Select File</label><input type="file" name="uptahead_file"></td>
	</tr>
	<tr>
		<td width="110" class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">Select Import Type</label>
			<select name="import_type" id="import_type" class="longselect" >
				 <?=html_options($importTYPE,$importTYPE)?>
			</select>
		</td>
	</tr>
	<tr>
		<td class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">&nbsp;</label><input type="submit" name="submit[save]" value="Upload File" class="themeInputButton"></td>
	</tr>
	
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	</tr>
</table>
</form>
</fieldset>
<fieldset class="themeFieldset01_notopborder">
<?=$tblDataList?>
</fieldset>
</div>