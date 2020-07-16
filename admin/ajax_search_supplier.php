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
$query = "select DISTINCT voucher_no from ph_purchase_master where voucher_no LIKE '$search%' $orsql";
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
$display.='<th><strong>Net Amount</strong></th>';
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
$tax_per=$row["tax_per"];
$ed_per=$row["ed_per"];
$dico_per=$row["dico_per"];
$mrp=$row["mrp"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
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
$sql21="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{


$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$vou_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$gro_amt-$pay_amt;
$sum3=$sum3+$due_amt;
$sum4=$sum4+$pay_amt;
$sum5=$sum5+$dis_amt;
$sum6=$sum6+$vat_amt1;
$sum7=$sum7+$gro_amt;




$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$date4.'</td>';
$display.='<td>'.$rowi["voucher_no"].'</td>';
$display.='<td>'.$row21["sup_name"].'</td>';
$display.='<td><div align="right">'.number_format($gro_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($vat_amt1,2).'</div></td>';
$display.='<td><div align="right">'.number_format($dis_amt,2).'</div></td>';
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

$searchcriteria=$_GET['q'];
$display.='<tr>';
$display.='<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensearchsuprepotdoc(&#39;'.$searchcriteria.'&#39;);" target="_blank" /></td>';
$display.='</tr>';

?>
<?php
$display.='</table>';
echo $display;
 }
 
 }
?>