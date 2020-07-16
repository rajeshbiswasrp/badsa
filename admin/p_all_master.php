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
			<h4>Purchase Module <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
            
            
            
            
           <!-- #################################-->
			<div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="purchase_master.php"><img src="img/pharmacy.png" width="120" title="PURCHASE MASTER"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="purchase_master.php">PURCHASE MASTER</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
           <div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="item_barcode.php"><img src="img/pharmacy.png" width="120" title="ITEM BARCODE"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="item_barcode.php">ITEM BARCODE</a></div></td>
  </tr>
</table>

            </div>
            <!-- #################################-->
            
             <!-- #################################-->
            
           <div class="span3" style="border:solid 1px #ccc; padding:10px; background-color:#EDFFF2; border-radius:5px;">
            <table width="95%" border="0">
  <tr>
    <td><div align="center"><a href="purchase_return.php"><img src="img/pharmacy.png" width="120" title="PURCHASE RETURN"/></a></div></td>
  </tr>
  <tr>
    <td><div style="text-align:center; font-weight:bold;"><a href="purchase_return.php">PURCHASE RETURN</a></div></td>
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