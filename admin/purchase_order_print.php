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

</head>

<body>
<div align="center"><a href="purchase_order.php">Back</a></div>

<!--  #########################Purchase details 1##############################-->
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
<td width="602" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:15px;">Purchase Order</div></td>
<td width="140" class="bbottom btop"> <div style="text-transform:uppercase; font-weight:bold; text-align:center; font-size:12px;">DL - 10020S/10030SB</div></td>
</tr>
</table>

<?php
$sqln="select*from ph_purchase_order where status ='1'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$sup_id=$rown["sup_id"];

$sqln1="select*from ph_supplier_master where id='$sup_id'";
$resn1=mysql_query($sqln1);
$rown1=mysql_fetch_assoc($resn1);
?>

<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
    <td width="99" class="btop "><strong>P.O. No.  :</strong></td>
    <td width="196" class="btop"><?php echo $rown["po_no"];?></td>
    <td width="88" class="btop"><strong>P.O. Date :</strong></td>
    <td width="109" class="btop"><?php echo $rown["po_date"];?></td>
    <td width="73" class="btop"><strong>Bill Date  :</strong></td>
    <td width="161" class="btop "><?php echo $rown["bill_date"];?></td>
  </tr>
  <tr>
    <td width="99" class=" "><strong>Supplier Name  :</strong></td>
    <td width="196" class=""><?php echo $rown1["sup_name"];?></td>
    <td width="88" class=""><strong>Mob. No. :</strong></td>
    <td width="109" class=""><?php echo $rown1["mobile"];?></td>
    <td width="73" class=""><strong>Email  :</strong></td>
    <td width="161" class=" "><span style="text-transform:lowercase;"><?php echo $rown1["email"];?></span></td>
  </tr>
  <tr>
    <td width="99" class=" bbottom"><strong>Address  :</strong></td>
    <td colspan="3" class="bbottom "><?php echo $rown1["address"];?></td>
    
    <td class="bbottom "><strong>DL No.  :</strong></td>
    <td class="bbottom "><span style="text-transform:capitalize;"><?php echo $rown1["dl_no"];?></span></td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="1" cellspacing="0" style="margin-top:1px;">
  <tr>
     <td width="31" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;"> No.</span></div></td>
     <td width="130" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Items</span></div></td>
     <td width="50" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Base</span></div></td>
     <td width="50" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Unit</span></div></td>
     <!--<td width="32" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Base Type</span></div></td>-->
     <td width="33" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Qty</span></div></td>
     <!--<td width="33" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">NTS</span></div></td>-->
     <!--<td width="50" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Batch</span></div></td>
     <td width="66" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Mfg. Date</span></div></td>
     <td width="69" class="btop bbottom bright"><div align="center"><span style="font-weight:bold; text-transform:uppercase; font-size:11px;">Exp. Date</span></div></td>-->
    </tr>
<?php
$c=1;
$sql="select * from ph_purchase_order where status ='1'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$m_id=$row["medicine_id"];
$po_no=$row["po_no"];
$t_id=$row["type_id"];

$b_type=$row["base_type"];
if($b_type==0)
{
$btype='Strip / Box';
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
    <td class="bright"><div align="left"><span style="text-transform:capitalize;"><?php echo $row2["medici_name"];?></span></div></td>
    <td class="bright"><div align="left"><?php echo $row3["type_name"]; ?></div></td>
    <td class="bright"><div align="left"><?php echo $row["unit"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $btype;?></div></td>-->
    <td class="bright"><div align="center"><?php echo $row["t_spq"];?></div></td>
    <!--<td class="bright"><div align="center"><?php //echo $row["nts"];?></div></td>-->
    <!--<td class="bright"><div align="center"><span style="text-transform:uppercase;"><?php //echo $row["batch"];?></span></div></td>
    <td class="bright"><div align="center"><?php //echo $row["mfg_date"];?></div></td>
    <td class="bright"><div align="center"><?php //echo $row["exp_date"];?></div></td>-->
    </tr>
<?php
$c++;
}
}
}
?>


<?php
$sql1="select SUM(gross_rate)as gro_amt from ph_purchase_order where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}
$sql12="select SUM(vat_amt)as vat_amt from ph_purchase_order where status='1'";
$res12=mysql_query($sql12);
while($row12=mysql_fetch_array($res12))
{
$vat_amt=$row12['vat_amt'];
}
$sql13="select SUM(dis_amt)as dis_amt from ph_purchase_order where status='1'";
$res13=mysql_query($sql13);
while($row13=mysql_fetch_array($res13))
{
$disco_amt=$row13['dis_amt'];
}

$sql14="select SUM(net_rate)as net_amount from ph_purchase_order where status='1'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$net_amount1=$row14['net_amount'];
}


$sqln3="select * from purchase_order_adj where po_no ='$po_no'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);

$amt_of_adj=$rown3["amt_of_adj"];
$add_status=$rown3["add_status"];

if($add_status==1)
{
$addmm='+';
$net_amount=$net_amount1+$amt_of_adj;
}
else{
$addmm='-';
$net_amount=$net_amount1-$amt_of_adj;
}



$fin_amount1=round($net_amount,2);
$ww=intval($net_amount);
$ff=$net_amount-$ww;
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
			 $subtot=$aaa+$net_amount;
			$subtot1=round($subtot,2);
			}
			else
			{
			 $subtot=$net_amount-$aaa;
			$subtot1=round($subtot,2);
			}
?>
<tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
 <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>-->
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>-->
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>

  <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <!--<td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>-->
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
   <!-- <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>-->
    <td class="bright"><div align="right"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
   <tr>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
   <!-- <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="right"></div></td>-->
    <td class="bright"><div align="center"></div></td>
    <td class="bright"><div align="center"></div></td>
    </tr>
</table>


<table align="center" width="750" border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td width="492" rowspan="4" valign="top" class="btop">
    <strong>Total Items :</strong>
    <span style="margin-left:5px;"><?php echo $nu_rows;?></span> <br/> 
    <strong></span></td>
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
