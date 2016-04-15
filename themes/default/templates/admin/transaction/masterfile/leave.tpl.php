<!-- this is used to check all the OT Table applicable per employee -->
<div id="tab-6" name="Leave" style="width:310; height:100%; overflow:inherit ">
<fieldset class="themeFieldset01">
	<form method="post" action="" onsubmit="return validate();">
	  <table width="100%" border="0" cellpadding="1" cellspacing="0">
        <tr>
          <td width="20%" class="divTblTH_">&nbsp;</td>
          <td width="80%" class="divTblTH_">&nbsp;</td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><b class="longlabel">Status</b>
            <select name="empleave_stat" id="empleave_stat" class="longselect">
              <?=html_options($salaryactive, $oDataLeave['empleave_stat']);?>
            </select></td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><b class="longlabel">Leave Type</b>
              <select name="leave_id" id="leave_id" class="longselect">
              <?=html_options_2d($leave_type,'leave_id','leave_name',$oDataLeave['leave_id']?$oDataLeave['leave_id']:'N/A',false);?>
          </select></td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><b class="longlabel">Leave Credit</b>
          <input name="empleave_credit" id="empleave_credit" value="<?=$oDataLeave['empleave_credit']?>" type="text" size="10" class="txtfields"/></td>
        </tr>
        
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_" style="padding-left:120px">
			<input type="submit" <?php if($_GET['empsalaryinfoedit']){?>name="leaveupdate" id="leaveupdate" value="Update"<?php }else{ ?>name="add_leave" id="add_leave" value="Save" <?php } ?> class="buttonstyle" >
			<input type="button"  value="Cancel" onclick="cancel('?statpos=emp_masterfile&empinfo=<?php print $_GET['empinfo']?>#tab-7')" class="buttonstyle"></td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_">&nbsp;</td>
        </tr>
      </table>
	</form>
</fieldset>
<fieldset class="themeFieldset01">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
  <tr>
	<td colspan="4"><?=$leaveList?></td>
  </tr>
</table>
</fieldset>
</div>