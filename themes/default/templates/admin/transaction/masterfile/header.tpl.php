<script src="../includes/jscript/dFilter.js" type="text/javascript"/></script>
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
</script>
<form method="post" action="">
<table cellpadding="1" cellspacing="0" style="width:100%">
  <tr>
    <td width="15%" valign="top">&nbsp;</td>
    <td width="85%" valign="top">&nbsp;
        <!--<a href="transaction.php?statpos=emp_masterfile&empinfo=<?=$getFirstRec['emp_id'];?>#tab-1" style="text-decoration: none;">
            <img src="<?=$themeImagesPath?>navigation/gofirst.gif" width="16" height="16" align="absmiddle" title="First" style="border: 0;" />
        </a>
        <a href="transaction.php?statpos=emp_masterfile&empinfo=<?=$getPrevRec['emp_id'];?>#tab-1" style="text-decoration: none;">
            <img src="<?=$themeImagesPath?>navigation/go-previous.gif" width="16" height="16" align="absmiddle" title="Prev" style="border: 0;" />
        </a>
        <a href="transaction.php?statpos=emp_masterfile&empinfo=<?=$getNextRec['emp_id'];?>#tab-1" style="text-decoration: none;">
            <img src="<?=$themeImagesPath?>navigation/go-next.gif" width="16" height="16" align="absmiddle" title="Next" style="border: 0;" />
        </a>
        <a href="transaction.php?statpos=emp_masterfile&empinfo=<?=$getLastRec['emp_id'];?>#tab-1" style="text-decoration: none;">
            <img src="<?=$themeImagesPath?>navigation/go-last.gif" width="16" height="16" align="absmiddle" title="Last" style="border: 0;" />
        </a>-->
    </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee No.<span class="needfield">*</span></td>
    <td valign="top">
        <input name="emp_idnum" id="emp_idnum" value="<?=$oData['emp_idnum']?>" type="text" class="txtfields" />
        <input type="submit" name="btnsearch" id="btnsearch" value="Search" class="buttonstyle" />    </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Employee Name</td>
    <td valign="top"><u><b><?=$oData['pi_fname']?>&nbsp;<?=$oData['pi_mname']?>&nbsp;<?=$oData['pi_lname']?></b></u>
      <input type="hidden" name="pi_id" id="pi_id" value="<?=$oData['pi_id']?>" />
      <br />
      <em style="font-size:8pt;color:#7a7a7a">(First Name/Middle Name/Last Name)</em></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>