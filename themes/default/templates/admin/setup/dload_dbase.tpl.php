<!--<div style="padding-top:5px;">-->
<!--&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="setup.php?statpos=dload_dbase&action=add">Add New</a><br />-->
<!--</div>-->
<br>
<br>
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
  <div class="divTblList" id="update_tbl_list">
  <form method="post" name="form_tbl_list" id="form_tbl_list">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" id="tbl_list" style="border: 1px inset #FAD163; -moz-border-radius: 1px;">
  <h5 class="h5notify">&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'info.gif'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="PDF File"/> <span class="style1"><b>Note:</b></span> To download backup Database, Please select file.</h5>
  <tbody><tr>
		    <td class="divTblListTH" width="50" align="center">Action</td>
		    <td class="divTblListTH">File Name</td>
		    <td class="divTblListTH">Date Created</td>
		  </tr>
<?php $count =0;
	if(count($listFile) == 0){ ?>
		<tr class="<?= $count % 2 == 0 ?  'divTblListTR2' :  'divTblListTR' ?>" id="_">
			<td class="divTblListTD" colspan="3"><strong>No Records Found</strong></td>
		</tr>
<?php } else { ?>
	
<?php  	foreach($listFile as $key => $val){ ?>
  	<tr class="<?= $count % 2 == 0 ?  'divTblListTR2' :  'divTblListTR' ?>" id="_">
  		<td class="divTblListTD" id="_viewdata" width="50" align="center"><a href="?statpos=dload_dbase&edit&file=<?= $val ?>"><img src="<?=$themeImagesPath?>admin/menu/bckupdownload.png" title="Download" hspace="2px" border="0" width="16" height="16"></a><a href="?statpos=dload_dbase&amp;delete=<?= $val ?>" onclick="return confirm('Are you sure, you want to delete?');"><img src="<?= SYSCONFIG_DEFAULT_IMAGES_INCTEMP ?>icons/edited/delete.png" title="Delete" hspace="2px" border="0" width="16" height="16"></a></td>
		<td class="divTblListTD" id="_mnu_name"><?= preg_replace("/\\.[^.\\s]{3,4}$/", "", $val);?></td>
		<td class="divTblListTD" id="_mnu_link"><?= date ("F d Y h:i:s A.", filemtime(SYSCONFIG_DBBACKUP_PATH.$val));?></td>
	</tr>
  	<?php $count++;}}?>
  	</tbody></table>
	</form>
	</div>
</fieldset>
</div>