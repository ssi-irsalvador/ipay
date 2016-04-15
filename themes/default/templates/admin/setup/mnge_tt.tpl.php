<?php
if (isset($eMsg)) {
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<strong>Check the following error(s) below:</strong><br />
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$Value?><br />
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

<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"></script>

<script src="../includes/jscript/jquery.validate.min.js"></script>
<style>
label.error{ color: #E42217; float: none; }
</style>
<script type="text/javascript">
$(document).ready(function() {
	$(".mnge_tt").validate(
		{
			rules:
			{
				tp_name:{
					required:true
				},
				tt_maxamount:{
					required:true
				}
			},
			messages:
			{
				tp_name:"Please enter Name.",
				tt_maxamount:"Please enter Maximum Tax Amount."
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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage Tax Table</h2></fieldset>
<fieldset class="themeFieldset01">
<form method="POST" class="mnge_tt">
<table width="100%" border="0" cellpadding="1" cellspacing="2">
    <tr>
      <td width="30%" class="divTblTH_">&nbsp;</td>
      <td width="70%" class="divTblTH_">&nbsp;</td>
    </tr>
			<tr>
			<form method="POST" class="mnge_tt">
			  <td class="divTblTH_"><div align="right"><span class="style3">Type&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				 <select id='dec_id' name='dec_id' class="longselect" onchange="if(this.options[this.selectedIndex].value != 'N/A')window.location='?statpos=mnge_sc&dec_id='+this.options[this.selectedIndex].value+'&edit='+this.options[this.selectedIndex].value+'&paygroup=<?=$_GET['paygroup']?>&exemption=<?=$_GET['exemption']?>'">
				  <?=html_options2($scheme,$_SESSION['schemevalue'],'edit',$_GET['edit'])?>			
				 </select>			  
			  </td>
			</tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Select Tax Table&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				 <select id='tp_id' name='tp_id' class="longselect" onchange="if(this.options[this.selectedIndex].value != '0')window.location='?statpos=mnge_tt&tp_id='+this.options[this.selectedIndex].value+'&edit='+this.options[this.selectedIndex].value">
				 <option value="0">Please select</option>
				  <?=html_options2($policy,$_SESSION['policyvalue'],'edit',$_GET['edit']?$_GET['edit']:'N/A')?>			
				 </select>			  
			  </td>
			</tr>
            <input type='hidden' name="tp_add">
			<tr>
			<td class="divTblTH_"><div align="right"><span class="style3">Name&nbsp;&nbsp;</span></div></td>
			<td class="divTblTH_"><input size="35" id='tp_name' name='tp_name' value="<?=trim($oData['tp_name'])?>" /></td>
			</tr>
			<tr>
			  <td class="divTblTH_"><div align="right"><span class="style3">Description&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input size="35" id='tp_desc' name='tp_desc' value="<?=trim($oData['tp_desc'])?>" /></td>
			</tr>
			<tr >
			  <td class="divTblTH_"><div align="right"><span class="style3">Effective Date&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_" style="padding:2px;"><input size="23" id='tp_edate' name='tp_edate' value="<?=trim($oData['tp_edate'])?>">&nbsp;<a href="javascript:void(0);" class="option" onclick="return showCalendar('tp_edate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
			</tr>
			<tr <?php if(isset($_GET['paygroup'])){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">13th Month Pay and Other Benefits shall not exceed</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
			  <input size="35" id='tt_other_benefits' name='tp_other_benefits' value="<?=trim($tax_policy['tp_other_benefits'])?>" /></td>
			</tr>
			<tr <?php if(isset($_GET['paygroup'])){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">For single individual or married individual judicially decreed as legally separated with no qualified dependents.</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
			  <input size="35" id='tt_no_q_dependents' name='tp_no_q_dependents' value="<?=trim($tax_policy['tp_no_q_dependents'])?>" /></td>
			</tr>
			<tr <?php if(isset($_GET['paygroup'])){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">For Head of Family</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
			  <input size="35" id='tt_head_family' name='tp_head_family' value='<?=trim($tax_policy['tp_head_family'])?>' /></td>
			</tr>
			<tr <?php if(isset($_GET['paygroup'])){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">For each Married Individual</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
			  <input size="35" id='tt_married_ind' name='tp_married_ind' value='<?=trim($tax_policy['tp_married_ind'])?>' />
			  </td>
			</tr>		
			<tr <?php if(isset($_GET['paygroup'])){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">&nbsp;</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
					<input size="35" id='tt_each_dependent' name='tp_each_dependent' value="<?=trim($tax_policy['tp_each_dependent'])?>" />&nbsp; 
					for each dependent not exceeding &nbsp;
					<input size="35" id='tt_num_dependents' name='tp_num_dependents' value="<?=trim($tax_policy['tp_num_dependents'])?>" /> 
			  
			  </td>
			</tr>
			<tr <?php if($_GET['paygroup']!= '5'){ print "style='display:none;'"; }?>>
			  <td class="divTblTH_"><div align="right"><span class="style3">Maximum Insurance Premium</span></div></td>
			  <td class="divTblTH_" style="padding:2px;">
			  <input size="35" id='tt_max_premium' name='tp_max_premium' value="<?=trim($tax_policy['tp_max_premium'])?>" class="dec"/></td>
			</tr>
			 <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><input type="Submit" name="Submit" value="<?php if(isset($_GET['tp_id'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle">
				<?php if (isset($_GET['tp_id'])){ ?>
				<input type="button" name="Delete" value="Delete" class="buttonstyle" onclick="if(confirm('Are your sure you want to delete '+tp_name.value+'?'))window.location='?statpos=mnge_tt&deletetp&tp_id=<?=$_GET['tp_id']?>'">
				<input type="button" name="Add New" value="Add New" class="buttonstyle" onclick="window.location='?statpos=mnge_tt'" /><?php }else{?>
				<input type="reset" name="Reset" value="Reset" class="buttonstyle"><?php } ?>
				</form>
				</td>
			</tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			</tr>
            <?php if ($_GET['edit'] == 0) {exit;}?>
			<form method="POST" class="mnge_tt">
			<tr>
			  <td class="divTblTH_"><div align="right"><span class="style3">Category&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				<select style="width:150px" name="tt_pay_group" class="longselect"		
				onchange="if(this.options[this.selectedIndex].value != '0')window.location='?statpos=mnge_tt&tp_id=<?=$_GET['tp_id']?>&edit=<?=$_GET['tp_id']?>&paygroup='+this.options[this.selectedIndex].value+'&exemption=<?=$_GET['exemption']?>'"
				>
                <option value="0">Please select</option>
				<?=html_options($paygroup,$_GET['paygroup']?$_GET['paygroup']:'N/A')?>
				</select>		  
			  </td>
			</tr>
			<tr <?php if($_GET['paygroup']== '5'){ print "style='display:none;'"; }?>>
			<td class="divTblTH_"><div align="right"><span class="style3">Tax Exemption&nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_">
				 <select name='tt_exemption' class="longselect"			 
				 onchange="if(this.options[this.selectedIndex].value != '0')window.location='?statpos=mnge_tt&tp_id=<?=$_GET['tp_id']?>&edit=<?=$_GET['tp_id']?>&paygroup=<?=$_GET['paygroup']?>&exemption='+this.options[this.selectedIndex].value">
                 <option value="0">Please select</option>
<?=html_options2($exemption,$_SESSION['exemptionid'],'exemption',$_GET['exemption']?$_GET['exemption']:'N/A')?>
				 </select>
			  </td>
			</tr>
			<tr>
				<td class="divTblTH_"><div align="right"><span class="style3">Maximum Tax Amount&nbsp;&nbsp;</span></div></td>
				<td class="divTblTH_"><input size="15" id='tt_maxamount' name='tt_maxamount' value="<?=trim($tt[0]['tt_maxamount'])?>" class="dec"/></td>
			</tr>
			<tr>
				<td class="divTblTH_"><div align="right"><span class="style3">Minimum Tax Amount&nbsp;&nbsp;</span></div></td>
				<td class="divTblTH_"><input size="15" id='tt_minamount' name='tt_minamount' value="<?=trim($tt[0]['tt_minamount'])?>" class="dec"/></td>
			</tr>
			<tr>
				<td class="divTblTH_"><div align="right"><span class="style3">% over&nbsp;&nbsp;</span></div></td>
				<td class="divTblTH_"><input size="15" id='tt_over_pct' name='tt_over_pct' value="<?=trim($tt[0]['tt_over_pct'])?>" class="dec"/></td>
			</tr>
			<tr>
				<td class="divTblTH_"><div align="right"><span class="style3">Tax amount&nbsp;&nbsp;</span></div></td>
				<td class="divTblTH_"><input size="15" id='tt_taxamount' name='tt_taxamount' value="<?=trim($tt[0]['tt_taxamount'])?>" class="dec"/></td>
			</tr>
			<input type='hidden' name="tt_add" />
			<input type='hidden' name='tax_policy_tp_id' value="<?=$_GET['tp_id']?>" />
			<input type='hidden' name="tp_id" value="<?=$_GET['tp_id']?>" />		
			 <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><input type="submit" name="Submit" value="<?php if(isset($_GET['editt'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle" />
				<?php if (isset($_GET['sc_id'])){ ?>
				<input type="button" name="delete" value="Delete" class="buttonstyle" onclick="if(confirm('Are your sure you want to delete '+sc_code.value+'?'))window.location='?statpos=mnge_sc&deletesc&dec_id=<?=$_GET['dec_id']?>&edit=<?=$_GET['edit']?>&sc_id=<?=$_GET['sc_id']?>'">
				<input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:history.back(0);"><?php }else{?>
				<input type="reset" name="Submit2" value="Reset" class="buttonstyle"><?php } ?>
				<?php if($_GET['editt']) print "
				<input type='hidden' name='tt_update' value='".$_GET['editt']."'>
				<input type='button' name='tt_cancel' value='Cancel' class='buttonstyle' 
				onclick=\"window.location='?statpos=mnge_tt&&tp_id=".$_GET['tp_id']."&edit=".$_GET['edit']."&paygroup=".$_GET['paygroup']."&exemption=".$_GET['exemption']."'\">"; 
				?>
				</form>
				</td>
			</tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
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