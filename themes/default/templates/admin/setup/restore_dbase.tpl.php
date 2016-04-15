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

<script src="../includes/jscript/jquery.js"></script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none; padding-left:10px;}
</style>
<script type="text/javascript">

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#restore_dbase").validate(
		{
			rules:
			{
				filename:{
					required:true
				}
			},
			messages:
			{
				filename:"Please select a file.",
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Restore Database</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="restore_dbase" method="POST" action="">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <h5 class="h5notify">&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'info.gif'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File" /> <span class="style1"><strong>Note:</strong></span> To restore backup Database, Please select file.</h5>
    <tr>
      <td width="30%" class="divTblTH_"><div class="style3">Select File: &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><select name="filename">
	<option value="">- Select Database File -</option>
<?php foreach ($_SESSION['fileList'] as $val) {
	echo "<option value=\"" . trim($val) . "\" id=\"showdetails\">" . preg_replace("/\\.[^.\\s]{3,4}$/", "", $val) . "</option>";
}?>
</select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Restore" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=bckup_dbase'" /><?php } else {?>
		<input type="reset" name="Submit2" value="Reset" class="buttonstyle" /><?php } ?></td>
    </tr>
</table>
</form>
</fieldset>
</div>