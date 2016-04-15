<br>
<br>
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
<script type="text/javascript">
$(document).ready(function() {
	$("#position").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
$(document).ready(function() {
	$("#department").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
</script>
<form method="post" action="" name="jay" id="jay">
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" style="background:#CCFF66"><em><strong>=== Employee List ===</strong></em></div></td>
  </tr>
  <tr>
    <td><input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Select Employee" class="themeInputButton" />
	  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=compbanks&view=<?=$_GET['view']?>&empinput=<?=$_GET['empinput']?>&bank=<?=$_GET['bank']?>'" /></td>
  </tr>
  <tr>
    <td><?=$tblDataList?>
      <input type="submit" name="btn_saveEmployee" id="btn_saveEmployee" value="Select Employee" class="themeInputButton" />
	  <input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=compbanks&view=<?=$_GET['view']?>&empinput=<?=$_GET['empinput']?>&bank=<?=$_GET['bank']?>'"  />&nbsp;</td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
</fieldset>
</div>
</form>