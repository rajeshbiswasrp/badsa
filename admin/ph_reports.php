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
			<h4>Reports Module <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
            <!-- #################################-->
			
            
<div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="quickbill_all_report.php"><img src="img/stock report.png" width="120" title="ALL ITEM STOCK"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="quickbill_all_report.php">QUICK BILL REPORT</a></div></td><!--ph_all_report.php-->
  </tr>
</table>

            </div> 
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="test_all_report.php"><img src="img/stock report.png" width="120" title="ALL SIZE WISE REPORTS"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="test_all_report.php">ALL SIZE WISE REPORT</a></div></td><!--ph_all_report.php-->
  </tr>
</table>

            </div>    
            
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="item_all_report.php"><img src="img/stock report.png" width="120" title="ALL SIZE WISE REPORTS"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="item_all_report.php">ALL ITEM WISE REPORT</a></div></td><!--ph_all_report.php-->
  </tr>
</table>

            </div>
            
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="emp_indall_report.php"><img src="img/stock report.png" width="120" title="EMP REPORT"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="emp_indall_report.php">EMP REPORT</a></div></td>
  </tr>
</table>

            </div> 
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_all_report.php"><img src="img/stock report.png" width="120" title="PROFIT / LOSS REPORT"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_all_report.php">PROFIT / LOSS REPORT</a></div></td>
  </tr>
</table>

            </div>   
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_cus_pay_report.php"><img src="img/stock report.png" width="120" title="ALL PAID CUSTOMER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_cus_pay_report.php">DAILY SALE REPORT</a></div></td>
  </tr>
</table>

            </div>  
             
            
            </div>
            <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
            <!-- #################################-->
			
            
 
                <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_item_report.php"><img src="img/stock report.png" width="120" title="ALL PAID CUSTOMER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_item_report.php">ALL ITEM STOCK</a></div></td>
  </tr>
</table>

            </div>
            
             
               
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_sup_pay_report.php"><img src="img/stock report.png" width="120" title="ALL SUPPLIER PAYMENT"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_sup_pay_report.php">ALL SUPPLIER PAYMENT</a></div></td>
  </tr>
</table>

            </div>  
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_sup_report.php"><img src="img/stock report.png" width="120" title="ALL SUPPLIER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_sup_report.php">ALL SUPPLIER</a></div></td>
  </tr>
</table>

            </div> 
            <div class="span2" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="ph_indsup_report.php"><img src="img/stock report.png" width="120" title="INDIVIDUAL SUPPLIER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a style=" font-size:10px; line-height:20px;" href="ph_indsup_report.php">INDIVIDUAL SUPPLIER</a></div></td>
  </tr>
</table>

            </div>
            
            </div>
            <!-- #################################-->

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