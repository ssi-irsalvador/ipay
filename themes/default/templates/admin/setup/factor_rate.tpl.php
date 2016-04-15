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
	$("#factor_rate").validate(
		{
			rules:
			{
				fr_name:{
					required:true
				},
				fr_hrperday:{
					required:true,
					number:true
				},
				fr_hrperweek:{
					required:true,
					number:true
				},
				fr_dayperweek:{
					required:true,
					number:true
				},
				fr_dayperyear:{
					required:true,
					number:true
				}
			},
			messages:
			{
				fr_name:"Please enter a Name.",
				fr_hrperday:{
					required:"Please indicate Hours per Day.",
					number:"Please enter a valid Hours per Day."
				},
				fr_hrperweek:{
					required:"Please indicate Hours per Week.",
					number:"Please enter a valid Hours per Week."
				},
				fr_dayperweek:{
					required:"Please indicate Average Work Days per Week.",
					number:"Please enter a valid Average Work Days per Week."
				},
				fr_dayperyear:{
					required:"Please indicate Days per Year.",
					number:"Please enter a valid Days per Year."
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Factor Rate</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="factor_rate" method="post" action="" onsubmit="return validform();">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="30%" class="divTblTH_"><div class="style3">Name &nbsp;&nbsp;</div></td>
      <td width="70%" class="divTblTH_"><input name="fr_name" id="fr_name" value="<?=trim($oData['fr_name'])?>" type="text" size="30" /></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Hours per Day &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_hrperday" id="fr_hrperday" value="<?=trim($oData['fr_hrperday'])?>" type="text" size="10" class="dec"/></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Hours per Week &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_hrperweek" id="fr_hrperweek" value="<?=trim($oData['fr_hrperweek'])?>" type="text" size="10" class="dec"/></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Average Work Days per Week &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_dayperweek" id="fr_dayperweek" value="<?=trim($oData['fr_dayperweek'])?>" type="text" size="10" class="dec"/></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Days per Year &nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><input name="fr_dayperyear" id="fr_dayperyear" value="<?=trim($oData['fr_dayperyear'])?>" type="text" size="10" class="dec"/></td>
    </tr>
    <tr>
      <td class="divTblTH_"><div class="style3">Minimum Wage Rates&nbsp;&nbsp;</div></td>
      <td class="divTblTH_"><select id="wrate_id" name="wrate_id">
				<?=html_options3($wrate,'wrate_id','wrate_name',$oData['wrate_id']?$oData['wrate_id']:'N/A');?>
			  </select></td>
    </tr>
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle">
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=factor_rate'"><?php }else{?>
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