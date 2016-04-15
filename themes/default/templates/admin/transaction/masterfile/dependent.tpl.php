
<!-- this is used to check all the Bank Detail applicable per employee -->
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

		<?php
		if ($oData['taxep_name'] == 'Single1 (S1)' || $oData['taxep_name'] == 'Married1 (ME1)') {
			$dependent_number = 1;
		}
		if ($oData['taxep_name'] == 'Single2 (S2)' || $oData['taxep_name'] == 'Married2 (ME2)') {
			$dependent_number = 2;
		}
		if ($oData['taxep_name'] == 'Single3 (S3)' || $oData['taxep_name'] == 'Married3 (ME3)') {
			$dependent_number = 3;
		}
		if ($oData['taxep_name'] == 'Single4 (S4)' || $oData['taxep_name'] == 'Married4 (ME4)') {
			$dependent_number = 4;
		}
		?>
		<div id="tab-9" name="Bank Detail/s" style="width:310; height:100%; overflow:inherit;">
		<fieldset class="themeFieldset01" style="display:block;">
		<form method="post" action="" onsubmit="return validform();">
		  <div align="center">
		    <table width="100%" border="0" cellpadding="1" cellspacing="0">
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
			<tr>
			  <td width="20%" class="divTblTH_">&nbsp;</td>
			  <td width="80%" class="divTblTH_"><strong class="longlabel">Dependent Name</strong>
		      <input name="depnd_fname" id="depnd_fname" value="<?=$oDataDepnd['depnd_fname']?>" type="text" size="10" class="txtfields" />
		      <input name="depnd_mname" id="depnd_mname" value="<?=$oDataDepnd['depnd_mname']?>" type="text" size="10" class="txtfields" />
		      <input name="depnd_lname" id="depnd_lname" value="<?=$oDataDepnd['depnd_lname']?>" type="text" size="10" class="txtfields" /><br /><strong class="longlabel">&nbsp;</strong><em style="font-size:8pt;color:#7a7a7a">(First Name/Middle Name/Last Name)</em></td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Date of Birth</strong>
		      <input name="depnd_bdate" id="depnd_bdate" value="<?=$oDataDepnd['depnd_bdate']?>" type="text" size="10" class="txtfields" />
			  <a class="option" onclick="return showCalendar('depnd_bdate');" href="javascript:void(0);">
<img height="20" width="20" border="0" align="absbottom" title="Date" alt="Date" src="/ipay/admin/../themes/default/images/calendar.png">
</a></td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Relation</strong>
			<select name="depnd_relationship" id="depnd_relationship" class="longselect">
            <?=dependent_relation($oDataDepnd['depnd_relationship']); ?>
          </select>
		      <!--<input name="depnd_relationship" id="depnd_relationship" value="<?=$oDataDepnd['depnd_relationship']?>" type="text" size="10" class="txtfields" />--></td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Nationality</strong>
		      <input name="depnd_nationality" id="depnd_nationality" value="<?=$oDataDepnd['depnd_nationality']?>" type="text" size="10" class="txtfields" /></td>
			  </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">&nbsp;</strong>
			  <input type="submit" name="<?php if(isset($_GET['depndedit'])){ echo 'update_dependent'; }else{ echo 'add_dependent'; } ?>" id="bntdependinfo" value="<?php if(isset($_GET['depndedit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
                <?php if (isset($_GET['depndedit'])){ ?>
                <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='transaction.php?statpos=emp_masterfile&amp;empinfo='+<?=$_GET['empinfo']?>+'#tab-9'" />
                <?php }else{?>
                <input type="reset" name="reset" value="Reset" class="buttonstyle" />
                <?php } ?></td>
		      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
		  </table>
		    <!--<span class="style1">Under development</span>--></div>
		</form>
</fieldset>
<fieldset class="themeFieldset01">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
  <tr>
	<td colspan="4"><?=$dependList?></td>
  </tr>
</table>
</fieldset>
</div>