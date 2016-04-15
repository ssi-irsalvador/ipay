<!--<div style="padding-top:5px;">-->
<!--&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="reports.php?statpos=bank_export_report&action=add">Add New</a><br />-->
<!--</div>-->
<h5 class="h5notify">To download the hash file, right click on the <img src="<?=$themeImagesPath?>/icon6.gif" border="0" width="13" align="absbottom"> link, click 'Save Link As...' then locate the location you want the file to be saved.</h5>
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
<?=$tblDataList?>