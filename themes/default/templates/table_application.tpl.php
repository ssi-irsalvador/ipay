<div class="divTblMainList">
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
	<div class="divTblPagingContent">
<?=$noSearchStart?>	
		<form method="GET" action="">
		  <div class="right srch_border">
		  <img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'sicon_.png'?>" width="15" height="15" hspace="5" align="absmiddle" title="Search" />
		  <input type="text" name="search_field" size="30" value="<?=$_GET['search_field']?>" />
		  <input type="submit" value="go" class="buttonstyle_for_go" name="go" />
		  <?=$qryForms?>
		  </div>
	  </form>
<?=$noSearchEnd?>	
<?=$noPaginatorStart?>	
	  <div class="divTblContent"><?=$resultsInfo?></div>
<?=$noPaginatorEnd?>
<?=$noSTATStart?>
<div align="left">
  <select id="emrpi_status" name="emrpi_status" style="height:22px">
    <?=html_options($AppStat,$oData['emrpi_status']);?>
  </select><input type="submit" name="bnt_statup" id="bnt_statup" value="Update Status" style="width:94px" class="button_"/>
</div>	
<?=$noSTATEnd?>
  </div>
  
  <div class="divTblList">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" id='tbl_list' style="border: 1px inset #FAD163; -moz-border-radius: 1px;">
  <tr>
		<?php
		foreach($tblFields as $fkey => $fvalue){
			if($fkey != 'chkbox'){
				$aQryStr = $arrQryStr;
				$aQryStr[] = "sortby=$fkey";
				$aQryStr[] = "sortof=".((isset($_GET['sortof']) && $_GET['sortof']=="asc")?"desc":"asc");
				$queryStr = implode("&",$aQryStr);
				$fvalue = (empty($fvalue))?"":"<a href='?$queryStr' class='external_link'>$fvalue</a>";
				$sortimg = isset($_GET['sortof'])?(($_GET['sortof']=="asc")?"asc.png":"dsc.png"):"";
				$sortimg = ($fkey==$_GET['sortby'])?" <img src='$themeImagesPath/$sortimg' align='absmiddle'>":"";
			}
		?>
    <td class="divTblListTH" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?>><?=$fvalue.$sortimg?></td>
		<?php } ?>
  </tr>
  <?php
	if(count($tblData) > 0){
	  $i = 0;
  	  foreach ($tblData as $dkey => $dvalue){
	  if( $odd = $i%2 ){
  ?>
  	<tr class="divTblListTR">
	<?php foreach($tblFields as $fkey => $fvalue){ ?>
    	<td class="divTblListTD" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?> ><?=$dvalue[$fkey]?></td>
	<?php } ?>
  	</tr>
  <?php } else { ?>
	<tr class="divTblListTR2">
	<?php foreach($tblFields as $fkey => $fvalue){ ?>
    	<td class="divTblListTD" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?> ><?=$dvalue[$fkey]?></td>
	<?php } ?>
  	</tr>
  <?php } $i++; } }else{ ?>
	<tr class="divTblListTR">
		<td colspan="<?=count($tblFields)?>" class="divTblListTD" >No record found.</td>
	</tr>
  <?php } ?>
  </table>
  </div>
<?=$noPaginatorStart2?>	
  <div class="divTblPagingContent"><?=$resultsInfo?></div>
<?=$noPaginatorEnd2?>	
</div>
