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
<script language="javascript">
function CheckAll(count){
	var i;
	if(document.getElementById('chkAttendAll').checked==true){
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = true;
		}
	}else {
		for(i=1; i<=count; i++){
			document.getElementById('chkAttend['+i+']').checked = false;
		}
	}
}
function UncheckAll(count){
	var i;
	for(i=1; i<=count; i++){
		if(document.getElementById('chkAttend['+i+']').checked==false){
		   document.getElementById('chkAttendAll').checked=false;
			return;
		}
		document.getElementById('chkAttendAll').checked=true;
	}	
}
</script>
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Process Payroll</h2></fieldset>
<fieldset class="themeFieldset01">
<?=$tblDataList?>
</fieldset>