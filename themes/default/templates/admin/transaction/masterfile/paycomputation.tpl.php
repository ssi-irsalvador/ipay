<!-- this is used to check all the Bank Detail applicable per employee -->
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

		<div id="tab-10" name="Bank Detail/s" style="width:310; height:100%; overflow:inherit">
		<fieldset class="themeFieldset01">
		<form method="post" action="" onsubmit="return validform();">	
		  <div align="center">
		    <table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
			  <td class="divTblTH_" width="20%">&nbsp;</td>
			  <td class="divTblTH_" width="40%">&nbsp;</td>
			  <td class="divTblTH_" width="40%">&nbsp;</td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><label class="longlabel"><em>Factor Rate</em></label>
			  <select name="fr_id" id="fr_id" class="longselect">
            	<?=html_options_2d($getFactorRate,'fr_id','fr_name', $oData_['fr_id']?$oData_['fr_id']:'N/A',false)?>
          	  </select></td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><label class="longlabel"><em>Pay Group</em></label>
			  <select name="pps_id" id="pps_id" class="longselect">
            	<?=html_options_2d($getPGroup,'pps_id','pps_name', $oData_['pps_id']?$oData_['pps_id']:'N/A',false)?>
              </select></td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><label class="longlabel"><em>OT Table</em></label>
			  <select class="longselect" name="ot_id" id="ot_id" >
			  	<?=html_options3($otList,'ot_id','ot_name',$otList['ot_id'])?>
			  </select></td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><label class="longlabel">&nbsp;</label><input type="submit" name="bntPaycal" id="bntPaycal" value="<?php if(isset($_GET['empinfoedit'])){ echo 'Update & Clear'; }else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; } ?>" class="buttonstyle"/></td>
		      <td class="divTblTH_">&nbsp;</td>
		      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  </tr>
		  </table>
		    <!--<span class="style1">Under development		  </span>-->	        </div>
		</form>
		  </fieldset>
		</div>