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
$(document).ready(function() {
	$("#popup2").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
function acceptValidNumbersOnly(obj,e) {
			var key='';
			var strcheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+=`{}[]:\";'\|/?,><\\ ";
			var whichcode = (window.Event) ? e.which : e.keyCode;
			try{
			if(whichcode == 13 || whichcode == 8)return true;
			key = String.fromCharCode(whichcode);
			if(strcheck.indexOf(key) != -1)return false;
			return true;
			}catch(e){;}
}
</script>

<?php 
$tin = explode("-", $oData['pi_tin']);
$sss = explode("-", $oData['pi_sss']);
$phic = explode("-", $oData['pi_phic']);
$hdmf = explode("-", $oData['pi_hdmf']);
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
<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"></script>

<script type="text/javascript" src="<?=$themeJQueryPath?>ui/ui.core.js"></script>
<script type="text/javascript" src="<?=$themeJQueryPath?>ui/ui.datepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('#tks_startdate').datepicker({
			changeMonth: true,
			changeYear: true,
            dateFormat: 'yy-mm-dd'
		});
	});
	</script>
<br />
<?php
//printa($_SESSION['admin_session_obj']['user_data']['user_name']);
//printa($departments);
//printa($_SESSION['deptvalue']);
//printa($oData);
$source = ((empty($oData['emp_picture'])) ? SYSCONFIG_DEFAULT_IMAGES."nopic.PNG" : "data:image/jpeg;base64,".base64_encode($oData['emp_picture']));
?>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<form method="POST" name="empladd" onsubmit="return validate(this,'empl')" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="2" cellspacing="1">
    <tr>
      <td class="divTblTH_" width="14%" rowspan="8" valign="top"><center>
	<div align="center"><img src="<?= $source?>" alt="" width="120" height="120" border="1" /></div>	</td>
      <td class="divTblTH_"><label>Employee No.<span class="needfield">*</span></label>
        <input name="emp_idnum" id="emp_idnum" value="<?=$oData['emp_idnum']?>" type="text" class="txtfields" /></td>
    </tr>
	 <tr>
	 <td colspan="2" class="divTblTH_"><label >Employee Name<span class="needfield">*</span></label><input name="pi_fname" id="pi_fname" value="<?=$oData['pi_fname']?>" type="text" class="txtfields" />
	   <label></label>
	   <input name="pi_mname" id="pi_mname" value="<?=$oData['pi_mname']?>" type="text" class="txtfields" />
	   <input name="pi_lname" id="pi_lname" value="<?=$oData['pi_lname']?>" type="text" class="txtfields" /><br /><i style="font-size:8pt;color:#7a7a7a">(First Name/Middle Name/Last Name)</i></td>
    </tr>
	 <tr>
	 <td width="34%" class="divTblTH_"><label>Company<span class="needfield">*</span></label>
	  <select name="comp_id" id="comp_name" class="longselect">
	  <?=html_options2($comp,$_SESSION['compvalue'],'edit',$oData['comp_id'],'company_info')?>	
	  </select>
	  <!--<input type="button" value="..." class="lib" onclick="javascript: openwindow('popup.php?statpos=popupcomp', '', '');">-->	  </td>
	   <td width="52%" class="divTblTH_"><label >Job Position<span class="needfield">*</span></label>
	   <select name="post_id" id="post_id" class="longselect">
	  <?=html_options2($position,$_SESSION['positionvalue'],'edit',$oData['post_id'])?>	
	  </select>
	  <!--<input type="button" class="lib" value="..">-->	  </td>
    </tr>
    <tr colspan="2">
	 <td width="34%" class="divTblTH_"><label>Location<span class="needfield"></span></label>
	  <select name="branchinfo_id" id="branchinfo_id" class="longselect">
	  <?=html_options3($branch,'branchinfo_id','branchinfo_name',$oData['branchinfo_id'],'branchinfo_id')?>	
	  </select> 
	  </td>
    </tr> 
	<tr>
	 <td class="divTblTH_"><label>Department<span class="needfield">*</span></label>
	  <select name="ud_id" id="ud_id" class="longselect">
	  <?=html_options2($departments,$_SESSION['deptvalue'],'edit',$oData['ud_id'],'ud_name')?>
	  </select>
	   <!--<input type="button" value=".." class="lib" onclick="javascript: openwindow('popup.php?statpos=popupdepart', '', '');">-->	 </td>
      
	 
      <td class="divTblTH_"><label>Type<span class="needfield">*</span></label>
	  <select name="emptype_id" id="emptype_id" class="longselect">
	  <?=html_options2($emptype,$_SESSION['emptypevalue'],'edit',$oData['emptype_id'])?>	
	  </select>
	  
	  <!--<input type="button" class="lib" value="..">-->	  </td>
    </tr>
	<tr>
      <td class="divTblTH_"><label>Category<span class="needfield">*</span></label>
	  <select name="empcateg_id" id="empcateg_id" class="longselect">
	  <?=html_options2($empcateg,$_SESSION['empcategvalue'],'edit',$oData['empcateg_id'],'emp_category')?>
	  </select>
	    <!--<input type="button" value=".." class="lib" onclick="javascript: openwindow('popup.php?statpos=popupcateg', '', '');">-->	  </td>
     
	  <td class="divTblTH_"><label>Hire Date<span class="needfield">*</span></label><input  name="emp_hiredate" type="text" class="txtfields" id="emp_hiredate" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['emp_hiredate']) print "value=".$oData['emp_hiredate'].""; else print "value=".date('Y-m-d');?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
        <a href="javascript:void(0);" class="option" onclick="return showCalendar('emp_hiredate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
	</tr>
	<tr>
      <td class="divTblTH_"><label>Status<span class="needfield">*</span></label>
	  <select name="emp_stat" id="emp_stat" class="longselect">
	  <?=html_options3($empstat_,'emp201status_id','emp201status_name',$oData['emp_stat'],'emp_stat')?>
	  </select>
	    <!--<input type="button" value=".." class="lib" onclick="javascript: openwindow('popup.php?statpos=popupcateg', '', '');">-->	  </td>
	  <td class="divTblTH_"><label>Resigned Date<span class="needfield">*</span></label><input  name="emp_resigndate" type="text" class="txtfields" id="emp_resigndate" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData['emp_resigndate']) print "value=".$oData['emp_resigndate'].""; else print "value=".date('Y-m-d');?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
        <a href="javascript:void(0);" class="option" onclick="return showCalendar('emp_resigndate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
	</tr>
	 <tr>
      <td class="divTblTH_" colspan="100%"><label>Photo</label>
        <input type="file" value="Upload Photo" size="30" name="emp_picture" id="emp_picture" />
		<em style="font-size:8pt;color:#7a7a7a">(10 x 10 gif, png, jpg/jpeg only.)</em></td>
    </tr>
	<tr style="background-color:#FAD163">
      <td colspan="100%"><b>General Information</b></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label >Gender<span class="needfield">*</span></label>
	  <input name="pi_gender" checked id="pi_gender1" type="radio" <?php if ($oData['pi_gender'] == 'Male') echo "checked"; ?> value="Male" />
		Male
		<input name="pi_gender" id="pi_gender2" type="radio" <?php if ($oData['pi_gender'] == 'Female') echo "checked"; ?> value="Female" />
		Female	  </td>
      <td class="divTblTH_">&nbsp;</td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label >Date of Birth<span class="needfield">*</span></label>
	  <input name="pi_bdate" type="text" class="txtfields" id="pi_bdate" onchange="getAge('pi_bdate','pi_age');dateFormat(this.value, "yyyy-mm-dd") maxlength="10" <? if($oData['pi_bdate']) print "value=".$oData['pi_bdate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
	   <img onclick="return showCalendar('pi_bdate','','pi_bdate','pi_age');" src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" style="cursor:pointer;" /></td>
      <td class="divTblTH_">
        <label>Nationality</label>
        <select name="pi_nationality" id="pi_nationality" class="longselect" >
          <?=nationality($oData['pi_nationality']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Place of Birth</label><input name="pi_place_bdate" id="pi_place_bdate" value="<?=$oData['pi_place_bdate']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label></label>
        <label>Race</label>
        <select name="pi_race" id="pi_race" class="longselect">
          <?=race_($oData['pi_race']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Height</label>
          <input name="pi_height" id="pi_height" value="<?=$oData['pi_height']?>" type="text" class="txtfields" />      </td>
      <td class="divTblTH_"><label>Civil Status</label>
          <select name="pi_civilstat" id="pi_civilstat" class="longselect">
            <?=civil_status($oData['pi_civilstat']); ?>
          </select>
      </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_"><label></label>
	    <label>Weight</label>
          <input name="pi_weight" id="pi_weight" value="<?=$oData['pi_weight']?>" type="text" class="txtfields" />	  </td>
	  <td class="divTblTH_"><label></label>
	    <label>Religion</label>
        <select name="pi_religion" id="pi_religion" class="longselect">
          <?=religion($oData['pi_religion']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" class="divTblTH_"><label></label>
        <label>Blood Group</label>
      <select name="pi_bloodtype" id="pi_bloodtype" width="50px">
        <?=blood_type($oData['pi_bloodtype']); ?>
      </select>	  </td>
    </tr>
	<tr bgcolor="#FAD163">
      <td colspan="100%"><b>Contact Information</td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_" colspan="2"><label><strong>Current Address</strong></label></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>Street </label>
      <input name="pi_add" id="pi_add" value="<?=$oData['pi_add']?>" type="text" class="longtxtfields"/></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>City/Province</label>
      <input name="province_name" id="province_name" value="<?=$oData['province_name']?>" type="text" class="txtfields_add" readonly/>
      <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupcity&popupadd=permaddress', 'searchwindow', '');"> -->
      <a id="popup" href="popup.php?statpos=popupcity&popupadd=permaddress">
      <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" />
      <input type="hidden" name="p_id" id="p_id" value="<?=$oData['p_id']?>" />
      </a></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>Region</label>
          <input name="region_name" id="region_name" value="<?=$oData['region_name']?>" type="text" class="txtfields_add" readonly />	  </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>Country</label>
          <input name="cou_description" id="cou_description" value="<?=$oData['cou_description']?>" type="text" class="txtfields_add" readonly />	  </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>Postal Zip Code</label>
          <input name="zipcode" id="zipcode" value="<?=$oData['zipcode']?>" type="text" class="txtfields_add" readonly="readonly" /> 
          <a id="popup2" href="#" onclick="javascript:href='popup.php?statpos=popupzipcode&amp;popupadd=permaddress&amp;p_id_='+ document.getElementById('p_id').value;"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a><input type="hidden" name="zipcode_id" id="zipcode_id" value="<?=$oData['zipcode_id']?>"/></td>
    </tr>
	
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Telephone #1</label><input name="pi_telone" id="pi_telone" value="<?=$oData['pi_telone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Telephone #2</label><input name="pi_teltwo" id="pi_teltwo" value="<?=$oData['pi_teltwo']?>" type="text" class="txtfields" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Mobile #1</label><input name="pi_mobileone" id="pi_mobileone" value="<?=$oData['pi_mobileone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Mobile #2</label><input name="pi_mobiletwo" id="pi_mobiletwo" value="<?=$oData['pi_mobiletwo']?>" type="text" class="txtfields" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Email(primary)</label><input name="pi_emailone" id="pi_emailone" value="<?=$oData['pi_emailone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Email(secondary)</label><input name="pi_emailtwo" id="pi_emailtwo" value="<?=$oData['pi_emailtwo']?>" type="text" class="txtfields" /></td>
    </tr>
<tr bgcolor="#FAD163">
      <td colspan="100%"><strong>Government Information</strong></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>TIN #</label> 
	  <input name="tin[]" id="tin1" value="<?=$tin[0]?>" type="text" maxlength="3" size="3"
	  onkeypress="autotab(this,'tin2')" class="txtstatutory" />
	  -
	  <input name="tin[]" id="tin2" value="<?=$tin[1]?>" type="text" maxlength="3" size="3" 
	  onkeypress="autotab(this,'tin3')" class="txtstatutory" />
	  -
	  <input name="tin[]" id="tin3" value="<?=$tin[2]?>" type="text" maxlength="3" size="3" class="txtstatutory" /></td>
      <td class="divTblTH_"><label>SSS #</label>
	  <input name="sss[]" id="sss[]" value="<?=$sss[0]?>" type="text" maxlength="2" size="2"
	  onkeypress="autotab(this,'sss2')" class="txtstatutory" />
	  -
	  <input name="sss[]" id="sss2" value="<?=$sss[1]?>" type="text" maxlength="7" size="7"  
	  onkeypress="autotab(this,'sss3')" class="txtstatutory" />
	  -
	  <input name="sss[]" id="sss3" value="<?=$sss[2]?>" type="text" maxlength="1" size="1" class="txtstatutory" />	  </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>PHIC #</label>
	   <input name="phic[]" id="phic1" value="<?=$phic[0]?>" type="text" maxlength="2" size="2"
	   onkeypress="autotab(this,'phic2')">
	  -
	  <input name="phic[]" id="phic2" value="<?=$phic[1]?>" type="text" maxlength="9" size="9"  onkeypress="autotab(this,'phic3')"/>
		-
	  <input name="phic[]" id="phic3" value="<?=$phic[2]?>" type="text" maxlength="1" size="1" />	  </td>
      <td class="divTblTH_"><label>HDMF #</label>
	  <input name="hdmf[]" id="hdmf1" value="<?=$hdmf[0]?>" type="text" maxlength="4" size="4"
	  onkeypress="autotab(this,'hdmf2')" />
	  -
	  <input name="hdmf[]" id="hdmf2" value="<?=$hdmf[1]?>" type="text" maxlength="4" size="4" 
	  onkeypress="autotab(this,'hdmf3')" />
	 -
	  <input name="hdmf[]" id="hdmf3" value="<?=$hdmf[2]?>" type="text" maxlength="4" size="4" />	  </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>NHMFC #</label>
        <input name="pi_nhmfc" id="pi_nhmfc" value="<?=$oData['pi_nhmfc']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Passport #</label><input name="pi_passport" id="pi_passport" value="<?=$oData['pi_passport']?>" type="text" class="txtfields" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" class="divTblTH_"><label>Tax Exemption<span class="needfield">*</span></label>
	   <select name="taxep_id" id="taxep_id" class="longselect">
	  <?=html_options2($taxep,$_SESSION['taxepvalue'],'edit',$oData['taxep_id'])?>	
	  </select></td>
    </tr>
	<?php if ($_GET['201filereview'] == yes) {exit;}?>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	   <td colspan="2" class="divTblTH_"><input name="save" id="save" value="&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;" type="submit" class="buttonstyle" />
      <input name="reset" id="reset" value="&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;" type="reset" class="buttonstyle"/>
      <input name="button" type="button" class="buttonstyle" onclick="window.location='?statpos=emp_masterfile';" value="&nbsp;&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;&nbsp;"/>
      <br />
      <br />	  </td>
    </tr>
</table>
<?php if($_GET['edit'])print "<input type='hidden' name='pi_id' value='".$_GET['edit']."'>";?>
</form>
<script>
	function autotab(original,destination){
		if (original.getAttribute&&original.value.length==original.getAttribute("maxlength"))
				document.getElementById(destination).focus();
		} 

</script>
</fieldset>
</div>
	<!--<fieldset class="themeFieldset01_notopborder">
	<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2"><?php //$tblDataList?></td>
    </tr>
  </table>
</fieldset>-->