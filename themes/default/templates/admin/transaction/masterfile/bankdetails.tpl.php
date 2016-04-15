<!-- this is used to check all the Bank Detail applicable per employee -->
<div id="tab-4" name="Bank Detail/s" style="width:310; height:100%; ">
<fieldset class="themeFieldset01">
		<form method="post" action="" onsubmit="return validate(this,'bank_info');">	
		<table width="100%" border="0" cellpadding="2" cellspacing="0">
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
			<tr>
			  <td width="20%" class="divTblTH_">&nbsp;</td>
			  <td width="80%" class="divTblTH_">
			  <b class="longlabel">Bank Name</b>
			    <select class="midselect" id="banklist_id" name="banklist_id">
				<?=html_options3($emp_bank_info,'banklist_id','banklist_name',$oDataBank['banklist_id']?$oDataBank['banklist_id']:'N/A');?>
			  </select></td>
		    </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><b class="longlabel">Accnt Type</b>
			    <select name="baccntype_id" id="baccntype_id" class="midselect">
                  <?=html_options2($bnkaccntype,$_SESSION['baccntype_id'],'edit',$oDataBank['baccntype_id'])?>
                </select></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><b class="longlabel">Accnt No.</b>
		      <input name="bankiemp_acct_no" type="text" id="bankiemp_acct_no" value="<?=$oDataBank['bankiemp_acct_no']?>" size="30" maxlength="25" class="txtfields"></td>
		    </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><b class="longlabel">Accnt Name</b>
		      <input name="bankiemp_acct_name" id="bankiemp_acct_name" value="<?=$oDataBank['bankiemp_acct_name']?>" type="text" size="30" class="txtfields"></td>
		    </tr>
			
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><b class="longlabel">Swift Code</b>
		      <input name="bankiemp_swift_code" id="bankiemp_swift_code" value="<?=$oDataBank['bankiemp_swift_code']?>" type="text" size="30" class="txtfields"/></td>
		  </tr>
		  <tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_"><b class="longlabel">Percentage</b>
		      <input name="bankiemp_perc" id="bankiemp_perc" value="<?=$oDataBank['bankiemp_perc']?>" type="number" size="30" class="txtfields"/></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_" style="padding-left:120px">
				 <input type="submit" <?php if (isset($_GET['empinfoedit'])) { print "value='&nbsp;Update&nbsp;' id='update_bankinfo' name='update_bankinfo'"; } else { print "value='&nbsp;Save&nbsp;' id='add_bankinfo' name='add_bankinfo'"; } ?>  class="buttonstyle" />
			<?php if ($_GET['empinfoedit']) { echo "<input type=\"button\" value=\"Cancel\" onclick=\"cancel('?statpos=emp_masterfile&empinfo=";}?>
			<?php if ($_GET['empinfoedit']) { echo $_GET['empinfo']."#tab-4')\" class=\"buttonstyle\" />"; }?>
			</td>
	      </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		    </tr>
		  </table>
		</form>
		</fieldset>
	<fieldset class="themeFieldset01">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
		<tr>
		  <td colspan="4"><?=$bank_info?></td>
		</tr>
	</table>
	</fieldset>
</div>