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
<table width="750" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<!--<td width="602" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Retail Invoice</div></td>-->
<!--<td width="140" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:12px;">DL - 0020S/10030SB</div></td>-->
</tr>
</table>
<?php
$sqlnr="select*from ph_sale_return where status='1'";
$resnr=mysql_query($sqlnr);
$rownr=mysql_fetch_assoc($resnr);

$sale_id=$rownr["sale_id"];
?>
<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
<tr>
<td width="166" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:left; font-size:12px;">Return No. - <?php echo $rownr["id"];?></div></td>
<td width="576" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:left; margin-left:50px; font-size:15px;">Credit Details</div></td>
</tr>
</table>

<?php
$sqlns="select*from ph_sale_return where status='1'";
$resns=mysql_query($sqlns);
$rowns=mysql_fetch_assoc($resns);
$pati_id=$rowns["pati_id"];
$dis_amt=$rowns["dis_amt"];

$sqln1="select*from ph_patient_master where id='$pati_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);

?>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td width="110" class="btop "><strong>Return No.  :</strong></td>
    <td width="189" class="btop"><?php echo $rownr["id"];?></td>
    <td width="58" class="btop"><strong>Date :</strong></td>
    <td width="85" class="btop"><?php echo $rownr["date"];?></td>
    <!--<td width="89" class="btop"><strong>Time  :</strong></td>
    <td width="145" class="btop "><span style="text-transform:capitalize;"><?php //echo $rown3["time"];?></span></td>-->
  </tr>
  <tr>
    <td width="110" class=" "><strong>Customer Name  :</strong></td>
    <td width="189" class=""><?php echo $rown1["pati_name"];?></td>
    <td width="58" class="">&nbsp;</td>
    <td width="85" class="">&nbsp;</td>
    <!--<td width="89" class=""><strong>Doctor Id  :</strong></td>
    <td width="145" class=" "><span style="text-transform:capitalize;"><?php //echo $rown["refer_id"];?></span></td>-->
  </tr>
  <tr>
    <td width="110" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo ($pati_type==1)?$rown1["full_add"]:$rown1["address"];?></td>
    
    <!--<td class="bbottom ">&nbsp;</td>
    <td class="bbottom ">&nbsp;</td>-->
  </tr>
</table>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
 <tr>
     <td width="45" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Sl. No.</span></div></td>
     <td width="100" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Items</span></div></td>
     <td width="47" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <td width="41" class="btop bbottom bright"><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">MRP</span></div></td>
     <td width="70" class="btop bbottom "><div align="right"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Amount</span></div></td>
  </tr>
<?php
$sum=0;
//$gross_amt=0;
$c=1;
$sql="select * from ph_sale_return where status='1'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$sale_id=$row["sale_id"];
?>
  <tr>
    <td class="bright"><div align="center"><?php echo $c;?></div></td>
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row["item_name"];?></span></div></td>
    <td class="bright"><div align="center"><?php echo $row["return_qty"];?></div></td>
    <td class="bright"><div align="right"><?php echo number_format($row["mrp"],'2','.','') ;?></div></td>
    <td><div align="right"><?php echo number_format($row["mrp"],'2','.','') ;?></div></td>
  </tr>
<?php
$c++;
}
$sql1="select SUM(mrp)as net_amount from ph_sale_return where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt1=$row1['net_amount'];
}
$gro_amt=$gro_amt1-$dis_amt;
?>
<?php
  

$a=1; 
for( $a = 1; $a <=(17-$nu_rows); $a++ ) 
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
$fin_amount1=round($gro_amt,2);
$ww=intval($gro_amt);
$ff=$gro_amt-$ww;
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
			 $subtot=$aaa+$gro_amt;
			$subtot1=round($subtot,2);
			}
			else
			{
			 $subtot=$gro_amt-$aaa;
			$subtot1=round($subtot,2);
			}
?>
<tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    
    <td class="bright"><div align="center"></div></td>
    <td class="bbottom"><div align="right"></div></td>
  </tr>
 <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Total</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo number_format($gro_amt1,'2','.','');?></div></td>
  </tr>
 

   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Discount Amt</div></td>
    <td class="bbottom"><div align="right"><?php echo number_format ($dis_amt,'2','.','');?></div></td>
  </tr>
  <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">R/O (+/-)</div></td>
    <td class="bbottom"><div align="right"><?php echo number_format ($aaa,'2','.','');?></div></td>
  </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    
    <td class="bright"><div align="center" style="font-weight:bold; text-align:right;">Credit Amount</div></td>
    <td class=""><div align="right" style="font-weight:bold;"><?php echo $subtot1; echo '.00';?></div></td>
  </tr>
</table>


<table align="center" width="450" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="492" rowspan="4" valign="top" class="btop">
    <strong>Total Items :</strong>
    <span style="margin-left:5px;"><?php echo $nu_rows;?></span> <br/> 
    <strong>Amount In-Words :</strong><br/>
    <span style="text-transform:capitalize;">Rupees <?php
		 echo convert_number_to_words($subtot1).' '.'Only';?>.</span><br/>
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
