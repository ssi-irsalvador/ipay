<style>
<!--
.style1 {color: #FF0000}
-->
.color { color: blue; }
</style>
<?php if ($_SESSION['admin_session_obj']['user_type'] == 'ESS') { ?>
<div style="margin-left: 23px;">
	<br />
	<span>Hi <strong><?php echo $_SESSION['admin_session_obj']['user_data']['user_fullname']; ?>!</strong> What do you want to do today?</span>
	<br /><br />
	<a href="<?php echo SYSCONFIG_DTR_URL;?>admin/setup.php?statpos=time_logs" class="color" title="View My Time Logs"><span>View My Time Logs</span></a>
	<br /><br />
<!--	<a href="../DTR/ess-viewschedules.html" class="color"><span>View My Schedules</span></a>-->
<!--	<br /><br />-->
	<a href="<?php echo SYSCONFIG_DTR_URL;?>admin/setup.php?statpos=overtime_request" class="color" title="Make an Overtime Request"><span>Make an Overtime Request</span></a>
	<br /><br />
	
		<?php if ($oDataSupervisor['erep_sup_emp_number']) { ?>
			<a href="<?php echo SYSCONFIG_DTR_URL;?>admin/setup.php?statpos=overtime_request_approval" class="color" title="View Subordinates' Overtime Requests"><span>View Subordinates' Overtime Requests</span></a>
			<br /><br />
		<?php } ?>
	
	<a href="reports.php?statpos=mypayslip" class="color" title="View My Payslips"><span>View My Payslips</span></a>
	<br /><br />
</div>
<?php } ?>

<table width="<?php if ($oData_number_of_dependent) { echo 6; } else { echo 3; } ?>0%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top" <?php if ($_SESSION['admin_session_obj']['user_type']=='Report Master' or $_SESSION['admin_session_obj']['user_type']=='ADMIN MASTER' or $_SESSION['admin_session_obj']['user_type']=='LOAN MASTER' or $_SESSION['admin_session_obj']['user_type']=='ESS') { echo 'style="display:none;"'; } ?>>
	<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;">
	<h2 style="margin: 0 0 -5px 0;">Employee Summary</h2>
	</fieldset>
	<fieldset class="themeFieldset01">
	<!--<legend class="themeLegend01">Employer Summary </legend>-->
	<div class="divTblList">
          <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="EFFAFE">
            <tr>
              <td valign="middle" class="divTblListTH">&nbsp;Company</td>
              <td width="12%" align="center" valign="middle" class="divTblListTH">Total</td>
            </tr>
            <? if(count($Total201)>0){  $totalval = 0;?>
            <? foreach($Total201 as $key => $val){?>
            <tr class="divTblListTR2">
              <td class="divTblListTD"><b>&nbsp;&nbsp;<a href="transaction.php?search_field=<?=$val['comp_name']?>&statpos=emp_masterfile"><?=$val['comp_name']?></a></b></td>
              <td class="divTblListTD"><div align="center"><a href="transaction.php?search_company=<?=$val['comp_name']?>&statpos=emp_masterfile"><?=$val['mycount']?></a></div></td>
            </tr>
            <? $totalval = $val['mycount'] + $totalval; } ?>
			<tr class="divTblListTR">
			  <td colspan="2"><table width="100%" border="0" cellspacing="1" cellpadding="1">
				<?php
					if (count($brachlist)>0) {
					$ctrl = 1; $totalperLoc = 0; 
				?>
                      <tr>
                        <td bgcolor="#FFFFFF" class="divTblListTH">&nbsp;Location Summary </td>
                        <td width="12%" align="center" valign="middle" bgcolor="#FFFFFF" class="divTblListTH">Total</td>
                      </tr>
				<?php foreach ($brachlist as $clSIKey => $clSIValue) { ?>
                      <tr class="divTblListTR2">
                        <td class="divTblListTD"><b>&nbsp;&nbsp;<?=$clSIValue['branchinfo_name']?></b></td>
                        <td class="divTblListTD"><b><div align="center"><?=$clSIValue['mycount']?></div></b></td>
                      </tr>
                <?php $totalperLoc = $clSIValue['mycount'] + $totalperLoc; } 
                
                IF(($val['mycount']-$totalperLoc) > 0){ ?>
                	<tr class="divTblListTR2">
                        <td class="divTblListTD"><b>&nbsp;&nbsp;Employees w/o Location</b></td>
                        <td class="divTblListTD"><b><div align="center"><?=$val['mycount']-$totalperLoc?></div></b></td>
                     </tr>
                    <?php } ?>
			    <!-- <tr class="divTblListTR2">
				 <td bgcolor="#FFFFFF" class="divTblListTH"><div align="right"><em>Total Employee per Location: &nbsp;&nbsp;</em></div></td> 
				  <td bgcolor="#FFFFFF" class="divTblListTH"><div align="center"><?php //echo $totalperLoc; ?></div></td>
			  </tr> -->
			  <? } ?>
              </table></td>
		    </tr>
			<tr class="divTblListTR">
              <td><div align="right">Total Employee: &nbsp;&nbsp;</div></td>
              <td><div align="center"><a href="transaction.php?statpos=emp_masterfile"><?php echo $totalval; ?></a></div></td>
			</tr>
            <? }else{?>
            <tr class="divTblListTR2">
              <td colspan="2" class="divTblListTD style1">No record found </td>
            </tr>
            <? } ?>
          </table>
          
	  </div>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
    </table>
	</fieldset></td>
	
	<td valign="top" <?php IF (!$oData_number_of_dependent) { echo 'style="display:none;"'; } ?> <?php if ($_SESSION['admin_session_obj']['user_type']=='Report Master' or $_SESSION['admin_session_obj']['user_type']=='ADMIN MASTER' or $_SESSION['admin_session_obj']['user_type']=='LOAN MASTER' or $_SESSION['admin_session_obj']['user_type']=='Payroll Master' or $_SESSION['admin_session_obj']['user_type']=='ESS') { echo 'style="display:none;"'; } ?>>
	<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;">
	<h2 style="margin: 0 0 -5px 0;">Notification</h2>
	</fieldset>
	<fieldset class="themeFieldset01">
	<div class="divTblList">
          <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="EFFAFE">
            <tr>
			<td valign="middle" class="divTblListTH">&nbsp;Employee who's Dependent reached the Age Limit.</td>
              <td width="12%" align="center" valign="middle" class="divTblListTH"><!--List of Employee that has/have Dependent that reached the Age Limit.-->Total</td>
            </tr>
			<?php 
			foreach($oData_number_of_dependent as $key => $oData_birthday_dependent) {
				echo 
				'<tr class="divTblListTR">' . 
				'<td class="divTblListTD">' . 
				$oData_birthday_dependent['pi_fname'] . ' ' . $oData_birthday_dependent['pi_mname'] . ' ' . 
				$oData_birthday_dependent['pi_lname'] . 
				'<td class="divTblListTD">' . 
				'<div align="center"><a href="transaction.php?statpos=emp_masterfile&empinfo=' . $oData_birthday_dependent['emp_id'] . '#tab-9">' . 
				$oData_birthday_dependent['dependent_number'] . '</a></div>' . 
				'</td>' . 
            '</tr>';
			}
			?>
          </table>
	  </div>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
    </table>
	</fieldset></td>
	
	
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>