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
			<h4>Master Module <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_category_master.php"><img src="img/1.png" width="120" title="MEDICINE CATEGORY MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_category_master.php">CATEGORY MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
            <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_type_master.php"><img src="img/2.png" width="92" title="MEDICINE TYPE MASTER "/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_type_master.php">BRAND MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
            <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_medicine_master.php"><img src="img/3.png" width="120" title="MEDICINE MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_medicine_master.php">ITEM MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
            <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_supplier_master.php"><img src="img/supplier.jpg" width="92" title="SUPPLIER MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_supplier_master.php">SUPPLIER MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
       
     
            
           
			  </div>
              
 <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_patient_master.php"><img src="img/patient.png" width="92" title="PATIENT MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_patient_master.php">CUSTOMER MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
            <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_employee_master.php"><img src="img/patient.png" width="92" title="PATIENT MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_employee_master.php">EMPLOYEE MASTER</a></div></td>
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