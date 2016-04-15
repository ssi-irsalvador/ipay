<br>
<div class="popuptitle">List of Bank</div><br>
<!--<div style="padding-top:5px;">
<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="setup.php?statpos=manage_bank&action=add">Add New</a>
</div>-->
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
    <div class="tblListErrMsg"></div>
    <?
	}
}
?>
<?=$tblDataList?>