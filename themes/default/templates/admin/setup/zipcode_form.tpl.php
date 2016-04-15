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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Zip Codes Form</legend>
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

<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{color:#E42217; float:none;font-weight:normal;font-size:small;}
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
	$("#zipcode").validate(
		{
			rules:
			{
				province_name:{
					required:true
				},
				zipcode_name:{
					required:true
				},
				zipcode:{
					required:true,
					number:true
				}
			},
			messages:
			{
				province_name:"Please select Province.",
				zipcode_name:"Please enter Zip Code Name.",
				zipcode:{
					number:"Please enter a valid Zip Code.",
					required:"Please enter Zip Code."
				}
			}
		}
	);
});
</script>
<form id="zipcode" name="zipcode" method="post" action="">
  <table border="0" width="100%">
    <tbody>
      <tr>
        <td width="16%">Province Name </td>
        <td width="84%"><input name="province_name" id="province_name" size="35" value="<?=trim($oData['province_name'])?>" type="text" readonly="true" />
          <span class="red">
         <!--  <a href='javascript:void(0);' onclick="javascript: openwindow('popup.php?statpos=popupcity&popupadd=permaddress&popupzipcode=zipcode', 'searchwindow', '');">-->
         <a id="popup" href="popup.php?statpos=popupcity&popupadd=permaddress&popupzipcode=zipcode"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a>
          <input name="p_id" type="hidden" id="p_id" value="<?=$oData['p_id']?>" />
          </span></td>
      </tr>
      <tr>
        <td>Zip Code Name </td>
        <td><span class="red">
          <input name="zipcode_name" id="zipcode_name" size="35" value="<?=trim($oData['zipcode_name'])?>" type="text" />
        </span></td>
      </tr>
      <tr>
        <td>Zip Code </td>
        <td><input name="zipcode" id="zipcode" size="20" value="<?=trim($oData['zipcode'])?>" type="text" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span class="red">
          <input name="btnOk" id="btnOk" type="submit" value=" Save and Exit " class="themeInputButton" />
          <input type="button" name="Reset" value="Reset" class="themeInputButton" onclick="jqResetForm('zipcode')" />
		  <input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=zipcode'" />
        </span></td>
      </tr>
    </tbody>
  </table>
</form>
</fieldset>
</div>