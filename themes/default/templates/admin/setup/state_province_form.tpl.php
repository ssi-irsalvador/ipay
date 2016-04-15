<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">State / Province Form</legend>
<?php 
if(isset($eMsg)){
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
$(document).ready(function() {
	$("#popup").fancybox({
		'width'				: '75%',
		'height'			: '75%',
		'autoScale'			: false,
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'type'				: 'iframe'
	});
});
</script>
<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;}
</style>
<script type="text/javascript">

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#state_province").validate(
		{
			rules:
			{
				region_name:{
					required:true
				},
				province_name:{
					required:true
				}
			},
			messages:
			{
				region_name:"Please select a Region Name.",
				province_name:"Please enter State / Province."
			}
		}
	);
});
</script>

<form id="state_province" name="state_province" method="post" action="">
  <table border="0" width="100%">
    <tbody>
      <tr>
        <td>Region Name</td>
        <td><input name="region_name" id="region_name" size="35" type="text" value="<?=trim($oData['region_name'])?>" readonly="readonly" />
          <input name="r_id" type="hidden" id="r_id" value="<?=$oData['r_id']?>" size="25" />
          <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupregion&amp;ftype=reg', 'searchwindow', '');"> -->
          <a id="popup" href="popup.php?statpos=popupregion&amp;ftype=reg"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a></td>
      </tr>
      
      <tr>
        <td width="16%">State / Province </td>
        <td width="84%"><input name="province_name" id="province_name" size="35" type="text" value="<?=trim($oData['province_name'])?>" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><span class="red">
          <input name="btnOk" id="btnOk" type="submit" value=" Save and Exit " class="themeInputButton" />
          <input type="button" name="Reset" value="Reset" class="themeInputButton" onclick="jqResetForm('state_province')" />
		  <input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=state_province'" />
          <input type="hidden" name="sta_dateadded" value="<?=date('Y-m-d H:i:s',time())?>" />
          &nbsp;</span></td>
      </tr>
    </tbody>
  </table>
</form>
</fieldset>
</div>