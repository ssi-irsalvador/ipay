<!-- this is used to check all the Loan Detail applicable per employee -->
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
		<div id="tab-8" name="Loan" style="width:310; height:100%;">
		<fieldset class="themeFieldset01">
		
		<form method="post" action="" onsubmit="return validate(this,'loan');">	
		<table width="100%" border="0" cellpadding="1" cellspacing="0" class="loan">
    
			<tr>
			  <td class="divTblTH_" width="20%">&nbsp;</td>
			  <td class="divTblTH_" width="30%"></td>
			  <td class="divTblTH_"></td>
		   </tr>
		  
			<tr>
			  <td class="divTblTH_"  align="right"><strong>Pay Element</strong></td>
			  <td class="divTblTH_">
				<select class="longselect" name="psa_id" <?php if($_GET['loanedit'])print "disabled";?>>
				<?=html_options2($loan,$_SESSION['loanvalue'],'psa_id',$loanData[0]['psa_id']?$loanData[0]['psa_id']:'N/A');?>
			  </select>&nbsp;
			  <!--<input name="button" type="button" class="lib" value="..." <?php if($_GET['loanedit'])print "disabled";?> />--></td>
			  <td class="divTblTH_"> <label><strong>Start Period</strong></label><br />
				<select class="midselect" id="smonth" name="loan_startdate[]" <?php if($_GET['loanedit'])print "disabled";?>
				onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan()">
					<?=calendar('month',$loanData[0]['loan_startdate'][0]?$loanData[0]['loan_startdate'][0]:'N/A');?>
				</select>&nbsp;
				<select id="syear" name="loan_startdate[]" <?php if($_GET['loanedit'])print "disabled";?>
				onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan()">	
					<?=calendar('year',$loanData[0]['loan_startdate'][1]?$loanData[0]['loan_startdate'][1]:'N/A');?>
				</select></td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_"  align="right"><strong>Type</strong></td>
			  <td class="divTblTH_">
				<select name="loantype_id" id="loantype_id" class="longselect" <?php if($_GET['loanedit'])print "disabled";?>>
				  <?=html_options_2d($loantype,'loantype_id','loantype_desc',$loanData[0]['loantype_id']?$loanData[0]['loantype_id']:'N/A',false);?>
                </select></td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
				
		  <tr>
			  <td class="divTblTH_" align="right"><strong>Voucher No.</strong></td>
			  <td class="divTblTH_" >
				<input type="text" name="loan_voucher_no" id="loan_voucher_no" value="<?=$loanData[0]['loan_voucher_no']?>" <?php if($_GET['loanedit'])print "disabled";?>>			  </td>
			  <td class="divTblTH_">
				
			  
			  <label><strong>End Period</strong></label>
			 <br />
				<select class="midselect" id="emonth" name="loan_enddate[]" <?php if($_GET['loanedit'])print "disabled";?>
				onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan();">
					<?=calendar('month',$loanData[0]['loan_enddate'][0]?$loanData[0]['loan_enddate'][0]:'N/A');?>
				</select>&nbsp;
				<select id="eyear" name="loan_enddate[]" <?php if($_GET['loanedit'])print "disabled";?>
				onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan();">
					<?=calendar('year',$loanData[0]['loan_enddate'][1]?$loanData[0]['loan_enddate'][1]:'N/A');?>
				</select>			  </td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_" align="right"><strong>Date of Promissory Note</strong></td>
			  <td class="divTblTH_"><input type="text" name="loan_datepromissory" id="loan_datepromissory" <?php if($_GET['loanedit'])print "disabled";?> maxlength="10" <? if($loanData[0]['loan_datepromissory']) print "value=".$loanData[0]['loan_datepromissory'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		      <a href="javascript:void(0);" class="option" onclick="return showCalendar('loan_datepromissory');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
			<td class="divTblTH_" style="font-weight:normal;border:1px solid #F9F9F9; rowspan="3">
			<fieldset class="themeFieldset01" style="width:250px;">
			<legend>Frequency&nbsp; </legend>
			<ul style="list-style:none;margin:4px;">
			<li><input class="noninput" name='pp1' id='pp1' type='checkbox' <?php if(($loanData[0]['loan_periodselection'][0]==1 OR !$_GET['loanedit'])) print "checked=true"; else if(!$_GET['loanedit'])print $s1;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s1)) print "disabled"; ?>>1st Pay Period</li>
			<li><input class="noninput" name='pp2' id='pp2' type='checkbox' <?php if($loanData[0]['loan_periodselection'][1]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s2;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s2)) print "disabled"; ?>>2nd Pay Period</li>
			<li><input class="noninput" name='pp3' id='pp3' type='checkbox' <?php if($loanData[0]['loan_periodselection'][2]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s3;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s3)) print "disabled"; ?>>3rd Pay Period</li>
			<li><input class="noninput" name='pp4' id='pp4' type='checkbox' <?php if($loanData[0]['loan_periodselection'][3]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s4;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s4)) print "disabled"; ?>>4th Pay Period</li>
			<li><input class="noninput" name='pp5' id='pp5' type='checkbox' <?php if($loanData[0]['loan_periodselection'][4]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s5;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s5)) print "disabled"; ?>>5th Pay Period</li>
			</ul>
			</fieldset></td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_" align="right"><strong>Date Granted</strong></td>
			  <td class="divTblTH_" ><input  type="text"  name="loan_dategrant" id="loan_dategrant" <?php if($_GET['loanedit'])print "disabled";?> maxlength="10" <? if($loanData[0]['loan_dategrant']) print "value=".$loanData[0]['loan_dategrant'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		      <a href="javascript:void(0);" class="option" onclick="return showCalendar('loan_dategrant');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
			  <td class="divTblTH_"></td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH_" align="right"><strong>Principal</strong></td>
			  <td class="divTblTH_">
			  <input type="text" class='longtxt' value="<?=number_format($loanData[0]['loan_principal'],2)?>" name="loan_principal" id="loan_principal" <?php if($_GET['loanedit'])print "disabled";?>
			  onkeyup="if(is_num(this.value,this.id)){calculate_loan()}"
			  onblur="this.value=roundf(this.value);"
			  ></td>
			  <td class="divTblTH_">
			  <strong><label>No of Months</label></strong>
			  <input <?php if($_GET['loanedit'])print "disabled";?> readonly type="text" class='longtxt' id="loan_numofmonths" name="loan_numofmonths" value="<?php if($_GET['loanedit']) print $loanData[0]['loan_numofmonths']; else print "1"; ?>">			  </td>
		   </tr> 

		   <tr>
			  <td class="divTblTH_" align="right"> <strong>Interest %</strong></td>
			  <td colspan="2" class="divTblTH_">			 
			  <input type="text" value="<?=number_format($loanData[0]['loan_interestperc'])?>" size="10" name="loan_interestperc" id="loan_interestperc" <?php if($_GET['loanedit'])print "disabled";?> onkeyup="if(is_num(this.value,this.id)){calculate_loan()}" onblur="this.value;calculate_loan();">
			  <strong>Amount</strong>
			  <input  type="text" size="15" <?php if($_GET['loanedit'])print "disabled";?>  value="<?=$loanData[0]['loan_interestamount']?>" 
			  onkeyup="if(is_num(this.value,this.id)){loan_interestperc.value = whatPercent(this.value,loan_principal.value); calculate_loan('',true);}"
			  onblur="this.value;calculate_loan();"name="loan_interestamount" id="loan_interestamount">			  </td>
		   </tr> 
		   
		   
		   
		   <tr>
			  <td class="divTblTH_" align="right"><strong>Total</strong></td>
			  <td class="divTblTH_">
			  <input readonly type="text" class='longtxt' name="loan_total" id="loan_total" <?php if($_GET['loanedit'])print "disabled";?> value="<?=number_format($loanData[0]['loan_total'],2)?>" >			  </td>
			  <td class="divTblTH_">&nbsp;</td>
		   </tr> 
		   
		   <tr>
			  <td class="divTblTH_" >&nbsp;</td>
			  <td class="divTblTH_">			  </td>
			  <td class="divTblTH_">&nbsp;</td>
		   </tr> 
		   
		   <tr>
			  <td class="divTblTH_" align="right"><strong>Monthly Amortization</strong></td>
			  <td class="divTblTH_">
			  <input type="text" class='longtxt' name="loan_monthly_amortization" id="loan_monthly_amortization" value="<?=number_format($loanData[0]['loan_monthly_amortization'],2)?>"></td>
		     <td class="divTblTH_"><label><strong>YTD</strong></label>
	         <input onkeydown = "if(parseFloat(loan_total.value) >= parseFloat(this.value)){loan_balance.value = roundf(loan_total.value - this.value); }
			  else{ alert('Input lower amount.');}" 
			  type="text" class="longtxt" name="loan_ytd" id="loan_ytd" value="<?=number_format($loanData[0]['loan_ytd'],2)?>" 
			  onblur = "this.value=roundf(this.value); if(parseFloat(loan_total.value) >= parseFloat(this.value)){loan_balance.value = roundf(loan_total.value - this.value); }
			  else{ alert('Input lower amount.');}"
			   <?php if($_GET['loanedit'])print "disabled";?> /></td>
	       </tr> 
		   
		   <tr>
			  <td class="divTblTH_" align="right"><strong>Pay Period Deduction</strong></td>
			  <td class="divTblTH_">
			   <input class='longtxt' name="loan_payperperiod" id="loan_payperperiod" value="<?=number_format($loanData[0]['loan_payperperiod'],2)?>" onchange="amortization_loan()"></td>
			  <td class="divTblTH_"><label><strong>Balance</strong></label>
			  <input <?php if($_GET['loanedit'])print "disabled";?> readonly type="text" class="longtxt" name="loan_balance" id="loan_balance" value="<?=number_format($loanData[0]['loan_balance'],2)?>"></td>
		   </tr> 
		   
		   <tr>
		     <td class="divTblTH_" >&nbsp;</td>
		     <td class="divTblTH_"></td>
		     <td class="divTblTH_"><label style="float:left;color:#FF0000"><strong>Suspend:</strong><input class="noninput" type="checkbox" name="loan_suspend" <?if($loanData[0]['loan_suspend']==1)print "checked";?>></label></td>
	      </tr>
		   <tr>
		     <td class="divTblTH_">&nbsp;</td>
		     <td class="divTblTH_">&nbsp;</td>
		     <td class="divTblTH_"><input type="submit" <?php if($_GET['loanedit']){?>name="loanupdate" value="Update"<?php }else{ ?>name="loan" id="addloan" value="Save"<?php } ?> class="buttonstyle">
               <?php if(!$_GET['loanedit']){?>
               <input type="reset" name="loanreset" value="Reset" class="buttonstyle" />
               <?php }?>
               <input type="button" name="loancancel" value="Cancel" onclick="cancel('?statpos=emp_masterfile&empinfo=<?=$_GET['empinfo']?>#tab-8')" class="buttonstyle" /></td>
	      </tr>
		   <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
	       </tr>
		  </table>

		</form>
		</fieldset>
		<fieldset class="themeFieldset01">
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
			  <td colspan="4" style="font-weight:normal"><?=$loanList?></td>
			</tr>
		</table>
		</fieldset>
</div>	
<script language="javascript" type="text/javascript">
	function calculate_loan(id,ihasFocus){
		var  p =  document.getElementById('loan_principal');
		var  i =  document.getElementById('loan_interestperc');
		var  t =  document.getElementById('loan_total');
		var ia =  document.getElementById('loan_interestamount');
		var  n =  document.getElementById('loan_numofmonths');
		var  a =  document.getElementById('loan_monthly_amortization');
		var pe = document.getElementById('loan_payperperiod');
		var ytd = document.getElementById('loan_ytd');
		var bal = document.getElementById('loan_balance');
		
		var convertMonths= [];
			convertMonths["January"] = 1;
			convertMonths["February"] = 2;
			convertMonths["March"]=3;
			convertMonths["April"]=4;
			convertMonths["May"]=5;
			convertMonths["June"]=6;
			convertMonths["July"]=7;
			convertMonths["August"]=8;
			convertMonths["September"]=9;
			convertMonths["October"]=10;
			convertMonths["November"]=11;
			convertMonths["December"]=12;
		
		
		
		if(i.value==''){
			alert(whatpercent(p.value,ia.value));
		}
		
		if(is_num(p.value) && is_num(i.value) && is_num(n.value)){
		
			//amount = roundf(parseFloat(p.value)*percent(parseFloat(i.value))); //Amount = Principal x Interest
			//total  = roundf(parseFloat(p.value)+parseFloat(amount)); //Total = Principal + Amount
			
			amount = roundf(parseFloat(p.value)*percent(parseFloat(i.value))); //Amount = Principal x Interest
			total  = roundf(parseFloat(p.value)+parseFloat(ia.value)); //Total = Principal + Amount
			
			months = n.value>0?n.value:1;
			amortization=roundf(parseFloat(total)/parseFloat(months));	//Monthly Amortization = Total / No of Months
										
			divisor = tick(id,'loan');
			payperperiod = roundf(amortization/divisor); //Pay Per Period = Amortization / No of Pay Periods selected
			
			if(ihasFocus != true){ia.value = amount;	}
			t.value  = total;
			a.value  = amortization;
			pe.value = payperperiod;	

			var currMonth = <?=date('m'); ?>;
			var currYear = <?=date('Y'); ?>;
			var eMonth = document.getElementById('emonth').value;
			var sMonth = document.getElementById('smonth').value;
			
			eMonth = convertMonths[eMonth];
			sMonth = convertMonths[sMonth];
			
			var eYear = document.getElementById('eyear').value;
			var sYear = document.getElementById('syear').value;
			var ytd_ = (currYear < sYear)?0.00: roundf(getNumofMonths('loanytd','','') * amortization) ;
			ytd_ = (currYear == eYear && currMonth >= eMonth) ? t.value : ytd_;
			ytd.value = ytd_;
			bal.value = roundf(t.value - ytd.value);//balance computation
		}else{
			return false;
		}
	}
	
	function amortization_loan(id,ihasFocus){
		var pe = document.getElementById('loan_payperperiod');
		var  a = document.getElementById('loan_monthly_amortization');
		
		numTimes = tick(id,'loan');
		
		/*amortization=roundf(parseFloat(total)/parseFloat(months));	//Monthly Amortization = Total / No of Months							
		divisor = tick(id,'loan');
		payperperiod = roundf(amortization/divisor);*/

		amortization = roundf(document.getElementById('loan_payperperiod').value * numTimes);
		a.value = amortization;
		/*alert(pe.value);
		alert(a.value);*/
	}
	
	function acceptValidNumbersOnly(obj,e) {
		var key='';
		var strcheck = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+=`{}[]:\";'\|/?,><\\ ";
		var whichcode = (window.Event) ? e.which : e.keyCode;
		try{
		if(whichcode == 13 || whichcode == 8)return true;
		key = String.fromCharCode(whichcode);
		if(strcheck.indexOf(key) != -1)return false;
		return true;
		}catch(e){;}
	}
</script>