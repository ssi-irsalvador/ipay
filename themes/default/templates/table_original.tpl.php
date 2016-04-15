<div class="divTblMainList">
<fieldset class="themeFieldset01">
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
	  <form method="GET" action="">
		  <div class="right srch_border"><img src="<?=SYSCONFIG_DEFAULT_IMAGES_INCTEMP.'sicon_.png'?>" width="15" height="15" hspace="5" align="absmiddle" title="Search" /><input type="text" id="search_field" name="search_field" size="30" value="<?=$_GET['search_field']?>" /><input type="submit" value="go" class="buttonstyle_for_go" name="go" /><?=$qryForms?>
		  </div>
	  </form>
	  <div class="divTblContent"><?=$resultsInfo?></div>
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
			$fvalue = ($fvalue=='Action')?"<a style=\"cursor: default; text-decoration: none; color: #444444;\">$fvalue</a>":"<a href='?$queryStr' class='external_link'>$fvalue</a>";
			$sortimg = isset($_GET['sortof'])?(($_GET['sortof']=="asc")?"asc.png":"dsc.png"):"";
			$sortimg = ($fkey==$_GET['sortby'])?" <img src='$themeImagesPath/$sortimg' align='absmiddle'>":"";
		?>
    <td class="divTblListTH" <?=(isset($attribs[$fkey])?$attribs[$fkey]:"")?>><?=$fvalue.$sortimg?></td>
		<?php
		}
		?>
  </tr>
  <?php
	if (count($tblData) > 0) {
	  $i = 0;
	  foreach ($tblData as $dkey => $dvalue) {
	  if ( $odd = $i%2 ) {
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
	<tr class="divTblListTR">
	<td colspan="<?=count($tblFields)?>" class="divTblListTD" >No record found.</td>
	</tr>
  <?php } ?>
	</table>
	</form>
	</div>
  <div class="divTblPagingContent"><?=$resultsInfo?></div>
</fieldset>  
</div>