<br/ >
<br />
<div class="popuptitle">City / Province</div>
<div style="padding-top:5px;">
<!--<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="setup.php?statpos=emptype&action=add">Add New</a>-->
</div>
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