<script language="javascript" type="text/javascript">

  function move_list_items(sourceid, destinationid)
  {
    $("#"+sourceid+"  option:selected").appendTo("#"+destinationid);
  }
  function move_list_items_all(sourceid, destinationid)
  {
    $("#"+sourceid+" option").appendTo("#"+destinationid);
  }
  $(document).ready(function() {
	    $("#moverightall").click(function() {
	        $("#selected_list").each(function(){
	            $("#selected_list option").attr("selected","selected"); });
	    }) ;
	 
	    $("#moveleftall").click(function() {
	        $("#from_select_list").each(function(){
	            $("#from_select_list option").removeAttr("selected"); });
	    }) ;
	    $("#moverightallinfo").click(function() {
	        $("#emp_info_selected_list").each(function(){
	            $("#emp_info_selected_list option").attr("selected","selected"); });
	    }) ;
	 
	    $("#moveleftallinfo").click(function() {
	        $("#from_empinfo").each(function(){
	            $("#from_empinfo option").removeAttr("selected"); });
	    }) ;
	    $("#clear").click(function() {
	        $("#from_select_list").each(function(){
	            $("#from_select_list option").removeAttr("selected"); });
	        $("#from_empinfo").each(function(){
	            $("#from_empinfo option").removeAttr("selected"); });
	    }) ;
	});
</script>
<?php 
if(isset($eMsg)){
	if (is_array($eMsg)) {
?>
	<div class="tblListErrMsg">
	<b>Check the following error(s) below:</b><br>
	<?php
	foreach ($eMsg as $key => $value) {
	?>
	&nbsp;&nbsp;&bull;&nbsp;<?=$value?><br>
	<?php		
	}
	?>
	</div>
<?php		
	}else {
?>
	<div class="tblListErrMsg">
	<?=$eMsg?>
	</div>
<?
	}
}
?>
<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Custom Pay Details Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Custom Pay Details Form</legend>-->
<form method="post" action="">

<table>
<tr>
	<td>Report Name</td>
	<td colspan="4"><input type="text" name="report_name"></td>
</tr>
<tr>
	<td>Filter</td>
	<td colspan="4"><select id="type" name="type"> 
			<?=html_options($options,$_POST['type'])?>
    </select></td>
</tr>
<tr>
	<td colspan="2">Employee Information</td>
	<td>&nbsp;</td>
	<td colspan="2">Report Fields Employee Information</td>
</tr>
<tr>
<td colspan="2">
       <select id="from_empinfo" multiple="multiple" name="from_empinfo[]" style="height: 200px; width:200px"> 
			<?=html_options($empInfo)?>
    </select>
    </td>
    <td colspan="2">
    <input id="moverightallinfo" type="button" value=" >> " class="themeInputButton" onclick="move_list_items_all('from_empinfo','emp_info_selected_list');" />
    <br><input id="moverightinfo" type="button" value="  >  " class="themeInputButton" onclick="move_list_items('from_empinfo','emp_info_selected_list');" />
    <br><input id="moveleftinfo" type="button" value="  <  " class="themeInputButton" onclick="move_list_items('emp_info_selected_list','from_empinfo');" />
    <br><input id="moveleftallinfo" type="button" value=" << " class="themeInputButton" onclick="move_list_items_all('emp_info_selected_list','from_empinfo');" />    
    </td>
    <td colspan="2">
        <select id="emp_info_selected_list" multiple="multiple" name="emp_info_selected_list[]" style="height: 200px; width:200px"> 
		 <?=html_options_multiple($selectedListInfo)?>
		 </select>
    </td>
<tr>
	<td colspan="2">Pay Elements</td>
	<td>&nbsp;</td>
	<td colspan="2">Report Fields Pay Elements</td>
</tr>
<tr>
<td colspan="2">
        <select id="from_select_list" multiple="multiple" name="from_select_list[]" style="height: 200px; width:200px"> 
			<?=html_options($payElementList)?>
        </select>
    </td>
    <td colspan="2">
    <input id="moverightall" type="button" value=" >> " class="themeInputButton" onclick="move_list_items_all('from_select_list','selected_list');" />
    <br><input id="moveright" type="button" value="  >  " class="themeInputButton" onclick="move_list_items('from_select_list','selected_list');" />
    <br><input id="moveleft" type="button" value="  <  " class="themeInputButton" onclick="move_list_items('selected_list','from_select_list');" />
    <br><input id="moveleftall" type="button" value=" << " class="themeInputButton" onclick="move_list_items_all('selected_list','from_select_list');" />    
    </td>
    <td colspan="2">
        <select id="selected_list" multiple="multiple" name="selected_list[]" style="height: 200px; width:200px"> 
		 <?=html_options_multiple($selectedList)?>
		 </select>
    </td>
</tr>
<tr><td colspan="5">
	<input type="submit" value="Save" class="themeInputButton">
	<input type="reset" id="clear" value="Clear" class="themeInputButton" onclick="move_list_items_all('emp_info_selected_list','from_empinfo'); move_list_items_all('selected_list','from_select_list');">
</td></tr>
</table>
</form>
</fieldset>
</div>