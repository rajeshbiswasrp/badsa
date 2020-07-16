<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$invoice_no=$_REQUEST['invoice_no'];
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
			<h4>Customer Sales Details <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Base</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Returned Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="right"><strong>MRP</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Dis%</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Expire Date</strong></div></td>
  </tr>
<?php
$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sales_id=$row["id"];
$m_id=$row["medicine_id"];
$bbase=$row["base"];
if($bbase==0)
{
$bb='Strip';
}
else{
$bb='Pieces';
}

$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $bb; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["iss_qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php echo $row["mrp"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["dico_per"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["exp_date"]; ?></strong></div></td>
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