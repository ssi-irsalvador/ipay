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

<script src="../includes/jscript/jquery.js"></script>
<script src="../includes/jscript/jquery.validate.min.js"></script>

<style>
label.error{ color: #E42217; float: none; }
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
	$("#factor_rate").validate(
		{
			rules:
			{
				wrate_name:{
					required:true
				},
				wrate_sec_ind:{
					required:true
				},
				region_id:{
					required:true
				},
				wrate_minwagerate:{
					required:true,
					number:true
				}
			},
			messages:
			{
				wrate_name:"Please enter a Name.",
				wrate_sec_ind:"Please enter Sector/Industry.",
				region_id:"Please select Region.",
				wrate_minwagerate:{
					required:"Please enter Basic Wage After COLA Integration.",
					number:"Please enter a valid Basic Wage After COLA Integration."
				}
			}
		}
	);
});
</script>
<script type="text/javascript" src="../includes/jquery/jquery1.7.2.min.js"></script>
<script language="javascript" type="text/javascript">
        $(function(){$('.dec').on('keyup', function(e) {    
    		var maxPlaces = <?= $genDecimal?>,        
    		integer = e.target.value.split('.')[0],        
    		mantissa = e.target.value.split('.')[1];        
    		if (typeof mantissa === 'undefined') {        
        		mantissa = '';    
        	}        
        	if (mantissa.length > maxPlaces) {        
            	e.target.value = integer + '.' + mantissa.substring(0, maxPlaces);    
            }});
		});
    </script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Wage Rate</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="factor_rate" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    
    <tr>
      <td class="divTblTH_"><div class="style3">Name&nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="wrate_name" id="wrate_name" value="<?=trim($oData['wrate_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td width="30%" class="divTblTH_"><div class="style3">Sector/Industry&nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="wrate_sec_ind" id="wrate_sec_ind" value="<?=trim($oData['wrate_sec_ind'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Region&nbsp;&nbsp;</div></td>
        <td class="divTblTH_">
            <select id="region_id" name="region_id">
                <option value="">Select Region</option>
                <?=html_options4($region,'region_id','region_name',$oData['region_id']?$oData['region_id']:'');?>
            </select>
        </td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Basic Wage After COLA Integration&nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="wrate_minwagerate" id="wrate_minwagerate" value="<?=trim($oData['wrate_minwagerate'])?>" type="text" size="10" class="dec"/></td>
    </tr>
    
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle">
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=wagerate'"><?php }else{?>
		<input type="reset" name="Submit2" value="Reset" class="buttonstyle"><?php } ?></td>
    </tr>
</table>
</form>
</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><?=$tblDataList?></td>
    </tr>
</table>
</div>