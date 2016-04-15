<script language="javascript" type="text/javascript">
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
</script><?php $status = ($oData_['salaryinfo_isactive'] == 'Active' ? '1' : '0');?>
<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
<div id="tab-2" name="Compensation" style="width:310; height:100%;">
<fieldset class="themeFieldset01">
	<form method="post" action="" onsubmit="return validate();">
	  <table width="100%" border="0" cellpadding="2" cellspacing="0">
        
        <tr>
          <td width="8%" class="divTblTH_">&nbsp;</td>
          <td width="43%" class="divTblTH_">&nbsp;</td>
          <td width="50%" class="divTblTH_">&nbsp;</td>
        </tr>
        
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><label class="longlabel">Status</label>
          	<select id="salaryinfo_isactive" name="salaryinfo_isactive">
		  		<?=html_options($salaryactive,$status,true)?>
		  	</select>
          </td>
		  <td class="divTblTH_">&nbsp;</td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_" colspan="2"><label class="longlabel">Salary Rate Type</label>
          	<select name="salarytype_id" id="salarytype_id" class="longselect">
          		<?=html_options_2d($salary_type,'salarytype_id','salarytype_name', $oData_['salarytype_id']?$oData_['salarytype_id']:'N/A',false)?>
          	</select>
          <? //$oData_['salarytype_name']?></td>
   		
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><label class="longlabel"><em>Basic Rate</em></label>
				<input type="number" step="any" name="salaryinfo_basicrate" value="<?= $oData_['salaryinfo_basicrate']?>">
		</td>
          <td class="divTblTH_"><label class="longlabel"><em>COLA</em></label>
          		<input type="number" name="salaryinfo_ecola" value="<?= $oData_['salaryinfo_ecola']?>">
		</td>
        </tr>
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><label class="longlabel"><em>Effective Date</em></label>
          	<input name="salaryinfo_effectdate" type="text" class="txtfields" id="salaryinfo_effectdate" onkeypress="javascript: return acceptValidNumbersOnly(this,event);" maxlength="10" <? if($oData_['salaryinfo_effectdate']) print "value=".$oData_['salaryinfo_effectdate'].""; else print "value=".date('Y-m-d');?> onKeyDown="javascript:return dFilter(event.keyCode, this, '####-##-##');"/>
          	<a href="javascript:void(0);" class="option" onclick="return showCalendar('salaryinfo_effectdate');"><img src="<?=SYSCONFIG_DEFAULT_IMAGES?>calendar.png" alt="Date" width="20" height="20" border="0" align="absbottom" title="Date" /></a>
          </td>
          <td class="divTblTH_"><label class="longlabel"><em>Minimum Net Pay</em></label>
          	<input type="number" name="salaryinfo_ceilingpay" value="<?= $oData_['salaryinfo_ceilingpay']?>">
          	</td>
        </tr>
        
        <tr>
          <td class="divTblTH_">&nbsp;</td>
          <td class="divTblTH_"><input name="<?= (isset($_GET['empsalaryinfoedit']) ? 'update_compensation' : 'add_compensation')?>" id="<?= (isset($_GET['empsalaryinfoedit']) ? 'update_compensation' : 'add_compensation')?>" value="&nbsp;&nbsp;&nbsp;&nbsp;<?= (isset($_GET['empsalaryinfoedit']) ? 'Update' : 'Save')?>&nbsp;&nbsp;&nbsp;&nbsp;" type="submit" class="buttonstyle" />
      <input name="reset" id="reset" value="&nbsp;&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;&nbsp;" type="reset" class="buttonstyle"/>
      <input name="button" type="button" class="buttonstyle" onclick="window.location='?statpos=emp_masterfile';" value="&nbsp;&nbsp;&nbsp;&nbsp;Cancel&nbsp;&nbsp;&nbsp;&nbsp;"/></td>
          <td class="divTblTH_">&nbsp;</td>
        </tr>
      </table>
	</form>
  </fieldset>
  <fieldset class="themeFieldset01">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-weight:normal;">
		<tr>
			<td colspan="4"><?=$tblDataList?></td>
		</tr>
	</table>
	</fieldset>
</div>