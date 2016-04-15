<br>
<br>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?>
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
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<div align="left">
<form name="form1" id="form1">
<fieldset class="themeFieldset01_menu" style="background-color:#ffffaa">
  <table width="100%" border="0" cellpadding="1" cellspacing="2">
        <tr align="center">
		<td width="40%"><strong>Select Status</strong></td>
		<td width="60%"><select name="listType" onchange="MM_jumpMenu('parent',this,0)">
	<option value="?statpos=201file_review">SELECT</option>
    <?php $ctr=0;?>
    <?php do {?>
    <option value="?statpos=201file_review&emp201status_id=<?=$lstemp201status[$ctr]['emp201status_id'];?>"><?=$lstemp201status[$ctr]['emp201status_name'];?></option>
	<?php $ctr++;?>
	<?php }while($ctr < sizeof($lstemp201status));?>
  </select></td>
  </tr>
</table>
</fieldset>
</form>
</div>
<?=$tblDataList?>