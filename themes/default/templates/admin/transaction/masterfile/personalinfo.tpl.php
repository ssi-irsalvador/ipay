<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
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
<div id="tab-1" name="Personal Information" style="width:310; height:100%;">
	<fieldset class="themeFieldset01">
	<table style="width:100%" border="0" cellpadding="2" cellspacing="0">
		<tr bgcolor="#FAD163">
		  <td colspan="3"><strong>Employment Information</strong></td>
	  </tr>
		<tr class="divTblTH_">
		  <td rowspan="5" align="right">&nbsp;</td>
		  <td style="left-padding:20px;"><lable class="longlabel"><em>Status</em></lable><b><?=$oData['emp201status_name']?></b></td>
		  <td>&nbsp;</td>
	  </tr>
		<tr class="divTblTH_">
          <td style="left-padding:20px;"><lable class="longlabel"><em>Position</em></lable><b><?=$oData['post_name']?></b></td>
		  <td><lable class="longlabel"><em>Company</em></lable><b><?=$oData['comp_name']?></b></td>
	  </tr>
		<tr class="divTblTH_">
          <td><lable class="longlabel"><em>Department</em></lable><b><?=$oData['ud_name']?></b></td>
		  <td><lable class="longlabel"><em>Location</em></lable><b><?=$oData['branchinfo_name']?></b></td>
	  </tr>
		<tr class="divTblTH_">
          <td><label class="longlabel"><em>Type</em></label><b><?=$oData['emptype_name']?></b></td>
		  <td><label class="longlabel"><em>Hire Date</em></label><b><?=$oData['emp_hiredate']?></b></td>
	  </tr>
		<tr class="divTblTH_">
		  <td><label class="longlabel"><em>Category</em></label><b><?=$oData['empcateg_name']?></b></td>
		  <td><label class="longlabel"><em>Resigned Date</em></label><b><? IF($oData['emp_resigndate']) print $oData['emp_resigndate']; else print "0000-00-00";?></b></td>
	  </tr>
	  <tr bgcolor="#FAD163">
		  <td colspan="3"><strong>Personal Information</strong></td>
	  </tr>
		<tr class="divTblTH_">
          <td width="8%" align="right"></td>
          <td width="43%" style="left-padding:20px;"><label class="longlabel"><em>Gender</em></label><b><?=$oData['pi_gender']?></b></td>
          <td width="50%"><label class="longlabel"><em>Work Email</em></label><b><?=$oData['pi_emailone']?></b></td>
      	</tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td><label class="longlabel"><em>Date of Birth</em></label><b><? if($oData['pi_bdate']) print $oData['pi_bdate']; else print "0000-00-00";?></b></td>
          <td><label class="longlabel"><em>Telephone</em></label><b><?=$oData['pi_telone']?></b></td>
        </tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td><label class="longlabel"><em>Civil Status</em></label><b><?=$oData['pi_civil']?></b></td>
          <td><label class="longlabel"><em>Mobile</em></label><b><?=$oData['pi_mobileone']?></b></td>
        </tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td colspan="2"><label class="longlabel"><em>Address</em></label><b><?=$oData['pi_add']?></b></td>
        </tr>
        
        <tr bgcolor="#FAD163">
          <td colspan="3"><strong>Government Information</strong></td>
        </tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td><label class="longlabel"><em>TIN</em></label><b><?=$oData['pi_tin']?></b></td>
          <td><label class="longlabel"><em>SSS No</em></label><b><?=$oData['pi_sss']?></b></td>
        </tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td><label class="longlabel"><em>PHIC No</em></label><b><?=$oData['pi_phic']?></b></td>
          <td><label class="longlabel"><em>HDMF No</em></label><b><?=$oData['pi_hdmf']?></b></td>
        </tr>
        <tr class="divTblTH_">
          <td align="right"></td>
          <td><label class="longlabel"><em>Tax Exemption</em></label><b><?=$oData['taxep_name']?></b></td>
          <td>&nbsp;</td>
        </tr>
	</table>
	</fieldset>
<br>
<input type="button" value="Edit Employee" class="buttonstyle" onclick="window.location='transaction.php?statpos=emp_masterfile&edit=<?= $_GET['empinfo']?>';">
</div>