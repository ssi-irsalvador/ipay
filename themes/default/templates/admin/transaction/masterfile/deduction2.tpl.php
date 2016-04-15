<!-- this is used to check all the Bank Detail applicable per employee -->
		<div id="tab-7" name="Benefit" style="width:310; height:100%; overflow:inherit">
		<fieldset class="themeFieldset01">
		<form method="post" >	
		<table width="100%" border="0" cellpadding="1" cellspacing="2">
			<tr>
			  <td class="divTblTH_" width="10%">&nbsp;</td>
			  <td class="divTblTH_" width="15%"></td>
			  <td class="divTblTH_">&nbsp;</td>
		   </tr>
		  
			<tr>
			  <td class="divTblTH_" width="10%"><b> </b>
			    <div align="right"><span class="style3"><b>Pay Element</b>&nbsp;&nbsp;</span></div>		      </td>
			  <td class="divTblTH_">				
				<select class="longselect" name="psa_id" id="psa_id" <?php if($_GET['benedit'])print "disabled";?>>
				<?=html_options2($payelement,$_SESSION['payvalue'],'',$benData[0]['psa_id']?$benData[0]['psa_id']:'N/A');?>
				</select>&nbsp;
			  <!--<input type="button" value="..." class="lib">-->			  </td>
			  <td class="divTblTH_">
			  Fixed &nbsp;<input <?php if($_GET['benedit'])print "disabled";?> type="radio" name="ben_isfixed" value="0" id="pfree"   class="noninput" checked onclick="ben_amount.disabled=false;ben_amount.value='0.00';ben_payperday.value='0.00';document.getElementById('lblpe').style.display='block';document.getElementById('tamount').style.display='block';document.getElementById('lblapp').style.display='block';document.getElementById('apperiod').style.display='block'" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==0) print "checked";?>>
			  
			  Free &nbsp;<input <?php if($_GET['benedit'])print "disabled";?> type="radio" name="ben_isfixed" value="1" id="pfixed"  class="noninput"  onclick="ben_amount.disabled=true;ben_payperday.value='0.00';ben_amount.value='0.00';document.getElementById('lblpe').style.display='none';document.getElementById('tamount').style.display='none';document.getElementById('lblapp').style.display='none';document.getElementById('apperiod').style.display='none'" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==1) print "checked";?>></td>
		  </tr>
				
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_" valign="bottom">			  </td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">
				<label><b>Start Period</b></label><br>
				<select <?php if($_GET['benedit'])print "disabled";?> class="midselect" name="ben_startdate[]" id="bensmonth" onchange="getNumofMonths('ben','','addben');">
					<?=calendar('month',$benData[0]['ben_startdate'][0]?$benData[0]['ben_startdate'][0]:'N/A');?>
				</select>&nbsp;
				<select <?php if($_GET['benedit'])print "disabled";?> class="midselect" name="ben_startdate[]" id="bensyear" onchange="getNumofMonths('ben','','addben');">
					<?=calendar('year',$benData[0]['ben_startdate'][1]?$benData[0]['ben_startdate'][1]:'N/A');?>
				</select></td>
			  <td class="divTblTH_" style="font-weight:normal;border:1px solid #F9F9F9;width:30%" rowspan="3">
			<fieldset class="themeFieldset01" style="width:250px;">
			<legend>Every:</legend>
			<?php
				
			
			?>
			<ul style="list-style:none;margin:4px;">
			
			<li>	<input class="noninput" name="ben1" id="ben1" type='checkbox' <?php if(($benData[0]['ben_periodselection'][0]==1 OR (!$_GET['benedit'] ))) print "checked=true"; else if(!$_GET['benedit']) print $s1;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s1)) print "disabled"; ?>>1st Pay Period</li>
			<li>	<input class="noninput" name="ben2" id="ben2" type='checkbox' <?php if($benData[0]['ben_periodselection'][1]==1) print "checked=true"; else if(!$_GET['benedit']) print $s2;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s2)) print "disabled"; ?>>2nd Pay Period</li>
			<li>	<input class="noninput" name="ben3" id="ben3" type='checkbox' <?php if($benData[0]['ben_periodselection'][2]==1) print "checked=true"; else if(!$_GET['benedit']) print $s3;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s3)) print "disabled"; ?>>3rd Pay Period</li>
			<li>	<input class="noninput" name="ben4" id="ben4" type='checkbox' <?php if($benData[0]['ben_periodselection'][3]==1) print "checked=true"; else if(!$_GET['benedit']) print $s4;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s4)) print "disabled"; ?>>4th Pay Period</li>
			<li>	<input class="noninput" name="ben5" id="ben5" type='checkbox' <?php if($benData[0]['ben_periodselection'][4]==1) print "checked=true"; else if(!$_GET['benedit']) print $s5;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s5)) print "disabled"; ?>>5th Pay Period</li>
			</ul>
			</fieldset>			  </td>
		  </tr>
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_" valign="bottom"><label><b>End Period</label>
			 <br>
			 <select <?php if($_GET['benedit'])print "disabled";?> class="midselect" name="ben_enddate[]" id="benemonth" onchange="getNumofMonths('ben','','addben');">
					<?=calendar('month',$benData[0]['ben_enddate'][0]?$benData[0]['ben_enddate'][0]:'N/A');?>
				</select>&nbsp;
				<select <?php if($_GET['benedit'])print "disabled";?> class="midselect" name="ben_enddate[]" id="beneyear" onchange="getNumofMonths('ben','','addben');">
					<?=calendar('year',$benData[0]['ben_enddate'][1]?$benData[0]['ben_enddate'][1]:'N/A');?>
				</select>			</td>
		  </tr>
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">			  </td>
		  </tr>
		  <tr>
			  <td class="divTblTH_" width="10%"><div align="right" id="lblpe"><span style="display:block"><b>Total Amount</b></span></div></td>
			  <td class="divTblTH_">
			  <div id="tamount" style="display:block">
			  <input <?php if($_GET['benedit'])print "disabled";?> type="text" class='longtxt' name="ben_amount" id="ben_amount"  value="<?php if($benData[0]['ben_amount']){print number_format($benData[0]['ben_amount'],2); }else{?>0.00<?php }?>"
			  onkeyup="if(is_num(this.value,this.id)){calculate_ben()}" 
			  onblur="this.value=roundf(this.value);"></div></td>
			  <td class="divTblTH_" height="25px">
			   <label style="float:left;color:#FF0000"><b>Suspend:<input class="noninput" type="checkbox" name="ben_suspend" id="ben_suspend" <?if($benData[0]['ben_suspend']==1)print "checked";?>></label>			  </td>
		  </tr> 
		   <tr>
			  <td class="divTblTH_" width="10%"><div align="right" id="lblapp"><span class="style3"><strong>Amout per Pay Period</strong>&nbsp;&nbsp;</span></div>			    </td>
		     <td class="divTblTH_"><div id="apperiod">
	         <input <?php if($_GET['benedit'])print "disabled";?> type="text" class='longtxt' name="ben_payperday" id="ben_payperday"  value="<?php if($benData[0]['ben_payperday']){print number_format($benData[0]['ben_payperday'],2); }else{?>0.00<?php }?>" readonly/></div></td>
			  <td class="divTblTH_" height="25px">
			  <input type="submit" <?php if($_GET['benedit']){?>name="benefitupdate" value="Update"<?php }else{ ?>name="addben" id="addben" value="Save"<?php } ?> class="buttonstyle">
			
				<input type="button"  value="Cancel" onclick="cancel('?statpos=emp_masterfile&empinfo=<?php print $_GET['empinfo']?>#tab-7')" class="buttonstyle">			  </td>
		   </tr>
		   <tr>
			  <td class="divTblTH_" width="10%">&nbsp;</td>
			  <td class="divTblTH_">			  </td>
			  <td class="divTblTH_">&nbsp;</td>
		   </tr>
		  </table>
		<input type="hidden" name="emp_id" value="<?php print $_GET['empinfo'];?>">
		</form>
		</fieldset>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td colspan="4" style="font-weight:normal"><?=$benList?></td>
			</tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td colspan="4"><?//=printa($benData)?></td>
			</tr>
		</table>
</div>		
<script>
	function calculate_ben(id,ihasFocus){
		var  p =  document.getElementById('ben_amount');
		var  i =  document.getElementById('ben_payperday');
		if(is_num(p.value)){
			amortization = document.getElementById('ben_amount').value;						
			divisor = tick(id,'ben');
			payperperiod = roundf(amortization/divisor); //Pay Per Period = Amortization / No of Pay Periods selected
			i.value = payperperiod;		
		}else{
			return false;
		}
	}
</script>
		