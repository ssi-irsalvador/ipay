<!-- this is used to check all the Bank Detail applicable per employee -->
		<div id="tab-7" name="Benefit" style="width:310; height:100%; overflow:inherit">
		<!-- 
		<fieldset class="themeFieldset01">
		<form method="post" >
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel" style="color:#FF0000">Suspend</strong>
			    <input class="noninput" type="checkbox" name="ben_suspend" id="ben_suspend" <?if($benData[0]['ben_suspend']==1)print "checked";?> /></td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
			<tr>
			  <td class="divTblTH_" width="15%">&nbsp;</td>
			  <td class="divTblTH_" width="45%"><strong class="longlabel">Type</strong>Fixed
			    <input <?php if($_GET['benedit'])print "disabled";?> type="radio" name="ben_isfixed" value="0" id="pfree"   class="noninput" checked onclick="ben_amount.disabled=false;ben_amount.value='0.00';ben_payperday.value='0.00';document.getElementById('lblpe').style.display='block';document.getElementById('tamount').style.display='block';document.getElementById('lblapp').style.display='block';document.getElementById('apperiod').style.display='block'" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==0) print "checked";?> />&nbsp;
Free
<input <?php if($_GET['benedit'])print "disabled";?> type="radio" name="ben_isfixed" value="1" id="pfixed"  class="noninput"  onclick="ben_amount.disabled=true;ben_payperday.value='0.00';ben_amount.value='0.00';document.getElementById('lblpe').style.display='none';document.getElementById('tamount').style.display='none';document.getElementById('lblapp').style.display='none';document.getElementById('apperiod').style.display='none'" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==1) print "checked";?> /></td>
			  <td width="40%" rowspan="6" valign="top" class="divTblTH_"><fieldset class="themeFieldset01" style="width:220px;">
              <legend>Frequency&nbsp;</legend>
              <ul style="list-style:none;margin:4px;">
                <li>
                  <input class="noninput" name="ben1" id="ben1" type='checkbox' <?php if(($benData[0]['ben_periodselection'][0]==1 OR (!$_GET['benedit'] ))) print "checked=true"; else if(!$_GET['benedit']) print $s1;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s1)) print "disabled"; ?> />
                  1st Pay Period</li>
                <li>
                  <input class="noninput" name="ben2" id="ben2" type='checkbox' <?php if($benData[0]['ben_periodselection'][1]==1) print "checked=true"; else if(!$_GET['benedit']) print $s2;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s2)) print "disabled"; ?> />
                  2nd Pay Period</li>
                <li>
                  <input class="noninput" name="ben3" id="ben3" type='checkbox' <?php if($benData[0]['ben_periodselection'][2]==1) print "checked=true"; else if(!$_GET['benedit']) print $s3;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s3)) print "disabled"; ?> />
                  3rd Pay Period</li>
                <li>
                  <input class="noninput" name="ben4" id="ben4" type='checkbox' <?php if($benData[0]['ben_periodselection'][3]==1) print "checked=true"; else if(!$_GET['benedit']) print $s4;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s4)) print "disabled"; ?> />
                  4th Pay Period</li>
                <li>
                  <input class="noninput" name="ben5" id="ben5" type='checkbox' <?php if($benData[0]['ben_periodselection'][4]==1) print "checked=true"; else if(!$_GET['benedit']) print $s5;?> onclick="tick(this.id,'ben');<?php if(!$_GET['benedit']){?>calculate_ben(this.id)<?php } ?>" <?php if(empty($s5)) print "disabled"; ?> />
                  5th Pay Period</li>
              </ul>
			  </fieldset></td>
		   </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">				
				<strong class="longlabel">Pay Element</strong>
				<select class="longselect" name="psa_id" id="psa_id" <?php if($_GET['benedit'])print "disabled";?>>
				<?=html_options2($payelement,$_SESSION['payvalue'],'',$benData[0]['psa_id']?$benData[0]['psa_id']:'N/A');?>
			  </select>&nbsp;</td>
	      </tr>	
		  
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">
				<strong class="longlabel">Start Period</strong>
			<input type="text" class="txtfields" name="ben_startdate" id="ben_startdate" maxlength="10" <? if($benData[0]['ben_startdate']) print "value=".$benData[0]['ben_startdate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/><a href="javascript:void(0);" class="option" onclick="return showCalendar('ben_startdate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absmiddle" /></a></td>
          </tr>
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_" valign="bottom"><strong class="longlabel">End Period</strong>
			    <input type="text" class="txtfields" name="ben_enddate" id="ben_enddate" maxlength="10" <? if($benData[0]['ben_enddate']) print "value=".$benData[0]['ben_enddate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/><a href="javascript:void(0);" class="option" onclick="return showCalendar('ben_enddate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absmiddle" /></a></td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><div id="lblpe" class="longlabel"><span style="display:block"><b>Base Amount</strong></span></div>
			    <div id="tamount" style="display:block">
                <input class="txtfields" <?php if($_GET['benedit'])print "disabled";?> type="text" class='longtxt' name="ben_amount" id="ben_amount"  value="<?php if($benData[0]['ben_amount']){print number_format($benData[0]['ben_amount'],2); }else{?>0.00<?php }?>"
			  onkeyup="if(is_num(this.value,this.id)){calculate_ben()}" 
			  onblur="this.value=roundf(this.value);" />
		      </div></td>
          </tr>
		  <tr>
			  <td height="25" class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><div id="lblapp"><strong class="longlabel">Amount per Payroll</strong></div>
			  <div id="apperiod">
              <input class="txtfields" <?php if($_GET['benedit'])print "disabled";?> type="text" class='longtxt' name="ben_payperday" id="ben_payperday"  value="<?php if($benData[0]['ben_payperday']){print number_format($benData[0]['ben_payperday'],2); }else{?>0.00<?php }?>" readonly/>
	        </div></td>
	      </tr> 
		   <tr>
			  <td class="divTblTH_">&nbsp;</td>
		     <td class="divTblTH_"><strong class="longlabel">&nbsp;</strong><input type="submit" <?php if($_GET['benedit']){?>name="benefitupdate" value="Update"<?php }else{ ?>name="addben" id="addben" value="&nbsp;Save&nbsp;"<?php } ?> class="buttonstyle">
	         <input name="button" type="button" class="buttonstyle" onclick="cancel('?statpos=emp_masterfile&amp;empinfo=<?php print $_GET['empinfo']?>#tab-7')"  value="Cancel" /></td>
			  <td class="divTblTH_" height="25">&nbsp;</td>
		   </tr>
		   <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		   </tr>
		  </table>
		<input type="hidden" name="emp_id" value="<?php print $_GET['empinfo'];?>">
		</form>
		</fieldset>-->
        <a class="buttonstyle" href="?statpos=recur_setup&edit=<?php echo $_GET['empinfo']; ?>">Recurring Form</a>
		<fieldset class="themeFieldset01">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td colspan="4" style="font-weight:normal"><?=$benList?></td>
			</tr>
		</table>
		</fieldset>
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
		