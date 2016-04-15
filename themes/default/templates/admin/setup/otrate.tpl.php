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
label.error{color:#E42217; float:none;font-weight:normal;font-size:small;}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$("#otrate").validate(
		{
			rules:
			{
				otr_name:{
					required:true
				},
				otr_desc:{
					required:true
				},
				otr_factor:{
					required:true,
					number:true
				},
				otr_max:{
					number:true
				}
			},
			messages:
			{
				otr_name:"Please enter a Code.",
				otr_desc:"Please enter a Description.",
				otr_factor:{
					required:"Please enter a Rate Factor.",
					number:"Please enter a valid Rate Factor."
				},
				otr_max:"Please enter a valid Maximum Rate Amount."
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">OT Rate</h2></fieldset>
<fieldset class="themeFieldset01">
<form id="otrate" method="post">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
	<tr >
	  <td width="30%" class="divTblTH_"><div align="right"><span class="style3">Code&nbsp;&nbsp;</span></div></td>
	  <td width="70%" class="divTblTH_"><input size="35" id='otr_name' name='otr_name' value="<?=trim($oData['otr_name'])?>" /></td>
	</tr>
	<tr >
	  <td class="divTblTH_"><div align="right"><span class="style3">Description&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input  size="35" id='otr_desc' name='otr_desc' value="<?=trim($oData['otr_desc'])?>" /></td>
	</tr>
	<tr >
	  <td class="divTblTH_"><div align="right"><span class="style3">OT Rate Type&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_">
		 <select id='otr_type' name='otr_type' class="longselect">
		  <option value='Hour'  <?$sel = $_GET['otype']=='Hour'?"selected='selected'":''; print $sel;?>>Hour</option>
		  <option value='Fixed' <?$sel = $_GET['otype']=='Fixed'?"selected='selected'":''; print $sel;?>>Fixed</option>
		  <option value='Day'   <?$sel = $_GET['otype']=='Day'?"selected='selected'":''; print $sel;?>>Day</option>	 
		  <option value='N/A'   <?$sel = ($_GET['otype'] != 'Day' AND $_GET['otype'] != 'Fixed' AND $_GET['otype'] != 'Hour')?"selected='selected'":''; print $sel;?>>N/A</option>				  
		 </select></td>
	</tr>
	<tr >
	  <td class="divTblTH_"><div align="right"><span class="style3">Rate Factor&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input  size="35" id='otr_factor' name='otr_factor' value="<?=trim($oData['otr_factor'])?>" class="dec"/></td>
	</tr>
	<tr >
	  <td class="divTblTH_"><div align="right"><span class="style3">Maximum Rate Amount&nbsp;&nbsp;</span></div></td>
	  <td class="divTblTH_"><input  size="35" id='otr_max' name='otr_max' value="<?=trim($oData['otr_max'])?>" class="dec"/></td>
	</tr>
	<input type='hidden' value="<?=$_GET['edit']?>" name="otr_id"> 
    <tr>
      <td class="divTblTH_">&nbsp;</td>
      <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['edit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
        <?php if (isset($_GET['edit'])){ ?>
        <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javacript:window.location='setup.php?statpos=otrate'" /><?php }else{?>
		<input type="reset" name="Submit2" value="Reset" class="buttonstyle" /><?php } ?></td>
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