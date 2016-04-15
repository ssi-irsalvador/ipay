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
<div class="themeFieldsetDiv01"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">OT Rate List</h2>
<br />
<strong><em>File Type:</em></strong><a href="reports.php?statpos=otreport&amp;exportOT=excel" target="_blank"><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" />Excel</a></fieldset>
<!--  <tr>
    <td><div align="center"><em><strong>== OT RATE LIST ==</strong></em></div></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;<strong><em>File Type:</em></strong><a href="reports.php?statpos=otreport&amp;exportOT=excel" target="_blank"><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" />Excel</a></td>
  </tr>-->
  <tr>
    <td><?=$tblDataList?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
