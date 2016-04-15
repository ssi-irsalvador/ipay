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
	
<!-- the following javascript bellow are the required files and declarations for the Tab Bar Menu -->
<script src="../includes/jscript/jquerytabs/jquery-1.1.2.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('#container-1').tabs();
		$('#container-2').tabs(2);
		$('#container-3').tabs({ fxSlide: true });
		$('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });
		$('#container-5').tabs({ fxSlide: true, fxFade: true, fxSpeed: 'fast' });
		$('#container-6').tabs({
			fxFade: true,
			fxSpeed: 'fast',
			onClick: function() {
				alert('onClick');
			},
			onHide: function() {
				alert('onHide');
			},
			onShow: function() {
				alert('onShow');
			}
		});
		$('#container-7').tabs({ fxAutoHeight: true });
		$('#container-8').tabs({ fxShow: { height: 'show', opacity: 'show' } });
		$('#container-10').tabs();
		$('#container-11').tabs({ disabled: [3] });

		$('<p><a href="#">Disable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).disableTab(3);
			return false;
		});
		$('<p><a href="#">Activate third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).triggerTab(3);
			return false;
		});
		$('<p><a href="#">Enable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
			$(this).parents('div').eq(1).enableTab(3);
			return false;
		});
	});
</script>
<link rel="stylesheet" href="../includes/jscript/jquerytabs/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!--************************************ END ******************************************-->
	
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Manage TA Import</h2></fieldset>
<fieldset class="themeFieldset01"><br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><div id="container-4">
		<ul>
			<li><a href="#tab-1"><span>General Mapping</span></a></li>
			<li><a href="#tab-2"><span>TA Mapping</span></a></li>
			<li><a href="#tab-3"><span>OT Mapping</span></a></li>
			<li><a href="#tab-4"><span>Custom Mapping</span></a></li>
		</ul>
		<div id="tab-1" name="General Mapping" style="width:310; height:100%; overflow:inherit">
		<form method="post" enctype="multipart/form-data" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;WorkSheet</em></strong></td>
		  	<td>&nbsp;</td>
		  </tr>
		  <tr>
		  	<td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Starting Row </em></td>
		  	<td width="80%">
		  	<input name="tamap_start" type="text" id="tamap_start" value="<?=trim($oData['tamap_start'])?>" size="10" maxlength="10"/></td>
		  </tr>
		  <tr>
		   <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Employee No</em></td>
		   <td><input name="tamap_emp_id" type="text" id="tamap_emp_id" value="<?=trim($oData['tamap_emp_id'])?>" size="10" maxlength="10" /></td>
    	  </tr>
		  
			<tr>
			  <td>&nbsp;</td>
			  <td><input type="submit" name="bnt_gen" id="bnt_gen" value="Upload File" class="themeInputButton" /></td>
		    </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		</table></form>
		</div>
		<div id="tab-2" name="TA Mapping" style="width:310; height:100%; overflow:inherit">
		<form method="post" enctype="multipart/form-data" action="">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td width="20%" style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;TA Mapping</em></strong></td>
		  	<td width="80%">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2">&nbsp;</td>
		    </tr>
		  <tr>
		  	<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>TA Name</em>&nbsp;&nbsp;&nbsp;<select name="tatbl_id" id="tatbl_id" class="longselect" <?php if($_GET['loanedit'])print "disabled";?>>
		  	    <?=html_options_2d($TAlist,'tatbl_id','tatbl_name',$loanData[0]['tatbl_id']?$loanData[0]['tatbl_id']:'N/A',false);?>
	  	      </select></td>
		  	</tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		  	<td style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;Data</em></strong></td>
		  	<td>&nbsp;</td>
		  </tr>
		  <tr>
		   <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="tabtn" type="radio" value="1" />&nbsp;Map to SpreadSheet Column 
		     <input name="tamapd_column[1]" type="text" id="tamapd_column[1]" value="<?=trim($oData['tamapd_column'])?>" size="10" maxlength="10"/></td>
		   </tr>
		  <tr>
		    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="tabtn" type="radio" value="2" />&nbsp;Fixed the value 
		      <input name="tamapd_column[2]" type="text" id="tamapd_column[2]" value="<?=trim($oData['tamapd_column'])?>" size="10" maxlength="10"/></td>
		  </tr>
		  
			<tr>
			  <td>&nbsp;</td>
			  <td><input type="submit" name="bnt_ta" id="bnt_ta" value="TA Save" class="themeInputButton" /></td>
		    </tr>
			<tr>
			  <td colspan="2"></td>
		    </tr>
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		</table>
		</form>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			  <td colspan="2"><?=$tblDataList_TA?></td>
		    </tr>
		</table>
		</div>
		<div id="tab-3" name="OT Mapping" style="width:310; height:100%; overflow:inherit;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td width="20%" style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;OT Mapping</em></strong></td>
		  	<td width="80%">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2">&nbsp;</td>
		    </tr>
		  <tr>
		  	<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>OT Name </em>&nbsp;&nbsp;<select name="otr_id" id="otr_id" class="longselect" <?php if($_GET['loanedit'])print "disabled";?>>
		  	    <?=html_options_2d($OTlist,'otr_id','otr_name',$loanData[0]['otr_id']?$loanData[0]['otr_id']:'N/A',false);?>
	  	      </select></td>
		  	</tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    </tr>
		  <tr>
		  	<td style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;Data</em></strong></td>
		  	<td>&nbsp;</td>
		  </tr>
		  <tr>
		   <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="radiobutton" type="radio" value="radiobutton" />&nbsp;Map to SpreadSheet Column 
		     <input name="user_fullname2" type="text" id="user_fullname2" value="<?=trim($oData['user_fullname'])?>" size="10" maxlength="10"/></td>
		   </tr>
		  <tr>
		    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="radiobutton" type="radio" value="radiobutton" />&nbsp;Fixed the value 
		      <input name="user_fullname22" type="text" id="user_fullname22" value="<?=trim($oData['user_fullname'])?>" size="10" maxlength="10"/></td>
		    </tr>
		  
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		</table>
		</div>
		<div id="tab-4" name="Custom Mapping" style="width:310; height:100%; overflow:inherit">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		  	<td style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;Custom Mapping</em></strong></td>
		  	<td>&nbsp;</td>
		  </tr>
		  <tr>
		  	<td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Custom Name </em></td>
		  	<td width="80%">
		  	<input name="user_fullname" type="text" id="user_fullname" value="<?=trim($oData['user_fullname'])?>" size="35" maxlength="255"/></td>
		  </tr>
		  <tr>
		  	<td style="background-color:#FAD163"><strong><em>&nbsp;&nbsp;Data</em></strong></td>
		  	<td>&nbsp;</td>
		  </tr>
		  <tr>
		   <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="radiobutton" type="radio" value="radiobutton" />&nbsp;Map to SpreadSheet Column 
		     <input name="user_fullname2" type="text" id="user_fullname2" value="<?=trim($oData['user_fullname'])?>" size="10" maxlength="10"/></td>
		   </tr>
		  <tr>
		    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="radiobutton" type="radio" value="radiobutton" />&nbsp;Fixed the value 
		      <input name="user_fullname22" type="text" id="user_fullname22" value="<?=trim($oData['user_fullname'])?>" size="10" maxlength="10"/></td>
		    </tr>
		  
			<tr>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			</tr>
		</table>
		</div></td>
    </tr>
</table>
</fieldset>
</div>