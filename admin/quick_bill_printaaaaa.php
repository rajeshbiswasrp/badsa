<?php
session_start();
require_once('config/db.php');
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("m-d-Y");
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
.style1 {font-size: 11px}
-->
</style>
<style>
.tax{

text-align:center;
font-size:16px;
margin-left:600px;}
.style2 {text-align: center; font-size: 16px; margin-left: 600px; font-weight: bold; }
.line {
line-height: 200%;}
</style>
</head>

<body>
<div align="center"><a href="quick_bill.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a" style="border:solid 1px #333; width:810px; margin-left:auto; margin-right:auto;">

<table align="center" width="802" border="0" cellpadding="5" cellspacing="0">


<tr>
  <td colspan="3" class="style2">CASH MEMO</td>
</tr>

  
</table>
<table align="center" width="802" border="0" cellpadding="2" cellspacing="0">
  <tr>
   
    <div style="font-size:28px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
     
    <div style="font-size:14px; line-height:30px;font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;"><?php echo $sname_logo['address'] ; ?>
    <div style="font-size:18px; line-height:10px; font-weight:bold; text-align:center; padding-top:5px;">Sales Office -  8/4B, PANDITYA ROAD, KOLKATA - 700029</div>
 <div style="line-height:40px;"> Ph: <?php echo $sname_logo['mobile'] ; ?>, Email : <span style="text-transform:lowercase;"><?php echo $sname_logo['email'] ; ?></span></div>
 
    </td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<!--<td width="602" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Retail Invoice</div></td>-->
<!--<td width="140" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:12px;">DL - 0020S/10030SB</div></td>-->
</tr>
</table>
<?php
$sqln="select*from quick_bill where status ='1'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
$refer_id=$rown["refer_id"];

$pati_id=$rown["pati_id"];
$invoice_no=$rown["invoice_no"];
$pati_type=$rown["pati_type"];

if($pati_type==0)
{
$sqln1="select*from ph_patient_master where id='$pati_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);
}
else
if($pati_type==1)
{
$sqln1="select*from patient_master where id='$pati_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);
}

$sqln2="select max(id) as maxid from ph_sales_payment where invoice_no='$invoice_no'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$mid=$rown2["maxid"];

$sqln3="select*from ph_sales_payment where id='$mid' and invoice_no='$invoice_no'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);

$sqln4="select*from refer_master where id='$refer_id'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
?>
<table width="802" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 
  <tr class="line">
    <td class="btop "><strong>
      <!--Invoice No.-->
      Cash Memo No :
      </strong> 
      <!--Invoice No.-->    </td>
    <td colspan="3" class="btop ">&nbsp;</td>
    <td width="117" class="btop "><strong>Date :</strong></td>
    <td width="148" class="btop "><?php echo $rown["date"];?></td>
  </tr>
 
  
  
</table>
<table width="802" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
 <tr valign="top">
     <!--<td width="43" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Sl. No.</span></div></td>-->
     <td width="742" class="btop bbottom bright"><div align="center"><span class="style1"><strong> ITEM DESCRIPTIONS</strong></span></div></td>
     <td width="40" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <!--<td width="101" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Base Type</span></div></td>-->
     <td width="67" class="btop bbottom bright"><div align="right"><span class="style1"><strong>RATE</strong></span></div></td>
     <!--<td width="84" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST % .</span></div></td>-->
     <!--<td width="98" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST Amt.</span></div></td>-->
     <td width="8" class="btop bbottom " colspan="2"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">&nbsp;</span></div></td>
      <td width="873" class="btop bbottom " colspan="2"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
     
  </tr>
<?php
$c=1;
$sql="select * from quick_bill where status ='1'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
$tax_amount=0;
while($row=mysql_fetch_array($res))
{
?>
  <tr>
    <!--<td class="bright"><div align="center"><?//php echo $c;?></div></td>-->
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row["item_name"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["qty"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["iss_qty"];?></div></td>-->
    <td class="bright"><div align="right"><?php echo number_format ($row["rate"],'2','.','');?></div></td>
    <!--<td class="bright"><div align="right"><?php //echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="right"><?php //echo $row["tax_amt"];?></div></td>-->
    <td colspan="2">&nbsp; </td>
     <td colspan="2"><div align="right"><?php echo number_format($row["tot_amt"],'2','.','') ;?></div></td>
  </tr>
 

<?php
$c++;
}
?>

<?php
  
if($nu_rows==1)
{
$a=1; 
for( $a = 1; $a <=17; $a++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==2)
{
$b=1; 
for( $b = 1; $b <=16; $b++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==3)
{
$cc=1; 
for( $cc = 1; $cc <=15; $cc++ ) 
{
?>
  <tr>
   <!-- <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==4)
{
$d=1; 
for( $d = 1; $d <=14; $d++ ) 
{
?>
  <tr>
   <!-- <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==5)
{
$e=1; 
for( $e = 1; $e<=13; $e++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==6)
{
$f=1; 
for( $f = 1; $f <=12; $f++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==7)
{
$g=1; 
for( $g = 1; $g <=11; $g++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==8)
{
$h=1; 
for( $h = 1; $h <=10; $h++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==9)
{
$i=1; 
for( $i = 1; $i <=9; $i++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==10)
{
$j=1; 
for( $j = 1; $j <=8; $j++ ) 
{
?>
 <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==11)
{
$k=1; 
for( $k = 1; $k <=7; $k++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==12)
{
$l=1; 
for( $l = 1; $l <=6; $l++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==13)
{
$m=1; 
for( $m = 1; $m <=5; $m++ ) 
{
?>
 <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==14)
{
$n=1; 
for( $n = 1; $n <=4; $n++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows==15)
{
$o=1; 
for( $o = 1; $o <=3; $o++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>
<?php
if($nu_rows > 15)
{
$p=1; 
for( $p = 1; $p <=2; $p++ ) 
{
?>
  <tr>
    <!--<td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>-->
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>



<?php
$sql1="select SUM(tot_amt)as gro_amt from quick_bill where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}



$tot_rate=$gro_amt;


$tot_valu=$tot_rate;
$less_pay=$rown3["less_pay"];

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
   <!-- <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>-->
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bbottom"><div align="right"></div></td>
  </tr>
 
 
  
  

   <tr>
    <td colspan="4"><div></div></td>
    <td class=""><div align="left"></div></td>
    <td class="bright btop"><div align="center" style="font-weight:bold; text-align:right;">Net Total</div></td>
    <td class="btop"><div align="right" style="font-weight:bold;"><?php echo number_format($tot_valu,'2','.','') ;?></div></td>
  </tr>
   <tr>
    <td colspan="4"><div><u><b>Amount Payable:</b></u></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">R/O (+/-)</div></td>
    <td class="bbottom"><div align="right"><?php echo number_format ($aaa,'2','.','');?></div></td>
  </tr>
   <tr>
    <td colspan="4"  class="bbottom"  ><div><span style="text-transform:capitalize;">Rupees:<b><?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>.</b></span></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center" style="font-weight:bold; text-align:right;">Balance Due</div></td>
    <td class="bbottom"><div align="right" style="font-weight:bold;"><?php echo $subtot1; echo '.00';?></div></td>
  </tr>
  <tr>
    <td colspan="5"  class="bright"><div><u><h4 style="font-size: 14px;" >Terms and Conditions:-</h4></u></div></td>
    <td colspan="2"><div align="center"><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:17px;"><?php echo $sname_logo['com_name'] ; ?></span></div></td>
  </tr>
  <tr>
    <td  colspan="5" rowspan="5" class="bright ">
		<ol>
			<li>Payment to br mede only by A/c Pay chq - MASTER COMMUNACATION</li>
			<li>Our Bank :-<b>UNITED BANK OF INDIA ,/</b>DESHPRAYA PARK , KOLKATA-700029, <b>A/c. No. 0105050017611 / IFC -UTBI 0 DES 110</b></li>
			<li>Bill if not paid within 7 days , interest @ 21% p.a. will be charged extra</li>
			<li>Products in this invoice are covered by the manufacture standard warranty we have no legal / finacial liable for the same.</li>
			<li>Warranty does not cover due to high voltage / natural calamity</li>
		</ol>	</td>
    <td class="" colspan="2" rowspan="5" align="center" ><b>Authorised Signatory</b></td>
  </tr>
</table>


<!--<table align="center" width="750" border="0" cellpadding="3" cellspacing="0">
<tr><td width="469" >Sales</td>
</tr>
  <tr>
    <td width="469" rowspan="4" valign="top" class="btop">
    <strong>Total Items :</strong>
    <span style="margin-left:5px;"><?php echo $nu_rows;?></span> <br/> 
    <strong>Amount Payable :</strong><br/>
    <span style="text-transform:capitalize;">Rupees <?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>.</span><br/>
    <span style="text-transform:capitalize; font-style:oblique; font-weight:bold;">All disputes subject to Kolkata Jurisdiction only.
Once Goods sold never refund.</span>
    </td>
    <td width="269" valign="top" class="btop"></td>
    
  </tr>
  <tr>
    <td width="269" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="269" valign="top" class="btop "><div style="text-transform:uppercase; letter-spacing:3px; text-align:center; font-weight:bold;">(SIGNATURE)</div></td>
  </tr>
  </table>-->
  
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
</body>
</html>
