<!--<div style="padding-top:5px;">
<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="setup.php?statpos=managemodule&action=add">Add New</a>
</div>-->
<?php 
if(isset($eMsg)){
?>
<div class="tblListErrMsg">
<?=$eMsg?>
</div>
<?
}
?>
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Module</h2></fieldset>
<?=$tblDataList?>