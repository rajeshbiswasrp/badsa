<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
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

<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        		
			<div class="well well-small">
			<h4>Cash Details<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="all_cash_details.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
  </form>
		
		
		<br/>
			
	</div>


<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong><!--Invoice No.-->Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Gross Amount</strong></th>
     <!-- <th><strong>Add Charges</strong></th>
      <th><strong>Discount</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>-->
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<tbody>         
    <?php
if($_POST["submit"])
{

$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
?>

<?php
$sum=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no,receipt_no,pati_id FROM ph_sales_master where date between '$date' and '$date1' and pati_id='1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$inv=$rowi['invoice_no'];
$temp_voucher=0;
$oldtempvoucher='999999999999999999';

$sql="SELECT * FROM ph_sales_master where invoice_no='$inv' and pati_id='1'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$pati_type=$row["pati_type"];

$temp_voucher=$row["invoice_no"];
$p_id=$row["pati_id"];
$date=$row["date"];

$sales_id=$row["id"];
$mrp=$row["mrp"];
$m_id=$row["medicine_id"];
$iss_qty=$row["iss_qty"];

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tot_qty=$iss_qty-$re_qty;
$gross_amt=$tot_qty*$mrp;

if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
else
{
//echo "555";
$sum=0;
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}

if($pati_type==0)
$sql21="SELECT * FROM ph_patient_master where id='$p_id'";
else
if($pati_type==1)
$sql21="SELECT * FROM patient_master where id='$p_id'";

$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$pati_name=$row21["pati_name"];
}

$sql2="select SUM(less_pay)as pay_amt from ph_sales_payment where invoice_no='$inv'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$pay_amt=$row2['pay_amt'];
}
$sql3="select SUM(add_charge)as add_amt from ph_sales_payment where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$add_amt=$row3['add_amt'];
}

$sql4="select SUM(less_dis)as dis_amt from ph_sales_payment where invoice_no='$inv'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$dis_amt=$row4['dis_amt'];
}

$tot_amt=$gro_amt+$add_amt;
$due_amt=$tot_amt-$pay_amt-$dis_amt;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $date; ?></td>
      <td><?php //echo $rowi["invoice_no"]; ?><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><?php echo $gro_amt; ?></td>
<!--      <td><?php //echo $add_amt; ?></td>
      <td><?php //echo $dis_amt; ?></td>
      <td><?php //echo $pay_amt; ?></td>
      <td><?php //echo $due_amt; ?></td>
-->      <td><a href='ph_sales_cash_report.php?invoice_no=<?php echo $rowi["invoice_no"];?>'>View</a></td>
      </tr>
<?php 
$c=$c+1;
}
?>    
  
<?php 
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