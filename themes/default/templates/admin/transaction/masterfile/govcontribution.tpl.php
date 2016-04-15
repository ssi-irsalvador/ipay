<!-- this is used to check all the OT Table applicable per employee -->
		<div id="tab-3" name="Government Information" style="width:310; height:100%; ">
		<fieldset class="themeFieldset01">
		<form method="post" action="" onsubmit="">	
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
			<tr>
			  <td width="30%" class="divTblTH_"><div align="right"><span class="style3"><strong>Deduction Type</strong>&nbsp;&nbsp;</span></div></td>
			  <td  class="divTblTH_"><select id="deduc_type" name="deduc_type" class="longselect" onchange="gov_deduction()">
			  <?=html_options3($deduction_type,'dec_id','dec_code','5')?>
			  </select>
			<?php //printa($deduction_type); printa($gov);?></td>
		    </tr>
			<?php $x=0; foreach($deduction_type as $type){ $dec_id = $deduction_type[$x]['dec_id'];?>
			<?php if($deduction_type[$x]['dec_code']=='TAX'){?>
			<tr style="display:none;" id="govdeduc_<?=$deduction_type[$x]['dec_id']?>">
			  <td width="20%" class="divTblTH_">
			  <div align="right"><span class="style3">&nbsp;&nbsp;</span></div></td>
			  <td  class="divTblTH_" style="font-weight:normal;">
			  <?php
				$tax=1;
			  	for($y=1; $y<6; $y++){
					for($e = 0; $e < count($gov); $e++){
						if($dec_id==$gov[$e]['empdd_id'] AND $y==$gov[$e]['bldsched_period']){
							$tax = $y; 
							$percent_tax = $gov[$e]['percent_tax'];
							$s_ltu = $gov[$e]['s_ltu'];
							$s_stat = $gov[$e]['s_stat'];
						}
					}
				} ?>						
				<fieldset class="themeFieldset01" style="width:250px;">
					<legend><?=$deduction_type[$x]['dec_name']?></legend>
					<ul style="list-style:none;margin:4px;">
					<li><input class="noninput" name='tax' id='tax' value='1' <?php if($tax==1) print "checked=true"; ?> type='radio' checked>TAX</li>
					<li><input class="noninput" name='tax' id='tax' value='2' <?php if($tax==2) print "checked=true"; ?> type='radio'>MWE</li>
					<li><input class="noninput" name='tax' id='tax' value='3' <?php if($tax==3) print "checked=true"; ?> type='radio'>Others</li>
					<li><input class="noninput" name='tax' id='tax' value='4' <?php if($tax==4) print "checked=true"; ?> type='radio'>by percent(%)</li><input class="noninput" id="percent_tax" name="percent_tax" type="text" size="10" maxlength="10" value="<?php echo $percent_tax;?>" /><li><input name="s_ltu" id="s_ltu" type="checkbox" <?php if($s_ltu==1)print "checked";?>/>Subject to TA Deduction</li><li><input name="s_stat" id="s_stat" type="checkbox" <?php if($s_stat==1)print "checked";?>/>Subject to Statutory</li>
					</ul>
				</fieldset></td>
		    </tr>
			<?php }else { ?>
			<tr style="display:none;" id="govdeduc_<?=$deduction_type[$x]['dec_id']?>">
			  <td width="20%" class="divTblTH_">
			  <div align="right"><span class="style3">&nbsp;&nbsp;</span></div></td>
			  <td  class="divTblTH_" style="font-weight:normal;">  
				<fieldset class="themeFieldset01" style="width:350px;">
					<legend><?=$deduction_type[$x]['dec_name']?></legend>
					<!--<label class="longlabel" style="float:right;color:red;">
                    <input type="checkbox" name="<?=$deduction_type[$x]['dec_code']?>" id="<?=$deduction_type[$x]['dec_code']?>" onclick="if(this.checked==false){disable(this.id,1,<?=$num_period+1?>,false);} else{disable(this.id,1,<?=$num_period+1?>,true);}"> 
                    Exclude</label>-->
					<ul style="list-style:none;margin:4px;">
					<?php
					for($y=0; $y<6; $y++){
						$t=false;
						$exclude=false;
						$varStat = 0;
						for($e = 0; $e < count($gov); $e++){
							if($dec_id==$gov[$e]['empdd_id'] AND $varStat==$gov[$e]['bldsched_period'])
							$exclude = true;
							if($dec_id==$gov[$e]['empdd_id'] AND $y==$gov[$e]['bldsched_period'])
							$t = true;
						}
						if($y=='0'){
							print "<li><input class='noninput' name='".$deduction_type[$x]['dec_code']."' id='".$deduction_type[$x]['dec_code']."' type='checkbox'";
							if($exclude) print " checked=true ";
							print " \"> <label style=\"float:none;color:red;\">Exclude</label></li>";
						}else{
							print "<li><input class='noninput' name='".$deduction_type[$x]['dec_code']."_".$y."' id='".$deduction_type[$x]['dec_code']."_".$y."' type='checkbox'";
							if($t) print " checked=true ";
							if(empty(${s.$y})) print " disabled ";
							print " >".ordinal($y)." Pay Period</li>";
							//print " onclick=\"tick(this.id,'".strtolower($deduction_type[$x]['dec_code'])."')\">".ordinal($y)." Pay Period</li>";
						}
					} ?>
					</ul>
				</fieldset></td>
		    </tr>
			<? } $x++;}?>
			<img onload="gov_deduction()" src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" style="display:none;" />
			<script>
				function gov_deduction(){
					<?php	
						$x=0; 
						foreach($deduction_type as $type){
							print "document.getElementById('govdeduc_".$deduction_type[$x]['dec_id']."').style.display='none';";
							$x++;
						} ?>
					if(isIE()) var display = 'list-item'; else var display = 'table-row';
					var sel=document.getElementById('deduc_type');
					document.getElementById('govdeduc_'+sel.options[sel.selectedIndex].value).style.display=display;
				}
			</script>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">
			  <input type="submit" 
			  <?php 
				  if(isset($_GET['govinfoedit'])){ 
						print "value='&nbsp;Update&nbsp;' id='update_govinfo' name='update_govinfo'"; 
				  }else{ 
						print "value='&nbsp;Save&nbsp;' id='add_govinfo' name='add_govinfo'";
				  } ?>
			  class="buttonstyle" />
              <input type="button" value="&nbsp;Cancel&nbsp;" class="buttonstyle" onclick="cancel('?statpos=emp_masterfile&empinfo=<?php print $_GET['empinfo'];?>#tab-3')"></td>
	      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		    </tr>
		  </table>
		</form>
		</fieldset>
	<fieldset class="themeFieldset01">	  
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal">
		<tr>
		  <td colspan="4"><?=$govTableList?></td>
		</tr>
	</table>
	</fieldset>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal">
		<tr>
		  <td colspan="4"><?//printa($deduction_type)?></td>
		  <td colspan="4"><?//printa($gov)?></td>
		</tr>
	</table>
</div>