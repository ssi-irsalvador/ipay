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
.style1 {color: red}
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
	$("#bckup_dbase").validate(
		{
			rules:
			{
				name:{
					required:true
				}
			},
			messages:
			{
				name:"Please enter a Filename.",
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Backup Database</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="bckup_dbase" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <h5 class="h5notify">&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'info.gif'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File"/> <span class="style1"><b>Note:</b></span> backup Database before or after process of payroll.</h5>
    <tr>
      <td width="30%" class="divTblTH_"><div class="style3">Enter File Name: &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="name" id="name" value="<?=trim($oData['name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Process" class="buttonstyle">
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=bckup_dbase'"><?php }else{?>
		<input type="reset" name="Submit2" value="Reset" class="buttonstyle"><?php } ?></td>
    </tr>
</table>
</form>
</fieldset>
</div>