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
<fieldset class="themeFieldset01">
<form method="post">
<?=$tblDataList?>
</form>
</fieldset>