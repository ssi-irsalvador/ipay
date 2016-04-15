<!-- this is used to check all the OT Table applicable per employee -->
		<div id="tab-5" name="OT" style="width:310; height:100%; ">
		<fieldset class="themeFieldset01">
		<form method="post" action="" >	
		<table width="100%" border="0" cellpadding="1" cellspacing="0">
    
			<tr>
			  <td width="20%" class="divTblTH_">&nbsp;</td>
			  <td width="80%" class="divTblTH_">&nbsp;</td>
		  </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td  class="divTblTH_"><label class="longlabel"><em>Factor Rate</em></label>
			  <select name="fr_id" id="fr_id" class="longselect">
            	<?=html_options_2d($getFactorRate,'fr_id','fr_name', $oData['fr_id']?$oData['fr_id']:'N/A',false)?>
          	  </select></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td  class="divTblTH_"><label class="longlabel"><em>Pay Group</em></label>
			  <select name="pps_id" id="pps_id" class="longselect">
            	<?=html_options_2d($getPGroup,'pps_id','pps_name', $oData['pps_id']?$oData['pps_id']:'N/A',false)?>
              </select></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td  class="divTblTH_"><label class="longlabel"><em>OT Table</em></label>
		        <select class="longselect" name="ot_id" id="ot_id" >
				  <?=html_options_2d($otList,'ot_id','ot_name', $oData['ot_id']?$oData['ot_id']:'N/A',false)?>
                </select>
	          <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" style="display:none" onload="" /></td>
		    </tr>
			<?php $var = $otList['0']['ot_desc'];?>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_" style="padding-left:120px">
              <input type="submit" value='&nbsp;Save&nbsp;' id='add_ot' name='add_ot'  class="buttonstyle"/>
              <input name="button" type="button"  class="buttonstyle" onclick="cancel('?statpos=emp_masterfile&empinfo=<?php print $_GET['empinfo'];?>#tab-5')" value="&nbsp;Cancel&nbsp;" /></td>
		    </tr>
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		    </tr>
		  </table>
		</form>
	</fieldset>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
		<tr>
		  <td colspan="4"><?=$otListTbl?></td>
		</tr>
	</table>
</div>
