<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Manage User Form</legend>
<?php
if (isset($eMsg)) {
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
	} else {
?>
	<div class="tblListErrMsg">
	<?=$eMsg?>
	</div>
<?
	}
}
?>
<!-- the following javascript bellow are the required files and declarations for the Tab Bar Menu -->
<script src="../includes/jscript/jquerytabs/jquery-1.1.2.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('#container-1').tabs();
		$('#container-2').tabs(2);
		$('#container-3').tabs({ fxSlide: true });
		$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });
		$('#container-5').tabs({ fxSlide: true, fxFade: true, fxSpeed: 'fast' });
		$('#container-6').tabs({
			fxFade: true,
			fxSpeed: 'fast',
			onClick: function() {
				alert('onClick');
			},
			onHide: function() {
				alert('onHide');
			},
			onShow: function() {
				alert('onShow');
			}
		});
		$('#container-7').tabs({ fxAutoHeight: true });
		$('#container-8').tabs({ fxShow: { height: 'show', opacity: 'show' } });
		$('#container-10').tabs();
		$('#container-11').tabs({ disabled: [3] });

		$('<p><a href="#">Disable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).disableTab(3);
			return false;
		});
		$('<p><a href="#">Activate third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).triggerTab(3);
			return false;
		});
		$('<p><a href="#">Enable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).enableTab(3);
			return false;
		});
	});
</script>
<link rel="stylesheet" href="../includes/jscript/jquerytabs/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!--************************************ END ******************************************-->

<form id="manage_user" method="post" name="empladd" onsubmit="return validate(this,'empl')" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="1" cellpadding="2">
  	<tr style="background-color:#FAD163;">
      <td colspan="100%"><strong>User Access </strong></td>
    </tr>
    <tr>
      <td width="15%" rowspan="6" class="divTblTH_"><div align="center"><img src="<?php if(isset($_GET['edit'])){ echo "setup.php?statpos=manageuser&amp;img=".$_GET['edit'];}else{echo SYSCONFIG_DEFAULT_IMAGES.'nopic.PNG';}?>" width="120" height="120" border="1" /></div>	  </td>
      <td width="85%" class="divTblTH_"><label for="user_name">Employee </label>
        <select name="emp_id" id="emp_id" class="longselect">
        <?=html_options_2d($lstActiveEmployees,'emp_id','fullname', trim($oData['emp_id']),false)?>
      </select></td>
    </tr>
     <tr>
      <td width="85%" class="divTblTH_"><label for="user_name">User ID </label>
        <input name="user_name" type="text" id="user_name" value="<?=trim($oData['user_name'])?>" size="35" maxlength="30" class="txtfields" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><label for="user_password">Password</label>
        <input name="user_password" type="password" id="user_password" size="20" class="txtfields" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><label for="ud_id">Department</label>
      <select name="ud_id" id="ud_id" class="longselect">
        <?=html_options_2d($lstDepartment,'ud_id','ud_name', trim($oData['ud_id']),false)?>
      </select></td>
    </tr>
    <tr>
      <td class="divTblTH_"><label for="user_type">User Type</label>
        <select name="user_type" id="user_type" class="longselect">
        	<?=html_options_2d($lstUserType, 'user_type', 'user_type_name', trim($oData['user_type']), false)?>
		</select></td>
    </tr>
    <tr>
      <td class="divTblTH_"><label for="user_status">Status</label>
	  <select name="user_status" id="user_status" class="longselect">
	  	<option value="0">Please select</option>
        <?=html_options($lstStatus,trim($oData['user_status']))?>
      </select></td>
    </tr>
    <tr class="divTblTH_">
      <td colspan="100%">
	  <div id="container-4">
		<ul>
			<li><a href="#tab-1"><span>User Information</span></a></li>
			<li><a href="#tab-2"><span>Access Rights</span></a></li>
		</ul>
		<div id="tab-1" name="User Information" style="width:310; height:100%; overflow:inherit">
		<fieldset class="themeFieldset01">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<!-- <tr>
		  	<td style="background-color:#FAD163" colspan="2"><strong><em>&nbsp;&nbsp;User Information</em></strong></td>
		  </tr>
		  <tr>
		  	<td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Name</em></td>
		  	<td width="80%">
		  	<input disabled="disabled" name="user_fullname" type="text" id="user_fullname" value="<?=trim($oData['user_fullname'])?>" size="35" maxlength="255"/></td>
		  </tr>
		  <tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Photo</em></td>
			  <td><input type="file" name="user_picture" id="user_picture" />
				<em style="font-size:8pt;color:#7a7a7a;">(10 x 10 gif, png, jpg/jpeg only.)</em></td>
    	  </tr> -->
		  <tr>
		  	  <td style="background-color:#FAD163" colspan="2"><strong><em>&nbsp;&nbsp;Email Server Info</em></strong></td>
			</tr>
			<tr>
			  <td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>SMTP Host</em></td>
			  <td><input name="user_smtp" type="text" id="user_smtp" value="<?=trim($oData['user_smtp'])?>" size="35" maxlength="255"/></td>
			</tr>
			<tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>SMTP Port</em></td>
			  <td><input name="user_port" type="text" id="user_port" value="<?=trim($oData['user_port'])?>" size="6" maxlength="6"/></td>
			</tr>
			  <tr>
			   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>SMTP User</em></td>
			   <td><input name="user_email" type="text" id="user_email" value="<?= empty($oData['user_email']) ? "" : $oData['user_email'] ?>" size="35" maxlength="255" /></td>
	    	  </tr>
			<tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>SMTP Password</em></td>
			  <td><input name="user_emailpass" type="password" id="user_emailpass" value="<?=trim($oData['user_emailpass'])?>" size="35" maxlength="255" /></td>
			</tr>
			<tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Test Email</em></td>
			  <td><input name="test_email" type="checkbox" value="test"/></td>
			</tr>
			<tr>
			  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Test Email Address</em></td>
			  <td><input name="test_email_add" type="text"/></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		</table></fieldset>
		</div>
		<div id="tab-2" name="Access Rights" style="width:310; height:100%; overflow:inherit;">
		<fieldset class="themeFieldset01">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td style="background-color:#FAD163" colspan="2"><strong><em>&nbsp;&nbsp;Access Rights</em></strong></td>
		    </tr>
		  <tr <?= count($lstUserDept) > 0 ? "" : "style=\"display:none;\""?>>
		    <td width="20%" valign="top"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company List</em></td>
		    <td width="80%"><?php
				foreach($lstUserDept as $Key => $Value){
					if(isset($oData) and is_array($oData)){
						if(count(unserialize($oData['user_comp_list']))>0){
							$xKey = empty($oData['user_comp_list']) ? "" : array_search($Value['comp_id'],unserialize($oData['user_comp_list']));
						}
					}
				$xKey = empty($xKey)?0:$xKey;
				$co = unserialize($oData['user_comp_list']);
			?>
		<input name="user_comp_list[]" type="checkbox" id="user_comp_list[]" value="<?=$Value['comp_id']?>" <?=(($co[$xKey]==$Value['comp_id'])?"checked":"")?> /><?=$Value['comp_name']?><br />
			</option><?php }?>&nbsp;</td>
		    </tr>
		  <tr <?= count($lstBranch) > 0 ? "" : "style=\"display:none;\""?>>
		  	<td valign="top"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location List</em></td>
		  	<td><?php
				foreach($lstBranch as $Key => $Value){
					if(isset($oData) and is_array($oData)){
						if(count(unserialize($oData['user_branch_list']))>0){
							$xKey = empty($oData['user_branch_list']) ? "" : array_search($Value['branchinfo_id'],unserialize($oData['user_branch_list']));
						}
					}
				$xKey = empty($xKey)?0:$xKey;
				$br = unserialize($oData['user_branch_list']);
			?>
		<input name="user_branch_list[]" type="checkbox" id="user_branch_list[]" value="<?=$Value['branchinfo_id']?>" <?=(($br[$xKey]==$Value['branchinfo_id'])?"checked":"")?> /><?=$Value['branchinfo_name']?><br />
			</option><?php }?>&nbsp;</td>
		  </tr>
		  <tr <?= count($lstPayGroup) > 0 ? "" : "style=\"display:none;\""?>>
		    <td valign="top"><em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pay Group Access</em></td>
		    <td><?php
				foreach($lstPayGroup as $Key => $Value){
					if(isset($oData) and is_array($oData)){
						if(count(unserialize($oData['user_paygroup_list']))>0){
							$xKey = empty($oData['user_paygroup_list']) ? "" : array_search($Value['pps_id'],unserialize($oData['user_paygroup_list']));
						}
					}
				$xKey = empty($xKey)?0:$xKey;
				$pg = unserialize($oData['user_paygroup_list']);
			?>
		<input name="user_paygroup_list[]" type="checkbox" id="user_paygroup_list[]" value="<?=$Value['pps_id']?>" <?=(($pg[$xKey]==$Value['pps_id'])?"checked":"")?> /><?=$Value['pps_name']?><br />
			</option><?php }?>&nbsp;</td>
		  </tr>
		</table></fieldset>
		</div></td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('empladd')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=manageuser'" /></td>
    </tr>
    <tr style="background-color:#FAD163;">
      <td colspan="2">&nbsp;</td>
      </tr>
  </table>
</form>
</fieldset>
</div>