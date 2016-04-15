<fieldset class="themeFieldset01_menu" style="background-color:#ffffaa">
      <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr align="right">
		<td width="50%"><strong>Select Status</strong></td>
		<td width="50%"><select name="emp_stat" id="emp_stat" onchange="javascript:window.location='transaction.php?statpos=<?=$_GET['statpos'];?>&emp_stat='+document.getElementById('emp_stat').value;">
		  <option value="1" <?php if($_GET['emp_stat']=='1'){echo "selected";}?>>New</option>
		  <option value="2"  <?php if($_GET['emp_stat']=='2'){echo "selected";}?>>For Approval</option>
		  <option value="3"  <?php if($_GET['emp_stat']=='3'){echo "selected";}?>>Pended</option>
		  <option value="4"  <?php if($_GET['emp_stat']=='4'){echo "selected";}?>>Cancelled</option>
		  <option value="5"  <?php if($_GET['emp_stat']=='5'){echo "selected";}?>>Approved</option>
		  </select></td>
        </tr>
      </table>
</fieldset>