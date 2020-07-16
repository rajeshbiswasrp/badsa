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

<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<link rel="stylesheet" href="../themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.datepicker.js"></script>

<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
	$(function() {
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
function opensuprepotdoc(dt,dt1){
window.location="quickbill_all_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script> 
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        		
			<div class="well well-small">
			<h4>Emp Report View<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>S.Date</strong></th>
      <th><strong>Bill No.</strong></th>
      <th><strong>C.Name</strong></th>
      <th><strong>Category</strong></th>
      <th><strong>Brand</strong></th>
      <th><strong>Items</strong></th>
      <th><strong>Size</strong></th>
      <th><strong>For</strong></th>
      <th><strong>S.Price</strong></th>
      <th><strong>S.Qty</strong></th>
      <th><strong>Status</strong></th>
    </tr>
        </tbody>
<tbody>           

<?php
$c=1;
$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$barcode=$row["barcode"];
$sale_id=$row["id"];
$purchase_id=$row["purchase_id"];
$medicine_id=$row["medicine_id"];
$pati_id=$row["pati_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
					
$sql2="SELECT * FROM ph_patient_master where id='$pati_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sql3="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
$categ_id=$row3["categ_id"];
$type_id=$row3["type_id"];

$sql4="SELECT * FROM ph_category_master where id='$categ_id'";
$result4=mysql_query($sql4);
while($row4=mysql_fetch_array($result4))
{
$sql5="SELECT * FROM ph_type_master where id='$type_id'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $row["invoice_no"]; ?></td>
      <td><?php echo $row2["pati_name"]; ?></td>
      <td><?php echo $row4["categ_name"]; ?></td>
      <td><?php echo $row5["type_name"]; ?></td>
      <td><?php echo $row3["medici_name"]; ?></td>
      <td><?php echo $row["size_type"]; ?></td>
      <td><?php echo $row["for_type"]; ?></td>
      <td><?php echo $row["mrp"]; ?></td>
      <td><?php echo $row["sale_qty"]; ?></td>
<?php
$sql6="SELECT * FROM ph_sale_return where sale_id='$sale_id'";
$result6=mysql_query($sql6);
while($row6=mysql_fetch_array($result6))
{
$barcode2=$row6["barcode"];
}
if($barcode==$barcode2)
{
?>
<td>Return</td>
<?php
}
else
{
?>
<td>Sale</td>
<?php }?>
      </tr>
<?php 
$c=$c+1;
}
}
}
}
}
?>  
</tbody>   
</table>	




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