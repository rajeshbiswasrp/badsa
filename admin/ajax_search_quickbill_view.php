<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $search = $_GET['q'];

 if($search!='')
 {
$query = "select DISTINCT voucher_no,invoice_no from quick_bill where voucher_no!='' and invoice_no LIKE '$search%' $orsql";
$result2=mysql_query($query);
?>

  
<?php
if(mysql_num_rows($result2)==0)
{
$display='';
$display='<table class="table table-hover table-striped table-bordered" id="product-table">';
$display.='<tr>';
$display.='<td height="22" colspan="7" width="100%" align="center" valign="middle"><font color="#FF0000">No Record Found.</font></td></tr>';
$display.='</table>';
echo $display;
}
else
{ 
$display='';
$display='<table class="table table-hover table-striped table-bordered">';
$display.='<tbody>';
$display.='<tr>';
$display.='<tr>';
$display.='<th><strong>Sl No.</strong></th>';
$display.='<th><strong>Date</strong></th>';
$display.='<th><strong>Bill No.</strong></th>';
$display.='<th><strong>Customer Name</strong></th>';
$display.='<th><strong>Total Amount</strong></th>';
$display.='<th><strong>Discount Amount</strong></th>';
$display.='<th colspan="4"><strong>Option</strong></th>';
$display.='</tr>';
$display.='</tbody>';


$sum=0;
$sum2=0;
$sum3=0;
$sum33=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$c=1;
while($rowi = mysql_fetch_array($result2))
{
$vou_no=$rowi['voucher_no'];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM quick_bill where voucher_no='$vou_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$dis_amt=$row["dis_amt"];
$less_pay=$row["less_pay"];
$cus_name=$row["cus_name"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";

$sql33="select SUM(tot_amt)as totrate from quick_bill where voucher_no='$vou_no'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}
if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
$oldtempvoucher=$temp_voucher;
}

$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$date4.'</td>';
$display.='<td>'.$rowi["voucher_no"].'</td>';
$display.='<td>'.$cus_name.'</td>';
$display.='<td><div align="right">'.number_format($totrate,2).'</div></td>';
$display.='<td><div align="right">'.number_format($dis_amt,2).'</div></td>';
$display.='<td><a href=#>Print</a></td>';
$display.='</tr>';
$c=$c+1;
}
?>
<?php
$display.='</table>';
echo $display;
 }
 
 }
?>