<style type="text/css">
<!--
.style3 {font-size: 12px}
.style4 {color: #333333}
.style5 {color: #FF0000}
-->
</style>
<br>
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">201 Category XLS Import</legend>
<form method="post" enctype="multipart/form-data" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><b>Upload 201 Category Information</b></td>
	  </tr>
	<tr>
		<td width="110" class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><b class="longlabel">Select File <span class="style5">*</span></b><input type="file" name="uptahead_file"></td>
	</tr>
	<tr>
		<td class="divTblTH_">&nbsp;</td>
		<td class="divTblTH_"><label class="longlabel">&nbsp;</label><input type="submit" name="submit[save]" value="Upload File" class="themeInputButton"></td>
	</tr>
	<tr bgcolor="#FAD163">
	  <td colspan="2" style="height:19px"><b>**Note </b></td>
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
	  <td class="divTblTH_ style3 style4"><div align="left">&bull; <em>Sample XLS file:&nbsp;<a href="importtemplate/201Category.xls" target="_blank">Download</a></em></div></td>
	</tr>
</table>
</form>
</fieldset>
</div>