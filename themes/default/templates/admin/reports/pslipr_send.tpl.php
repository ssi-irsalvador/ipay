<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Send Email</h2></fieldset>
<fieldset class="themeFieldset01">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td width="12%" class="divTblTH_"><em>Pay Group</em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['pps_name']?>
      </strong></td>
      <td class="divTblTH_"><em>Type</em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$oData['salaryclass_id']?>
      </strong></td>
      </tr>
    <tr>
      <td class="divTblTH_"><em>Start Date </em></td>
      <td class="divTblTH_"><strong>
        <?=$oData['payperiod_start_date']?>
      </strong></td>
      <td class="divTblTH_"><em>End Date </em></td>
      <td width="16%" class="divTblTH_"><strong>
        <?=$oData['payperiod_end_date']?>
      </strong></td>
      <td width="12%" class="divTblTH_"><em>Pay Date </em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['payperiod_trans_date']?>
      </strong></td>
    </tr>
    <tr>
      <td class="divTblTH_"><em>Status</em></td>
      <td width="21%" class="divTblTH_"><strong>
        <?=$oData['pp_stat_id']?>
      </strong></td>
      <td width="18%" class="divTblTH_"><em>Total No. of Employee </em></td>
      <td colspan="3" class="divTblTH_"><strong>
        <?=$oData['totalemp']?>
      </strong></td>
    </tr>
	</table>
</fieldset>
<fieldset class="themeFieldset01">
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
<table width="100%" border="0" cellpadding="2" cellspacing="0" id="tbl_list" style="border: 1px inset #FAD163; -moz-border-radius: 1px;">
<tbody>
	<tr>
	    <td class="divTblListTH"><a href="?statpos=pslipr&amp;send=16&amp;sortby=fullname&amp;sortof=asc" class="external_link">Full Name</a></td>
	    <td class="divTblListTH"><a href="?statpos=pslipr&amp;send=16&amp;sortby=sending_status&amp;sortof=asc" class="external_link">Status</a></td>
	</tr>
	<?php for($ctr=0;$ctr<count($empList);$ctr++){?>
	<tr class="divTblListTR2" id="<?= $empList[$ctr]['emp_id']?>">
	   	<td class="divTblListTD" id="fullname"><?= $empList[$ctr]['fullname']?></td>
	   	<td class="divTblListTD" id="sending_status<?= $empList[$ctr]['emp_id']?>">Sending</td>
	</tr>
</tbody></table>
</fieldset>
</div>
	<?php } flush();
    		ob_flush();
    		?>
<?php for( $i = 0 ; $i < 10 ; $i++ ){
			    echo $i . '<br />';
			    flush();
			    ob_flush();
			    sleep(1);
			}
    		?>