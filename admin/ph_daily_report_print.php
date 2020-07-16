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
<div align="center"><a href="ph_daily_report.php">Back</a></div>
<div id="topprint">


<div id="b" class="page">
<table align="center" width="750" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td valign="top" class="btop bleft bbottom" width="100"><div align="center"><img src="img/logo.png" width="90" height="90"/></div></td>
    <td valign="top" class="btop bleft bbottom bright" width="620">
    <div style="font-size:20px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">SMART GARMENTSM</div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">Address : Dankuni, Howrah</div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:lo; padding-top:5px;"></div>
    </td>
  </tr>
</table>
<br/>
<table align="center" width="754" border="1" cellpadding="1" cellspacing="0" style="font-size:13px;">
    <tbody>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Add Charges</strong></th>
      <th><strong>Discount</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>
      </tr>
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
if(isset($_GET['searchcustomer'])){
 $search = urldecode($_GET['searchcustomer']);
 
if($search!='')
{
    $custarr='';
	$querycustid="SELECT * FROM ph_patient_master where pati_name LIKE '%$search%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
$orsql="OR ( pati_id in ($custarr) and pati_type='0' )";
else
$orsql="";	

    $custarr='';
	$querycustid="SELECT * FROM patient_master where pati_name LIKE '%$search%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
{
if(strlen($orsql)>0)
$orsql=$orsql." OR ( pati_id in ($custarr) and pati_type='1' )";
else
$orsql="OR ( pati_id in ($custarr) and pati_type='1' )";
}
else
{
if(strlen($orsql)==0)
$orsql="";	
}
	
	
}
 	
}

$sum=0;
$c=1;
if(isset($_GET['dt']) && isset($_GET['dt1']))
{
$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where date between '$date' and '$date1'";
}
else
if(isset($_GET['searchcustomer'])){
$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where receipt_no LIKE '$search%' $orsql";
}


$resulti = mysql_query($sqli);

$sumgros=0;
$sumadd=0;
$sumdis=0;
$sumpay=0;
$sumdue=0;


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
      <td><div align="center"><?php echo $c;?></div></td>
      <td><div align="center"><?php echo $date; ?></div></td>
      <td><?php //echo $rowi["invoice_no"]; ?><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><div align="right"><?php echo number_format($gro_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($add_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($dis_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($pay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($due_amt,2); ?></div></td>
     </tr>
<?php 
$c=$c+1;

$sumgros=$sumgros+$gro_amt;
$sumadd=$sumadd+$add_amt;
$sumdis=$sumdis+$dis_amt;
$sumpay=$sumpay+$pay_amt;
$sumdue=$sumdue+$due_amt;
}
?>    
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sumgros,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumadd,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumdis,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumpay,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumdue,2); ?></strong></div></td>
      
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
