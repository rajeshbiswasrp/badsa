<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $search = $_GET['sup_id'];
 $dt1=$_GET['dt1'];
 $dt2=$_GET['dt2'];

if($search!='')
{
	/*$supparr='';
	$querysuppid="SELECT * FROM ph_supplier_master where sup_name LIKE '$search%'";
	$resultsuppid=mysql_query($querysuppid);
	while($rowsuppid=mysql_fetch_array($resultsuppid)){
	$supparr.=$rowsuppid['id'].",";
	
	}*/
list($day,$month,$year)=split('[/.]',$dt1);
                    $date1 = "$year-$month-$day";	
list($day,$month,$year)=split('[/.]',$dt2);
                    $date2 = "$year-$month-$day";	

if(strlen($search)>0)
$orsql="sup_id = '$search' and date between '$date1' and '$date2'";
else
$orsql="";	
	
}


if($search!='')
{
$query = "select DISTINCT voucher_no from ph_purchase_master where  $orsql";
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
$display.='<th><strong>Voucher No.</strong></th>';
$display.='<th><strong>Supplier Name</strong></th>';
$display.='<th><strong>Gross Amount</strong></th>';
$display.='<th><strong>Tax Amount</strong></th>';
$display.='<th><strong>Discount Amount</strong></th>';
$display.='<th><strong>Paid Amount</strong></th>';
$display.='<th><strong>Due Amount</strong></th>';
$display.='<th><strong>Option</strong></th>';
$display.='</tr>';
$display.='</tbody>';


$c=1;
while($rowi = mysql_fetch_array($result2))
{
$vou_no=$rowi['voucher_no'];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM ph_purchase_master where voucher_no='$vou_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
//echo $vou_no=$row["voucher_no"];
//$tem_vono."<br>";
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
$t_spq=$row["t_spq"];
$ptr=$row["ptr"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tax_per=$row["tax_per"];
$ed_per=$row["ed_per"];
$vat_tax=$tax_per+$ed_per;
$tot_qty=$t_spq-$re_qty;
$gross_amt=$tot_qty*$ptr;
$vat_amt1=$gross_amt*$vat_tax/100;

if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$gross_amt;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;

$sum=$sum+$gross_amt;
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

$sql13="select SUM(dis_amt)as dis_amt from ph_purchase_master where voucher_no='$vou_no'";
$res13=mysql_query($sql13);
while($row13=mysql_fetch_array($res13))
{
$disco_amt=$row13['dis_amt'];
}

$tot_amt=$gro_amt+$vat_amt-$disco_amt;

$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$vou_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$tot_amt-$pay_amt;
$sum3=$sum3+$due_amt;
$sum4=$sum4+$pay_amt;
$sum5=$sum5+$disco_amt;
$sum6=$sum6+$vat_amt;
$sum7=$sum7+$gro_amt;




$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$date4.'</td>';
$display.='<td>'.$rowi["voucher_no"].'</td>';
$display.='<td>'.$row21["sup_name"].'</td>';
$display.='<td><div align="right">'.number_format($gro_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($vat_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($disco_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($pay_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($due_amt,2).'</div></td>';
$display.='<td><a href=ph_purchase_stock_report.php?voucher_no='.$rowi["voucher_no"].'>View</a></td>';
$display.='</tr>';



$c=$c+1;
}
}

$display.='<tr>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>Total</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sum7,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sum6,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sum5,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sum4,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sum3,2).'</strong></div></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='</tr>';

$sup_id=$_GET['sup_id'];
$display.='<tr>';
$display.='<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensearchindisuprepotdoc(&#39;'.$searchcriteria.'&#39;,&#39;'.$date1.'&#39;,&#39;'.$date2.'&#39;);" target="_blank" /></td>';
$display.='</tr>';

?>
<?php
$display.='</table>';
echo $display;
 }
 
 }
?>