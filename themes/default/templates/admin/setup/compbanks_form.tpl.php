<div class="themeFieldsetDiv01">
<script type="text/javascript">
$(document).ready(function() {
	$("#popup").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
</script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:left; width:250px;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#compbanks").validate(
		{
			rules:
			{
				banklist_name:{
					required:true
				},
				bank_routing_number:{
					number:true
				},
				bank_acct_no:{
					required:true,
					number:true
				},
				bank_acct_name:{
					required:true
				},
				bank_ceiling_amount:{
					number:true
				},
				bank_branch:{
					required:true
				}
			},
			messages:
			{
				banklist_name:{
					required:"Please select Bank."
				},
				bank_routing_number:{
					number:"Please enter a valid Presenting Office Code."
				},
				bank_acct_no:{
					required:"Please enter Account Number.",
					number:"Please enter a valid Account number."
				},
				bank_acct_name:{
					required:"Please enter Account Name."
				},
				bank_ceiling_amount:{
					number:"Please enter a valid Default Ceiling Amount."
				},
				bank_branch:{
					required:"Please enter Branch."
				}
			}
		}
	);
});
</script>
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Bank</h2></fieldset>
<form id="compbanks" method="post" action="">
<fieldset class="themeFieldset01" style="background-color: #FFF;">
  <table border="0" cellpadding="0" cellspacing="1" width="100%">
      <tr>
        <td><em>Company Code</em></td>
        <td><b><?=$oDatacomp['comp_code']?>
        </b></td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td><em>Company Name</em></td>
        <td><b><?=$oDatacomp['comp_name']?>
        </b></td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td width="41%" valign="top">&nbsp;</td>
      </tr>
      <tr>
      <td width="15%"><em>Contact No.</em></td>
      <td width="31%"><strong>
        <?=$oDatacomp['comp_tel']?>
      </strong></td>
      <td width="13%"><em>Address</em></td>
      <td width="41%" rowspan="2" valign="top"><strong><?=$oDatacomp['comp_add']?>
      </strong></td>
      </tr>
    <tr>
      <td><em>TIN No.</em></td>
      <td><b>
        <?=$oDatacomp['comp_tin']?>
      </b></td>
      <td width="13%">&nbsp;</td>
    </tr>
    <tr>
      <td><em>SSS No.</em></td>
      <td><strong>
        <?=$oDatacomp['comp_sss']?>
      </strong></td>
      <td><em>Email</em></td>
      <td valign="top"><b><?=$oDatacomp['comp_email']?>
      </b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="13%">&nbsp;</td>
      <td width="41%" valign="top">&nbsp;</td>
    </tr>
  </table>
</fieldset>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	&nbsp;<strong>Check the following error(s) below:</strong><br />
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br />
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
<br />
<?php IF(isset($_GET['edit'])){ ?>
<div style="display: inline;">
<?php }else{ ?>
<div style="display: inline;">
<?php } ?>
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Company Bank/s Form</legend>
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Status &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_">
	  <select name="bank_isactive" id="bank_isactive">
	  	<option value="0">Please select</option>
        <?=html_options($lstStatus,$oData['bank_isactive'])?>
      </select></td>
      <td class="divTblTH_"><div align="right"><span class="style3">Account Type  &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><select name="baccntype_id" id="baccntype_id">
                <?=html_options2($bnkaccntype,$_SESSION['baccntype_id'],'edit',$oData['baccntype_id'])?>
            </select></td></td>
    </tr>
    <tr>
      <td width="20%" class="divTblTH_"><div align="right"><span class="style3">Bank Name &nbsp;&nbsp;</span></div></td>
      <td width="26%" class="divTblTH_"><input name="banklist_name" id="banklist_name" value="<?=trim($oData['banklist_name'])?>" type="text" size="27" readonly="">
	  <input type="hidden" name="banklist_id" id="banklist_id" value="<?=$oData['banklist_id']?>" />
	  <!-- <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupbank', 'banklist_name', '');"> -->
	  <a id="popup" href="popup.php?statpos=popupbank">
	  <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a></td>
      <td width="21%" class="divTblTH_"><div align="right"><span class="style3">Default Ceiling Amount &nbsp;&nbsp;</span></div></td>
      <td width="33%" class="divTblTH_"><input name="bank_ceiling_amount" id="bank_ceiling_amount" value="<?=trim($oData['bank_ceiling_amount'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3"> Presenting Office Code  &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_routing_number" id="bank_routing_number" value="<?=trim($oData['bank_routing_number'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><div align="right"><span class="style3">Swift Code &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_swift_code" id="bank_swift_code" value="<?=trim($oData['bank_swift_code'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Company Code &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_company_code" id="bank_company_code" value="<?=trim($oData['bank_company_code'])?>" type="text" size="30" /></td>
      <td class="divTblTH_"><div align="right"><span class="style3">Branch &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_branch" id="bank_branch" value="<?=trim($oData['bank_branch'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Account No. &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_acct_no" id="bank_acct_no" value="<?=trim($oData['bank_acct_no'])?>" type="text" size="30" ></td>
      <td class="divTblTH_"><div align="right"><span class="style3">Account Name &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_acct_name" id="bank_acct_name" value="<?=trim($oData['bank_acct_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div align="right"><span class="style3">Bank Building&nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_building" id="bank_building" value="<?=trim($oData['bank_building'])?>" type="text" size="30"></td>
      <td class="divTblTH_"><div align="right"><span class="style3">Bank Address &nbsp;&nbsp;</span></div></td>
      <td class="divTblTH_"><input name="bank_address" id="bank_address" value="<?=trim($oData['bank_address'])?>" type="text" size="30"/></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" class="divTblTH_"><div align="center">
        <input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle"/>
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=compbanks&view=<?php echo $_GET['view_'];?>'" />
        <?php }else{?>
        <input type="reset" name="Reset" value="Reset" class="buttonstyle" />
        <?php } ?>
      </div></td>
      </tr>
  </table>
</fieldset>
</div>
</form>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?=$tblDataList?></td>
    </tr>
</table>

</div>