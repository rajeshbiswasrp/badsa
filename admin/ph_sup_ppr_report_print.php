<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>

<?php
function convert_number_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
    if($no == 0)
        return ' ';
    else {
	$novalue='';
	$highno=$no;
	$remainno=0;
	$value=100;
	$value1=1000;       
            while($no>=100)    {
                if(($value <= $no) &&($no  < $value1))    {
                $novalue=$words["$value"];
                $highno = (int)($no/$value);
                $remainno = $no % $value;
                break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
          if(array_key_exists("$highno",$words))
              return $words["$highno"]." ".$novalue." ".convert_number_to_words($remainno);
          else {
             $unit=$highno%10;
             $ten =(int)($highno/10)*10;            
             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".convert_number_to_words($remainno);
           }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MERRYLAND NURSING HOME</title>
<link rel="shortcut icon" href="img/logo_icon.png" />
<link rel="stylesheet" type="text/css" href="invoice.css"/>
<script>
function print1()
{
document.getElementById("button").innerHTML='';
 var divElements1 = document.getElementById('topprint').innerHTML;
document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements1 + "</body>";
window.print();
return false;
//document.getElementById("button").style.display='block';
}
</script>
</head>

<body>
<div align="center"><a href="ph_sup_ppr_report.php">Back</a></div>
<div id="topprint">


<div id="b" class="page">
<table align="center" width="750" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td valign="top" class="btop bleft bbottom" width="100"><div align="center"><img src="img/logo.png" width="90" height="90"/></div></td>
    <td valign="top" class="btop bleft bbottom bright" width="620">
    <div style="font-size:20px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">MERRYLAND NURSING HOME </div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">Address : P-46, Nani Gopal Roy Chowdhury Avevue </div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:lo; padding-top:5px;"><span style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">Kolkata - 700014 Ph: 033 65000315</span>,Email : merryland.nh92@gmail.com</div>
    </td>
  </tr>
</table>
<br/>
<table align="center" width="754" border="1" cellpadding="1" cellspacing="0" style="font-size:13px;">
    <tbody>
      <tr>
      <th><div align="center"><strong>Sl No.</strong></div></th>
      <th><div align="center"><strong>Date Of Purchase</strong></div></th>
      <th><div align="center"><strong>Voucher No.</strong></div></th>
      <th><strong>GRN No.</strong></th>
      <th><div align="center"><strong>Supplier Name</strong></div></th>
      <th><div align="center"><strong>Bill Amount</strong></div></th>
    <!--  <th><div align="right"><strong>Bill Details</strong></div></th>-->
      <th><div align="center"><strong>Return Amount</strong></div></th>
      <!--<th><div align="right"><strong>Return Details</strong></div></th>-->
      <th><div align="center"><strong>Stock Balance</strong></div></th>
      <!--<th><div align="right"><strong>Stock Items</strong></div></th>-->
    </tr>
   </tbody>
<tbody>  


<?php
if(isset($_GET['dt']) && isset($_GET['dt1']))
{
$date = $_GET['dt'];
$date1 = $_GET['dt1'];
}
else
if(isset($_GET['searchsupplierret'])){
 $search = urldecode($_GET['searchsupplierret']);
 

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
 	
}
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$c=1;
/*if($_GET[id]!="")
{
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}*/
if(isset($_GET['dt']) && isset($_GET['dt1']))
{
$sqli = "SELECT DISTINCT voucher_no FROM ph_purchase_master where date between '$date' and '$date1'";
}
else
if(isset($_GET['searchsupplierret'])){
$sqli = "select DISTINCT voucher_no from ph_purchase_master where voucher_no LIKE '$search%' $orsql";
}

$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
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

$grn_no=$row["grn_no"];
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
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><?php echo $grn_no; ?></td>
      <td><?php echo $row21["sup_name"]; ?></td>
      <td><div align="right"><?php echo number_format($gro_amt,2); ?></div></td>
     <?php /*?> <td><a href='ph_purchase_bill_report.php?voucher_no=<?php echo $rowi["voucher_no"];?>' target="_blank">View</a></td><?php */?>
      <td><div align="right"><?php echo number_format($pay_amt,2); ?></div></td>
      <?php /*?><td><a href='ph_purchase_return_report.php?voucher_no=<?php echo $rowi["voucher_no"];?>' target="_blank">View</a></td><?php */?>
      <td><div align="right"><?php echo number_format($due_amt,2); ?></div></td>
      <?php /*?><td><a href='ph_purchase_stock_report.php?voucher_no=<?php echo $rowi["voucher_no"];?>' target="_blank">View</a></td><?php */?>
      </tr>
<?php 
$c=$c+1;
}
}

?>  
<tr>
      <th><strong>&nbsp;</strong></th>
      <th><strong>&nbsp;</strong></th>
      <th><strong>&nbsp;</strong></th>
      <th><strong>&nbsp;</strong></th>
      <th><strong>Total</strong></th>
      <th><div align="right"><strong><?php echo number_format($sum7,2); ?></strong></div></th>
      <?php /*?><th><strong><?php //echo $sum6; ?></strong></th><?php */?>
      <th><div align="right"><strong><?php echo number_format($sum4,2); ?></strong></div></th>
      <?php /*?><th><strong><?php //echo $sum4; ?></strong></th><?php */?>
      <th><div align="right"><strong><?php echo number_format($sum3,2); ?></strong></div></th>
      <!--<th><strong>&nbsp;</strong></th>-->
    </tr>  




</tbody>   
</table>	




</div>
<br />
<table align="center" border="0">
  <tr>
    <td><div align="center" id="button"><input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/></div></td>
    </tr> 
</table>
<br />
</div>

</body>
</html>
