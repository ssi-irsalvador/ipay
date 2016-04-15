<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01">
<legend class="themeLegend01">Region Form</legend>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br />
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br>
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
label.error{color:#E42217; float:none;}
</style>
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

function jqResetForm(form){
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#region").validate(
		{
			rules:
			{
				cou_description:{
					required:true
				},
				region_code:{
					required:true
				},
				region_name:{
					required:true
				},
				region_desc:{
					required:true
				},
				region_ord:{
					number:true
				}
			},
			messages:
			{
				cou_description:"Please select Country.",
				region_code:"Please enter Region Code.",
				region_name:"Please enter Region Name.",
				region_desc:"Please enter Region Description.",
				region_ord:"Please enter a valid Order number."
			}
		}
	);
});
</script>

<form id="region" name="region" method="post" action="">
  <table border="0" width="100%">
    <tr>
      <td>Country</td>
      <td>:</td>
      <td><input name="cou_description" readonly="readonly" type="text" id="cou_description" value="<?=trim($oData['cou_description'])?>" size="35" />
        <input name="cou_id" type="hidden" id="cou_id" value="<?=$oData['cou_id']?>" size="25" />
        <!-- <a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popupcountry&amp;ftype=curcountry', 'searchwindow', '');"> -->
        <a id="popup" href="popup.php?statpos=popupcountry&amp;ftype=curcountry"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" title="Search" alt="Search" /></a></td>
    </tr>
    <tbody>
      <tr>
        <td>Region Code </td>
        <td>:</td>
        <td><input name="region_code" id="region_code" size="35" value="<?=trim($oData['region_code'])?>" type="text" /></td>
      </tr>
      <tr>
        <td width="20%">Region Name </td>
        <td width="1%">:</td>
        <td width="79%"><input name="region_name" id="region_name" size="35" value="<?=trim($oData['region_name'])?>" type="text" /></td>
      </tr>
      <tr>
        <td>Region Description </td>
        <td>:</td>
        <td><input name="region_desc" id="region_desc" size="35" value="<?=trim($oData['region_desc'])?>" type="text" /></td>
      </tr>
      <tr>
        <td>Order </td>
        <td>:</td>
        <td><input name="region_ord" id="region_ord" size="35" value="<?=trim($oData['region_ord'])?>" type="text" /></td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><span class="red">
          <input name="btnOk" id="btnOk" type="submit" value=" Save and Exit " class="themeInputButton" />
          <input type="button" name="Reset" value="Reset" class="themeInputButton" onclick="jqResetForm('region')" />
		  <input type="button" name="Cancel" value="Cancel" class="themeInputButton" onclick="javascript:window.location='setup.php?statpos=region'" />
          <input type="hidden" name="sta_dateadded" value="<?=date('Y-m-d H:i:s',time())?>" />
&nbsp;</span></td>
      </tr>
    </tbody>
  </table>
</form>
</fieldset>
</div>