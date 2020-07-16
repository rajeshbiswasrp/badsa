<?php
session_start();
require_once('config/db.php');
date_default_timezone_set('Asia/Kolkata');
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("m-d-Y");
$invoice_no=$_REQUEST['invoice_no'];
$sname_logo=mysql_fetch_array(mysql_query("select * from ph_config_master where status='1'"));
?>

<?php
function convert_number_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred ','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
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
<title><?php echo $sname_logo['com_name'] ; ?></title>
<link rel="shortcut icon" href="img/logo_icon.png" />
<link rel="stylesheet" type="text/css" href="invoice.css"/>

<script>
function print1()
{
document.getElementById("button").innerHTML='';
 var divElements1 = document.getElementById('a').innerHTML;
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
<div align="center"><a href="ph_patient_view.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a">
<table align="center" width="750" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td valign="top" class="" width="88"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="70" height="70"/></td>
    <td valign="top" class="" width="642">
    <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">Address : <?php echo $sname_logo['address'] ; ?><br/>
Ph: <?php echo $sname_logo['mobile'] ; ?>, Email : <span style="text-transform:lowercase;"><?php echo $sname_logo['email'] ; ?></span></div>
    </td>
  </tr>
</table>

<table width="750" border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td width="602" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Retail Invoice</div></td>
</tr>
</table>
<?php
$sqln="select*from ph_sales_master where invoice_no='$invoice_no'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);

$pati_id=$rown["pati_id"];

$pati_type=$rown["pati_type"];

if($pati_type)
$sqln1="select*from patient_master where id='$pati_id'";
else
$sqln1="select*from ph_patient_master where id='$pati_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);

$sqln2="select min(id) as maxid from ph_sales_payment where invoice_no='$invoice_no'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$mid=$rown2["maxid"];

$sqln3="select*from ph_sales_payment where id='$mid' and invoice_no='$invoice_no'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);

?>
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td width="91" class="btop "><strong><!--Invoice No.-->Receipt No.  :</strong></td>
    <td width="213" class="btop"><?php //echo $rown["invoice_no"];?><?php echo $rown["receipt_no"];?></td>
    <td width="79" class="btop"><strong>Date :</strong></td>
    <td width="109" class="btop"><?php echo $rown["bill_date"];?></td>
    <td width="89" class="btop"><strong>Time  :</strong></td>
    <td width="145" class="btop "><span style="text-transform:capitalize;"><?php echo date("h:i:s  A",time());?></span></td>
  </tr>
  <tr>
    <td width="91" class=" "><strong>Paitent Name  :</strong></td>
    <td width="213" class=""><?php echo $rown1["pati_name"];?></td>
    <td width="79" class="">&nbsp;</td>
    <td width="109" class="">&nbsp;</td>
    <td width="89" class="">&nbsp;</td>
    <td width="145" class="">&nbsp;</td>
  </tr>
  <tr>
    <td width="91" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo ($pati_type==1)?$rown1["full_add"]:$rown1["address"];?></td>
    
    <td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 <tr>
     <td width="45" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Sl. No.</span></div></td>
     <td width="100" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Description</span></div></td>
     
     <td width="47" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <td width="41" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Rate</span></div></td>
     <td width="70" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST(%)</span></div></td>
     <td width="80" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST Amount</span></div></td>
     <td width="94" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Batch No.</span></div></td>
     <td width="70" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
  </tr>
<?php
$sum=0;
$sum2=0;
//$gross_amt=0;
$c=1;
$sql="select * from ph_sales_master where invoice_no='$invoice_no'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$sales_id=$row["id"];
$m_id=$row["medicine_id"];
$mrp=$row["mrp"];
$iss_qty=$row["iss_qty"];
$t_id=$row["type_id"];
$vat=$row["taxpm"];
//$vat_amt=$row["tax_amt"];

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tot_qty=$iss_qty-$re_qty;
$gross_amt=$tot_qty*$mrp;
$vat_amt=$gross_amt*$vat/100;
$gross_amt=$gross_amt+$gross_amt1+$vat_amt;

$sum=$sum+$gross_amt;
$gro_amt=$sum;
$sum2=$sum2+$vat_amt;

$sql2="select * from ph_medicine_master where id ='$m_id'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$sql4="SELECT * FROM ph_type_master where id='$t_id'";
$result4=mysql_query($sql4);
while($row4=mysql_fetch_array($result4))
{
?>
  <tr>
    <td class="bright"><div align="center"><?php echo $c;?></div></td>
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row2["medici_name"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $tot_qty;?></div></td>
    <td class="bright"><div align="right"><?php echo number_format ($row["mrp"],'2','.','');?></div></td>
    <td class="bright"><div align="right"><?php echo number_format ($row["taxpm"],'2','.','');?></div></td>
    <td class="bright"><div align="right"><?php echo number_format ($vat_amt,'2','.','');?></div></td>
    <td class="bright"><div align="center"><?php echo $row["batch"];?></div></td>
    <td><div align="right"><?php echo number_format($gross_amt,'2','.','') ;?></div></td>
    
  </tr>
<?php
$c++;
}
}
}
?>

<?php
  

$a=1; 
for( $a = 1; $a <=(23-$nu_rows); $a++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $a;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
?>



<?php
$tot_rate=$gro_amt;
$tot_valu=$tot_rate;

$sql3="select SUM(less_pay)as tot_pay from ph_sales_payment where invoice_no='$invoice_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$less_pay=$row3['tot_pay'];
}


$due_amt=$tot_valu-$less_pay;


$fin_amount1=round($due_amt,2);
$ww=intval($due_amt);
$ff=$due_amt-$ww;
$qq=round($ff,2);
if($qq>=0.5)
			{
			 $aaa=1.00-$qq;
			
			}
			else
			{
			 $aaa=$qq;
			}
			
			
			if($ff>=0.5)
			{
			 $subtot=$aaa+$due_amt;
			$subtot1=round($subtot,2);
			}
			else
			{
			 $subtot=$due_amt-$aaa;
			$subtot1=round($subtot,2);
			}
?>
<tr>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="right"></div></td>
    <td class="bright bbottom"><div align="right"></div></td>
    <td class="bbottom"><div align="right"></div></td>
  </tr>
 <tr>
<td  colspan="6">
<?php
$sum123=0;
$sqli = "SELECT DISTINCT taxpm FROM ph_sales_master where status ='1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$taxpm=$rowi['taxpm'];

$sql12p="select SUM(new_amt)as p_amt from ph_sales_master where status='1' and taxpm='$taxpm'";
$res12p=mysql_query($sql12p);
while($row12p=mysql_fetch_array($res12p))
{
$p_amt=$row12p['p_amt'];
}
$sql12pa="select SUM(tax_amt)as paa_amt from ph_sales_master where status='1' and taxpm='$taxpm'";
$res12pa=mysql_query($sql12pa);
while($row12pa=mysql_fetch_array($res12pa))
{
$paa_amt=$row12pa['paa_amt'];
}
?> 
	<div><b>Sale:-@ <?php echo number_format($rowi["taxpm"],'2','.','') ;?>% Rs. <?php echo number_format($p_amt,'2','.','') ;?>..VAT Rs. <?php echo number_format($paa_amt,'2','.','') ;?></b></div>
		<?php }?>
<?php
$sql12pa2="select SUM(tax_amt)as taxtotal_amt from ph_sales_master where status='1'";
$res12pa2=mysql_query($sql12pa2);
while($row12pa2=mysql_fetch_array($res12pa2))
{
echo $taxtotal_amt=$row12pa2['taxtotal_amt'];
}
?>
	</td>    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Total</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo number_format($gro_amt,'2','.','');?></div></td>
  </tr>
   
 
  
<?php
$i=1;
$sql13="select * from ph_sales_payment where invoice_no='$invoice_no'";
$res13=mysql_query($sql13);
$rowsize=mysql_num_rows($res13);
?>
   <tr>
    <td colspan="7" class="bright"><div align="center" style="font-weight:bold; text-align:right;">Paid 

<?php
if($rowsize==0)
{
}
else{
echo'(';
while($row13=mysql_fetch_array($res13))
{

$pay=$row13['less_pay'];

if($rowsize==$i)
{
$p='';
}
else
{
$p=' +';
}
?>
<?php echo $pay;?><?php echo $p; $i++;}?>)<?php }?>
    </div></td>
    <td class="btop "><div align="right" style="font-weight:bold;"><?php echo number_format($less_pay,'2','.','') ;?></div></td>
  </tr>
   <tr>
    
     <td  colspan="6"><div><u><b>Amount Payable</b></u></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">R/O (+/-)</div></td>
    <td class="bbottom"><div align="right"><?php echo number_format ($aaa,'2','.','');?></div></td>
  </tr>
   <tr>
    <td  colspan="6"><div>Rupees:<b><?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>.</b></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Balance Due</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo $subtot1; echo '.00';?></div></td>
  </tr>

</table>


<table align="center" width="750" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="492" rowspan="4" valign="top" class="btop bright bbottom">
    <strong><u>Terms and Conditions</u></strong>
	<ol>
			<li>Payment to br mede only by A/c Pay chq - MASTER COMMUNACATION</li>
			<li>Our Bank :-<b>UNITED BANK OF INDIA ,/</b>DESHPRAYA PARK , KOLKATA-700029, <b>A/c. No. 0105050017611 / IFC -UTBI 0 DES 110</b></li>
			<li>Bill if not paid within 7 days , interest @ 21% p.a. will be charged extra</li>
			<li>Products in this invoice are covered by the manufacture standard warranty we have no legal / finacial liable for the same.</li>
			<li>Warranty does not cover due to high voltage / natural calamity</li>
		</ol>
    
    </td>
    <td width="246" valign="top" class="btop "><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:20px;"><?php echo $sname_logo['com_name'] ; ?></span></td>
    
  </tr>
  <tr>
    <td width="246" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="246" valign="top" class="btop bbottom "><div style="text-transform:uppercase; letter-spacing:3px; text-align:center; font-weight:bold;">(SIGNATURE)</div></td>
  </tr>
  </table>
  </div>
  <!--  #########################Retail Invoice 1 End##############################-->
  <br/>
<!--  #########################Retail Invoice 2##############################-->
  
  <!--  #########################Retail Invoice 2 End##############################-->
<table align="center" border="0">
  <tr>
    <td><div align="center" id="button"><input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/></div></td>
    </tr> 
</table>
<br />
<br />
<br />
</body>
</html>
