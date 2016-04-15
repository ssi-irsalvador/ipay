
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Employee Master File Form</legend>
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
<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/>
</script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/>
</script>
<script type="text/javascript">  
function autotab(original,destination){
		if (original.getAttribute&&original.value.length==original.getAttribute("maxlength"))
				destination.focus()
		}  

function agecomp(){
		
	
}		
</script>				
<form method="post" action="" name="frmapp">

  <table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr class="divTblTH_">
      <td colspan="2" rowspan="5" align="center"><table width="388" border="0" align="center" cellpadding="2" cellspacing="1">
        <tr>
          <td width="102"><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'admin/NoPhotoAvailable.jpg'?>" alt="" width="100" height="100" border="1" /></td>
          <td width="275">Upload Picture<br />
              <input type="file" name="emp_picture" id="emp_picture" />
              <input type="submit" name="Submit3" value="Upload" class="buttonstyle" /></td>
        </tr>
      </table></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="20%" class="divTblTH_">Employee No. <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="emp_idnum" id="emp_idnum" value="<?=$oData['emp_idnum']?>" type="text" class="txtfields" />
        <input type="hidden" name="pi_id" id="pi_id" value="<?=$oData['pi_id']?>" /></td>
    </tr>
    
    <tr>
      <td class="divTblTH_">Last Name <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="pi_lname" id="pi_lname" value="<?=$oData['pi_lname']?>" type="text" class="txtfields" /></td>
    </tr>
    <tr>
      <td class="divTblTH_">First Name <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="pi_fname" id="pi_fname" value="<?=$oData['pi_fname']?>" type="text" class="txtfields"/></td>
    </tr>
    <tr>
      <td class="divTblTH_">Middle Name <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="pi_mname" id="pi_mname" value="<?=$oData['pi_mname']?>" type="text" class="txtfields" /></td>
    </tr>
    <tr>
      <td width="17%" class="divTblTH_">Job Position <span class="needfield">*</span></td>
      <td width="32%" class="divTblTH_"><input name="post_name" id="post_name" value="<?=$oData['post_name']?>" type="text" class="txtfields">
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom"/></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupjobpost', 'post_name', '');"><input type="hidden" name="post_id" id="post_id" value="<?=$oData['post_id']?>" />
</a></td>
      <td width="20%" valign="top" class="divTblTH_">Type <span class="needfield">*</span></td>
      <td width="31%" valign="top" class="divTblTH_"><input name="emptype_name" id="emptype_name" value="<?=$oData['emptype_name']?>" type="text" class="txtfields" />
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popuptype', 'emptype_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" /></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popuptype', 'emptype_name', '');">
        <input type="hidden" name="emptype_id" id="emptype_id" value="<?=$oData['emptype_id']?>" />
        </a></td>
    </tr>
    <tr>
      <td class="divTblTH_">Department <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="ud_name" id="ud_name" value="<?=$oData['ud_name']?>" type="text" class="txtfields">
	    <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" /></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupdepart', 'ud_name', '');"><input type="hidden" name="ud_id" id="ud_id" value="<?=$oData['ud_id']?>"></a></td>
      <td width="20%" valign="top" class="divTblTH_">Category <span class="needfield">*</span></td>
      <td width="31%" valign="top" class="divTblTH_"><input name="empcateg_name" id="empcateg_name" value="<?=$oData['empcateg_name']?>" type="text" class="txtfields" />
        <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupcateg', 'empcateg_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" />
        <input type="hidden" name="empcateg_id" id="empcateg_id" value="<?=$oData['empcateg_id']?>" />
        </a>
	</td>
    </tr>
    <tr>
      <td class="divTblTH_">Company <span class="needfield">*</span></td>
      <td class="divTblTH_"><input name="comp_name" id="comp_name" value="<?=$oData['comp_name']?>" type="text" class="txtfields">
    <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupcomp', 'comp_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" /></a><a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupcomp', 'comp_name', '');"><input type="hidden" name="comp_id" id="comp_id" value="<?=$oData['comp_id']?>"></a></td>
      <td width="20%" valign="top" class="divTblTH_">Hire Date <span class="needfield">*</span></td>
      <td width="31%" valign="top" class="divTblTH_"><input name="emp_hiredate" id="emp_hiredate" value="<?=$oData['emp_hiredate']?>" type="text" class="txtfields" />
        <a href="javascript:void(0);" class="option" onclick="return showCalendar('emp_hiredate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_">&nbsp;</td>
      <td width="20%" valign="top" class="divTblTH_">&nbsp;</td>
      <td width="31%" valign="top" class="divTblTH_">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr class="divTblTH_">
          <td colspan="4" bgcolor="#CCCCCC"><em><strong>General Information</strong></em></td>
          </tr>
        <tr class="divTblTH_">
          <td width="17%">Gender <span class="needfield">*</span></td>
          <td width="32%"><input name="pi_gender" id="pi_gender1" type="radio" <?php if ($oData['pi_gender'] == 'Male') echo "checked"; ?> value="Male" />
Male
  <input name="pi_gender" id="pi_gender2" type="radio" <?php if ($oData['pi_gender'] == 'Female') echo "checked"; ?> value="Female" />
Female</td>
          <td width="20%">&nbsp;</td>
          <td width="31%">&nbsp;</td>
        </tr>
        <tr class="divTblTH_">
          <td>Date of Birth <span class="needfield">*</span></td>
          <td><input type="text" name="pi_bdate" id="pi_bdate" class="txtfields" value="<?=$oData['pi_bdate']?>" onchange="agecomp();" />
            <a href="javascript:void(0);" class="option" onclick="return showCalendar('pi_bdate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
          <td>Age</td>
          <td><input name="age" type="text" id="age" value="" size="2" maxlength="2" readonly="true"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Place of Birth </td>
          <td><input type="text" name="pi_place_bdate" id="pi_place_bdate" value="<?=$oData['pi_place_bdate']?>" class="txtfields"/></td>
          <td>Nationality</td>
          <td><input type="text" name="pi_nationality" id="pi_nationality" value="<?=$oData['pi_nationality']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Religion</td>
          <td><input type="text" name="pi_religion" id="pi_religion" value="<?=$oData['pi_religion']?>" class="txtfields"/></td>
          <td>Race</td>
          <td><input type="text" name="pi_race" id="pi_race" value="<?=$oData['pi_race']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Height </td>
          <td><input type="text" name="pi_height" id="pi_height" value="<?=$oData['pi_height']?>"class="txtfields"/></td>
          <td>Weight</td>
          <td><input type="text" name="pi_weight" id="pi_weight" value="<?=$oData['pi_weight']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Blood Group </td>
          <td><input type="text" name="pi_bloodtype" id="pi_bloodtype" value="<?=$oData['pi_bloodtype']?>" class="txtfields"/></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      </tr>
    <tr>
      <td colspan="4"><table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC"><em><strong>Contact Information </strong></em></td>
          </tr>
        <tr class="divTblTH_">
          <td width="17%" >Address</td>
          <td colspan="3"><input name="pi_add" type="text" id="pi_add" value="<?=$oData['pi_add']?>" size="103" /></td>
          </tr>
        <tr class="divTblTH_">
          <td>Tel1</td>
          <td width="32%"><input type="text" name="pi_telone" id="pi_telone" value="<?=$oData['pi_telone']?>" class="txtfields"/></td>
          <td width="20%">Tel2 </td>
          <td width="31%"><input type="text" name="pi_teltwo" id="pi_teltwo" value="<?=$oData['pi_teltwo']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>mobile1</td>
          <td><input type="text" name="pi_mobileone" id="pi_mobileone" value="<?=$oData['pi_mobileone']?>" class="txtfields"/></td>
          <td>mobile2</td>
          <td><input type="text" name="pi_mobiletwo" id="pi_mobiletwo" value="<?=$oData['pi_mobiletwo']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Email1</td>
          <td><input type="text" name="pi_emailone" id="pi_emailone" value="<?=$oData['pi_emailone']?>" class="txtfields"/></td>
          <td>Email2</td>
          <td><input type="text" name="pi_emailtwo" id="pi_emailtwo" value="<?=$oData['pi_emailtwo']?>" class="txtfields"/></td>
        </tr>
        
      </table></td>
      </tr>    
    <tr>
      <td colspan="4"><table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC"><em><strong>Government Information </strong></em></td>
          </tr>
        <tr class="divTblTH_">
          <td width="17%">TIN</td>
          <td width="32%">
<input name="pi_tin[]" type="text" id="pi_tin[]" value="<?=$oData['pi_tin'][0]?>" size="4" onkeyup="autotab(this,document.frmapp.pi_tin2)" maxlength="3" />
-
<input name="pi_tin[]" id="pi_tin2" size="4" maxlength="3"  value="<?=$oData['pi_tin'][1]?>" type="text" onkeyup="autotab(this,document.frmapp.pi_tin3)" />
-
<input name="pi_tin[]" id="pi_tin3" size="3" maxlength="3"  value="<?=$oData['pi_tin'][2]?>"  type="text" /></td>
          <td width="20%">SSS No. </td>
          <td width="31%"><input name="pi_sss[]" type="text" id="pi_sss[]" value="<?=$oData['pi_sss'][0]?>" size="2"  onkeyup="autotab(this,document.frmapp.pi_sss2)" maxlength="2" />
						  -
						  <input name="pi_sss[]" id="pi_sss2" size="7" maxlength="7" value="<?=$oData['pi_sss'][1]?>" type="text" onkeyup="autotab(this,document.frmapp.pi_sss3)" />
						  -
						  <input name="pi_sss[]" id="pi_sss3" size="1" maxlength="1" value="<?=$oData['pi_sss'][2]?>" type="text" /></td>
        </tr>
        <tr class="divTblTH_">
          <td>PHIC No.</td>
          <td><input name="pi_phic[]" type="text" id="pi_philhealthno[]" value="<?=$oData['pi_phic'][0]?>" size="4" maxlength="2" onkeyup="autotab(this,document.frmapp.pi_philhealthno2)" />
-
<input name="pi_phic[]" size="9" maxlength="9" id="pi_philhealthno2"  value="<?=$oData['pi_phic'][1]?>" type="text"  onkeyup="autotab(this,document.frmapp.pi_philhealthno3)"/>
-
<input name="pi_phic[]" size="1" maxlength="1" value="<?=$oData['pi_phic'][2]?>" id="pi_philhealthno3" type="text"></td>
          <td>HDMF No. </td>
          <td><input name="pi_hdmf[]" type="text" value="<?=$oData['pi_hdmf'][0]?>" size="4" maxlength="4" onkeyup="autotab(this,document.frmapp.pi_pagibigno2)" />
-
<input name="pi_hdmf[]" id="pi_pagibigno2" size="4" maxlength="4"  value="<?=$oData['pi_hdmf'][1]?>" type="text" onkeyup="autotab(this,document.frmapp.pi_pagibigno3)" />
-
<input name="pi_hdmf[]" id="pi_pagibigno3" size="2" maxlength="2" value="<?=$oData['pi_hdmf'][2]?>"  type="text" /></td>
        </tr>
        <tr class="divTblTH_">
          <td>NHMFC No </td>
          <td><input type="text" name="pi_nhmfc" id="pi_nhmfc" value="<?=$oData['pi_nhmfc']?>" class="txtfields"/></td>
          <td>Passport No </td>
          <td><input type="text" name="pi_passport" id="pi_passport" value="<?=$oData['pi_passport']?>" class="txtfields"/></td>
        </tr>
        <tr class="divTblTH_">
          <td>Tax Exemption </td>
          <td><input name="taxep_name" id="taxep_name" value="<?=$oData['taxep_name']?>" type="text" class="txtfields" />
            <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popuptaxep', 'taxep_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" /><input type="hidden" name="taxep_id" id="taxep_id" value="<?=$oData['taxep_id']?>" /></a></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        
        
      </table></td>
      </tr>
    
    <tr class="divTblTH_">
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td colspan="3" bgcolor="#CCCCCC"><input type="submit" name="Submit" value="Save & Exit" class="buttonstyle">
        <input type="reset" name="Submit2" value="Reset" class="buttonstyle"></td>
      </tr>
  </table>
</form>
</fieldset>
</div>