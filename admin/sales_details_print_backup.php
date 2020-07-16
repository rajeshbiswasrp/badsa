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
</style>
</head>

<body>
<div align="center"><a href="sales_master.php">Back</a></div>
<!--  #########################Retail Invoice 1##############################-->
<div id="a">
<table align="center" width="750" border="1" cellpadding="2" cellspacing="0">
<tr><td>&nbsp;
<table align="center" width="750" border="0" cellpadding="5" cellspacing="0">
<tr><td valign="top" class="" width="18">VAT No. - </td><td valign="top" class="" width="18">xxxxxxxxx</td><td valign="top" class="" width="388">Original Copy</td></tr>
<tr><td valign="top" class="" width="88">CST No. - </td><td valign="top" class="" width="88">xxxxxxxxx</td><td  align="right"valign="top" class="" width="88">&nbsp;</td></tr>
<tr><td class="tax" colspan="3">TAX INVOICE</td></tr>

  <tr>
    <!--<td valign="top" class="" width="88"><img src="<?php //echo "logo1/".$sname_logo['sch_img']; ?>" width="70" height="70"/></td>-->
    <td valign="top"  colspan="3"class="" width="642">
    <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><h1><?php echo $sname_logo['com_name'] ; ?></h1></div>
    
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">Address : <?php echo $sname_logo['address'] ; ?><br/>
Ph: <?php echo $sname_logo['mobile'] ; ?>, Email : <span style="text-transform:lowercase;"><?php echo $sname_logo['email'] ; ?></span></div>
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
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
  <td width="91"><strong><!--Invoice No.-->Consignee. <br />To :</strong></td></tr>
  <tr>
    <td width="91" class="btop "><strong><!--Invoice No.-->Receipt No.  :</strong></td>
    <td width="213" class="btop"><?php //echo $rown["invoice_no"];?><?php echo $rown["receipt_no"];?></td>
    <td width="79" class="btop"><strong>Date :</strong></td>
    <td width="109" class="btop"><?php echo $rown["bill_date"];?></td>
    <td width="89" class="btop"><strong>Time  :</strong></td>
    <td width="145" class="btop "><span style="text-transform:capitalize;"><?php echo $rown3["time"];?></span></td>
  </tr>
  <tr>
    <td width="121" class=" "><strong> Customer Name :</strong></td>
    <td width="213" class=""><?php echo $rown1["pati_name"];?></td>
    <!--<td width="79" class=""><strong>Patient Id :</strong></td>
    <td width="109" class=""><?php //echo $rown["patient_id"];?></td>
-->    <!--<td width="89" class=""><strong>Doctor Id  :</strong></td>
    <td width="245" class=" "><span style="text-transform:capitalize;"><?php //echo $rown4["refer_id"];?> - <?php //echo $rown4["refer_name"];?></span></td>-->
  </tr>
  <tr>
    <td width="91" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo ($pati_type==1)?$rown1["full_add"]:$rown1["address"];?></td>
    
    <td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 <tr>
     <td width="52" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Sl. No.</span></div></td>
     <td width="245" class="btop bbottom bright"><div align="center"><span class="style1">DESCRIPTIONS</span></div></td>
     <td width="101" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <!--<td width="101" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Base Type</span></div></td>-->
     <td width="100" class="btop bbottom bright"><div align="right"><span class="style1">RATE</span></div></td>
     <td width="78" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST % .</span></div></td>
     <td width="125" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">VAT / CST Amt.</span></div></td>
     <td width="107" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
     <td style="border-bottom:1px solid;">&nbsp;</td>
  </tr>
<?php
$c=1;
$sql="select * from ph_sales_master where status ='1'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$m_id=$row["medicine_id"];
$t_id=$row["type_id"];

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
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row2["medici_name"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["iss_qty"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["iss_qty"];?></div></td>-->
    <td class="bright"><div align="right"><?php echo number_format ($row["mrp"],'2','.','');?></div></td>
    <td class="bright"><div align="center"><?php echo $row["taxpm"];?></div></td>
    <td class="bright"><div align="center"><?php echo $row["tax_amt"];?></div></td>
    <td width="53" ><div align="right"><?php echo number_format($row["new_amt"],'2','.','') ;?></div></td>
  </tr>
<?php
$c++;
}
}
}
?>
<?php
$sql1="select SUM(new_amt)as gro_amt from ph_sales_master where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}

$sql12="select SUM(tax_amt)as v_amt from ph_sales_master where status='1'";
$res12=mysql_query($sql12);
while($row12=mysql_fetch_array($res12))
{
$v_amt=$row12['v_amt'];
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
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>-->
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bbottom"><div align="right"></div></td>
  </tr>
 <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>-->
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Total</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo number_format($gro_amt,'2','.','');?></div></td>
  </tr>
  
  
   
 
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>-->
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Less Paid</div></td>
    <td class="bright "><div align="right"><?php echo number_format($rown3["less_pay"],'2','.','') ;?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>-->
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Net Total</div></td>
    <td class="btop "><div align="right" style="font-weight:bold;"><?php echo number_format($tot_valu,'2','.','') ;?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>-->
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">R/O (+/-)</div></td>
    <td class="bbottom"><div align="right"><?php echo number_format ($aaa,'2','.','');?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Balance Due</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo $subtot1; echo '.00';?></div></td>
  </tr>

</table>


<table align="center" width="750" border="0" cellpadding="3" cellspacing="0">
<tr><td width="750" >Sales</td></tr>
  <tr>
    <td width="492" rowspan="4" valign="top" class="btop">
    <strong>Total Items :</strong>
    <span style="margin-left:5px;"><?php echo $nu_rows;?></span> <br/> 
    <strong>Amount Payable :</strong><br/>
    <span style="text-transform:capitalize;">Rupees <?php
		 echo convert_number_to_words(number_format($tot_valu,'2','.','')).' '.'Only';?>.</span><br/>
    <span style="text-transform:capitalize; font-style:oblique; font-weight:bold;">All disputes subject to Kolkata Jurisdiction only.
Once Goods sold never refund.</span>
    </td>
    <td width="246" valign="top" class="btop"><span style="font-style:oblique;">for</span> <span style="font-size:14px; font-weight:bold; margin-left:20px;"><?php echo $sname_logo['com_name'] ; ?></span></td>
    
  </tr>
  <tr>
    <td width="246" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="246" valign="top" class="btop "><div style="text-transform:uppercase; letter-spacing:3px; text-align:center; font-weight:bold;">(SIGNATURE)</div></td>
  </tr>
  </table>
  </td>
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
</body>
</html>
