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
			<h4 style="margin-top:0px; font-size:15px;">Purchase View<small class="pull-right">&nbsp;</small></h4>
            
      
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Tax Amount</strong></th>
      <!--<th colspan="2"><strong>Adjustment</strong></th>-->
      <th><strong>Discount Amount</strong></th>
      <th><strong>Net Amount</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>
      <th colspan="2"><strong>Option</strong></th>
    </tr>
        </tbody>
<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}

$sqli = "SELECT DISTINCT voucher_no FROM ph_purchase_master where voucher_no!=''";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$vou_no=$rowi['voucher_no'];
$temp_voucher=0;
$oldtempvoucher='999999999999999999';

$sql="SELECT * FROM ph_purchase_master where voucher_no='$vou_no'";

$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
//echo $vou_no=$row["voucher_no"];
//$tem_vono."<br>";
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$bill_date=$row["bill_date"];
$t_spq=$row["t_spq"];
$ptr=$row["ptr"];
$tax_per=$row["tax_per"];
$ed_per=$row["ed_per"];
$dico_per=$row["dico_per"];
$mrp=$row["mrp"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id' and voucher_no='$vou_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}

$tot_qty=$t_spq-$re_qty;
$ed_per_valu=$ed_per*$tot_qty;
$gross_rate1=$tot_qty*$mrp;
$tot_rate1=$tot_qty*$ptr;
$dis_amt=$tot_rate1*$dico_per/100;
$gross_rate=$tot_qty*$ptr-$ed_per_valu;
$vat_amt1=$gross_rate1*$tax_per/100;
$net_rate=$gross_rate-$dis_amt+$ed_per_valu+$vat_amt1;
if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;
$sum=$sum+$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
$oldtempvoucher=$temp_voucher;
}

$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$vou_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$gro_amt-$pay_amt;

$sql21="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{


?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $bill_date; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><?php echo $row21["sup_name"]; ?></td>
      <td><?php echo number_format($gross_rate,2); ?></td>
      <td><?php echo number_format($vat_amt1,2); ?></td>
      <!--<td><?php //echo $amt_of_adj; ?></td>
      <td><?php // echo $addmm; ?></td>-->
      <td><?php echo number_format($dis_amt,2); ?></td>
      <td><?php echo number_format($gro_amt,2); ?></td>
      <td><?php echo number_format($pay_amt,2); ?></td>
      <td><?php echo number_format($due_amt,2); ?></td>
      <td><a href='purchase_details_print2.php?voucher_no=<?php echo $rowi["voucher_no"];?>'>Print</a></td>
      <td><a href='sup_paydetails.php?sup_id=<?php echo $row21["id"];?>'>Pay Details</a></td>
      </tr>
<?php 
$c=$c+1;
}
//}
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