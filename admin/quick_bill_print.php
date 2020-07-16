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
<style>
.decora{

    border-spacing: 1px 5px;
	margin-left:2px;}
</style>
</head>

<body>
<div align="center"><a href="quick_bill.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a" style="border:solid 1px #333; width:460px; margin-left:auto; margin-right:auto;">
<div style="border:solid 1px #333; width:460px; margin-left:auto; margin-right:auto;">
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0">


<tr>
<td width="70" class="style2"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="100" height="30"/></td>
  <td width="410" class="style2"><div style="text-align:left; margin-left:60px;">CASH MEMO</div></td>
  
  </tr>
</table>
<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
   
    <div style="font-size:28px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
   <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">Footware</div>
   
     
    <div style="font-size:14px; line-height:30px;font-weight:bold; text-align:center;"><?php echo $sname_logo['address'] ; ?>
   
 <!--<div style="line-height:10px; margin-bottom:5px;"> Ph: <?php// echo $sname_logo['mobile'] ; ?> <span style="text-transform:lowercase;"><?php //echo $sname_logo['email'] ; ?></span></div>
--> 
    </td>
    <div style="font-size:14px; line-height:10px;font-weight:bold; text-align:center; padding-bottom:4px;  padding-top:1px;">Ph: 033 2565 4645,
E-mail - badsashoes@gmail.com</div>
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

?>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 
  <tr class="line">
    <td width="224" class="btop "><strong>
      <!--Invoice No.-->
      Cash Memo No :BA / 2017 / <?php echo $rown["voucher_no"];?>
      </strong> 
      <!--Invoice No.-->    </td>
    <td width="75"  align="right" class="btop "><strong>&nbsp;</strong></td>
    <td colspan="5" align="right" class="btop  "><strong>Date: </strong><?php echo $rown["date"];?></td>
  </tr>
<!--</table>
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
--> <tr valign="top">
     <!--<td width="43" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Sl. No.</span></div></td>-->
     <td width="224" class="btop bbottom bright"><div align="center"><span class="style1"><strong> ITEM DESCRIPTIONS</strong></span></div></td>
     <td width="75" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <!--<td width="101" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Base Type</span></div></td>-->
     <td  width="91"  class="btop decora  bbottom bright" ><div align="center"><span class="style1"  ><strong>RATE</strong></span></div></td>
     <!--<td width="84" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST % .</span></div></td>-->
     <!--<td width="98" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST Amt.</span></div></td>-->
     <td width="52" colspan="4" class="btop bbottom  "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
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
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row["item_name"];?> Size - <?php echo $row["size_type"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["qty"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["iss_qty"];?></div></td>-->
    <td class="bright decora"><div align="right"><?php echo number_format ($row["rate"],'2','.','');?></div></td>
    <!--<td class="bright"><div align="right"><?php //echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="right"><?php //echo $row["tax_amt"];?></div></td>-->
    <td colspan="4" class=""> <div align="right"><?php echo number_format($row["tot_amt"],'2','.','') ;?></div></td>
     </tr>
 

<?php
$c++;
}
?>

<?php
if($nu_rows==1)
{
$a=1; 
for( $a = 1; $a <=15; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=14; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=13; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=12; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=11; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=10; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=9; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=8; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=7; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=6; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=5; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=4; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=3; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=2; $a++ ) 
{
?>
  <tr>
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
$a=1; 
for( $a = 1; $a <=1; $a++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
    <td class=""><div align="center">&nbsp;</div></td>
  </tr>
<?php
}
}
?>

<!--</table>-->




<?php
$sql1="select SUM(tot_amt)as gro_amt from quick_bill where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}



$tot_rate=$gro_amt;


$tot_valu=$tot_rate;
$dis_amt=$rown["dis_amt"];

$totamt=$tot_valu-$dis_amt;


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

 
 <!--
  <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
  -->
<tr>
    <!--<td class="bright"><div align="center"><?//php echo $c;?></div></td>-->
    <td class=" btop"><div align="left"><span style="text-transform:capitalize;"><strong> <u>&nbsp;</u></strong></div></td>
    <td class="btop bright"><div align="center">&nbsp;</div></td>
    
    <td class="btop  bright"><div align="center"><strong> Amount</strong></div></td>
    <!--<td class="bright"><div align="right"><?php //echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="right"><?php //echo $row["tax_amt"];?></div></td>-->
    <td colspan="4" class="btop"> <div align="right"><strong><?php echo number_format($tot_valu,'2','.','') ;?></strong></div></td>
     </tr>
     <tr>
    <!--<td class="bright"><div align="center"><?//php echo $c;?></div></td>-->
    <td class=""><div align="left"><span style="text-transform:capitalize;"><strong> <u>Amount Payable </u></strong></div></td>
    <td class="bright"><div align="center"><?php //echo $row["qty"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["iss_qty"];?></div></td>-->
    <td class="bright btop"><div align="center"><strong>Discount</strong></div></td>
    <!--<td class="bright"><div align="right"><?php //echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="right"><?php //echo $row["tax_amt"];?></div></td>-->
    <td colspan="4" class=" btop"> <div align="right"><strong><?php echo number_format($dis_amt,'2','.','') ;?></strong></div></td>
     </tr>
     <tr>
    <!--<td class="bright"><div align="center"><?//php echo $c;?></div></td>-->
    <td class=""><div align="left"><strong>
    <span style="text-transform:capitalize;">Rupees <?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>.</span></div></td>
    <td class="bright"><div align="center"><?php //echo $row["qty"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["iss_qty"];?></div></td>-->
    <td class="bright btop bbottom"><div align="center"><strong> Net Amount</strong></div></td>
    <!--<td class="bright"><div align="right"><?php //echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="right"><?php //echo $row["tax_amt"];?></div></td>-->
    <td colspan="4" class="btop bbottom"> <div align="right"> <strong><?php echo number_format($totamt,'2','.','') ;?></strong></div></td>
     </tr>
  </table>
  <table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td colspan="5" rowspan="7">
    <div style="font-weight:bold;">VAT No.: 19663076029, CST NO.: 19663076223</div>
    <div><u><span align="left" style="font-size: 14px; font-weight:bold;" >Terms and Conditions:-</span></u></div>
      <ol style="padding-left:12px; font-size:11px;">
        <li>ক্রেডিট ও ডেবিট কার্ড গ্রহণ করা হয়।</li>
      <li>কোন কারনেই নগদ মুল্য ফেরত দেওয়া যাবে না।</li>
      <li>সোল ক্র্যাক ও পেস্টিং ওয়ারেন্টি ৬০দিন।</li>
      <li>Belt, Purse, Wallet, Accessories এর উপর কোন ওয়ারেন্টি নেই।</li>
      <li>PRODUCT ARE INCLUSIVE OF ALL APPLICABLE TAXES</li>
	    </ol></td>
      </tr>
  
  
  <tr>
    <td colspan="2" class=""><div align="left"><span style="font-size:14px; font-weight:bold; margin-left:17px;">for <?php echo $sname_logo['com_name'] ; ?></span></div></td>
  </tr>
  <tr>
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
