
<style type="text/css">
.barValue {
	width:  5px;
	display: inline-block;
	position:relative;
	vertical-align: baseline;
	background-color: black;
	
	left: 75px;
	}
	
.barBottom{
	width: 837px;
	position:absolute;
	background-color: black;
	top: 150;
	left: 101px;
	}

.bar {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: blue;
	top: 50;
	left: 88px;
	}
.bar2 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: red;
	vertical-align: baseline;
	top: 50;
	left: 88px;
	
	}
	.bar3 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: CornflowerBlue ;
	vertical-align: baseline;
	top: 50;
	left: 88px;
	}

	.bar4 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: green;
	vertical-align: baseline;
	top: 50;
	left: 88px;
	}
.bar5 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: violet;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar6 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: LightSeaGreen;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar7 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: brown;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar8 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: #FF00FF;
	vertical-align: baseline;
	top:50;
	left: 88px;
	}
.bar9 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: #AEB404;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar10 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: Navy  ;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar11{
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: gray;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}
.bar12 {
	width: 65px;
	margin: 1.6px;
	display: inline-block;
	position:relative;
	background-color: DarkSlateGray ;
	vertical-align: baseline;
	top:50;
	left: 88px;
	
	}

}
h5.zero
{position:absolute;
left:120px;
top:1200.5px;
}

h4.b
{
position:absolute;
left:78px;
top:1330.5px;
}

h4.t
{
position:absolute;
left:40px;
top:183.5px;
}


</style>

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
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Variance Graph Form</h2></fieldset>
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Variance Graph Form</legend>-->
<form method="post" action="">
      

	<table   width ="920" class="table" bgcolor=#FCB334>
	<tr>
    
      <td>CHOOSE YEAR:	<select name="get" id="get" >
          	<?=html_options($yeartake,$_GET['year'])?>
      </select> 
     		 <input type="submit"  name="submit" value="Generate" class="themeInputButton"/> 
     			
      </td>
        
      
      </tr>
	</table>

<?php if(isset($_GET['year']) && $_GET['year']!=''){
		
		echo '<table width ="920" bgcolor="#F7D358" height="980">';
		
		echo '<tr bgcolor=#F7D358>';
		echo '<td >';
			
			echo'<h4 class="t">'.$top.'</h4>';
			echo'<h4 class="b">0</h4>';
			
			for($index=1;$index<=count($LValue);$index++)
			{echo '<p style=" color:black; position:absolute; left:48px; top:'.$LValueH[$index].'px; ">'.$LValue[$index].'</p>';
 			}//diplaying left values
		echo '</td >';	

	  	echo '<td >';
			
			echo '<div style="height: 1155px; " class="barValue"></div>';
			echo '<div style="height:5px; " class="barBottom"></div>';
			for($index=1;$index<=count($barData);$index++)
			{
				
				if($index=1){
				echo '<div style="height: '.$barData[$index].'px; " class="bar"></div>';
				echo  '<p style=" color:white; position:absolute; left:118px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=2){
				echo '<div style="height: '.$barData[$index].'px; " class="bar2"></div>';
				echo  '<p style=" color:white; position:absolute; left:186px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=3){
				echo '<div style="height: '.$barData[$index].'px; " class="bar3"></div>';
				echo  '<p style=" color:white; position:absolute; left:256px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=4){
				echo '<div style="height: '.$barData[$index].'px; " class="bar4"></div>';
				echo  '<p style=" color:white; position:absolute; left:323px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=5){
				echo '<div style="height: '.$barData[$index].'px; " class="bar5"></div>';
				echo  '<p style=" color:white; position:absolute; left:390px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=6){
				echo '<div style="height: '.$barData[$index].'px; " class="bar6"></div>';
				echo  '<p style=" color:white; position:absolute; left:458px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=7){
				echo '<div style="height: '.$barData[$index].'px; " class="bar7"></div>';
				echo  '<p style=" color:white; position:absolute; left:527px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=8){
				echo '<div style="height: '.$barData[$index].'px; " class="bar8"></div>';
				echo  '<p style=" color:white; position:absolute; left:595px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=9){
				echo '<div style="height: '.$barData[$index].'px; " class="bar9"></div>';
				echo  '<p style=" color:white; position:absolute; left:662px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=10){
				echo '<div style="height: '.$barData[$index].'px; " class="bar10"></div>';
				echo  '<p style=" color:white; position:absolute; left:732px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=11){
				echo '<div style="height: '.$barData[$index].'px; " class="bar11"></div>';
				echo  '<p style=" color:white; position:absolute; left:799px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
				if($index=12){
				echo '<div style="height: '.$barData[$index].'px; " class="bar12"></div>';
				echo  '<p style=" color:white; position:absolute; left:869px; top:'.$tvalue[$index].'px; ">'.$exact[$index]['ftotal'].'</p>';
 
				}
		    }//displaying bar*/
		echo '</td>';
		echo '</tr>';
		echo'</table>';
		
		
		echo '<table width ="920" bgcolor="#F7D358" >';
		echo '<tr>';
			
			echo '<td width="10%" >';
				$nbsp;
			echo '</td>';
			
			echo '<td width="8%" align="center">';
				echo "January";
			echo '</td>';
			
			echo '<td width="7%" align="center">';
				echo "February";
			echo '</td>';
		
			echo '<td width="9%" align="center">';
				echo "March";
			echo '</td>';
		
			echo '<td width="7%" align="center">';
				echo "April";
			echo '</td>';
		
			echo '<td width="8%" align="center">';
				echo "May";
			echo '</td>';
		
			echo '<td width="7%" align="center">';
				echo "June";
			echo '</td>';
		
			echo '<td width="7%" align="center">';
				echo "July";
			echo '</td>';
			
			echo '<td width="8%" align="center">';
				echo "August";
			echo '</td>';
		
			echo '<td width="8%" align="center">';
				echo "September";
			echo '</td>';
		
			echo '<td width="5%" align="center">';
				echo "October";
			echo '</td>';
		
			echo '<td width="8%" align="center">';
				echo "November";
			echo '</td>';
		
			echo '<td width="8%" align="center">';
				echo "December";
			echo '</td>';
		
		echo '</tr>';
		echo'</table>';
			} ?>


</form>
</fieldset>
</div>