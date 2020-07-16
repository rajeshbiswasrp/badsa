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

<!--*********************************-->
		<div class="span12">		
			<div class="well well-small">
			<h4 style="margin-top:0px; font-size:15px;">Sale View <small class="pull-right">&nbsp;</small></h4>
            
      
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Bill Date</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Total Amount</strong></th>
      <th><strong>Tax Amt</strong></th>
      <th><strong>Net Amount</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<?php
$sum=0;
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_sales_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}

$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master ORDER BY id DESC";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$inv=$rowi['invoice_no'];
$temp_voucher=0;
$oldtempvoucher='999999999999999999';

$sql="SELECT * FROM ph_sales_master where invoice_no='$inv'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$pati_type=$row["pati_type"];
	
$temp_voucher=$row["invoice_no"];
$p_id=$row["pati_id"];
$date=$row["date"];
$bill_date=$row["bill_date"];
$sales_id=$row["id"];
$mrp=$row["mrp"];
$iss_qty=$row["iss_qty"];
$vat=$row["taxpm"];

$sql33="select SUM(gross_amt)as totrate from ph_sales_master where invoice_no='$inv'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}

$sql3="select SUM(tot_sramt)as totreturn from ph_sales_return where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}
$tot_rate1=$totrate-$totreturn;

$sql33v="select SUM(tax_amt)as tottaxpp from ph_sales_master where invoice_no='$inv'";
$res33v=mysql_query($sql33v);
while($row33v=mysql_fetch_array($res33v))
{
$tottaxpp=$row33v['tottaxpp'];
}
$sql3v="select SUM(tax_amt)as tottaxpprr from ph_sales_return where invoice_no='$inv'";
$res3v=mysql_query($sql3v);
while($row3v=mysql_fetch_array($res3v))
{
$tottaxpprr=$row3v['tottaxpprr'];
}
$tottaxxxx=$tottaxpp-$tottaxpprr;

$net_rate=$tot_rate1+$tottaxxxx;
$gross_rate=$net_rate;


if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$gross_rate;
$gro_amt=$sum;
}
else
{
//echo "555";
$sum=0;
$sum=$gross_rate;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}

if($pati_type)
$sql21="SELECT * FROM patient_master where id='$p_id'";
else
$sql21="SELECT * FROM ph_patient_master where id='$p_id'";
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
$due_amt=$gro_amt-$pay_amt;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $date; ?></td>
      <td><?php echo $bill_date; ?></td>
      <td><?php //echo $rowi["invoice_no"]; ?><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><?php echo number_format($tot_rate1,2); ?></td>
      <td><?php echo number_format($tottaxxxx,2); ?></td>
      <td><?php echo number_format($gro_amt,2); ?></td>
      <td><?php echo number_format($pay_amt,2); ?></td>
      <td><?php echo number_format($due_amt,2); ?></td>
      
      <td><a href='sales_details_print2.php?invoice_no=<?php echo $rowi["invoice_no"];?>'>Print</a></td>
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
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>