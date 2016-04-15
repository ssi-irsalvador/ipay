<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#isEnabled').click(function() {
    $("#prevForm").toggle(this.checked);
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
<div id="tab-12" name="PreviousEmp" style="width:310; height:100%;">
<span class="style1"><input type="checkbox" id="isEnabled" <?= $showForm =='none' ? "" : "checked"?>/>Have Previous Employer? (For Alphalist Use Only)</span>
	<fieldset class="themeFieldset01" id="prevForm" style="display:<?= $showForm ?>">
	<form method="post" name="prev_emp">
	<table style="width:100%" border="0" cellpadding="2" cellspacing="0">
	<tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Year Covered</em></td>
		  <td><input name="bir_alphalist_year" type="text" maxlength="4" style="height:15px; width:200px;" value="<?= $prevEmp['bir_alphalist_year'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Tax Withheld</em></td>
		  <td><input name="tax_withheld" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['tax_withheld'] ?>"></td>
	  </tr>
	  <?php if($taxSettings['bldsched_period'] != 2){?>
	  <tr bgcolor="#FAD163">
		  <td colspan="2"><strong>Taxable</strong></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Basic Salary</em></td>
		  <td><input name="taxable_basic" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['taxable_basic'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>13<sup>th</sup> Month &amp; Other Benefits</em></td>
		  <td><input name="taxable_other_ben" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['taxable_other_ben'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Salaries &amp; Other Forms of Compensation</em></td>
		  <td><input name="taxable_compensation" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['taxable_compensation'] ?>"></td>
	  </tr>
		<tr bgcolor="#FAD163">
		  <td colspan="2"><strong>Non Taxable</strong></td>
	  </tr>
		<tr class="divTblTH_">
          <td style="left-padding:20px;width:45%;"><em>13<sup>th</sup> Month &amp; Other Benefits</em></td>
		  <td><input name="nt_other_ben" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_other_ben'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>De Minimis Benefits</em></td>
		  <td><input name="nt_deminimis" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_deminimis'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>SSS, PHIC, &amp; HDMF Contributions and Union Dues</em></td>
		  <td><input name="nt_statutories" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_statutories'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Salaries &amp; Other Forms of Compensation</em></td>
		  <td><input name="nt_compensation" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_compensation'] ?>"></td>
	  </tr>
	  <?php } else {?>
	  <tr bgcolor="#FAD163">
		  <td colspan="2"><strong>Non Taxable</strong></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Gross Compensation</em></td>
		  <td><input name="gross_compensation" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['gross_compensation'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Basic/SMW</em></td>
		  <td><input name="basic_smw" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['basic_smw'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Holiday Pay</em></td>
		  <td><input name="holiday_pay" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['holiday_pay'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Overtime Pay</em></td>
		  <td><input name="overtime_pay" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['overtime_pay'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Night Shift Differential</em></td>
		  <td><input name="night_differential" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['night_differential'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Hazard Pay</em></td>
		  <td><input name="hazard_pay" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['hazard_pay'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>13<sup>th</sup> Month & Other Benefits</em></td>
		  <td><input name="nt_other_ben" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_other_ben'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;">De Minimis Benefits</em></td>
		  <td><input name="nt_deminimis" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_deminimis'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;">SSS, PHIC, & HDMF Contributions and Union Dues</em></td>
		  <td><input name="nt_statutories" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_statutories'] ?>"></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;">Salaries & Other Forms of Compensation</em></td>
		  <td><input name="nt_compensation" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['nt_compensation'] ?>"></td>
	  </tr>
	  <tr bgcolor="#FAD163">
		  <td colspan="2"><strong>Taxable</strong></td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>13<sup>th</sup> Month &amp; Other Benefits</em></td>
		  <td><input name="taxable_other_ben" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['taxable_other_ben'] ?>"></td>
	  </tr>
	  	  <tr class="divTblTH_">
          <td style="left-padding:20px;"><em>Salaries &amp; Other Forms of Compensation</em></td>
		  <td><input name="taxable_compensation" type="text" style="height:15px; width:200px;" value="<?= $prevEmp['taxable_compensation'] ?>"></td>
	  </tr>
	  <?php } ?>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;" colspan="2">&nbsp;</td>
	  </tr>
	  <tr class="divTblTH_">
          <td style="left-padding:20px;" colspan="2">
          	<input type="submit" name="prev_emp" value="Save">
          	<input type="reset" name="cancel" value="Clear">
          </td>
	  </tr>
	</table>
	</form>
	</fieldset>
</div>