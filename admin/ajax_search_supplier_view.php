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
	$supparr='';
	$querysuppid="SELECT * FROM ph_supplier_master where sup_name LIKE '$search%'";
	$resultsuppid=mysql_query($querysuppid);
	while($rowsuppid=mysql_fetch_array($resultsuppid)){
	$supparr.=$rowsuppid['id'].",";
	
	}
	
$supparr=substr($supparr,0,strlen($supparr)-1);
if(strlen($supparr)>0)
$orsql="OR sup_id in ($supparr)";
else
$orsql="";	
	
}


 if($search!='')
 {
$query = "select DISTINCT sup_id from ph_purchase_master where voucher_no!='' and invoice_no LIKE '$search%' $orsql";
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
$display.='<th><strong>Supplier Name</strong></th>';
$display.='<th><strong>Supplier Id</strong></th>';
$display.='<th><strong>Gross Purchased</strong></th>';
$display.='<th><strong>Purchased Returned</strong></th>';
$display.='<th><strong>Net Purchased</strong></th>';
$display.='<th><strong>Paid Amount</strong></th>';
$display.='<th><strong>Due Amount</strong></th>';
$display.='<th><strong>Option</strong></th>';
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
$sup_id=$rowi['sup_id'];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM ph_purchase_master where sup_id='$sup_id'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";

$t_spq=$row["qty"];
$ptr=$row["ptr"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["taxpm"];

$sql33="select SUM(total_rate)as totrate from ph_purchase_master where sup_id='$sup_id'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}
$sql3="select SUM(ptr)as totreturn from ph_purchase_return where sup_id='$sup_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}
$net_rate=$totrate-$totreturn;


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
$sql21="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{



$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where sup_id='$sup_id'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$gro_amt-$pay_amt;



$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$row21["sup_name"].'</td>';
$display.='<td>'.$row21["supplier_id"].'</td>';
$display.='<td><div align="right">'.number_format($totrate,2).'</div></td>';
$display.='<td><div align="right">'.number_format($totreturn,2).'</div></td>';
$display.='<td><div align="right">'.number_format($net_rate,2).'</div></td>';
$display.='<td><div align="right">'.number_format($pay_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($due_amt,2).'</div></td>';
$display.='<td><a href=ph_supplier_payment.php?sup_id='.$rowi["sup_id"].'>Pay</a></td>';
$display.='</tr>';
$c=$c+1;
}
}
?>
<?php
$display.='</table>';
echo $display;
 }
 
 }
?>