<!--<div class="popuptitle">Loan Payment History</div>-->
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Loan Payment History</h2></fieldset>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="9%"><em><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Excel Export</strong></em></td>
    <td width="91%"><input type="radio" name="format" id="radio5" value="excel" checked="checked"/><a href="popup.php?statpos=popuploanpaymenthistory&action=exportexcel&emp_id=<?=$_GET['emp_id']?>&loan_id=<?=$_GET['loan_id']?>&loantype_id=<?=$_GET['loantype_id']?>"><img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /> Excel </a></td>
  </tr>
</table>
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
<?=$tblDataList?>