<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Tax Policy Form</h2></fieldset>
<form method="post" action="">
<fieldset class="themeFieldset01" style="background-color:#FDEEF4">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="21%">&nbsp;</td>
      <td width="79%">&nbsp;</td>
    </tr>
    <tr>
      <td><em>&nbsp;&nbsp;&nbsp;&nbsp;Tax Name</em> </td>
      <td><b><?=$oData['tp_name']?></b></td>
    </tr>
    <tr>
      <td><em>&nbsp;&nbsp;&nbsp;&nbsp;Tax Description</em> </td>
      <td><b><?=$oData['tp_desc']?></b></td>
    </tr>
    <tr>
      <td><em>&nbsp;&nbsp;&nbsp;&nbsp;Effective Date</em> </td>
      <td><b><?=$oData['tp_edate']?></b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
<br />
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Tax Policy</legend>
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
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td class="divTblTH_"><span class="style3">13th Month Pay and Other Benefits shall not exceed</span></td>
    <td class="divTblTH_"><input size="25" id='tp_other_benefits' name='tp_other_benefits' value="<?=trim($oData['tp_other_benefits'])?>" style="text-align:right" /></td>
  </tr>
  <tr>
    <td class="divTblTH_"><span class="style3">For single individual or married individual judicially decreed as legally separated with no qualified dependents</span></td>
    <td class="divTblTH_"><input  size="25" id='tp_no_q_dependents' name='tp_no_q_dependents' value="<?=trim($oData['tp_no_q_dependents'])?>" style="text-align:right"/></td>
  </tr>
  <tr>
    <td class="divTblTH_"><span class="style3">For Head of Family</span></td>
    <td class="divTblTH_"><input  size="25" id='tp_head_family' name='tp_head_family' value='<?=trim($oData['tp_head_family'])?>' style="text-align:right"/> </td>
  </tr>
  <tr>
    <td class="divTblTH_"><span class="style3">For each Married Individual</span></td>
    <td class="divTblTH_"><input  size="25" id='tp_married_ind' name='tp_married_ind' value='<?=trim($oData['tp_married_ind'])?>' style="text-align:right"/></td>
  </tr>
  <tr>
    <td class="divTblTH_"><span class="style3">For each Dependent</span>
      <input  size="25" id='tp_each_dependent' name='tp_each_dependent' value="<?=trim($oData['tp_each_dependent'])?>" style="text-align:right"/><span class="style3">&nbsp; not exceeding &nbsp;</span><input  size="10" id='tp_num_dependents' name='tp_num_dependents' value="<?=trim($oData['tp_num_dependents'])?>" style="text-align:right"/><span class="style3">&nbsp; dependent/s &nbsp;</span></td><td class="divTblTH_">&nbsp;</td>
  </tr>
  <tr>
    <td class="divTblTH_"><span class="style3">Maximum Insurance Premium</span></td>
    <td class="divTblTH_"><input  size="25" id='tp_max_premium' name='tp_max_premium' value="<?=trim($oData['tp_max_premium'])?>" style="text-align:right"></td>
  </tr>
  <tr>
    <td colspan="2" class="divTblTH_">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2" class="divTblTH_"><div align="center">
      <input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle"/>
      <?php if (isset($_GET['edit'])){ ?>
      <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=compbanks&view=<?php echo $_GET['view_'];?>'" />
      <?php }else{?>
      <input type="reset" name="Reset" value="Reset" class="buttonstyle" />
      <?php } ?>
    </div></td>
    </tr>
  <tr>
    <td colspan="2" class="divTblTH_">&nbsp;</td>
    </tr>
</table>
</fieldset>
</form>
</div>