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
			<h4>Stock / Supplier Stock Reports Details <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchase Price</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchased Qty</strong></div></td>
   <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Returned Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Box</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Total Sale Return Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Box In Hand</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Pieces In Hand</strong></div></td>
  </tr>
<?php
$sql="SELECT * FROM ph_purchase_master where voucher_no='$voucher_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$purchase_qty=$row["qty"];
$total_qty_p=$row["total_qty_p"];
$nts=$row["nts"];
$purchase_id=$row["id"];
$m_id=$row["medicine_id"];
$purchase_id=$row["id"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$re_qtyinpieces=$re_qty*$nts;
$sql33="select SUM(sale_qty)as isb_qty from ph_sales_master where purchase_id='$purchase_id'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$isb_qty=$row33['isb_qty'];
}

$totsalepp=$isb_qty;


$sql33r="select SUM(return_qty)as isb_return from ph_sales_return where purchase_id='$purchase_id'";
$res33r=mysql_query($sql33r);
while($row33r=mysql_fetch_array($res33r))
{
$isb_return=$row33r['isb_return'];
}
$isb_rrrrinpp=$isb_return;
$totsalereturnpp=$isb_rrrrinpp;


$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["ptr"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $isb_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $isp_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $totsalereturnpp; ?></strong></div></td>

  </tr>
<?php 
}
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