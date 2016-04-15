<!-- this is used to check all the Bank Detail applicable per employee -->
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>

		<div id="tab-11" name="YTD" style="width:100%; height:100%;">
		<fieldset class="themeFieldset01">
		<form method="post" action="" onsubmit="return validform();">	
		  <div align="center">
		    <!--<table width="100%" border="0" cellpadding="1" cellspacing="2">
    
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
		  </tr>
			<tr>
			  <td width="20%" class="divTblTH_"><div align="right"><span class="style3">Bank Name &nbsp;&nbsp;</span></div></td>
			  <td width="26%" class="divTblTH_"><input name="banklist_name" id="banklist_name" value="<?=$oDataBank['banklist_name']?>" type="text" size="30">
			  <a href="javascript:void(0);" onclick="javascript: openwindow('popup.php?statpos=popupbank&comp_id='+<?=$oData['comp_id']?>, 'banklist_name', '');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'icons/edited/search3.png'?>" width="20" height="20" hspace="1" border="0" align="absbottom" /></a><input type="hidden" name="banklist_id" id="banklist_id" value="<?=$oData['banklist_id']?>" />
		</a>
		<input type="hidden" name="bank_id" id="bank_id" value="<?=$oDataBank['bank_id']?>" /></td>
			  <td width="21%" class="divTblTH_"><div align="right"><span class="style3">Swift Code &nbsp;&nbsp;</span></div></td>
			  <td width="33%" class="divTblTH_"><input name="bankiemp_swift_code" id="bankiemp_swift_code" value="<?=$oDataBank['bankiemp_swift_code']?>" type="text" size="30" /></td>
			</tr>
			<tr>
			  <td class="divTblTH_"><div align="right"><span class="style3">Account No. &nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input name="bankiemp_acct_no" id="bankiemp_acct_no" value="<?=$oDataBank['bankiemp_acct_no']?>" type="text" size="30"></td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			</tr>
			<tr>
			  <td class="divTblTH_"><div align="right"><span class="style3">Account Name &nbsp;&nbsp;</span></div></td>
			  <td class="divTblTH_"><input name="bankiemp_acct_name" id="bankiemp_acct_name" value="<?=$oDataBank['bankiemp_acct_name']?>" type="text" size="30"></td>
			  <td class="divTblTH_">&nbsp;</td>
			  <td class="divTblTH_">&nbsp;</td>
			</tr>
			
			
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td colspan="3" class="divTblTH_"><input type="submit" name="bntBankinfo" id="bntBankinfo" value="<?php if(isset($_GET['empinfoedit'])){ echo 'Update & Clear'; }else{ echo 'Save & Clear'; } ?>" class="buttonstyle"/>
                <?php if (isset($_GET['empinfoedit'])){ ?>
                <input type="button" name="cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='transaction.php?statpos=emp_masterfile&empinfo='+<?=$_GET['empinfo']?>+'#tab-3'" />
                <?php }else{?>
                <input type="reset" name="Submit2" value="Reset" class="buttonstyle" />
                <?php } ?></td>
		  </tr>
			<tr>
			  <td class="divTblTH_">&nbsp;</td>
			  <td colspan="3" class="divTblTH_">&nbsp;</td>
			</tr>
		  </table>-->
		    <span class="style1">Under development		  </span>	        </div>
		</form>
		  </fieldset>
		</div>