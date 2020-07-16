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
<div align="center"><a href="sales_master.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a" style="border:solid 2px #333; width:460px; margin-left:auto; margin-right:auto;">

<table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">


<tr>
<td width="70" class="style2"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="100" height="30"/></td>
  <td width="410" class="style2"><div style="text-align:left; margin-left:57px;">TAX INVOICE</div></td>
  
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
<table width="750" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<!--<td width="602" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Retail Invoice</div></td>-->
<!--<td width="140" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:12px;">DL - 0020S/10030SB</div></td>-->
</tr>
</table>
<?php
$sqln="select*from ph_sales_master where status ='1'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
$refer_id=$rown["refer_id"];

$pati_id=$rown["pati_id"];
$invoice_no=$rown["invoice_no"];
$pati_type=$rown["pati_type"];

$sqln1="select*from ph_patient_master where id='$pati_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);

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
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 
  <tr class="line">
    <td class="btop "><strong>
      <!--Invoice No.-->
    </strong> 
      <!--Invoice No.-->    <strong>Receipt No.  :</strong></td>
    <td width="226" class="btop "><?php //echo $rown["invoice_no"];?>
      <?php echo $rown["receipt_no"];?></td>
    <td width="67" class="btop "><strong>Date :</strong></td>
    <td width="82" class="btop "><?php echo $rown["bill_date"];?></td>
  </tr>
  <tr>
    <td width="117" ><strong>
      <!--Invoice No.-->
    Customer Name :</strong></td>
    <td ><?php echo $rown1["pati_name"];?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td width="117" class=" "><strong>Address  :</strong></td>
    <td colspan="3" class=""><span ><?php echo ($pati_type==1)?$rown1["full_add"]:$rown1["address"];?></span></td>
    <!--<td width="79" class=""><strong>Patient Id :</strong></td>
    <td width="109" class=""><?php //echo $rown["patient_id"];?></td>
-->
    <!--<td width="89" class=""><strong>Doctor Id  :</strong></td>
    <td width="245" class=" "><span style="text-transform:capitalize;"><?php //echo $rown4["refer_id"];?> - <?php //echo $rown4["refer_name"];?></span></td>-->
  </tr>
</table>
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
 <tr valign="top">
     <td width="43" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;"> No.</span></div></td>
     <td width="342" class="btop bbottom bright"><div align="center"><span class="style1"><strong>DESCRIPTIONS</strong></span></div></td>
     <td width="40" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <td width="67" class="btop bbottom bright"><div align="right"><span class="style1"><strong>RATE</strong></span></div></td>
     <td colspan="3" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
    </tr>
<?php
$c=1;
$sql="select * from ph_sales_master where status ='1'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$m_id=$row["medicine_id"];
?>
  <tr>
    <td class="bright"><div align="center"><?php echo $c;?></div></td>
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row["item_name"];?> Size - <?php echo $row["size_type"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["sale_qty"];?></div></td>
    <td class="bright"><div align="right"><?php echo number_format ($row["mrp"],'2','.','');?></div></td>
    <td colspan="3" ><div align="right"><?php echo number_format($row["gross_amt"],'2','.','') ;?></div></td>
    </tr>
 

<?php
$c++;
}
?>

<?php
  

$a=1; 
for( $a = 1; $a <=(15-$nu_rows); $a++ ) 
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
?>





<?php
$sql1="select SUM(gross_amt)as gro_amt from ph_sales_master where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}


$tot_rate=$gro_amt;


$tot_valu=$tot_rate;
$credit_amt=$rown3["credit_amt"];
$dis_amt=$rown3["dis_amt"];

$totamt=$tot_valu-$dis_amt-$credit_amt;


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
    <td colspan="3" class=" bbottom"><div align="center"></div></td>
    </tr>
 </table>
 
 
 <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td colspan="5"><div><u><b>Amount Payable:</b></u></div>
    <div align="left"></div></td>
    <td width="73" class="bright bleft "><div align="center" style="font-weight:bold; text-align:right;">Net Total</div></td>
    <td width="18" class=""><div align="right" style="font-weight:bold;"><?php echo number_format($tot_valu,'2','.','') ;?></div></td>
  </tr>
  <tr>
    <td colspan="5"><div><span style="text-transform:capitalize;">Rupees:<b>
      <?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>
      .</b></span></div>
    <div align="left"></div></td>
    <td class="bright bleft  btop"><div align="center" style="font-weight:bold; text-align:right;">Discount</div></td>
    <td class="btop "><div align="right" style="font-weight:bold;"><?php echo number_format($dis_amt,'2','.','') ;?></div></td>
  </tr>
  <tr>
    <td colspan="5" rowspan="8">
    <div style="font-weight:bold;">W.B.S.T.19531706116, VAT NO.1953170619</div>
    <div><u><span style="font-size: 14px; font-weight:bold;" >Terms and Conditions:-</span></u></div>
		<ol style="padding-left:12px; font-size:11px;">
		  <li>ক্রেডিট ও ডেবিট কার্ড গ্রহণ করা হয়।</li>
      <li>কোন কারনেই নগদ মুল্য ফেরত দেওয়া যাবে না।</li>
      <li>সোল ক্র্যাক ও পেস্টিং ওয়ারেন্টি ৬০দিন।</li>
      <li>Belt, Purse, Wallet, Accessories এর উপর কোন ওয়ারেন্টি নেই।</li>
      <li>PRODUCT ARE INCLUSIVE OF ALL APPLICABLE TAXES</li>
	      </ol></td>
    <td class="bright bleft  btop"><div align="center" style="font-weight:bold; text-align:right;">Credit Amt</div></td>
    <td class="btop "><div align="right" style="font-weight:bold;"><?php echo number_format($credit_amt,'2','.','') ;?></div></td>
  </tr>
  <tr>
    <td class="bright bleft bbottom btop"><div align="center" style="font-weight:bold; text-align:right;">Paid</div></td>
    <td class="btop bbottom"><div align="right" style="font-weight:bold;"><?php echo number_format($totamt,'2','.','') ;?></div></td>
  </tr>
   
 
  <tr>
    <td colspan="2" class="bleft"><div align="center"><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:17px;"><?php echo $sname_logo['com_name'] ; ?></span></div></td>
  </tr>
  <tr>
    <td class="bleft" colspan="2" rowspan="5" align="center" ><b>Authorised Signatory</b></td>
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
