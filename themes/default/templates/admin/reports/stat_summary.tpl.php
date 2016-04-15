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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Statutory Summary</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Statutory Summary Report</legend>-->
<form method="post" target="">
	
  <table width="532" border="0">
    <tr>
    <td>
    <div id="company" style="display:inline";>
      Company
     </div>
     </td>
      <td><select name="comp_id" id="comp_id" class="longselect" style="display:inline;">
          <?=html_options($comp,$oData['comp_id'])?>
      </select></td>
    </tr>
    <tr>
    <tr>
    <td>
    <div id="months" style="display:inline";>
      Month
     </div></td>
      <td><select name="month" id="month" class="longselect" style="display:inline;">
          <?=html_options($month,$_POST['month'])?>
        </select>      </td>
    </tr>
    <tr>
      <td>
      <div id="years" style="display:inline;">Year</div></td>
      <td><select name="year" id="year" class="longselect" style="display:inline;">
          <?=html_options($year,$_POST['month'])?>
      </select></td>
    </tr>
    <tr>
      <td>
      <div id="emp" style="display:none;">Employee</div></td>
      <td><select name="employee" id="employee" class="longselect" style="display:none">
      	  <?=html_options($empList,$_POST['employee'])?>
      </select>
    </tr>
    <tr>
      <td>
      <div id="Preparedby" style="display:none;">Prepared by:</div></td>
      <td><input type="text" id="preparedby1" name="preparedby1" class="longselect" style="display:none;"></td>
    </tr>
    <tr>
      <td>
      <div id="Notedby" style="display:none;">Noted by:</div></td>
      <td><input type="text" id="notedby1" name="notedby1" class="longselect" style="display:none;"></td>
    </tr>
    <tr>
      <td>
      <div id="Certified" style="display:none;">Certified Correct:</div></td>
      <td><input type="text" id="Certified1" name="Certified1" class="longselect" style="display:none;"></td>
    </tr>
    <tr>
    	<td></td>
    	<td width="297"><div id="phic" style="display:none;"><input type="radio" name="mode1" id="radio3" value="03" checked="checked"/>PHIC</div>
    					<div id="sss" style="display:none;"><input type="radio" name="mode1" id="radio4" value="04">SSS</div>
    					<div id="hdmf" style="display:none;"><input type="radio" name="mode1" id=radio5" value="05">HDMF</div>
    </tr>
    <tr>
    
      	<td></td>
        <td width="297"><div id=statsummary" style="display:inline;"><input type="radio" name="mode" id="radio1" value="01" checked="checked" />Statutory Summary</div> 
        				<!-- <div id="certification" style="display:inline;"><input type="radio" name="mode" id="radio2" value="02">Certification</div> --></td>
    
      
    </tr>  
      <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Process" class="themeInputButton" /></td>
    </tr>
  </table>
 
</form>	
</fieldset>
</div>
<script type="text/javascript" src="../includes/jquery/jquery-latest-min.js"></script>
<script type="text/javascript">
$("#radio1").click(function(){ 
	$("#company").css("display","inline");
	$("#comp_id").css("display","inline");
	$("#month").css("display","inline");
	$("#months").css("display","inline");
	$("#year").css("display","inline");
	$("#years").css("display","inline");
	$("#emp").css("display","none");
	$("#employee").css("display","none");
	$("#Preparedby").css("display","none");
	$("#preparedby1").css("display","none");
	$("#Notedby").css("display","none");
	$("#notedby1").css("display","none");
	$("#Certified").css("display","none");
	$("#Certified1").css("display","none");
	$("#phic").css("display","none");
	$("#sss").css("display","none");
	$("#hdmf").css("display","none");
	});
$("#radio2").click(function(){
	$("#company").css("display","inline");
	$("#comp_id").css("display","inline");
	$("#month").css("display","none");
	$("#months").css("display","none");
	$("#year").css("display","none");
	$("#years").css("display","none");
	$("#emp").css("display","inline");
	$("#employee").css("display","inline");
	$("#Preparedby").css("display","inline");
	$("#preparedby1").css("display","inline");
	$("#Notedby").css("display","inline");
	$("#notedby1").css("display","inline");
	$("#Certified").css("display","inline");
	$("#Certified1").css("display","inline");
	$("#phic").css("display","inline");
	$("#sss").css("display","inline");
	$("#hdmf").css("display","inline");
	});

</script>




