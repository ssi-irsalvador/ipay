<script type="text/javascript">
function showType() {
	if ( document.getElementById('psa_type').value == 1 || document.getElementById('psa_type').value == 2) {
		document.getElementById('govsat').style.display = '';
	} else {
		//document.getElementById('govsat').className = '';
		document.getElementById('govsat').style.display = 'none';
	}
}
</script>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;"><?php if(isset($_GET['add'])){?>Add New Pay Element<?php } else {?>Update Pay Element<?php } ?></h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Pay Stub Accounts Form</legend>-->
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
label.error{color:#E42217; float:none;}
</style>
<script type="text/javascript">

function jqResetForm(form) {
   $(':input','form[name='+form+']')
   .not(':button, :submit, :reset, :hidden')
   .val('')
   .removeAttr('checked')
   .removeAttr('selected');
}

$(document).ready(function() {
	$("#mnge_pe").validate(
		{
			rules:
			{
				psa_name:{
					required:true,
					maxlength:20
				},
				psa_order:{
					number:true
				}
			},
			messages:
			{
				psa_name:{
					required:"Please enter a Name.",
					maxlength:"Maximum of 20 characters."
				},
				psa_order:"Please enter a valid Order number."
			}
		}
	);
	$("#insert").click(function(event) {               
    	$('#formula')[0].value += $('#keywords').val();
    });
    $("#clear").click(function(event) {               
    	$('#formula')[0].value = '';
    });
});
</script>

<form id="mnge_pe" name="mnge_pe" method="POST" action="">
  <table border="0" cellpadding="2" cellspacing="0" style="float:left;">
    <tr>
      <td width="32">&nbsp;</td>
      <td width="400"><label class="longlabel">Status</label>
        <select id="psa_status" name="psa_status" style="width:150px">
			<?=html_options($typeStat, $oData['psa_status'])?>
      </select></td>
    </tr>
<!--    <tr>
      <td>&nbsp;</td>
      <td><label class="longlabel">Company</label><select name="comp_id" id="comp_id" class="longselect">
        <?php //html_options($comp,$oData['comp_id'])?>
      </select></td>
    </tr>-->
    <tr>
      <td>&nbsp;</td>
      <td><label class="longlabel">Type</label><select id="psa_type" name="psa_type" onchange="showType();" style="width:150px">
			<?=html_options($typePSAccnt, $oData['psa_type'])?>
	</select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label class="longlabel">Classification</label><select id="psa_clsfication" name="psa_clsfication" onchange="showType();" style="width:150px">
        <?=html_options($clsfiPSAccnt, $oData['psa_clsfication'])?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label class="longlabel">Property Code</label><select id="psa_procode" name="psa_procode" onchange="showType();" style="width:150px">
        <?=html_options($propertycode, $oData['psa_procode'])?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label class="longlabel">Name</label><input type="text" size="30" name="psa_name" id="psa_name" value="<?=trim($oData['psa_name'])?>" /></td>
    </tr>
	<!--<tr><?php //printa($getPriority);?>
	  <td>&nbsp;</td>
	  <td><label class="longlabel">Priority</label><select name="psa_priority" id="psa_priority">
          <?=html_options_2d($getPrio,'ppc_id','ppc_priority_no',$oData['psa_priority']?$oData['psa_priority']:'N/A',false)?>
        </select></td>
	  </tr>-->
	<tr>
	  <td>&nbsp;</td>
	  <td><label class="longlabel">Order</label><input type="text" size="6" id="psa_order" name="psa_order" value="<?=trim($oData['psa_order'])?>" /></td>
	  </tr>
	
	<tbody id="govsat">
	<tr>
      <td>&nbsp;</td>
      <td><fieldset class="themeFieldset01" style="width: 250px;">
	  <legend>Subject to</legend>
	  <table width="200" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <td width="59"><div align="right">
            <input type="checkbox" name="tax" id="tax" <?if($oData['psa_tax']==1)print "checked";?>/>
          </div></td>
          <td width="134">TAX</td>
        </tr>
        <tr>
          <td><div align="right">
            <input type="checkbox" name="psa_statutory" id="psa_statutory" <?if($oData['psa_statutory']==1)print "checked";?>/>
          </div></td>
          <td>Statutory Contribution</td>
        </tr>
      </table>
	  </fieldset></td>
	</tr></tbody>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?php /*
	<tr>
      <td> Accrual</td>
      <td class="cellRightEditTable"><select name="data[accrual_id]">
        
							{html_options options=$data.accrual_options selected=$data.accrual_id}
						
      </select>      </td>
    </tr>
    <tr>
      <td> Debit Account</td>
      <td><input type="text" size="40" name="psa_debit_accnt" id="psa_debit_accnt" value="<?=$oData['psa_debit_accnt']?>" />      </td>
    </tr>
    <tr>
      <td> Credit Account</td>
      <td><input type="text" size="40" name="psa_credit_accnt" id="psa_credit_accnt" value="<?=$oData['psa_credit_accnt']?>"  />      </td>
    </tr> */ ?>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value=" Save & Exit " class="themeInputButton" />
        <input type="button" name="Reset" value="&nbsp;&nbsp;&nbsp;Reset&nbsp;&nbsp;&nbsp;" class="buttonstyle" onclick="jqResetForm('mnge_pe')" />
		<input type="button" name="Cancel" value="Cancel" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pe'" /></td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <?php if($showF){ ?>
  <fieldset class="themeFieldset01">
	  <legend>Formula</legend>
	  <table style="float:left;">
	  	<tr><td>Keywords: <select name="keywords" id="keywords">
	  		<?php if(count($kWords)>0){
	  			for($c=0;$c<count($kWords);$c++){ print "<option id=".$kWords[$c]['app_fkey_id'].">".$kWords[$c]['app_fkey_name']."</option>"; }
	  		} else {
				print "<option id=0>No Active Keywords Available</option>";
  			} ?>
	  		</select>
	  		<input id="insert" type="button" value="Insert Keyword" class="buttonstyle"/>
	  		</td></tr>
	  	<tr><td>
	  		<input id="formula" type="text" size="72" name="formula" value="<?php if($_POST){ echo $_POST['formula']; } else { echo $formula; }?>"/>
	  	</td></tr>
	  	<tr><td>
	  		<input id="clear" type="button" value="Clear" class="buttonstyle"/>
	  		<input id="resetf" type="button" value="Reset Formula" class="buttonstyle" onclick="javascript:window.location='setup.php?statpos=mnge_pe&edit=<?= $_GET['edit']?>'"/>
	  	</td></tr>
	  </table>
  </fieldset>
  <?php } ?>
</form>
</fieldset>
</div>