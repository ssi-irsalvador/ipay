<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br>
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Custom Report: <?= $reportName?></h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Custom Pay Details Form</legend>-->
<form method="post" action="">
<table>
<tr>
	<td>Please Select <?= $tag?>: </td>
	<td><select id="select" name="select"> 
			<?=html_options($list,$_POST['select'])?>
    </select></td>
</tr>
<?php IF($tag=='Month'){?>
<tr>
	<td>Please Select Year: </td>
	<td><select id="year" name="year"> 
			<?=html_options($year,$_POST['year'])?>
    </select></td>
</tr>
<?php } ?>
<tr>
	<td colspan="2"><input type="submit" value="Generate" class="themeInputButton"></td>
</tr>
</table>
</form>
</fieldset>
</div>