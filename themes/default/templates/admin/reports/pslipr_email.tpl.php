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

<?
	}
}
?>
<script language="javascript">
$(function () {
    $('#chkAttendAll').click(function () {
        $(this).parents('fieldset:eq(0)').find(':checkbox').attr('checked', this.checked);
    });
});
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Send Email</h2></fieldset>
<fieldset class="themeFieldset01">
<form method="post" action="reports.php?statpos=pslipr&email=<?php echo $_GET['email'];?>">
<table>
  <tr>&nbsp;</tr>
<!--   <tr>
    <td class="divTblTH_">Select Company</td>
    <td class="divTblTH_">
      <select name="comp_id" id="comp_id" class="longselect">
          <?=html_options($comp,$oData['comp_id'])?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Select Location</td>
    <td><select name="branchinfo_id" id="branchinfo_id" class="longselect">
		<option value="0">SELECT ALL</option>
        <?=html_options($localinfo,$oData['branchinfo_id'])?>	
      </select>
    </td>
  </tr>
  -->
  <tr>
    <td><b>Subject to appear on Email Header &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
    <td><input type="text" size=70 name="email_subject" class="txtfields"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Preview" value="Preview" class="buttonstyle" />
      &nbsp;&nbsp;
      <input type="submit" name="SendEmail" value="SendMail" class="buttonstyle" />
    </td>
  </tr>
  <tr></tr>
</table>
<?=$tblDataList?>
</form>
</fieldset>
</div>