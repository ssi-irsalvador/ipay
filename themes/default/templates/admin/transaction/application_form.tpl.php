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
if(isset($eMsg)){
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
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" title="green">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>

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
?>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;}
</style>
<script type="text/javascript">

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#manage_comp").validate(
		{
			rules:
			{
				comp_code:{
					required:true
				},
				comp_name:{
					required:true
				},
				comp_zipcode:{
					number:true
				},
				comp_tel:{
					number:true
				},
				comp_email:{
					email:true
				},
				comp_prim_contc:{
					number:true
				},
				comp_tin:{
					number:true
				},
				comp_sss:{
					number:true
				},
				comp_phic:{
					number:true
				},
				comp_hdmf:{
					number:true
				},
				comp_priority:{
					number:true
				}
			},
			messages:
			{
				comp_code:"Please enter Company Code.",
				comp_name:"Please enter Company Name.",
				comp_zipcode:"Please enter a valid Zip Code.",
				comp_tel:"Please enter a valid Telephone Number.",
				comp_email:"Please enter a valid Email Address.",
				comp_prim_contc:"Please enter a valid Primary Contact Number.",
				comp_tin:"Please enter a valid TIN number.",
				comp_sss:"Please enter a valid SSS number.",
				comp_phic:"Please enter a valid PHIC number.",
				comp_hdmf:"Please enter a valid HDMF number.",
				comp_priority:"Please enter a valid Priority number."
			}
		}
	);
});
</script>






<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Application Form</legend>
<form method="post" name="empladd" id="empladd" onsubmit="return validate(this,'empl')" ENCTYPE="multipart/form-data">
<table width="921" border="0" cellpadding="2" cellspacing="1">
    <?php //printa($_SESSION['positionvalue']); ?>
    <tr>
      <td class="divTblTH_" width="14%" rowspan="4"><center>
      <div align="center"><img src="<?php if(isset($_GET['edit'])){ echo "transaction.php?statpos=application_form&amp;img=".$_GET['edit'];}else{echo SYSCONFIG_DEFAULT_IMAGES.'nopic.PNG';}?>" alt="" width="120" height="120" border="1" /></div>	</td>
      <td colspan="2" class="divTblTH_"><label>Application Date</label>
		  <input name="emrpi_appdate" id="emrpi_appdate" maxlength="10" <? if($oData['emrpi_appdate']) print "value=".$oData['emrpi_appdate'].""; else print "value=".date('Y-m-d');?> type="text" class="txtfields" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
          <a href="javascript:void(0);" class="option" onclick="return showCalendar('emrpi_appdate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a></td>
    </tr>
	 <tr>
	 <td colspan="2" class="divTblTH_"><label>Name<span class="needfield">*</span></label>
	   <input name="emrpi_fname" id="emrpi_fname" value="<?=$oData['emrpi_fname']?>" type="text" class="txtfields" />
	   <input name="emrpi_mname" id="emrpi_mname" value="<?=$oData['emrpi_mname']?>" type="text" class="txtfields" />
	   <input name="emrpi_lname" id="emrpi_lname" value="<?=$oData['emrpi_lname']?>" type="text" class="txtfields" /><br /><i style="font-size:8pt;color:#7a7a7a;">(First Name/Middle Name/Last Name)</i></td>
    </tr>
	 <tr>
	   <td colspan="2" class="divTblTH_"><label >Position<span class="needfield">*</span></label>
           <select name="post_id" id="post_id" class="longselect">
             <?=html_options2($position,$_SESSION['positionvalue'],'edit',$oData['post_id'])?>
           </select>
       <!--<input type="button" class="lib" value="..">-->       </td>
    </tr> 
	 
	 <tr>
      <td class="divTblTH_" colspan="100%"><label>Photo</label><input type="file" name="emrpi_picture" id="emrpi_picture">
		<em style="font-size:8pt;color:#7a7a7a">(10 x 10 gif, png, jpg/jpeg only.)</em></td>
    </tr>
	<tr style="background-color:#FAD163">
      <td colspan="100%"><strong>General Information</strong></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td width="36%" class="divTblTH_"><label >Gender<span class="needfield">*</span></label>
	  <input name="emrpi_gender" checked id="emrpi_gender1" type="radio" <?php if ($oData['emrpi_gender'] == 'Male') echo "checked"; ?> value="Male" />
		Male
		<input name="emrpi_gender" id="emrpi_gender2" type="radio" <?php if ($oData['emrpi_gender'] == 'Female') echo "checked"; ?> value="Female" />
	  Female	  </td>
      <td width="50%" class="divTblTH_">&nbsp;</td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label >Date of Birth<span class="needfield">*</span></label>
	  <input  name="emrpi_bdate" type="text" class="txtfields" id="emrpi_bdate" maxlength="10" <?php if($oData['emrpi_bdate']) print "value=".$oData['emrpi_bdate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
	   <img onclick="return showCalendar('emrpi_bdate','','emrpi_bdate','pi_age');" src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></td>
      <td class="divTblTH_">
        <label>Nationality</label>
        <select name="emrpi_nationality" id="emrpi_nationality" class="longselect" >
          <?=nationality($oData['emrpi_nationality']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Place of Birth</label><input name="emrpi_place_bdate" id="emrpi_place_bdate" value="<?=$oData['emrpi_place_bdate']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label></label>
        <label>Race</label>
        <select name="emrpi_race" id="emrpi_race" class="longselect">
          <?=race_($oData['emrpi_race']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Height</label>
        <input name="emrpi_height" id="emrpi_height" value="<?=$oData['emrpi_height']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Civil Status</label>
          <select name="emrpi_civil" id="emrpi_civil" class="longselect">
            <?=civil_status($oData['emrpi_civil']); ?>
          </select>      </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td class="divTblTH_"><label></label>
	    <label>Weight</label>
          <input name="emrpi_weight" id="emrpi_weight" value="<?=$oData['emrpi_weight']?>" type="text" class="txtfields" />	  </td>
	  <td class="divTblTH_"><label></label>
	    <label>Religion</label>
        <select name="emrpi_religion" id="emrpi_religion" class="longselect">
          <?=religion($oData['emrpi_religion']); ?>
        </select></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td colspan="2" class="divTblTH_"><label></label>
        <label>Blood Group</label>
      <select name="emrpi_bloodtype" id="emrpi_bloodtype" width="50px">
        <?=blood_type($oData['emrpi_bloodtype']); ?>
      </select>	  </td>
    </tr>
	<tr bgcolor="#FAD163">
      <td colspan="100%"><strong>Contact Information</strong></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_" colspan="2"><label><strong>Current Address</strong></label></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>Street</label>
      <input name="emrpi_add" id="emrpi_add" value="<?=$oData['emrpi_add']?>" type="text" class="longtxtfields"/></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_"><label>City/Province</label>
      <input name="province_name" id="province_name" value="<?=$oData['province_name']?>" type="text" class="txtfields_add" readonly/>
      <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupcity&popupadd=permaddress', 'searchwindow', '');">  -->
      <a id="popup" href="popup.php?statpos=popupcity&popupadd=permaddress">
      <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" alt="Search" title="Search" />
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
          <input name="zipcode" id="zipcode" value="<?=$oData['zipcode']?>" type="text" class="txtfields_add" /> 
          <a id="popup2" href="#" onclick="javascript:href='popup.php?statpos=popupzipcode&popupadd=permaddress&p_id_='+ document.getElementById('p_id').value;">
          <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" alt="Search" title="Search" /></a><input type="hidden" name="zipcode_id" id="zipcode_id" value="<?=$oData['zipcode_id']?>" /></td>
    </tr>
	
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Telephone #1</label><input name="emrpi_telone" id="emrpi_telone" value="<?=$oData['emrpi_telone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Telephone #2</label><input name="emrpi_teltwo" id="emrpi_teltwo" value="<?=$oData['emrpi_teltwo']?>" type="text" class="txtfields" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Mobile #1</label><input name="emrpi_mobileone" id="emrpi_mobileone" value="<?=$oData['emrpi_mobileone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Mobile #2</label><input name="emrpi_mobiletwo" id="emrpi_mobiletwo" value="<?=$oData['emrpi_mobiletwo']?>" type="text" class="txtfields" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>Email(primary)</label><input name="emrpi_emailone" id="emrpi_emailone" value="<?=$oData['emrpi_emailone']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Email(secondary)</label><input name="emrpi_emailtwo" id="emrpi_emailtwo" value="<?=$oData['emrpi_emailtwo']?>" type="text" class="txtfields" /></td>
    </tr>
<tr bgcolor="#FAD163">
      <td colspan="100%"><strong>Government Information</strong></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>TIN #</label> 
	  <input name="tin[]" id="tin1" value="<?=$oData['emrpi_tin'][0]?>" type="text" maxlength="3" size="3"
	  onkeypress="autotab(this,'tin2')" class="txtstatutory" />
	  -
	  <input name="tin[]" id="tin2" value="<?=$oData['emrpi_tin'][1]?>" type="text" maxlength="3" size="3" 
	  onkeypress="autotab(this,'tin3')" class="txtstatutory" />
	  -
	  <input name="tin[]" id="tin3" value="<?=$oData['emrpi_tin'][2]?>" type="text" maxlength="3" size="3" class="txtstatutory" /></td>
      <td class="divTblTH_"><label>SSS #</label>
	  <input name="sss[]" id="sss[]" value="<?=$oData['emrpi_sss'][0]?>" type="text" maxlength="2" size="2"
	  onkeypress="autotab(this,'sss2')" class="txtstatutory" />
	  -
	  <input name="sss[]" id="sss2" value="<?=$oData['emrpi_sss'][1]?>" type="text" maxlength="7" size="7"  
	  onkeypress="autotab(this,'sss3')" class="txtstatutory" />
	  -
	  <input name="sss[]" id="sss3" value="<?=$oData['emrpi_sss'][2]?>" type="text" maxlength="1" size="1" class="txtstatutory" /></td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>PHIC #</label>
	   <input name="phic[]" id="phic1" value="<?=$oData['emrpi_phic'][0]?>" type="text" maxlength="2" size="2"
	   onkeypress="autotab(this,'phic2')" style="height:15;font-size:11px;" />
	  -
	  <input name="phic[]" id="phic2" value="<?=$oData['emrpi_phic'][1]?>" type="text" maxlength="9" size="9"  onkeypress="autotab(this,'phic3')" style="height:15;font-size:11px;" />
		-
	  <input name="phic[]" id="phic3" value="<?=$oData['emrpi_phic'][2]?>" type="text" maxlength="1" size="1" style="height:15;font-size:11px;" />	  </td>
      <td class="divTblTH_"><label>HDMF #</label>
	  <input name="hdmf[]" id="hdmf1" value="<?=$oData['emrpi_hdmf'][0]?>" type="text" maxlength="4" size="4"
	  onkeypress="autotab(this,'hdmf2')" style="height:15;font-size:11px;" />
	  -
	  <input name="hdmf[]" id="hdmf2" value="<?=$oData['emrpi_hdmf'][1]?>" type="text" maxlength="4" size="4" 
	  onkeypress="autotab(this,'hdmf3')" style="height:15;font-size:11px;" />
	 -
	  <input name="hdmf[]" id="hdmf3" value="<?=$oData['emrpi_hdmf'][2]?>" type="text" maxlength="4" size="4" style="height:15;font-size:11px;" />	  </td>
    </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><label>NHMFC #</label>
        <input name="emrpi_nhmfc" id="emrpi_nhmfc" value="<?=$oData['emrpi_nhmfc']?>" type="text" class="txtfields" /></td>
      <td class="divTblTH_"><label>Passport #</label><input name="emrpi_passport" id="emrpi_passport" value="<?=$oData['emrpi_passport']?>" type="text" class="txtfields" /></td>
    </tr>
	
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	  <td colspan="2" class="divTblTH_">&nbsp;</td>
	  </tr>
	<tr>
	  <td colspan="3" class="divTblTH_" style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
	  </tr>
	<tr>
	  <td class="divTblTH_">&nbsp;</td>
	   <td colspan="2" class="divTblTH_"><input name="save" id="save" value="Save" type="submit" class="button_"/>
      <input type="button" name="Reset" value="Reset" class="buttonstyle" onclick="jqResetForm('empladd')" />
      <input name="button" type="button" class="button_" onclick="window.location='?statpos=emp_masterfile';" value="Cancel"/>
      <br />
      <br /><?php if($_GET['edit'])print "<input type='hidden' name='pi_id' value='".$_GET['edit']."'>";?></td>
    </tr>
</table>
</form>
<script>
	function autotab(original,destination){
		if (original.getAttribute&&original.value.length==original.getAttribute("maxlength"))
				document.getElementById(destination).focus();
		}
</script>
</fieldset>
</div>