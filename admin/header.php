<?php 
/* $DEVID="5B820D00452C";
//$DEVID="0019E06B71015A880C030001";
$a = new COM('WScript.Shell');

try{
if (!($regcount = $a->RegRead("HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\USBSTOR\Enum\Count"))) {
   // throw new Exception("Cannot access registry.");
}
}
catch(Exception $e){
   echo "error access device";
   
}
$usbfound=0;
if(isset($regcount) && $regcount>0){
for($i=0;$i<$regcount;$i++)
{
  if(!($usbdevice = $a->RegRead("HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\USBSTOR\Enum\\".$i))) {
    //throw new Exception("Cannot access registry.");
   }
   
   if(strpos($usbdevice,$DEVID))
   {
       $usbfound=1;
       break;
   }
}
}
if(!$usbfound)
{
?>
<script>
window.location="not_support_system.php"
</script>
<?php
}
*/
ob_start();
//Get the ipconfig details using system commond
system('ipconfig /all');

// Capture the output into a variable
$mycomsys=ob_get_contents();

// Clean (erase) the output buffer
ob_clean();

$find_mac = "Physical";
//find the "Physical" & Find the position of Physical text

$pmac = strpos($mycomsys, $find_mac);
// Get Physical Address

$macaddress=substr($mycomsys,($pmac+36),17);
//Display Mac Address


$password = $macaddress;

$iterations = '1000';
$hash= md5($password.$iterations);


$sql="select * from `key` where 1";
$result=mysql_query($sql);
if(mysql_num_rows($result)==0)
{
	?>
	<script>
	window.location="index.php";
	</script>
	<?php 
}
else
{
	$sql1="Select * from `key` where `key`='$hash'";
	$result1=mysql_query($sql1);
	if(mysql_num_rows($result1)==0)
	{
			?>
			<script>
			window.location="index.php";
			</script>
			<?php 
	}

}
?>
<?php
$sname_logo=mysql_fetch_array(mysql_query("select * from ph_config_master where status='1'"));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $sname_logo['com_name'] ; ?></title>
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
    <!--<div align="right" class="btn btn-primary"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Back</a></div><span class="btn btn-success "><a style="text-decoration:none; color:#fff;" href="#">blink&nbsp;<i class="icon-eye-open blink" style="color:#000; font-size:16px;"></i></a></span>-->
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
      <a class="brand bappa1" href="pharmacy_management.php"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="50" alt="MERRYLAND NURSING HOME"/></a>
		<!--<form class="form-inline navbar-search" method="post" action="" >
		<input id="srchFld" class="srchTxt" type="text" style="padding-left:30px; margin:11px 0px -5px 0px;" />
		   
		  <button type="submit" id="submitButton" class="btn btn-primary" style="margin:11px 0px -5px 0px;">Go</button>
    </form>-->
		<ul class="nav" style="text-transform:capitalize; float:right; margin:15px 0px -5px 0px;">
			<li><a href="pharmacy_management.php">Home</a></li>
            <li><a href="quick_bill.php">Quick Bill</a></li>
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Master <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="ph_employee_master.php">Employee Master</a></li>
					<li><a href="ph_category_master.php">Category Master</a></li>
                    <li><a href="ph_type_master.php">Brand  Master</a></li>
                    <li><a href="ph_medicine_master.php">Items Master</a></li>
                    <li><a href="ph_supplier_master.php">Supplier Master</a></li>
                    <li><a href="ph_patient_master.php">Customer Master</a></li>
				</ul>
			</li>
			
			<!--<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Purchase Module <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	
					<li><a href="purchase_order.php">Purchase Order</a></li>
                    <li><a href="purchase_order_view.php">Purchase Master</a></li>
					<li><a href="purchase_reorder.php">Purchase Reorder</a></li>
				</ul>
			</li>-->
            <li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Purchase Module<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	
					<li><a href="purchase_master.php">Purchase Master</a></li>
                    <li><a href="item_barcode.php">Item Barcode</a></li>
                    <li><a href="purchase_return.php">Purchase Return</a></li>
                    <!--<li><a href="purchase_view.php">Purchase View</a></li>-->
				</ul>
			</li>
            <!--<li><a href="purchase_master.php">Purchase Master</a></li>-->
			
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Sales Module <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	
					<li><a href="sales_master.php">Sales Master</a></li>
                    <!--<li><a href="sales_view.php">Sales View</a></li>-->
                    <li><a href="sale_return.php">Sale Return</a></li>
                    <!--<li><a href="rate_chart.php">Rate Chart</a></li>-->
				</ul>
			</li>
			
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">Payment / Print<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">	
					<li><a href="quick_bill_view.php">Quick Bill</a></li>
                    <li><a href="ph_patient_view.php">Customer</a></li>
                    <li><a href="ph_supplier_view.php">Supplier</a></li>
				</ul>
			</li>
			<!--<li><a href="all_cash_details.php">Cash Details</a></li>-->
			
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="ph_reports.php">Reports <b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li><a href="quickbill_all_report.php">Quick Bill Report</a></li>
                    <li><a href="test_all_report.php">All Size Wise Report</a></li>
                    <li><a href="item_all_report.php">All Item Wise Report</a></li>
                    <li><a href="emp_indall_report.php">Emp Report</a></li>
                    <li><a href="ph_all_report.php">Profit / Loss Report</a></li>
                    <li><a href="ph_cus_pay_report.php">Daily Sale Report</a></li>
                    <li><a href="ph_item_report.php">All Item Stock</a></li>
                    <li><a href="ph_sup_pay_report.php">All Supplier Payment Report</a></li>
					<li><a href="ph_sup_report.php">All Supplier<!-- / Stock--></a></li>
                    <li><a href="ph_indsup_report.php">Individual Supplier</a></li>
                    
                    
				</ul>
			</li>
        
			
			
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