<script type="text/javascript">
$().ready(function() {
    $("#search_field_name").autocomplete("../includes/jscript/autocomplete/payDetailsByName.php", {
        width: 188,
        matchContains: true,
        selectFirst: true
    });
});
$().ready(function() {
    $("#search_field_id").autocomplete("../includes/jscript/autocomplete/payDetailsByID.php", {
        width: 188,
        matchContains: true,
        selectFirst: true
    });
});
</script>

<div class="divTblMainList">
<?php if ($title) { ?>
	<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;"><?php echo $title; ?></h2></fieldset>
<?php } ?>
 <!--<fieldset class="themeFieldset01">-->
<?php
if (!empty($_SERVER['QUERY_STRING'])) {
	$qrystr = explode("&",$_SERVER['QUERY_STRING']);
	foreach ($qrystr as $value) {
		$qstr = explode("=",$value);
		if ($qstr[0]!="sortby" && $qstr[0]!="sortof") {
			$arrQryStr[] = implode("=",$qstr);
		}
		if ($qstr[0]!="search_field" && $qstr[0]!="p") {
			$qryFrm[] = "<input type='hidden' name='$qstr[0]' value='$qstr[1]'>";
		}
	}
	$aQryStr = $arrQryStr;
	$aQryStr[] = "p=@@";
	$qryForms = (count($qryFrm)>0)? implode(" ",$qryFrm) : '';
}

$srchFormAction = $_SERVER['PHP_SELF']."?$queryStr";

?>
 <!--Autocomplete Condition-->
		<?php if ($_GET['statpos'] == 'emp_masterfile' || $_GET['statpos'] == 'recur_setup' || $_GET['statpos'] == 'loan_app') {?>
		<form method="POST" action="">
        <div>
        <div>
	        <div style="font-size:13px; margin: 15px; float:left;">
	        <label>Employee Name</label>
	        <input type="text" id="search_field_name" name="search_field_name" style="color: #DEDEEB; height: 15px; width: 150px;" onfocus="if(this.value=='Type Employee Name') this.value=''; this.style.color = 'black';" size="30" placeholder="Type Employee Name" />
	        </div>
	        <div style="font-size:13px; margin: 15px; float:left;">
	        <label>Employee ID</label>
	        <input type="text" id="search_field_id" name="search_field_id" style="color: #DEDEEB; height: 15px; width: 150px;" onfocus="if(this.value=='Type Employee ID') this.value=''; this.style.color = 'black';" size="30" placeholder="Type Employee ID" />
	        </div>
        </div>
        <div style="clear:both;">
	        <div style="font-size:13px; margin: 15px; float:left;">
		        <label>Location</label>
		        <select name="search_location" style="width:153px;">
		        	<option value="">All</option>
		        	<?php foreach($locList as $keyLoc => $valLoc){
		        		echo "<option value=\"".$valLoc."\">".$valLoc."</option>";
					} ?>
		        </select>
        	</div>
	        <div style="font-size:13px; margin: 15px; float:left;">
		        <label>Department</label>
		        <select name="search_department" style="width:153px;">
		        	<option value="">All</option>
		        	<?php foreach($deptList as $keyDept => $valDept){
		        		echo "<option value=\"".$valDept."\">".$valDept."</option>";
					} ?>
		        </select>
        	</div>
        	<div style="font-size:13px; margin: 15px; float:left;">
		        <label>Position</label>
		        <select name="search_position" style="width:153px;">
		        	<option value="">All</option>
		        	<?php foreach($posList as $keyPos => $valPos){
		        		echo "<option value=\"".$valPos."\">".$valPos."</option>";
					} ?>
		        </select>
        	</div>
        	<div style="font-size:13px; margin: 15px; float:left;">
		        <label>Company</label>
		        <select name="search_company_name" style="width:153px;">
		        	<option value="">All</option>
		        	<?php foreach($compList as $keyComp => $valComp){
		        		echo "<option value=\"".$valComp."\">".$valComp."</option>";
					} ?>
		        </select>
        	</div>
        </div>
        
        <div style="border-bottom: 1px solid #FAD163; margin: 8px 0 8px 0; clear:both;"></div>
        <input type="submit" value="Search" class="buttonstyle" />
        <input type="reset" value="Reset" class="buttonstyle" /><?=$qryForms?>
        <div style="border-top: 3px solid #FAD163; margin: 10px 0 10px 0;"></div>
        </div>
        <?php } else { ?>
        <?=$noSearchStart?>
        <form method="GET" action="">
        <div class="right srch_border">
        <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'sicon_.png'?>" width="15" height="15" hspace="5" align="absmiddle" title="Search" />
        <input type="text" id="search_field" name="search_field" size="30" value="<?=$_GET['search_field']?>" />
        <input type="submit" value="go" class="buttonstyle_for_go" name="go" /><?=$qryForms?>
        </div>
        
        <?php } ?>
      
	  </form>
      <?=$noSearchEnd?>
	<div class="divTblPagingContent">
	  <div class="divTblContent"><br><br><?=$resultsInfo?></div>
   </div>
  <div class="divTblList" id="update_tbl_list">
  <form method="post" name="form_tbl_list" id="form_tbl_list">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" id='tbl_list' style="border: 1px inset #FAD163; -moz-border-radius: 1px;">
  <tr>
		<?php
		foreach($tblFields as $fkey => $fvalue){
			$aQryStr = $arrQryStr;
			$aQryStr[] = "sortby=$fkey";
			$aQryStr[] = "sortof=".((isset($_GET['sortof']) && $_GET['sortof']=="asc")?"desc":"asc");
			$queryStr = implode("&",$aQryStr);
			// Ito yung dati.
//			$fvalue = (empty($fvalue))?"":"<a href='?$queryStr' class='external_link'>$fvalue</a>";
			// Ito na yung bago.
			$fvalue = (strstr($fvalue, "Action") || strstr($fvalue, "<input"))?"<a style=\"cursor: default; text-decoration: none; color: #444444;\">$fvalue</a>":"<a href='?$queryStr' class='external_link'>$fvalue</a>";
			$sortimg = isset($_GET['sortof'])?(($_GET['sortof']=="asc")?"asc.png":"dsc.png"):"";
			$sortimg = ($fkey==$_GET['sortby'])?" <img src='$themeImagesPath/$sortimg' align='absmiddle'>":"";
		?>
    <td class="divTblListTH" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?>><?=$fvalue.$sortimg?></td>
		<?php
		}
		?>
  </tr>
  <?php
	if(count($tblData) > 0){
	  $i = 0;
	  foreach ($tblData as $dkey => $dvalue){
	  if( $odd = $i%2 ){
  ?>
  	<tr class="divTblListTR" id="<?=$trID."_".$dvalue[$trID]?>">
		<?php foreach($tblFields as $fkey => $fvalue){ ?>
    	<td class="divTblListTD" id="<?=$dvalue[$trID].'_'.$fkey?>" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?> ><?=$dvalue[$fkey]?></td>
		<?php } ?>
  	</tr>
  <?php } else { ?>
	<tr class="divTblListTR2" id="<?=$trID."_".$dvalue[$trID]?>">
		<?php foreach($tblFields as $fkey => $fvalue){ ?>
    	<td class="divTblListTD" id="<?=$dvalue[$trID].'_'.$fkey?>" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?> ><?=$dvalue[$fkey]?></td>
		<?php } ?>
  	</tr>
  <?php } $i++; } }else{ ?>
	<tr class="divTblListTR2">
	<td colspan="<?=count($tblFields)?>" class="divTblListTD">No record found.</td>
	</tr>
  <?php } ?>
	</table>
	</form>
	</div>
  <div class="divTblPagingContent"><?=$resultsInfo?></div>
<!--</fieldset>-->
</div>