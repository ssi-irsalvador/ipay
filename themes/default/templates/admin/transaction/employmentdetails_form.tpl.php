<div class="themeFieldsetDiv01">
<fieldset class="themeFieldset01" style="background: #FAD163; border-radius: 4px 4px 0 0;"><h2 style="margin: 0 0 -5px 0;">Employee Master File</h2></fieldset>
<?php
if (isset($eMsg) || $_SESSION['eMsg']) {
	if ($_SESSION['eMsg']) {
?>
	<div class="tblListErrMsg">

	<?=$eMsg?>
	
	</div>
<?php	}
	else if (is_array($eMsg)) {
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

<!-- the following javascript bellow are the required files and declarations for the Tab Bar Menu -->
<script src="../includes/jscript/jquerytabs/jquery-1.1.2.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="../includes/jscript/jquerytabs/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
            $(function() {

                $('#container-1').tabs();
                $('#container-2').tabs(1);
                $('#container-3').tabs({ fxSlide: true });
                $('#container-4').tabs({ fxFade: true, fxSpeed: 'fast' });
                $('#container-5').tabs({ fxSlide: true, fxFade: true, fxSpeed: 'fast' });
                $('#container-6').tabs({
                    fxFade: true,
                    fxSpeed: 'fast',
                    onClick: function() {
                        alert('onClick');
                    },
                    onHide: function() {
                        alert('onHide');
                    },
                    onShow: function() {
                        alert('onShow');
                    }
                });
                $('#container-7').tabs({ fxAutoHeight: true });
                $('#container-8').tabs({ fxShow: { height: 'show', opacity: 'show' } });
				$('#container-9').tabs({ remote: true });
                $('#container-10').tabs();
                $('#container-11').tabs({ disabled: [3] });

                $('<p><a href="#">Disable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
                    $(this).parents('div').eq(1).disableTab(3);
                    return false;
                });
                $('<p><a href="#">Activate third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
                    $(this).parents('div').eq(1).triggerTab(3);
                    return false;
                });
                $('<p><a href="#">Enable third tab<\/a><\/p>').prependTo('#fragment-28').find('a').click(function() {
                    $(this).parents('div').eq(1).enableTab(3);
                    return false;
                });

            });
</script>
<link rel="stylesheet" href="../includes/jscript/jquerytabs/jquery.tabs.css" type="text/css" media="print, projection, screen">
<!-- //----------------------------------------------------  -->

<!-- import the calendar css -->
<link rel="STYLESHEET" type="text/css" href="../includes/jscript/calendar/calendar-mos.css">
<!-- import the calendar script -->
<script src="../includes/jscript/calendar/calendar_mini.js" type="text/javascript"/></script>
<!-- import the language module -->
<script src="../includes/jscript/calendar/lang/calendar-en.js" type="text/javascript"/></script>				
<fieldset class="themeFieldset01">
<!--<legend class="themeLegend01">Employee Master File Form</legend>-->
<?php
//printa($_SESSION);
//printa($oData);
//printa($_SESSION['pps_id']);
if (!$_GET['benedit'] OR !$_GET['loanedit']) {
	$c = "checked";
	switch ($oData['salaryclass_id']){
		case '1': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
		case '2': $s1 = $c; $s2 = $c;$s3 = $c; $s4 = $c; $s5 = $c; $num_period=5; break;
		case '3': $s1 = $c; $s2 = $c;$s3 = ""; $s4 = ""; $s5 = ""; $num_period=2; break;
		case '4': $s1 = $c; $s2 = $c;$s3 = ""; $s4 = ""; $s5 = ""; $num_period=2; break;
		case '5': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
		case '6': $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
		default:  $s1 = $c; $s2 = "";$s3 = ""; $s4 = ""; $s5 = ""; $num_period=1; break;
	}
}
?>
<form method="post" action="" onsubmit="return validate(this,'empl');" ENCTYPE="multipart/form-data" name="server">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td><?php include('masterfile/header.tpl.php'); ?></td>
	</tr>
    <tr>
      <td>	
	  <div id="container-4">
		<ul>
		<li><a href="#tab-1"><span>General Information</span></a></li>	
		<li><a href="#tab-2"><span>Compensation</span></a></li>	
		<li><a href="#tab-4"><span>Bank Detail/s</span></a></li>
		<li><a href="#tab-6"><span>Leave</span></a></li>
		<li><a href="#tab-7"><span>Benefit/Deduction</span></a></li>
		<li><a href="#tab-8"><span>Loan</span></a></li>
		<li><a href="#tab-5"><span>Pay Calculation</span></a></li>
		<li><a href="#tab-3"><span>Goverment Policy</span></a></li>
		<?php
		if ($oData['taxep_name'] != 'Zero' && $oData['taxep_name'] != 'Single (S)' && $oData['taxep_name'] != 'Single(S)' && $oData['taxep_name'] != 'Married (ME)') {
			echo '<li><a href="#tab-9"><span>Dependent</span></a></li>';
		}
		?>
		<li><a href="#tab-12"><span>Previous Employer</span></a></li>
		<!--<li><a href="#tab-10"><span>OT</span></a></li>
		<li><a href="#tab-11"><span>YTD</span></a></li>-->
		</ul>
		<?php 
			include('masterfile/personalinfo.tpl.php');
			include('masterfile/compensation.tpl.php');	
			include('masterfile/bankdetails.tpl.php');
			include('masterfile/leave.tpl.php');
			include('masterfile/deduction.tpl.php');
			include('masterfile/loan.tpl.php');
			include('masterfile/ot.tpl.php');
			include('masterfile/govcontribution.tpl.php');
			include('masterfile/dependent.tpl.php');
			//include('masterfile/paycomputation.tpl.php');
			//include('masterfile/ytd.tpl.php');
			include('masterfile/prev_emp.tpl.php');
		?>
	  </div>
	</td>
    </tr>
  </table>
  </form>
</fieldset>
</div>