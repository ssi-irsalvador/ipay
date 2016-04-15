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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Import Loan</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Loan XLS Import</legend>-->
<form method="post" enctype="multipart/form-data" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><strong>Upload Loan Information</strong></td>
	  </tr>
	<tr>
		<td width="110" class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><strong class="longlabel">Select File <span class="style5">*</span></strong>
		  <input type="file" name="uptahead_file" accept="application/vnd.ms-excel"></td>
	</tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_"><label class="longlabel">&nbsp;</label>
	    <input type="submit" name="submit[save]" value="Upload File" class="themeInputButton" /></td>
	  </tr>
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><strong>**Note </strong></td>
	  </tr>
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left">&bull; <em> All header in &quot;<span class="style5">Red Font</span>&quot; are compulsory </em></div></td>
	  </tr>
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left">&bull; <em>All date fields should be in YYYY-MM-DD format </em></div></td>
	  </tr>
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left">&bull; <em>Each import file should be configured for 1000 records or less </em></div></td>
	  </tr>
	<tr>
	  <td class="divTblTH_ style3 style4"><div align="left"></div></td>
	  <td class="divTblTH_ style3 style4"><div align="left">&bull; <em>Sample XLS file:&nbsp;<a href="?statpos=importloan&download=LoanTemplate">Download</a></em></div></td>
	</tr>
</table>
</form>
</fieldset>
</div>