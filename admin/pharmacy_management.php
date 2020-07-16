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
			<h4>Module <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           
		   <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="quick_bill.php"><img src="img/pharmacist-master-icon.png" width="120" title="QUICK BILL MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="quick_bill.php">QUICK BILL MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
		   
		   <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="pharmacy_allmaster.php"><img src="img/master.png" width="120" title="MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="pharmacy_allmaster.php">MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
  <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="p_all_master.php"><img src="img/purchase-master-icon.png" width="120" title="PURCHASE MODULE"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="p_all_master.php">PURCHASE MODULE</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->    
    
            
<!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="p_saleall_master.php"><img src="img/sales-master-icon.png" width="95" title="SALES MASTER"/></a></div></td><!---->
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="p_saleall_master.php">SALES MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->   
             <!-- #################################-->
			
                 
     
            
           
			  </div>
              
  
  
  <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           
		   
            <!-- #################################-->   
		   
		   <!-- #################################-->
			<!--<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="all_cash_details.php"><img src="img/view.png" width="120" title="CASH DETAILS"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="all_cash_details.php">CASH DETAILS</a></div></td>
  </tr>
</table>

            </div>-->
            <!-- #################################-->
            
          <div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_all_view.php"><img src="img/view.png" width="92" title="VIEW"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_all_view.php">PAYMENT / PRINT</a></div></td><!--ph_all_view.php-->
  </tr>
</table>

            </div>
            

   <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_reports.php"><img src="img/reports.png" width="120" title="REPORTS"/></a></div></td><!--ph_reports.php-->
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="ph_reports.php">REPORTS</a></div></td><!--ph_sup_report.php-->
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