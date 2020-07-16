<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>MERRYLAND NURSING HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
<script src="../themes/js/jquery.min.js"></script>
    <link id="callCss" rel="stylesheet" href="../themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="../themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="../themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="../themes/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="../themes/css/animate.css" rel="stylesheet"/>
<!-- Google-code-prettify -->	
	<link href="../themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="../themes/images/logo_icon.png"/>
    <script>
   $(document).ready(function(){
      $('.bappa1').addClass('animated flip');
});
</script>
<!--scroll ########################-->
   <link rel="stylesheet" type="text/css" href="css/perfect-scrollbar.css">
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script src="js/perfect-scrollbar.js"></script>
    <style>
      #description {
        border: 0px solid #34495e;
        height:311px;
        width: 100%;
		margin-left:0px;
        overflow: hidden;
		padding:0px;
        position: relative;
      }
	   
	   
	  .bbottom{ border-bottom:dotted 1px #ccc;}
    </style>
    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#description').perfectScrollbar();
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#description1').perfectScrollbar();
      });
    </script>
   
    <!-- scroll########################-->

<!--blink start-->
 <script type="text/javascript" language="javascript" src="jquery-1.3.2.min.js"></script>
    <script type="text/javascript" language="javascript"> 
$(document).ready(
function(){
$('.blink').css("text-decoration","none");
 $('.blink').each(function() {
    var elem = $(this);
    setInterval(function() {
        if (elem.css('visibility') == 'hidden') {
            elem.css('visibility', 'visible');
        } else {
            elem.css('visibility', 'hidden');
        }    
    }, 200);
});

}
  
);
</script>
<!--blink start--> 

  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6">Welcome!<strong> Admin</strong></div>
    <div align="right" class="btn btn-primary"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Back</a></div><!--<span class="btn btn-success "><a style="text-decoration:none; color:#fff;" href="#">blink&nbsp;<i class="icon-eye-open blink" style="color:#000; font-size:16px;"></i></a></span>-->
	<div class="span6">
	<div class="pull-right">
		
		<!--<a href="#"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> button</span> </a> -->
	</div>
	</div>
</div>

<!-- Navbar ================================================== -->

<div class="navbar">
  <div class="navbar-inner">
	<div class="container">
    <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
	  <div class="nav-collapse">
      <a class="brand bappa1" href="../admin/dashboard.php"><img src="../themes/images/logo.png" width="60" alt="MERRYLAND NURSING HOME"/></a>
		<!--<form class="form-inline navbar-search" method="post" action="" >
		<input id="srchFld" class="srchTxt" type="text" style="padding-left:30px; margin:11px 0px -5px 0px;" />
		   
		  <button type="submit" id="submitButton" class="btn btn-primary" style="margin:11px 0px -5px 0px;">Go</button>
    </form>-->
		<ul class="nav" style="text-transform:capitalize; float:right; margin:15px 0px -5px 0px;">
			<li><a href="pharmacy_management.php">Home</a></li>
<!--            <li><a href="../admin/reception_module.php">Reception</a></li>
            <li><a href="../admin/opd_module1.php">OPD</a></li>
            <li><a href="../admin/ipd_module1.php">IPD</a></li>
            <li><a href="../pathology/dashboard.php">Pathology</a></li>
            <li><a href="../admin/master.php">Master</a></li>
            <li><a href="pharmacy_management.php">Pharmacy</a></li>
-->			<!--<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Master <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					
					<li><a href="doctor_master.php">Doctor Master</a></li>
                    <li><a href="refer_master.php">Referrer Master</a></li>
                    <li><a href="room_master.php">Room Master</a></li>
                    <li><a href="bed_master.php">Bed Master</a></li>
                    <li><a href="commission_master.php">Commission Master</a></li>
                    <li><a href="disease_master.php">Disease Master</a></li>
                    <li><a href="pathology_master.php">Pathology Master</a></li>
				</ul>
			</li>-->
        <!--<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Payment <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					
					<li><a href="opd_module1.php">OPD</a></li>
                    <li><a href="ipd_payment.php">IPD</a></li>
                    <li><a href="#">PATHOLOGY</a></li>
				</ul>
			</li>-->
            <!--<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Commission <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
					
					<li><a href="opd_comm.php">OPD</a></li>
                    <li><a href="ipd_comm.php">IPD</a></li>
                    <li><a href="#">PATHOLOGY</a></li>
				</ul>
			</li>-->
			
			
            <li class="">
	 <a href="logout.php" role="button"  style="padding-right:0; margin:-20px 0px 0px 0px;"><span class="btn btn-large btn-success">Logout</span></a>
	
	</li>
		</ul>
		
	  </div>
	</div>
  </div>
</div>



</div>
</div>