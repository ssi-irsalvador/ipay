<!--<div style="padding-top:5px;">-->
<!--&nbsp;&nbsp;<img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'module.png'?>" border="0" align="absbottom">&nbsp;<a href="reports.php?statpos=ytdrept&action=add">Add New</a><br />-->
<!--</div>-->
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Year To Date(YTD) Report</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Year To Date(YTD) Report</legend>-->
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
<script type="text/javascript">
function change()
{
	if(document.getElementById("emp_id").value == "0"){
		document.getElementById("empType").style.display ="block"
	} else {
		document.getElementById("empType").style.display ="none"
	}
}
function parseNavigation(ob) {
	toBeBrokenDown = ob.options[ob.selectedIndex].value.split("|");

	targetWindow = toBeBrokenDown[0];
	targetURL    = toBeBrokenDown[1];
	
		if (targetWindow!=='') {
		window.open(targetURL,targetWindow,'toolbar=1,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1,width=400,height=300');
		ob.selectedIndex = 0;
			} else {
		// or else it will open in the current windo	
		window.open(targetURL,'_top')
		}
	}
</script>
<form method="post" action="">
	<table width="532" border="0" cellpadding="2" cellspacing="0" style="border-collapse:collapse;">
		<tr>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;Company</td>
		    <td ><select name="comp_id" id="comp_id" class="longselect">
		    <?php foreach($oData as $key => $val){?>
		        <option value="<?= $val['comp_id']?>"><?= $val['comp_name']?></option>
		    <?php }?>
		      </select></td>
		</tr>
		<tr>
	      <td width="224">&nbsp;&nbsp;&nbsp;&nbsp;Department</td>
	      <td width="298" ><select name="dept" id="dept" class="longselect" onchange="parseNavigation(this)">
	      <option value="|<?php echo BASE_URL;?>reports.php?statpos=ytdrept" id="all_dept">All Department</option>
	      <?php for($count=0;count($deptData)>$count;$count++){?>
	          <option value="|<?php echo BASE_URL;?>reports.php?statpos=ytdrept&dept_id=<?= $deptData[$count]['ud_id']?>" <?php if($_GET['dept_id']==$deptData[$count]['ud_id']){ echo "selected=\"selected\"";}?>><?= $deptData[$count]['ud_name']?></option>
	      <?php }?>
	        </select></td>
	    </tr>
	    <?php if(!isset($_GET['dept_id'])){
	     if(count($haveLoc) > 1){?>
		<tr id="groupings">
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;Group by Department</td>
		    <td><input type="checkbox" name="isdpart" id="isdpart" value="1" /></td>
		</tr>
		<?php }} else {?>
		<tr id="employees">
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;Employee &nbsp;&nbsp;&nbsp;&nbsp;</td>
		    <td><select name="emp_id" id="emp_id" class="longselect" onchange="change()">
		      <option value="0">All Employee</option>
		      <?php for($count=0;count($emp)>$count;$count++){?>
		      <option value="<?= $emp[$count]['emp_id']?>"><?= $emp[$count]['fullname']?></option>
		      <?php }?>
		    </select></td>
		</tr>
		<?php } ?>
		<tr id="empType" style="display:block;">
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;Status</td>
		    <td><select name="emp_status" id="emp_status" class="longselect" style="float:left; position:relative; top:0px; left:171px;">
		      <option value="0">All Employee</option>
		       <?php for($count=0;count($status)>$count;$count++){?>
			  <option value="<?= $status[$count]['emp201status_id']?>"><?= $status[$count]['emp201status_name']?></option>
			  <?php }?>
		    </select></td>
		</tr>
		<tr id="month">
	      <td>&nbsp;&nbsp;&nbsp;&nbsp;From Month </td>
	      <td><select name="frommonth" id="frommonth" class="longselect">
	          <?=html_options($month,$_POST['month'])?>
	        </select>      </td>
	    </tr>
	    <tr>
	      <td>&nbsp;&nbsp;&nbsp;&nbsp;From Year</td>
	      <td ><select name="fromyear" id="fromyear" class="longselect">
	          <?=html_options($year,$_POST['month'])?>
	      </select></td>
	    </tr>
	   <tr id="month">
	      <td>&nbsp;&nbsp;&nbsp;&nbsp;To Month </td>
	      <td><select name="tomonth" id="tomonth" class="longselect">
	          <?=html_options($month,$_POST['month'])?>
	        </select>      </td>
	    </tr>
	   	<tr>
	      <td>&nbsp;&nbsp;&nbsp;&nbsp;To Year</td>
	      <td><select name="toyear" id="toyear" class="longselect">
	          <?=html_options($year,$_POST['month'])?>
	      </select></td>
	    </tr>
	    
		<tr>
		  <td>&nbsp;&nbsp;&nbsp;&nbsp;Report Format</td>
		  <td ><div style="float:left;">
	      <input type="radio" name="rformat" id="rformat" value="peremp" checked="checked" />
	        Per Employee&nbsp;&nbsp;&nbsp;
	        <input type="radio" name="rformat" id="rformat" value="summary" />
	        Summary</div></td>
	  </tr>
		<tr>
	    <td>&nbsp;&nbsp;&nbsp;&nbsp;File Format</td>
	    <td ><div style="float:left;"><input type="radio" name="format" id="format" value="excel" checked="checked" />
			<img src="<?=SYSCONFIG_DEFAULT_IMAGES.'excel2.png'?>" hspace="1" align="absbottom" border="0" height="18" width="18" title="Excel File" /><label for="format" style="float: right;">Excel</label></div></td>
	  	</tr>
	  
	   <tr>
		    <td style="color:#CCFF66; border-top: 1px solid">&nbsp;</td>
		    <td style="color:#CCFF66; border-top: 1px solid"><input type="submit" class="themeInputButton" name="bnt_excel" id="bnt_excel" value="Process" /></td>
	   </tr>
	</table>
</form>
</fieldset></div>