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
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Statutory Contribution</h2></fieldset>
<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>


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
	$("#mnge_sc").validate(
		{
			rules:
			{
				sc_code:{
					required:true
				}
			},
			messages:
			{
				sc_code:"Please enter Statutory Name."
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
<fieldset class="themeFieldset01">
<form id="mnge_sc" method="post">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
    </tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Scheme&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				 <select id='dec_id' name='dec_id' class="longselect" onchange="if(this.options[this.selectedIndex].value != 'N/A')window.location='?statpos=mnge_sc&dec_id='+this.options[this.selectedIndex].value+'&edit='+this.options[this.selectedIndex].value">
					<option value="0">Please select</option>
				  <?=html_options2($scheme,$_SESSION['schemevalue'],'edit',$_GET['edit']?$_GET['edit']:'N/A')?>			
				 </select>
			  </td>
			</tr>
			<?php if ($_GET['edit'] == 0) {exit;}?>
			<tr>
			<td class="divTblTH_"><div align="right"><span class="style3">Statutory selection&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				 <select id='sc_id' name='sc_id' class="longselect" onchange="if(this.options[this.selectedIndex].value != 'N/A')window.location='?statpos=mnge_sc&dec_id='+dec_id.options[dec_id.selectedIndex].value+'&edit='+dec_id.options[dec_id.selectedIndex].value+'&sc_id='+this.options[this.selectedIndex].value">
				 <?php if(!$_GET['sc_id'] AND $_GET['dec_id']){ ?><option>N/A</option><?php }?>
				 <?=html_options2($statutory,$_SESSION['statvalue'],'sc_id',$_GET['sc_id'])?>			
				 </select>			  
			  </td>
			</tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Statutory Name&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input size="35" id='sc_code' name='sc_code' value="<?=trim($oData['sc_code'])?>" /></td>
			</tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Description&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input size="80" id='sc_desc' name='sc_desc' value="<?=trim($oData['sc_desc'])?>" /></td>
			</tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Effective Date&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input id='sc_effectivedate' name='sc_effectivedate' value="<?=trim($oData['sc_effectivedate'])?>" /><a href="javascript:void(0);" class="option" onclick="return showCalendar('sc_effectivedate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
			</tr>
			 <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><input type="Submit" name="Submit" value="<?php if (isset($_GET['sc_id'])) { echo 'Update & Clear'; } else { echo 'Save & Clear'; } ?>" class="buttonstyle" />
				<?php if (isset($_GET['sc_id'])){ ?>
				<input type="button" name="Delete" value="Delete" class="buttonstyle" onclick="if(confirm('Are your sure you want to delete '+sc_code.value+'?'))window.location='?statpos=mnge_sc&deletesc&dec_id=<?=$_GET['dec_id']?>&edit=<?=$_GET['edit']?>&sc_id=<?=$_GET['sc_id']?>'" />
				<input type="button" name="Add New" value="Add New" class="buttonstyle" onclick="window.location='?statpos=mnge_sc&dec_id=<?=$_GET['dec_id']?>&edit=<?=$_GET['edit']?>'" /><?php }else{?>
				<input type="reset" name="Reset" value="Reset" class="buttonstyle" /><?php } ?>
				</form>
				</td>
			</tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			</tr>
			<?php if ($_GET['edit'] == 0 || $_GET['sc_id'] == 0) {exit;}?>
			<tr>
			<td class="divTblTH_">&nbsp;</td>
			<td colspan='100%' class="divTblTH_">
				<form method="post">
				<table>
					<tr>
					  <td class="divTblTH_"><div class="style3" style="text-align:left;">Minimum Salary</div></td>
					   <td class="divTblTH_"><div class="style3" style="text-align:left;">Maximum Salary</div></td>
					</tr>
					<tr>
					  <td class="divTblTH_"><input type='text' id='min_salary' name='min_salary' value='<?=trim($scrData['min_salary'])?>' size="35" class="dec" /></td>
					  <td class="divTblTH_"><input type='text' id='max_salary' name='max_salary' value='<?=trim($scrData['max_salary'])?>' size="35" class="dec" /></td>
					</tr>
					<tr>
					  <td class="divTblTH_"><div class="style3" style="text-align:left;">Minimum Statutory Age</div></td>
					   <td class="divTblTH_"><div class="style3" style="text-align:left;">Maximum Statutory Age</div></td>
					</tr>
					
					<tr>
					  <td class="divTblTH_"><input type='text' id='min_age' name='min_age' value='<?=trim($scrData['min_age'])?>' size="35" class="dec" /></td>
					  <td class="divTblTH_"><input type='text' id='max_age' name='max_age' value='<?=trim($scrData['max_age'])?>' size="35" class="dec" /></td>
					</tr>
					<tr>
					  <td class="divTblTH_" colspan="2">
						<table style='border-collapse:collapse;'>
						<tr><td><b>ER</b><br>
						<input type='text' id='scr_er' name='scr_er' value='<?=trim($scrData['scr_er'])?>' size="10" class="dec"/ >
						</td>
						
						<td><b>EE</b><br>
						<input type='text' id='scr_ee' name='scr_ee' value='<?=trim($scrData['scr_ee'])?>' size="10" class="dec" /></td>
						
						<td><b>ER/EC</b><br>
						<input type='text' id='scr_ec' name='scr_ec' value='<?=trim($scrData['scr_ec'])?>' size="10" class="dec" /></td>
						</tr>
						<tr>
						<td><b>%</b><br>
						<input type='text' id='scr_pcent' name='scr_pcent' value='<?=trim($scrData['scr_pcent'])?>' size="10"class="dec" /></td>
						
						<td><b>+ Amount</b><br>
						<input type='text' id='scr_pcentamnt' name='scr_pcentamnt' value='<?=trim($scrData['scr_pcentamnt'])?>' size="10" class="dec" /></td>
						</tr>
						</table>
					<input type='hidden' name='sc_id' id='sc_id' value='<?=$_GET['sc_id']?>' />
					<input type='hidden' name='scr_id' id='scr_id' value='<?=$_GET['scr_id']?>' />
					<input type='hidden' name='dec_id' id='dec_id' value='<?=$_GET['dec_id']?>' />					</td></tr><tr>
      <td colspan="2" class="divTblTH_">
	  <?php 
	  if(isset($_GET['scr_id'])){
	  ?>
	  <input  type='submit' name='updatescrecords' value='Update & Clear' class='buttonstyle' />
	  <?php
	  }
	  else{?>
		<input  type='submit' name='savescrecords' value='Save & Clear' class='buttonstyle' />
		<? } ?>
        <?php if (isset($_GET['scr_id'])){ ?>
		<input type="button" name="delete" value="Delete" class="buttonstyle" onclick="if(confirm('Are your sure you want to delete?'))window.location='?statpos=mnge_sc&deletescrecords&dec_id=<?=$_GET['dec_id']?>&edit=<?=$_GET['edit']?>&sc_id=<?=$_GET['sc_id']?>&scr_id=<?=$_GET['scr_id']?>'" />
				
        <input type="button" name="cancel" value="Add New" class="buttonstyle" onclick="javascript:history.back(0);" />
        <?php }else{?>
		<input type="reset" name="Reset" value="Reset" class="buttonstyle" />		<?php } ?></td>
      </tr>
    <tr>
      <td colspan="2" class="divTblTH_">&nbsp;</td>
      </tr>
			</table>
				</form></td></tr>
	</fieldset>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><?=$tblDataList?></td>
    </tr>
</table>
</div>