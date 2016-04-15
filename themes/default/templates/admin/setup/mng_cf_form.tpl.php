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
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage Custom Fields Form</legend>
<form method="post" action="">
 <table width="100%" border="0" cellspacing="1" cellpadding="2">
    <!-- <tr>
      <td width="15%">Custom Number </td>
      <td width="85%"><input type="text" name="textfield" value="<?= $oData['cfhead_code']?>"/></td>
    </tr> -->
    <tr>
      <td width="15%">Custom Name </td>
      <td width="85%"><input type="text" name="cfhead_name" value="<?= $oData['cfhead_name']?>"/></td>
    </tr>
    <tr>
      <td>Type</td>
      <td><select id='cfhead_type' name='cfhead_type' class="longselect">
		  <option value='Hour'  <?$sel = $oData['cfhead_type']=='Hour'?"selected='selected'":''; print $sel;?>>Hour</option>
		  <option value='Day' <?$sel = $oData['cfhead_type']=='Day'?"selected='selected'":''; print $sel;?>>Day</option>
		  <option value='Amount'   <?$sel = $oData['cfhead_type']=='Amount'?"selected='selected'":''; print $sel;?>>Amount</option>	 
		  <option value='N/A'   <?$sel = ($oData['cfhead_type'] != 'Day' AND $oData['cfhead_type'] != 'Amount' AND $oData['cfhead_type'] != 'Hour')?"selected='selected'":''; print $sel;?>>N/A</option>				  
		 </select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=mng_cf'" />
        <?php }else{?>
        <input type="reset" name="Submit2" value="Reset" class="buttonstyle" />
        <?php } ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</fieldset>
</div>