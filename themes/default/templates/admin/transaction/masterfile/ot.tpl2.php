<!-- this is used to check all the OT Table applicable per employee -->
		<div id="tab-5" name="OT" style="width:310; height:100%; ">
		<fieldset class="themeFieldset01">
		<form method="post" action="" >	
		<table width="100%" border="0" cellpadding="1" cellspacing="2">
    
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
			<tr>
			  <td width="20%" class="divTblTH_"><div align="right"><span class="style3">&nbsp;&nbsp;</span></div></td>
			  <td  class="divTblTH_">
				 <label><b>Name</b></label>
			  	  
			  <select class="longselect" name="ot_id" id="ot_id" >
			  <?=html_options3($otList,'ot_id','ot_name',$otList['ot_id'])?>
			  </select>
			  
			  &nbsp;
			<!--<input type="button" value="..." class="lib">-->
			  <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" style="display:none" onload="" />						 </td>
		    </tr>
			<?php $var = $otList['0']['ot_desc'];?>
			<tr>
			  <td width="20%" class="divTblTH_"><div align="right"><span class="style3">&nbsp;&nbsp;</span></div></td>
			  <td  class="divTblTH_"><!--<label><b>Description</b></label>-->
	          <!--<input type="text" style="height:50px;width:250px" id="ot_desc" name="ot_desc" value="<?php echo "$var";?>" readonly />--></td>
		    </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">
			  <label>&nbsp;</label>
				<input type="submit" value='&nbsp;Save&nbsp;' id='add_ot' name='add_ot'  class="buttonstyle"/>
				<input type="button" value="&nbsp;Cancel&nbsp;"  class="buttonstyle" onclick="cancel('?statpos=emp_masterfile&empinfo=<?php print $_GET['empinfo'];?>#tab-5')">			  </td>
	      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		    </tr>
		  </table>
		</form>
		  </fieldset>
			<fieldset class="themeFieldset01_notopborder">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
				<tr>
				  <td colspan="4"><?=$otListTbl?></td>
				</tr>
				</table>
				
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="4"><?php //printa($otList) ?></td>
				</tr>
				</table>
				
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				  <td colspan="4">&nbsp;</td>
				</tr>
				</table>
			</fieldset>
		</div>