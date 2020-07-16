<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php include('header.php'); ?>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->
		<div class="span12">		
			<div class="well well-small">
			<h4>Payment / Print Module <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
            <div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="quick_bill_view.php"><img src="img/pharmacist-master-icon.png" width="112" title="QUICK BILL"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="quick_bill_view.php">QUICK BILL</a></div></td>
  </tr>
</table>

            </div>
           <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_patient_view.php"><img src="img/customer.jpg" width="150" title="VIEW CUSTOMER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_patient_view.php">CUSTOMER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
            <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_supplier_view.php"><img src="img/supplier.jpg" width="88" title="VIEW SUPPLIER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_supplier_view.php">SUPPLIER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
           
           
			  </div>
              
		</div>
		
			  	

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>