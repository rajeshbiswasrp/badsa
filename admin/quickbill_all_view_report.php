<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$voucher_no=$_REQUEST['voucher_no'];
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
			<h4>Quick Bill All Reports Details <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sl No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Items</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>For</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Size</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Rate</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Quantity</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Total Amount</strong></div></td>
  </tr>
<?php
$c=1;
$sql="SELECT * FROM quick_bill where voucher_no='$voucher_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$for_type=$row["for_type"];
if($for_type==1)
{
$ft='M';
}
else
{
$ft='F';
}
?> 
  <tr>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $c;?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["item_name"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $ft; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["size_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["rate"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["tot_amt"]; ?></strong></div></td>
  </tr>
<?php
$c=$c+1; 
}
?>
</table>
 </div>
           
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