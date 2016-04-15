<div class="themeFieldsetDiv01">
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
<br>
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Employee Mass Assign</legend>
<table width="100%" border="0" cellpadding="4" cellspacing="0">
      <tr>
        <td><span class="themeInputButton"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'add2.png'?>" border="0" align="absbottom">&nbsp;&nbsp;<a href="setup.php?statpos=compbanks&view=<?=$_GET['view']?>&empinput=<?=$_GET['empinput']?>&bank=<?=$_GET['bank']?>&empinput_add">&nbsp;&nbsp;Select Employee</a></td>
      </tr>
</table>
</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?=$tblDataList?></td>
  </tr>
</table>
</div>
