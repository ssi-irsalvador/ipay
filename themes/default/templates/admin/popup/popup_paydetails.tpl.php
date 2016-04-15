<!--<div style="padding-top:5px;">-->
<!--&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="popup.php?statpos=popup_paydetails&action=add">Add New</a><br />-->
<!--</div>-->
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Pay Period List</h2></fieldset>
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