<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>
<!-- END -->
<script type="text/javascript" src="../includes/jquery/jquery1.7.2.min.js"></script>
<script language="javascript" type="text/javascript">
        $(function(){$('#ben_amount').on('keyup', function(e) {    
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
<form method="post" action="" onsubmit="return validate(this,'loan');">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Recurring Form</h2></fieldset>
<fieldset class="themeFieldset01" style="background-color: #FFF;">
  <table border="0" cellpadding="0" cellspacing="1" width="100%">
      <tr>
        <td width="15%"><em>Employee No</em></td>
        <td width="31%"><strong><?=$oDataEMP['emp_idnum']?>
        </strong></td>
        <td width="13%"><em>Company</em></td>
        <td width="41%" valign="top"><b><?=$oDataEMP['comp_name']?></b></td>
      </tr>
      <tr>
        <td><em>Employee Name</em></td>
        <td><b><?=$oDataEMP['empname']?>
        </b></td>
        <td><em>Location</em></td>
        <td valign="top"><strong><?=$oDataEMP['branchinfo_name']?></strong></td>
      </tr>
      <tr>
        <td><em>Position</em></td>
        <td><strong>
          <?=$oDataEMP['post_name']?>
        </strong></td>
        <td><em>Department</em></td>
        <td valign="top"><strong><?=$oDataEMP['ud_name']?></strong></td>
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
<!--<legend class="themeLegend01">Recurring Form</legend>-->
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH"><strong class="longlabel" style="color:#FF0000">Suspend</strong>
			    <input class="noninput" type="checkbox" name="ben_suspend" id="ben_suspend" <?if($benData[0]['ben_suspend']==1)print "checked";?> /> <input type="hidden" name="emp_id" value="<?php print $_GET['edit'];?>"></td>
			  <td class="divTblTH">&nbsp;</td>
		  </tr>
			<tr>
			  <td class="divTblTH" width="15%">&nbsp;</td>
			  <td class="divTblTH" width="45%"><strong class="longlabel">Type</strong>Fixed
			    <input type="radio" name="ben_isfixed" value="0" id="pfree" class="noninput" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==0) print "checked";?> checked onclick = "ben_amount.disabled=false;ben_amount.value='0.00';ben_payperday.value='0.00'"/>&nbsp;
Free
<input type="radio" name="ben_isfixed" value="1" id="pfixed" class="noninput" <?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==1) print "checked";?> onclick = "ben_payperday.value='0.00';ben_amount.value='0.00';" /></td>
			  <td width="40%" rowspan="6" valign="top" class="divTblTH"><fieldset class="themeFieldset01" style="width:220px;">
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
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH">				
				<strong class="longlabel">Pay Element</strong>
				<select class="longselect" name="psa_id" id="psa_id">
				<?=html_options2($payelement,$_SESSION['payvalue'],'',$benData[0]['psa_id']?$benData[0]['psa_id']:'N/A');?>
			  </select>&nbsp;</td>
	      </tr>	
		  
		  <tr>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH">
				<strong class="longlabel">Start Period</strong>
			<input type="text" class="txtfields" name="ben_startdate" id="ben_startdate" maxlength="10" <? if($benData[0]['ben_startdate']) print "value=".$benData[0]['ben_startdate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/><a href="javascript:void(0);" class="option" onclick="return showCalendar('ben_startdate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absmiddle" /></a></td>
          </tr>
		  <tr>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH" valign="bottom"><strong class="longlabel">End Period</strong>
			    <input type="text" class="txtfields" name="ben_enddate" id="ben_enddate" maxlength="10" <? if($benData[0]['ben_enddate']) print "value=".$benData[0]['ben_enddate'].""; else print "value='0000-00-00'";?> onkeypress="javascript: return acceptValidNumbersOnly(this,event);" onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/><a href="javascript:void(0);" class="option" onclick="return showCalendar('ben_enddate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" title="Date" width="20" height="20" border="0" align="absmiddle" /></a></td>
		  </tr>
		  
		  <tr>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH"><div id="lblpe" class="longlabel"><span style="display:block"><b>Base Amount</strong></span></div>
			    <div id="tamount" style="display:block">
                <input class="txtfields" type="text" class='longtxt' name="ben_amount" id="ben_amount"  value="<?php if($benData[0]['ben_amount']){print number_format($benData[0]['ben_amount'],$genDecimal,'.',''); }else{ print number_format(0,$genDecimal,'.',''); }?>"
			  onkeyup="if(is_num(this.value,this.id)){calculate_ben()}" 
			  onblur="this.value=this.value;" />
		      </div></td>
          </tr>
		  <tr>
			  <td height="25" class="divTblTH">&nbsp;</td>
			  <td class="divTblTH"><div id="lblapp" style="display:<?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==1) print "none";?>"><strong class="longlabel">Amount per Payroll</strong></div>
			  <div id="apperiod" style="display:<?php if($_GET['benedit'] AND $benData[0]['ben_isfixed']==1) print "none";?>">
              <input class="txtfields" type="text" class='longtxt' name="ben_payperday" id="ben_payperday"  value="<?php if($benData[0]['ben_payperday']){print number_format($benData[0]['ben_payperday'],$genDecimal,'.',''); }else{ print number_format(0,$genDecimal,'.',''); }?>" readonly/>
	        </div></td>
	      </tr> 
		   <tr>
			  <td class="divTblTH">&nbsp;</td>
		     <td class="divTblTH"><strong class="longlabel">&nbsp;</strong><input type="submit" <?php if($_GET['benedit']){?>name="benefitupdate" value="Update"<?php }else{ ?>name="addben" id="addben" value="&nbsp;Save&nbsp;"<?php } ?> class="buttonstyle">
	         <input name="button" type="button" class="buttonstyle" onclick="cancel('?statpos=recur_setup&amp;edit=<?php print $_GET['edit']?>')"  value="Cancel" /></td>
			  <td class="divTblTH" height="25">&nbsp;</td>
		   </tr>
		   <tr>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH">&nbsp;</td>
			  <td class="divTblTH">&nbsp;</td>
		   </tr>
    </table>
</form>
</fieldset>
<fieldset class="themeFieldset01">
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr><td colspan="4" style="font-weight:normal"><?=$benList?></td></tr>
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
			payperperiod = amortization/divisor; //Pay Per Period = Amortization / No of Pay Periods selected
			i.value = payperperiod.toFixed(<?= $genDecimal?>);		
		}else{
			return false;
		}
	}
</script>
<script type="text/javascript" src="../includes/jquery/jquery-latest-min.js"></script>
<script type="text/javascript">
$("#pfree").click(function(){
	  $("#lblpe").css("display","inline");
	  $("#tamount").css("display","inline");
	  $("#lblapp").css("display","inline");
	  $("#apperiod").css("display","inline");
	});
$("#pfixed").click(function(){
	  $("#lblpe").css("display","inline");
	  $("#tamount").css("display","inline");
	  $("#lblapp").css("display","none");
	  $("#apperiod").css("display","none");
	});
</script>
