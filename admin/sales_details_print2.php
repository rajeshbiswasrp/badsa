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
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<div align="center"><a href="ph_patient_view.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a" style="border:solid 2px #333; width:460px; margin-left:auto; margin-right:auto;">

<table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">


<tr>
<td width="70" class="style2"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="100" height="30"/></td>
  <td width="410" class="style2"><div class="style1" style="text-align:left; margin-left:57px;">TAX INVOICE</div></td>
  
  </tr>


  
</table>

<table align="center" width="450" border="0" cellpadding="2" cellspacing="0">
  <tr>
   
    <div style="font-size:28px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
     <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">Footware</div>
    <div style="font-size:14px; line-height:30px;font-weight:bold; text-align:center; text-transform:capitalize; padding-top:1px;"><?php echo $sname_logo['address'] ; ?>
   
 <div style="line-height:10px; margin-bottom:5px;"> Ph: <?php echo $sname_logo['mobile'] ; ?>, E-mail <span style="text-transform:lowercase;"> - <?php echo $sname_logo['email'] ; ?></span></div>
 
    </td>
  </tr>
</table>
<?php
$sqln="select*from ph_sales_master where invoice_no='$invoice_no'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);

$pati_id=$rown["pati_id"];

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
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td width="108" class="btop "><strong><!--Invoice No.-->Receipt No.  :</strong></td>
    <td class="btop"><?php //echo $rown["invoice_no"];?><?php echo $rown["receipt_no"];?></td>
    <td width="64" class="btop"><strong>Date :</strong></td>
    <td width="95" class="btop "><span><?php echo $rown["bill_date"];?></span></td>
  </tr>
  <tr>
    <td width="108" class=" "><strong>Customer Name  :</strong></td>
    <td class=""><?php echo $rown1["pati_name"];?></td>
    <td width="64" class="">&nbsp;</td>
    <td width="95" class="">&nbsp;</td>
  </tr>
  <tr>
    <td width="108" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo ($pati_type==1)?$rown1["full_add"]:$rown1["address"];?></td>
    </tr>
</table>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 <tr>
     <td width="40" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">No.</span></div></td>
     <td width="224" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Description</span></div></td>
     
     <td width="42" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <td width="56" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Rate</span></div></td>
     <td width="78" colspan="3" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div>       </td>
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
$iss_qty=$row["sale_qty"];

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tot_qty=$iss_qty-$re_qty;
$gross_amt=$tot_qty*$mrp;

$sum=$sum+$gross_amt;
$gro_amt=$sum;
$sum2=$sum2+$vat_amt;

$sql2="select * from ph_medicine_master where id ='$m_id'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
?>
  <tr>
    <td class="bright"><div align="center"><?php echo $c;?></div></td>
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row2["medici_name"];?> Size - <?php echo $row["size_type"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $tot_qty;?></div></td>
    <td class="bright"><div align="right"><?php echo number_format ($row["mrp"],'2','.','');?></div></td>
    <td colspan="3"><div align="right"><?php echo number_format($gross_amt,'2','.','') ;?></div>      </td>
    </tr>
<?php
$c++;
}
}
?>

<?php
  
if($nu_rows==1)
{
$a=1; 
for( $a = 1; $a <=10; $a++ ) 
{
?>
  <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==2)
{
$b=1; 
for( $b = 1; $b <=9; $b++ ) 
{
?>
  <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==3)
{
$cc=1; 
for( $cc = 1; $cc <=8; $cc++ ) 
{
?>
  <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==4)
{
$d=1; 
for( $d = 1; $d <=7; $d++ ) 
{
?>
  <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class="bright"><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==5)
{
$e=1; 
for( $e = 1; $e<=6; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==6)
{
$e=1; 
for( $e = 1; $e<=5; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==7)
{
$e=1; 
for( $e = 1; $e<=4; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==8)
{
$e=1; 
for( $e = 1; $e<=3; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==9)
{
$e=1; 
for( $e = 1; $e<=2; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
}
?>
<?php
if($nu_rows==10)
{
$e=1; 
for( $e = 1; $e<=1; $e++ ) 
{
?>
   <tr>
     <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td colspan="3" class=""><div align="center">&nbsp;</div></td>
    </tr>
<?php
}
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


$sqln4="select*from ph_sales_payment where invoice_no='$invoice_no'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
$dis_amt=$rown4['dis_amt'];
$credit_amt=$rown4['credit_amt'];

$due_amt=$tot_valu-$less_pay-$dis_amt;


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
     <td class="bright bbottom"><div align="center">&nbsp;</div></td>
    <td class="bright bbottom"><div align="center">&nbsp;</div></td>
    <td class="bright bbottom"><div align="center">&nbsp;</div></td>
    <td class="bright bbottom"><div align="center">&nbsp;</div></td>
    <td colspan="3" class="bbottom"><div align="center">&nbsp;</div></td>
    </tr>
    
  </table>
  <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
  <tr>
     <td  colspan="5" class="bright" ><div><u><b>Amount Payable</b></u></div>
     <div align="right" style="font-weight:bold;"></div></td>
	 <td width="78" class="bright "><div align="center" style="font-weight:bold; text-align:right;">Total</div></td>
    <td width="26" class=""><div align="right" style="font-weight:bold;"><?php echo number_format($gro_amt,'2','.','');?></div></td>
  </tr>
  <tr>
     <td  colspan="5" class="bright" ><div>Rupees:<b>
       <?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>
       .</b></div>
     <div align="right" style="font-weight:bold;"></div></td>
	 <td class="bright "><div align="center" style="font-weight:bold; text-align:right;">Discount</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo number_format($dis_amt,'2','.','');?></div></td>
  </tr>
   <tr>
     <td  colspan="5" rowspan="4" valign="top" class="bright" >
     <div style="font-weight:bold;">W.B.S.T.19531706116, VAT NO.1953170619</div>
     <div><u><span style="font-size: 14px; font-weight:bold;" >Terms and Conditions:-</span></u></div>
		<ol style="padding-left:12px; font-size:11px;">
		  <li>ক্রেডিট ও ডেবিট কার্ড গ্রহণ করা হয়।</li>
      <li>কোন কারনেই নগদ মুল্য ফেরত দেওয়া যাবে না।</li>
      <li>সোল ক্র্যাক ও পেস্টিং ওয়ারেন্টি ৬০দিন।</li>
      <li>Belt, Purse, Wallet, Accessories এর উপর কোন ওয়ারেন্টি নেই।</li>
      <li>PRODUCT ARE INCLUSIVE OF ALL APPLICABLE TAXES</li>
	      </ol>
     
     </td>
	 <td class="bright "><div align="center" style="font-weight:bold; text-align:right;">Credit Amt</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo number_format($credit_amt,'2','.','');?></div></td>
  </tr>
  
<?php
$i=1;
$sql13="select * from ph_sales_payment where invoice_no='$invoice_no'";
$res13=mysql_query($sql13);
$rowsize=mysql_num_rows($res13);
?>
   <tr>
     <td class="bright bbottom"><div align="center" style="font-weight:bold; text-align:right;">Paid 

<?php
if($rowsize==0)
{
}
else{
echo'(';
while($row13=mysql_fetch_array($res13))
{

$pay=$row13['net_amt'];

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
    <td class="btop bbottom"><div align="right" style="font-weight:bold;"><?php echo number_format($pay,'2','.','') ;?></div></td>
  </tr>
  
  
  <tr>
     <td colspan="2" class=" "><span class=" "><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:20px;"><?php echo $sname_logo['com_name'] ; ?></span></span></td> 
	 </tr>
  <tr>
     <td colspan="2" class=" "><div style="text-transform:uppercase; letter-spacing:3px; text-align:center; font-weight:bold;">(SIGNATURE)</div></td> 
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
