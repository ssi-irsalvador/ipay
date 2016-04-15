<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
		?>
<div class="tblListErrMsg"><strong>Check the following error(s) below:</strong><br />
		<?php
		foreach ($eMsg as $key => $value) {
			?> &nbsp;&nbsp;&bull;&nbsp;<?=$value?><br />
			<?php
		}
		?></div>
		<?php
	} else {
		?>
<div class="tblListErrMsg"><?php echo $eMsg; ?></div>
		<?
	}
}
?>

<script type="text/javascript">
$(function () {
    $('#chkAttendAll').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
});
</script>

<?php
if (!$_GET['comp_id']) { ?>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Bank Group Mass Assign</h2></fieldset>
<fieldset class="themeFieldset01">
<br><br>
<table width="100%" cellpadding="2" cellspacing="0" border="0" class="divTblListTH">
  <tr>
	<td width="30" valign="top" class="divTblListTH"><div align="center">Action</div></td>
	<td width="85" class="divTblListTH">Company Code </td>
	<td width="200" class="divTblListTH">Company Name</td>
	<td width="160" class="divTblListTH">Address</td>
	<td width="67" class="divTblListTH">Tel</td>
  </tr>
  <?php
	//printa($comp);
	IF(count($comp) > 0) {
	?>
          <tr>
            <td colspan="5"><table width="100%" cellpadding="2" cellspacing="0" border="0" style="background-color:#ffffaa">
                <tr class="divTblListTR2">
                  <td width="35" class="divTblListTD"><div align="center"><a href="?statpos=mass_assign_bank_group&comp_id=<?=$comp['comp_id']?>"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search.png'?>" title="View Company's Bank" hspace="2px" border=0 width="16" height="16"></a></div></td>
                  <td width="85" class="divTblListTD"><b><?=$comp['comp_code']?></b></td>
                  <td width="200" class="divTblListTD"><b><?=$comp['comp_name']?>
                  <input type="hidden" name="hiddenField" value="<?=$comp['comp_id']?>" /></b></td>
                  <td width="160" class="divTblListTD"><strong><?=$comp['comp_add']?>
                  <td width="66" class="divTblListTD"><strong><?=$comp['comp_tel']?></strong></td>
                </tr>
             	<tr>
                  <td colspan="9" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
				<?php
					if (count($brachlist)>0) {
					$ctrl = 1;
				?>
                      <tr>
                        <td width="2%" bgcolor="#FFFFFF" class="divTblListTH"><div align="center">Action</div></td>
                        <td width="9%" bgcolor="#FFFFFF" class="divTblListTH">Location Code</td>
                        <td width="18%" bgcolor="#FFFFFF" class="divTblListTH">Location Name</td>
                        <td width="31%" bgcolor="#FFFFFF" class="divTblListTH">Address</td>
                        <td width="7%" bgcolor="#FFFFFF" class="divTblListTH">Tel</td>
                      </tr>
				<?php
					foreach ($brachlist as $clSIKey => $clSIValue) {
				?>
                      <tr class="divTblListTR2">
                        <td class="divTblListTD"><div align="center"><a href="?statpos=mass_assign_bank_group&comp_id=<?=$comp['comp_id']?>&local=<?=$clSIValue['branchinfo_id']?>"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search.png'?>" title="View Location's Bank" hspace="2px" border=0 width="16" height="16"></a></div></td>
                        <td class="divTblListTD"><b><?=$clSIValue['branchinfo_code']?></b></td>
                        <td class="divTblListTD"><b><?=$clSIValue['branchinfo_name']?></b></td>
                        <td class="divTblListTD"><b><?=$clSIValue['branchinfo_add']?></b></td>
                        <td class="divTblListTD"><b><?=$clSIValue['branchinfo_tel1']?></b></td>
                      </tr>
                <?php }} else{?>
                      <font color="#FF0000">No Selected Supplier.</font>
                <? } ?>
                  </table></td>
                </tr>
            </table><br />
            <?php } ?>
			</td>
          </tr>
        </table>
    <strong><font color="#FF0000">No record found</font></strong>
</fieldset>
</div>
<?php } elseif ($_GET['comp_id'] && !$_GET['bank_id']) {
	echo "

<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Company Bank Account/s</h2></fieldset>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
        <td>
			<input type='button' name='Back' value='Back' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_bank_group\"' />
        </td>
      </tr>
    <tr>
		<td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</fieldseet>
</div>

	";

} elseif ($_GET['bank_id'] && $_GET['banklist_id'] && !$_GET['select_employee']) {
	echo "

<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Assigned Employee</h2></fieldset>

<form method='POST' action=''>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='1.5' cellspacing='0' class='divTblTH_'>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Bank Name</em></span><strong>{$oData['banklist_name']}</strong></td>
      </tr>
      <tr>
        <td width='30'>&nbsp;</td>
        <td width='543'><span class='longlabel'><em>Account No.</em></span><strong>{$oData['bank_acct_no']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Account Name</em></span><strong>{$oData['bank_acct_name']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Branch</em></span><strong>{$oData['bank_branch']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class='longlabel'><em>Status</em></span><strong>{$oData['bank_isactive']}</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type='button' name='btn_saveEmployee' id='btn_saveEmployee' value='Select Employee' class='themeInputButton' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_bank_group&comp_id={$_GET['comp_id']}&bank_id={$_GET['bank_id']}&banklist_id={$_GET['banklist_id']}&select_employee=1\"' style='margin-left: 118px;' />
		<input type='submit' name='btn_removeEmployee' id='btn_removeEmployee' value='Remove Selected' class='buttonstyle' onclick=\"
		if ( confirm('Are you sure, you want to Remove the Selected Employee Account/s from this Bank Group?') ) {
			return true;
		} else {
			return false;
		}
		\" />
		<input type='button' name='Back' value='Back' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_bank_group&comp_id={$_GET[comp_id]}\"' />
        </td>
      </tr>
</table>
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
    <tr>
      <td colspan='2'>{$tblDataList}</td>
    </tr>
</table>
</fieldset>
</form>
</div>

	";
} elseif (isset($_GET['select_employee'])) {
	echo "

<form method='POST' action=''>
<div class='themeFieldsetDiv01'>
<fieldset class='themeFieldset01' style='background: #FAD163; border-radius: 4px 4px 0 0;'><h2 style='margin: 0 0 -5px 0;'>Select Employee</h2></fieldset>
<fieldset class='themeFieldset01'>
<table width='100%' border='0' cellpadding='0' cellspacing='0' class='divTblTH_'>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<input type='submit' name='btn_saveEmployee' id='btn_saveEmployee' value='Assign Employee' class='themeInputButton' style='margin-left: 50px;' onclick=\"
		if ( confirm('Are you sure, you want to Assign the Selected Employee Account/s to this Bank Group?') ) {
			return true;
		} else {
			return false;
		}
		\" />
			<input type='button' name='Cancel' value='Cancel' class='buttonstyle' onclick='javascript:window.location=\"setup.php?statpos=mass_assign_bank_group&comp_id={$_GET[comp_id]}&bank_id={$_GET[bank_id]}&banklist_id={$_GET[banklist_id]}\"' />
		</td>
	</tr>
	<tr>
		<td colspan='2'>{$tblDataList}</td>
	</tr>
</table>
</fieldset>
</div>
</form>

	";
}
?>