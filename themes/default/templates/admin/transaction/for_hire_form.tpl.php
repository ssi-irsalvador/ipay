<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
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
<legend class="themeLegend01">For Hire Form</legend>
<form method="post" action="">
<table width="921" border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td class="divTblTH_" width="14%" rowspan="5"><center>
        <div align="center"><img src="<?php if(isset($_GET['edit'])){ echo "transaction.php?statpos=application_form&amp;img=".$_GET['edit'];}else{echo SYSCONFIG_DEFAULT_IMAGES.'nopic.PNG';}?>" alt="" width="120" height="120" border="1" /></div>	</td>
        <td colspan="2" class="divTblTH_"><div align="right"><a href="transaction.php?statpos=application_form&edit=<?=$_GET['edit']?>" class="button_">View Application Form </a></div></td>
      </tr>
      <tr>
      <td colspan="2" class="divTblTH_"><label class="longlabel">Application Date</label>
		  <input name="emrpi_appdate" id="emrpi_appdate" maxlength="10" <? if($oData['emrpi_appdate']) print "value=".$oData['emrpi_appdate'].""; else print "value=".date('Y-m-d');?> type="text" class="txtfields" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/></td>
    </tr>
	 
	  <tr>
	    <td colspan="2" class="divTblTH_"><label class="longlabel">Hire Date <span class="needfield">*</span></label>
          <input name="emp_hiredate" id="emp_hiredate" maxlength="10" <? if($oData['emp_hiredate']) print "value=".$oData['emp_hiredate'].""; else print "value=".date('Y-m-d');?> type="text" class="txtfields" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onkeydown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
          <a href="javascript:void(0);" class="option" onclick="return showCalendar('emp_hiredate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
      </tr>
	  <tr>
	   <td colspan="2" class="divTblTH_"><label class="longlabel">Employee No.<span class="needfield">*</span></label><input name="emp_idnum" id="emp_idnum" value="<?=$oData['emp_idnum']?>" type="text" class="txtfields" /></td>
      </tr>
	 <tr>
	 <td colspan="2" valign="top" class="divTblTH_"><label class="longlabel">Name<span class="needfield">*</span></label>
	   <input name="emrpi_fname" id="emrpi_fname" value="<?=$oData['emrpi_fname']?>" type="text" class="txtfields" />
	   <input name="emrpi_mname" id="emrpi_mname" value="<?=$oData['emrpi_mname']?>" type="text" class="txtfields" />
	   <input name="emrpi_lname" id="emrpi_lname" value="<?=$oData['emrpi_lname']?>" type="text" class="txtfields" /><br /><i style="font-size:8pt;color:#7a7a7a;">(First Name/Middle Name/Last Name)</i></td>
    </tr>
	  
	<tr style="background-color:#FAD163">
      <td colspan="100%"><b> Company Information</b></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_" style="left-padding:20px;">&nbsp;</td>
	  <td class="divTblTH_">&nbsp;</td>
	  </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td width="40%" class="divTblTH_" style="left-padding:20px;"><label class="longlabel">Position <span class="needfield">*</span></label>
          <select name="post_id" id="post_id" class="longselect">
            <?=html_options2($position,$_SESSION['positionvalue'],'edit',$oData['post_id'])?>
        </select></td>
      <td width="50%" class="divTblTH_"><label class="longlabel">Department <span class="needfield">*</span></label>
          <select name="ud_id" id="ud_id" class="longselect">
            <?=html_options2($departments,$_SESSION['deptvalue'],'edit',$oData['ud_id'])?>
        </select></td>
	</tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label class="longlabel">Company <span class="needfield">*</span></label>
          <select name="comp_id" id="comp_id" class="longselect">
            <?=html_options2($comp,$_SESSION['compvalue'],'edit',$oData['comp_id'])?>
        </select></td>
      <td class="divTblTH_"><label class="longlabel">Type <span class="needfield">*</span></label>
          <select name="emptype_id" id="emptype_id" class="longselect">
            <?=html_options2($emptype,$_SESSION['emptypevalue'],'edit',$oData['emptype_id'])?>
        </select></td>
	</tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label class="longlabel">Category <span class="needfield">*</span></label>
          <select name="empcateg_id" id="empcateg_id" class="longselect">
            <?=html_options2($empcateg,$_SESSION['empcategvalue'],'edit',$oData['empcateg_id'])?>
        </select></td>
      <td class="divTblTH_"><label class="longlabel">Tax Exemption <span class="needfield">*</span></label>
	   <select name="taxep_id" id="taxep_id" class="longselect">
	  <?=html_options2($taxep,$_SESSION['taxepvalue'],'edit',$oData['taxep_id'])?>	
	  </select></td>
	</tr>
	

	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_">&nbsp;</td>
	  </tr>
	
	<tr>
	  <td class="divTblTH_" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
	  <td class="divTblTH_" style="color:#CCFF66; border-top: 1px solid"><input name="save" id="save" value="Hired & Exit" type="submit" class="buttonstyle" onclick="return confirm('Are you sure, you want to hired this person?');"/>
	    <input name="button" type="button" class="buttonstyle" onclick="window.location='?statpos=for_hire';" value="Cancel"/>
	    <?php if($_GET['edit'])print "<input type='hidden' name='pi_id' value='".$_GET['edit']."'>";?></td>
	  <td class="divTblTH_" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
	  </tr>
</table>
</form>
</fieldset>
</div>