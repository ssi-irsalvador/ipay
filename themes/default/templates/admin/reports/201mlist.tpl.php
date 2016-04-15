<?php 
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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">201 Master List</h2></fieldset>
<fieldset class="themeFieldset01">
<form method="post" action="">
<table width="532" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="37%">&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Company</em></b></td>
    <td colspan="5"><select name="comp_id" id="comp_id">
        <?=html_options($comp,$oData['comp_id'])?>	
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Branch</em></b></td>
    <td colspan="5">
		<select name="select" id="select" class="longselect">
		  <option value="0">SELECT ALL</option>
		  <?=html_options_2d($branch,'branchinfo_id','branchinfo_name',$_POST['branchinfo_id'],false)?>
		</select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Department</em></b></td>
    <td colspan="5">
		<select name="ud_id" id="ud_id" class="longselect">
		  <option value="0">SELECT ALL</option>
		  <?php //html_options_2d($dept,'ud_id','ud_name',$_POST['ud_id'],false) ?>
		  <?=html_options2($departments,$_SESSION['deptvalue'],'edit',$oData['ud_id'])?>
		</select></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Employee Status</em></b></td>
    <td colspan="5"><!--<select name="emp_type" id="emp_type" class="longselect">
      <option value="0">All Active Employee</option>	
	  <?=html_options($emptype,$_POST['emptype'])?>
    </select>-->
      <select name="emp_type" id="emp_type" class="longselect">
	  	<option value="0">SELECT ALL</option>
        <?=html_options_2d($empstat,'emp201status_id','emp201status_name',$_POST['emp201status_id'],false)?>
      </select></td>
  </tr>
  <!--<tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;Group by Department </td>
    <td colspan="5"><input type="checkbox" name="isdpart" id="isdpart" value="1" /></td>
  </tr>-->
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>Sorted by</em></b></td>
    <td colspan="5"><input type="checkbox" name="isdpart" id="isdpart" value="1" />
    Department</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5"><input type="checkbox" name="islname" id="islname" value="1" />
    Last Name</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><em>File Format</em></b></td>
    <td colspan="5">
      		<div style="float:left;"><!--<input type="radio" name="format" id="format" value="pdf" checked="checked"/>
			<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'pdf2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Payslip PDF View" />PDF&nbsp;&nbsp;&nbsp;--><input type="radio" name="format" id="format" value="excel" checked="checked"/>
			<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" />Excel</div></td>
  </tr>
  <tr>
    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
    <td width="63%" style="color:#CCFF66; border-top: 1px solid"><input type="submit" class="themeInputButton" name="bnt_excel" id="bnt_excel" value="&nbsp;&nbsp;&nbsp;&nbsp;PROCESS&nbsp;&nbsp;&nbsp;&nbsp;"/></td>
  </tr>
</table>
</form>
</fieldset>
</div>