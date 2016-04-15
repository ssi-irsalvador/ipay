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

<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;font-weight:normal;font-size:small;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#ottable").validate(
		{
			rules:
			{
				ot_name:{
					required:true
				},
				ot_desc:{
					required:true
				}
			},
			messages:
			{
				ot_name:"Please enter a Name.",
				ot_desc:"Please enter a Description."
			}
		}
	);
});
</script>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">OT Table</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="ottable" method="POST">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
	<tr >
	  <td width="30%" class="divTblTH_"><div align="right"><span class="style3">OT Table ID&nbsp;&nbsp;</span></div></td>
	  <td width="70%" class="divTblTH_">
		 <select id='ot_id' name='ot_id' onchange="window.location='?statpos=ottable&ot_id='+this.options[this.selectedIndex].value+'&edit='+this.options[this.selectedIndex].value">
		  <option>Please Select</option>
		  <?=html_options2($otname,$_SESSION['otvalue'],'ot_id',$_GET['ot_id']?$_GET['ot_id']:'N/A',false)?>			
		 </select>
		 <div <?php if(!empty($_GET['ot_id']))print 'style="display: inline"'; else print 'style="display: none"';?>>
         <!--<a class="popup" href="popup.php?statpos=popupotrates&tbl='+document.getElementById('ot_name').value+'">-->
		 <img style="cursor: pointer" onclick="openwindow('popup.php?statpos=popupotrates&tbl='+document.getElementById('ot_name').value+'&ot_id='+document.getElementById('ot_id').options[document.getElementById('ot_id').selectedIndex].value, 'post_name', '');" title="Add OT Rates" src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom"/>
         <!--</a>-->
         </div>         </td>
	</tr>
	<tr >
	  <td class="divTblTH_"><div align="right"><span class="style3">Name&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input size="35" id='ot_name' name='ot_name' value="<?=trim($oData['ot_name'])?>" /></td>
	</tr>
	<tr >
	  <td class="divTblTH_" valign="top"><div align="right"><span class="style3">Description&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><textarea name="ot_desc" cols="35" id="ot_desc" ><?=trim($oData['ot_desc'])?></textarea></td>
	</tr>	
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Subject to TAX&nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input type="checkbox" name="ot_istax" id="ot_istax" value="1" <?if($oData['ot_istax']==1)print "checked";?>/></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" /> <?php if(isset($_GET['edit'])){ print '<a style="text-decoration:none;" onclick="return confirm(\'Are you sure, you want to delete?\');"><input type="submit" name="delete" value="Delete" class="buttonstyle" /></a>';}?>
        <?php if (isset($_GET['edit'])){ ?>
		
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=ottable'" /><?php } else {?>
		<input type="reset" name="Reset" value="Reset" class="buttonstyle" /><?php } ?></td>
    </tr>
</table>
</form>
</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><?=$tblDataList?></td>
    </tr>
</table>
</div>