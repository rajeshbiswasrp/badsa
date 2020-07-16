<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $search_type=$_GET['searchtype'];
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

?>

  
<?php
if(mysql_num_rows($resulti)==0)
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
$display1='';
$display1='<table  class="table table-hover table-striped table-bordered">';
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
$display='<table class="table table-hover table-striped table-bordered">';
$display.='<tbody>';
$display.='<tr>';
$display.='<tr>';
$display.='<th><strong>Sl No.</strong></th>';
$display.='<th><strong>Items Name</strong></th>';
$display.='<th><strong>Base</strong></th>';
$display.='<th><strong>Qty</strong></th>';
$display.='<th><div align="right"><strong>Returned Qty</strong></div></th>';
$display.='<th><strong>MRP</strong></th>';
$display.='<th><strong>Dis%</strong></th>';
$display.='<th><strong>Batch No.</strong></th>';
$display.='<th><strong>Expire Date</strong></th>';
$display.='<th><div align="right"><strong>Gross Amount</strong></div></th>';
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

/*  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $bb; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["iss_qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php echo $row["mrp"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["dico_per"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["exp_date"]; ?></strong></div></td>
  </tr>
*/
$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td>'.$row2["medici_name"].'</td>';
$display.='<td>'. $bb.'</td>';
$display.='<td><div align="right">'.$row["iss_qty"].'</div></td>';
$display.='<td><div align="right">'.$re_qty.'</div></td>';
$display.='<td><div align="right">'.$row["mrp"].'</div></td>';
$display.='<td><div align="right">'.$row["dico_per"].'</div></td>';
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
$display.='<th><div align="right"><strong>'.$sumissqty.'</strong></div></th>';
$display.='<th><div align="right"><strong>'.($sumreqty>0?$sumreqty:'').'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($summrp,2).'</strong></th>';
$display.='<th><div align="right"><strong>'.($sumdico_per>0?$sumdico_per:'').'</strong></div></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumamt,2).'</strong></div></th>';
$display.='</tr>';


$display.='<tr>';
$display.='<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensearchcusrepotdoc1(&#39;'.$pati_id.'&#39;,&#39;'.$patient_type.'&#39;,&#39;'.urlencode($patient_id).'&#39;,&#39;'.$referid.'&#39;,&#39;'.urlencode($bed_no).'&#39;,&#39;'.$search_type.'&#39;);" target="_blank" /></td>';
$display.='</tr>';

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
$display.='<th><strong>Receipt No.</strong></th>';
$display.='<th><strong>Customer Name</strong></th>';
$display.='<th><strong>Gross Amount</strong></th>';
$display.='<th><strong>Add Charges</strong></th>';
$display.='<th><strong>Discount</strong></th>';
$display.='<th><strong>Paid Amount</strong></th>';
$display.='<th><strong>Due Amount</strong></th>';
$display.='<th><strong>Option</strong></th>';
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
$display.='<td><div align="center">'.$c.'</td>';
$display.='<td>'.$date.'</td>';
$display.='<td>'.$rowi["receipt_no"].'</td>';
$display.='<td>'.$pati_name.'</td>';
$display.='<td><div align="right">'.number_format($gro_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($add_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($dis_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($pay_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($due_amt,2).'</div></td>';
$display.='<td><a href=ph_sales_stock_report.php?invoice_no='.$rowi["invoice_no"].' target="_blank">View</a></td>';
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
$display.='<th><div align="right"><strong>'.number_format($sumgros,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumadd,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdis,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumpay,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdue,2).'</strong></div></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='</tr>';

$display.='<tr>';
$display.='<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensearchcusrepotdoc1(&#39;'.$pati_id.'&#39;,&#39;'.$patient_type.'&#39;,&#39;'.urlencode($patient_id).'&#39;,&#39;'.$referid.'&#39;,&#39;'.urlencode($bed_no).'&#39;,&#39;'.$search_type.'&#39;);" target="_blank" /></td>';
$display.='</tr>';


$display.='</table>';
echo $display;

}


?>
<?php


}//no row
 
 
 
 
 
 
 
 
 }
?>