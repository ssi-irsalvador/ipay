<!-- import the calendar css -->
<link rel="stylesheet" type="text/css" href="../includes/jscript/calendar/calendar-mos.css" />
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<!-- END -->
<script type="text/javascript" src="../includes/jquery/jquery1.7.2.min.js"></script>
<script language="javascript" type="text/javascript">
        $(function(){$('#loan_principal').on('keyup', function(e) {    
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
        $(function(){$('#loan_interestperc').on('keyup', function(e) {    
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
        $(function(){$('#loan_ytd').on('keyup', function(e) {    
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
        $(function(){$('#loan_interestamount').on('keyup', function(e) {    
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
		$(function(){$('#loan_total').on('keyup', function(e) {    
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
		$(function(){$('#loan_monthly_amortization').on('keyup', function(e) {    
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
		$(function(){$('#loan_payperperiod').on('keyup', function(e) {    
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
		$(function(){$('#loan_balance').on('keyup', function(e) {    
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
<?php
$salary = $salaryClass;
$c = "checked";
switch ($salary){
	case '1': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
	case '2': $s1 = $c; $s2 = $c;$s3 = $c; $s4 = $c; $s5 = $c; $num_period=5; break;
	case '3': $s1 = $c; $s2 = $c;$s3 = ""; $s4 = ""; $s5 = ""; $num_period=2; break;
	case '4': $s1 = $c; $s2 = $c;$s3 = ""; $s4 = ""; $s5 = ""; $num_period=2; break;
	case '5': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
	case '6': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
	default:  $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
}
?>

<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Loan Application Form</h2></fieldset>
<form method="post" action="" onsubmit="return validate(this,'loan');">
<fieldset class="themeFieldset01" style="background-color: #FFF;">
  <table border="0" cellpadding="0" cellspacing="1" width="100%">
      <tr>
        <td width="15%"><em>Employee No</em></td>
        <td width="31%"><strong><?=$oDataEMP['emp_idnum']?>
        </strong></td>
        <td width="13%"><em>Company</em></td>
        <td width="41%" valign="top"><strong><?=$oDataEMP['comp_name']?></strong></td>
      </tr>
      <tr>
        <td><em>Employee Name</em></td>
        <td><strong><?=$oDataEMP['empname']?>
        </strong></td>
        <td><em>Location</em></td>
        <td valign="top"><strong><?=$oDataEMP['branchinfo_name']?></strong></td>
      </tr>
      <tr>
        <td><em>Position</em></td>
        <td><strong>
          <?=$oDataEMP['post_name']?>
        </strong></td>
        <td><em>Department</em></td>
        <td valign="top"><strong>
          <?=$oDataEMP['ud_name']?>
        </strong></td>
      </tr>
  </table>
</fieldset><br />
<fieldset class="themeFieldset01">
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
<!--<legend class="themeLegend01">Loan Application Form</legend>-->
	<table width="100%" border="0" cellpadding="2" cellspacing="0" class="loan">
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"></td>
		  </tr>
			<tr>
			  <td class="divTblTH_" width="13%">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel" style="color:#FF0000">Suspend</strong>
			      <input class="noninput" type="checkbox" name="loan_suspend" <?if($loanData[0]['loan_suspend']==1)print "checked";?> /></td>
			  <td class="divTblTH_"><!--<strong <?php if($_GET['loanedit'])print "style=visibility:visible"; else print "style=visibility:hidden";?> class="buttonstyle"><a href="javascript:;" onclick="javascript: openwindow('popup.php?statpos=popuploanpaymenthistory&emp_id=<?=$_GET['edit']?>&loan_id=<?=$_GET['loanedit']?>&loantype_id='+document.getElementById('loantype_id').value, 'searchwindow', '');">Loan Payment History</a></strong>--></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Pay Element</strong>
				<select class="longselect" name="psa_id" id="psa_id" <?php if($_GET['loanedit'])print "disabled";?>>
				<?=html_options2($loan,$_SESSION['loanvalue'],'psa_id',$loanData[0]['psa_id']?$loanData[0]['psa_id']:'N/A');?>
			  </select></td>
			  <td class="divTblTH_"><strong class="longlabel">Start Period</strong>
			  <select class="datemselect" id="smonth" name="loan_startdate[]" onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan()">
					<?=calendar('month',$loanData[0]['loan_startdate'][0]?$loanData[0]['loan_startdate'][0]:'N/A');?>
				</select>&nbsp;
				<select id="syear" name="loan_startdate[]" class="dateyselect" onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan()">	
					<?=calendar('year',$loanData[0]['loan_startdate'][1]?$loanData[0]['loan_startdate'][1]:'N/A');?>
				</select></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Loan Type</strong>
			    <select name="loantype_id" id="loantype_id" class="longselect" <?php if($_GET['loanedit'])print "disabled";?>>
                <?=html_options_2d($loantype,'loantype_id','loantype_desc',$loanData[0]['loantype_id']?$loanData[0]['loantype_id']:'N/A',false);?>
              </select></td>
		      <td class="divTblTH_"><strong class="longlabel">End Period</strong>
			  <select class="datemselect" id="emonth" name="loan_enddate[]" onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan();" >
					<?=calendar('month',$loanData[0]['loan_enddate'][0]?$loanData[0]['loan_enddate'][0]:'N/A');?>
				</select>&nbsp;
				<select id="eyear" name="loan_enddate[]" class="dateyselect" onchange="getNumofMonths('loan','loan_numofmonths','addloan');calculate_loan();">
					<?=calendar('year',$loanData[0]['loan_enddate'][1]?$loanData[0]['loan_enddate'][1]:'N/A');?>
				</select></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Voucher No.</strong>
			  <input type="text" name="loan_voucher_no" id="loan_voucher_no" class="txtfields" value="<?=$loanData[0]['loan_voucher_no']?>" /></td>
		      <td class="divTblTH_"><strong class="longlabel">No of Months</strong>
			  <input name="loan_numofmonths" type="text" class="txtfieldsmall" id="loan_numofmonths" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" value="<?php if($_GET['loanedit']) print $loanData[0]['loan_numofmonths']; else print "1"; ?>" size="5" readonly="readonly"></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Promissory Date</strong>
			    <input type="text" name="loan_datepromissory" id="loan_datepromissory" class="txtfields" maxlength="10" <? if($loanData[0]['loan_datepromissory']) print "value=".$loanData[0]['loan_datepromissory'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');" />
		      <a href="javascript:void(0);" class="option" onclick="return showCalendar('loan_datepromissory');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
		      <td rowspan="5" class="divTblTH_"><fieldset class="themeFieldset01" style="width:250px;">
			<legend>Frequency</legend>
			<ul style="list-style: none; margin: 4px;">
			<li><input class="noninput" name='pp1' id='pp1' type='checkbox' <?php if(($loanData[0]['loan_periodselection'][0]==1 OR !$_GET['loanedit'])) print "checked=true"; else if(!$_GET['loanedit'])print $s1;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s1)) print "disabled"; ?>>1st Pay Period</li>
			<li><input class="noninput" name='pp2' id='pp2' type='checkbox' <?php if($loanData[0]['loan_periodselection'][1]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s2;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s2)) print "disabled"; ?>>2nd Pay Period</li>
			<li><input class="noninput" name='pp3' id='pp3' type='checkbox' <?php if($loanData[0]['loan_periodselection'][2]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s3;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s3)) print "disabled"; ?>>3rd Pay Period</li>
			<li><input class="noninput" name='pp4' id='pp4' type='checkbox' <?php if($loanData[0]['loan_periodselection'][3]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s4;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s4)) print "disabled"; ?>>4th Pay Period</li>
			<li><input class="noninput" name='pp5' id='pp5' type='checkbox' <?php if($loanData[0]['loan_periodselection'][4]==1) print "checked=true"; else if(!$_GET['loanedit']) print $s5;?> onclick="tick(this.id,'loan');<?php if(!$_GET['loanedit']){?>calculate_loan(this.id)<?php } ?>" <?php if(empty($s5)) print "disabled"; ?>>5th Pay Period</li>
			</ul>
			</fieldset></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Date Granted</strong>
			  <input  type="text"  name="loan_dategrant" id="loan_dategrant" class="txtfields" maxlength="10" <? if($loanData[0]['loan_dategrant']) print "value=".$loanData[0]['loan_dategrant'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
		      <a href="javascript:void(0);" class="option" onclick="return showCalendar('loan_dategrant');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absbottom" /></a></td>
	      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Principal</strong><input type="text" value="<?=$loanData[0]['loan_principal']?>" name="loan_principal" id="loan_principal" class="txtfields" onkeyup="if(is_num(this.value,this.id)){calculate_loan()}"  onblur="this.value=this.value;" style="text-align:right"></td>
	      </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Interest</strong><input name="loan_interestperc" type="text" id="loan_interestperc" onblur="this.value;calculate_loan();" onkeyup="if(is_num(this.value,this.id)){calculate_loan()}" value="<?=number_format($loanData[0]['loan_interestperc'])?>" size="10" style="text-align:right">
			  <strong> % </strong>
			  <input  type="text" size="12" value="<?=$loanData[0]['loan_interestamount']?>" onkeyup="if(is_num(this.value,this.id)){loan_interestperc.value = whatPercent(this.value,loan_principal.value); calculate_loan('',true);}" name="loan_interestamount" id="loan_interestamount" style="text-align:right">
			  <strong>Amount</strong></td>
	      </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong class="longlabel">Total Loan</strong>
		      <input type="text" name="loan_total" id="loan_total" class="txtfields" value="<?=$loanData[0]['loan_total']?>" style="text-align:right"/></td>
		  </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong>Monthly Amortization</strong>
			  <input type="text" class="txtfields" name="loan_monthly_amortization" id="loan_monthly_amortization" value="<?=$loanData[0]['loan_monthly_amortization']?>" style="text-align:right"/></td>
			  <td class="divTblTH_"><strong class="longlabel">YTD</strong>
		      <input onkeydown = "if(parseFloat(loan_total.value) >= parseFloat(this.value)){loan_balance.value = (loan_total.value - this.value).toFixed(<?= $genDecimal?>); }
			  else{ alert('Input lower amount.');}" 
			  type="text" class="txtfields" name="loan_ytd" id="loan_ytd" value="<?=$loanData[0]['loan_ytd']?>" 
			  onblur = "this.value=this.value; if(parseFloat(loan_total.value) >= parseFloat(this.value)){loan_balance.value = loan_total.value - this.value; }
			  else{ alert('Input lower amount.');}" style="text-align:right"/></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><strong>Pay Period Deduction</strong>
			  <input class="txtfields" name="loan_payperperiod" id="loan_payperperiod" value="<?=$loanData[0]['loan_payperperiod']?>" onchange="amortization_loan()" style="text-align:right"/></td>
			  <td class="divTblTH_"><strong class="longlabel">Balance</strong>
			  <input type="text" class="txtfields" name="loan_balance" id="loan_balance" value="<?=$loanData[0]['loan_balance']?>" style="text-align:right"/></td>
		   </tr>
		  
		    <tr>
		      <td colspan="3" align="center" class="divTblTH_">&nbsp;</td>
	      </tr>
	       <tr>
		     <td colspan="3" align="center" class="divTblTH_"><input type="submit" <?php if($_GET['loanedit']){?>name="loanupdate" value="Update"<?php }else{ ?>name="loan" id="addloan" value="Save"<?php } ?> class="buttonstyle">
               <?php if($_GET['loanedit']){?>
			   <input type="button" name="loancancel" value="Cancel" onclick="cancel('?statpos=loan_app&edit=<?=$_GET['edit']?>')" class="buttonstyle" />
               <?php }else{ ?>
			   <input type="reset" name="loanreset" value="Reset" class="buttonstyle" /><?php } ?>
               </td>
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
<script type="text/javascript">
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
		
			//amount = parseFloat(p.value)*percent(parseFloat(i.value)); //Amount = Principal x Interest
			//total  = parseFloat(p.value)+parseFloat(amount); //Total = Principal + Amount
			
			amount = parseFloat(p.value)*percent(parseFloat(i.value)); //Amount = Principal x Interest
			total  = parseFloat(p.value)+parseFloat(ia.value); //Total = Principal + Amount
			
			months = n.value>0?n.value:1;
			amortization=parseFloat(total)/parseFloat(months);	//Monthly Amortization = Total / No of Months
										
			divisor = tick(id,'loan');
			payperperiod = amortization/divisor; //Pay Per Period = Amortization / No of Pay Periods selected
			
			if(ihasFocus != true){ia.value = amount.toFixed(<?= $genDecimal?>);	}
			t.value  = total.toFixed(<?= $genDecimal?>);
			a.value  = amortization.toFixed(<?= $genDecimal?>);
			pe.value = payperperiod.toFixed(<?= $genDecimal?>);	

			var currMonth = <?=date('m'); ?>;
			var currYear = <?=date('Y'); ?>;
			var eMonth = document.getElementById('emonth').value;
			var sMonth = document.getElementById('smonth').value;
			
			eMonth = convertMonths[eMonth];
			sMonth = convertMonths[sMonth];
			
			var eYear = document.getElementById('eyear').value;
			var sYear = document.getElementById('syear').value;
			var ytd_ = (currYear < sYear)?0.00: getNumofMonths('loanytd','','') * amortization ;
			ytd_ = (currYear == eYear && currMonth >= eMonth) ? t.value : ytd_;
			<!--ytd.value = ytd_;-->
			<!--bal.value = roundf(t.value - ytd.value);-->
			ytd.value = 0.00;
			bal.value = (t.value - ytd.value).toFixed(<?= $genDecimal?>);//balance computation
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
		payperperiod = amortization/divisor;*/

		amortization = document.getElementById('loan_payperperiod').value * numTimes;
		a.value = amortization.toFixed(<?= $genDecimal?>);
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