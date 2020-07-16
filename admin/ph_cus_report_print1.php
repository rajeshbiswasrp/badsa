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
<div align="center"><a href="ph_cus_report.php">Back</a></div>
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
<?php
 $search_type=$_GET['search_type'];
 $pati_id = $_GET['pati_id'];
 $patient_type = $_GET['patient_type'];
 $patient_id=urldecode($_GET['patient_id']);
 $refer_id = $_GET['referid'];
 $bed_no=urldecode($_GET['bed_no']);
 /*$patientname=$_GET['patient_name'];
 $address=$_GET['address'];
 $mobile=$_GET['mobile'];
 $bed_no=$_GET['bed_no'];
 $refername=$_GET['refername'];
 $admissiondate=$_GET['admissiondate'];
 $dischargedate=$_GET['dischargedate'];
 $patientname=$_GET['patient_name'];*/

		if($patient_type==0)
		$tablename='ph_patient_master';
		else
		if($patient_type==1)
		$tablename='patient_master';
		$sqlname="SELECT * from $tablename where id='$pati_id'";
		$resultname=mysql_query($sqlname);
		while($rowname=mysql_fetch_array($resultname)){
		$patientname=$rowname["pati_name"];
			if($patient_type==0)
			{
			$address=$rowname["address"];
			$mobile=$rowname["mobile"];
			$admissiondate=$rowname["date"];
			}
			else
			if($patient_type==1)
			{
			$address=$rowname["full_add"];
			$mobile=$rowname["mobile"];
			$admissiondate=$rowname["regis_date"];
			}
			
		}
		if($patient_type==1)
		{
			$sqlname="SELECT dis_date from discharge_patient where pmax_id='$pati_id'";
			$resultname=mysql_query($sqlname);
			if(mysql_num_rows($resultname)==0)
			$dischargedate='';
			else
			{
				while($rowname=mysql_fetch_array($resultname)){
				$dischargedate=$rowname["dis_date"];	
				}
			}
		}
		$sqlname1="SELECT refer_name from refer_master where id='$refer_id'";
		$resultname1=mysql_query($sqlname1);
		while($rowname1=mysql_fetch_array($resultname1)){
		$refer_name=$rowname1["refer_name"];
		
		}
		
		
		
if($pati_id!='')
{
	$orsql=" pati_id in ($pati_id) and pati_type='$patient_type' ";
}





if($pati_id!='')
{

$sum=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where $orsql";
$resulti = mysql_query($sqli);

$display1='';
$display1='<table align="center" width="754" border="1" cellpadding="1" cellspacing="0" style="font-size:13px;">';
$display1.='<tr>';
$display1.='<td colspan="3" ><div align="center"><strong>'.($search_type==0?'Summary Report':'Details Reports').'</strong></div></td>';
//$display1.='<td>&nbsp;</td>';
//$display1.='<td>&nbsp;</td>';
$display1.='</tr>';
$display1.='<tr>';
$display1.='<td><strong>Patient Name:</strong>'.$patientname.'</td>';
$display1.='<td><strong>Patient Id:</strong>'.$patient_id.'</td>';
$display1.='<td><strong>Patient Address:</strong>'.$address.'</td>';

$display1.='</tr>';
$display1.='<tr>';
$display1.='<td><strong>Patient Mobile:</strong>'.$mobile.'</td>';
$display1.='<td><strong>Patient Type:</strong>'.($patient_type==0?"GEN":"IPD").'</td>';
$display1.='<td><strong>Doctor Name:</strong>'.$refer_name.'</td>';

$display1.='</tr>';
$display1.='<tr>';
$display1.='<td><strong>Patient Bed No:</strong>'.$bed_no.'</td>';
$display1.='<td><strong>Admission Date:</strong>'.$admissiondate.'</td>';
$display1.='<td><strong>Discharge Date:</strong>'.$dischargedate.'</td>';
$display1.='</tr>';
$display1.='</table>';

echo $display1.'<br/><br/>';


if($search_type==1){
	
	
$display='';
$display='<table align="center" width="754" border="1" cellpadding="1" cellspacing="0" style="font-size:13px;">';
$display.='<tbody>';
$display.='<tr>';
$display.='<tr>';
$display.='<th><strong>Sl No.</strong></th>';
$display.='<th><strong>Items Name</strong></th>';
$display.='<th><strong>Base</strong></th>';
$display.='<th><strong>Qty</strong></th>';
$display.='<th><strong>Returned Qty</strong></th>';
$display.='<th><strong>MRP</strong></th>';
$display.='<th><strong>Dis%</strong></th>';
$display.='<th><strong>Batch No.</strong></th>';
$display.='<th><strong>Expire Date</strong></th>';
$display.='<th><strong>Gross Amount</strong></th>';
$display.='</tr>';
$display.='</tbody>';	

$sumissqty=0;
$sumreqty=0;
$summrp=0;
$sumdico_per=0;
$sumamt=0;



while($rowi = mysql_fetch_array($resulti))
{
$inv=$rowi['invoice_no'];	

$sql="SELECT * FROM ph_sales_master where invoice_no='$inv'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sales_id=$row["id"];
$m_id=$row["medicine_id"];
$bbase=$row["base"];
if($bbase==0)
{
$bb='Strip';
}
else{
$bb='Pieces';
}

$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}


$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$row2["medici_name"].'</td>';
$display.='<td>'. $bb.'</td>';
$display.='<td><div align="right">'.$row["iss_qty"].'</div></td>';
$display.='<td><div align="right">'.$re_qty.'</div></td>';
$display.='<td><div align="right">'.number_format($row["mrp"],2).'</div></td>';
$display.='<td><div align="right">'.number_format($row["dico_per"],2).'</div></td>';
$display.='<td>'.$row["batch"].'</td>';
$display.='<td>'.$row["exp_date"].'</td>';
$display.='<td><div align="right">'.number_format((($row["iss_qty"]-$re_qty)*$row["mrp"]),2).'</div></td>';
$display.='</tr>';

$amt=0;

$sumissqty=$sumissqty+$row["iss_qty"];
$sumreqty=$sumreqty+$re_qty;
$summrp=$summrp+$row["mrp"];
$sumdico_per=$sumdico_per+$row["dico_per"];
$sumamt=$sumamt+(($row["iss_qty"]-$re_qty)*$row["mrp"]);

$c=$c+1;
}
}

}


$display.='<tr>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>Total</strong></th>';
$display.='<th><strong>'.$sumissqty.'</strong></th>';
$display.='<th><strong>'.($sumreqty>0?$sumreqty:'').'</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($summrp,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.($sumdico_per>0?$sumdico_per:'').'</strong></div></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumamt,2).'</strong></div></th>';
$display.='</tr>';

$display.='</table>';
echo $display;
	
	
}
else
{

$display='';
$display='<table align="center" width="754" border="1" cellpadding="1" cellspacing="0" style="font-size:13px;">';
$display.='<tbody>';
$display.='<tr>';
$display.='<tr>';
$display.='<th><strong>Sl No.</strong></th>';
$display.='<th><strong>Date</strong></th>';
$display.='<th><strong>Receipt No.</strong></th>';
$display.='<th><strong>Customer Name</strong></th>';
$display.='<th><strong>Gross Amount</strong></th>';
$display.='<th><strong>Add Charges</strong></th>';
$display.='<th><strong>Discount</strong></th>';
$display.='<th><strong>Paid Amount</strong></th>';
$display.='<th><strong>Due Amount</strong></th>';
$display.='</tr>';
$display.='</tbody>';


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



$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$date.'</td>';
$display.='<td>'.$rowi["receipt_no"].'</td>';
$display.='<td>'.$pati_name.'</td>';
$display.='<td><div align="right">'.number_format($gro_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($add_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($dis_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($pay_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($due_amt,2).'</div></td>';
$display.='</tr>';


$c=$c+1;


$sumgros=$sumgros+$gro_amt;
$sumadd=$sumadd+$add_amt;
$sumdis=$sumdis+$dis_amt;
$sumpay=$sumpay+$pay_amt;
$sumdue=$sumdue+$due_amt;
}




$display.='<tr>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>Total</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumgros,2).'</div></strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumadd,2).'</div></strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdis,2).'</div></strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumpay,2).'</div></strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdue,2).'</div></strong></th>';

$display.='</tr>';



$display.='</table>';
echo $display;

}


?>
<?php


 
 }
?>




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
