<?php
session_start();
require_once('config/db.php');
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("m-d-Y");
$voucher_no=$_REQUEST['voucher_no'];
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
<div align="center"><a href="purchase_master.php">Back</a></div>

<!--  #########################Purchase details 1##############################-->
<div id="a" style="border:solid 1px #333; width:460px; margin-left:auto; margin-right:auto;">
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0">


<tr>
<td width="70" class="style2"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="100" height="30"/></td>
  <td width="410" class="style2"><div class="style3 style1" style="text-align:left; margin-left:60px;">CASH MEMO</div></td>
  
  </tr>
</table>
<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
   
    <div style="font-size:28px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
   <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">Footware</div>
   
     
    <div style="font-size:14px; line-height:30px;font-weight:bold; text-align:center; text-transform:capitalize; padding-top:1px;"><?php echo $sname_logo['address'] ; ?>
   
 <div style="line-height:10px; margin-bottom:5px;"> Ph: <?php echo $sname_logo['mobile'] ; ?>, E-mail <span style="text-transform:lowercase;"> - <?php echo $sname_logo['email'] ; ?></span></div>
 
    </td>
  </tr>
</table>

<?php
$sqln="select*from ph_purchase_master where voucher_no ='$voucher_no'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$sup_id=$rown["sup_id"];
$po_no1=$rown["po_no"];

$sqln1="select*from ph_supplier_master where id='$sup_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);
?>

<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
<tr>

<td width="344" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Purchase Details</div></td>
</tr>
</table>



<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td width="97" class="btop "><strong>Voucher No.  :</strong></td>
    <td width="180" class="btop"><?php echo $rown["voucher_no"];?></td>
    <td width="87" class="btop"><strong>Voucher Date :</strong></td>
    <td width="78" class="btop "><span class=""><?php echo $rown["voucher_date"];?></span></td>
  </tr>
  <tr>
    <td width="97" class=" "><strong>Supplier Name  :</strong></td>
    <td class=""><?php echo $rown1["sup_name"];?></td>
    <td width="87" class=""><strong>Invoice No.  :</strong></td>
    <td width="78" class=" "><span style="text-transform:capitalize;"><?php echo $rown["invoice_no"];?></span></td>
  </tr>
  <tr>
    <td width="97" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo $rown1["address"];?></td>
    </tr>
</table>
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0" style="margin-top:1px;">
  <tr>
     <td width="33" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;"> No.</span></div></td>
     <td width="239" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">ITEM NAME</span></div></td>
     <td width="38" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">QTY</span></div></td>
     <td width="68" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Price</span></div></td>
     <td width="63" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">TOTAL </span></div></td>
     <td width="118" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">AMOUNT</span></div></td>
     <!--<td width="68" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>-->
  </tr>
<?php
$c=1;
$sql="select * from ph_purchase_master where voucher_no ='$voucher_no'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$t_id=$row["type_id"];
$m_id=$row["medicine_id"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["taxpm"];

$b_type=$row["base_type"];
if($b_type==0)
{
$btype='Box';
}
else
{
$btype='Pieces';
}

$sql2="select * from ph_medicine_master where id ='$m_id'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$sql3="SELECT * FROM ph_type_master where id='$t_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
?>
  <tr>
    <td class="bright"><div align="center"><?php echo $c;?></div></td>
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row2["medici_name"];?> <?php echo $row3["type_name"]; ?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["qty"];?></div></td>
    <td class="bright"><div align="right"><?php echo $row["ptr"];?></div></td>
    <td class="bright"><div align="right">
      <?php //echo $row["total_rate"];?>
      <?php echo number_format ($row["total_rate"],'2','.','');?></div></td>
    <td class="" ><div align="right">
      <?php //echo $row["net_amt"];?>
      <?php echo number_format ($row["net_amt"],'2','.','');?></div></td>
  </tr>
<?php
$c++;
}
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
    <td class="bright"><div align="center"><?php //echo $a;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
for( $b = 1; $b <=9; $b++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
for( $cc = 1; $cc <=8; $cc++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
for( $d = 1; $d <=7; $d++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
for( $e = 1; $e<=6; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$e=1; 
for( $e = 1; $e<=5; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$e=1; 
for( $e = 1; $e<=4; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$e=1; 
for( $e = 1; $e<=3; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$e=1; 
for( $e = 1; $e<=2; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$e=1; 
for( $e = 1; $e<=1; $e++ ) 
{
?>
  <tr>
    <td class="bright"><div align="center"><?php //echo $b;?></div></td>
    <td class="bright"><div align="center">&nbsp;</div></td>
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
$sql1="select SUM(net_amt)as net_amount from ph_purchase_master where voucher_no='$voucher_no'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$net_amount=$row1['net_amount'];
}
?>
 <tr>
   
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
	 <td class="bbottom"><div align="center"></div></td>
  </tr>
 <tr>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class="bright bbottom"><div align="center"></div></td>
    <td class=" bbottom"><div align="center" style="font-weight:bold;"><?php echo number_format($net_amount,'2','.','');?></div></td>
  </tr>
<?php
$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$voucher_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}



$sql144="select SUM(tot_ramt)as pprrr_amt from ph_purchase_return where voucher_no='$voucher_no'";
$res144=mysql_query($sql144);
while($row144=mysql_fetch_array($res144))
{
$pprrr_amt=$row144['pprrr_amt'];
}
if($dis_status==0)
{
$dissamt=$pprrr_amt*$discount/100;
}
else
{
$dissamt=$pprrr_amt-$discount;
}
$afetrdis=$pprrr_amt-$dissamt;
$vatamt=$afetrdis*$vat/100;
$totretunaammtt=$afetrdis+$vatamt;

$due_ant=$net_amount-$pay_amt-$totretunaammtt;

$i=1;
$sql13="select * from ph_supplier_payment where voucher_no='$voucher_no'";
$res13=mysql_query($sql13);
$rowsize=mysql_num_rows($res13);
?>
  <tr>
    <td colspan="5" class="bright bbottom">    <div align="center" style="font-weight:bold; text-align:right;border-top:none;">Paid Amt 
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
<?php echo $pay;?><?php echo $p; $i++;}?>)<?php }?></div></td>
    <!--<td class="bright bbottom"><div align="center"></div></td>-->
    <td class=" bbottom"><div align="center" style="font-weight:bold;"><?php echo number_format($pay_amt,'2','.','');?></div></td>
  </tr>
<?php 
if($totretunaammtt>0)
{
?>  
  <tr>
    <td colspan="5" class="bright bbottom"><div align="center" style="font-weight:bold; text-align:right;border-top:none;">Return Amt </div></td>
    
    <!--<td class="bright bbottom"><div align="center"></div></td>-->
    <td class=" bbottom"><div align="center" style="font-weight:bold;"><?php echo number_format($totretunaammtt,'2','.','');?></div></td>
  </tr>
<?php }?>  
   <tr>
    <td colspan="5" class="bright bbottom"><div align="center" style="font-weight:bold; text-align:right;border-top:none;">Due Amt </div></td>
    
    <!--<td class="bright bbottom"><div align="center"></div></td>-->
    <td class=" bbottom"><div align="center" style="font-weight:bold;"><?php echo number_format($due_ant,'2','.','');?></div></td>
  </tr>
   <!--<tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;"> Add. Tax</div></td>
    <td class=" "><div align="right"><?php //echo number_format($vat_amt,'2','.','');?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;"> Gift(-)</div></td>
    <td class=" "><div align="right"><?php //echo number_format($disco_amt,'2','.','');?></div></td>
  </tr>
  <!--<tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;"> Adjustment(<?php //echo $addmm;?>)</div></td>
    <td class=" "><div align="right"><?php //echo number_format($amt_of_adj,'2','.','');?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">R/O (+/-)</div></td>
    <td class="bbottom"><div align="right"><?php //echo number_format ($aaa,'2','.','');?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Net Amount</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php //echo $subtot1; echo '.00';?></div></td>
  </tr>-->
</table>






<table align="center" width="450" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="492" rowspan="4" valign="top" class="btop">
    
    <strong>Amount In-Words :</strong><br/>
    <span style="text-transform:capitalize;">Rupees <?php
		 echo convert_number_to_words($net_amount).' '.'Only';?>.</span></td>
    <td width="246" valign="top" class="btop"><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:20px;"><?php echo $sname_logo['com_name'] ; ?></span></td>
    
  </tr>
  <tr>
    <td width="246" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="246" valign="top" class="btop "><div style="text-transform:uppercase; letter-spacing:3px; text-align:center; font-weight:bold;">(SIGNATURE)</div></td>
  </tr>
  </table>
</div>
  <!--  #########################Purchase details 1 End##############################-->
  <br/>
<!--  #########################Purchase details 2##############################-->
  
  <!--  #########################Purchase details 2 End##############################-->
<table align="center" border="0">
  <tr>
    <td><div align="center" id="button"><input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/></div></td>
    </tr> 
</table>
</body>
</html>
