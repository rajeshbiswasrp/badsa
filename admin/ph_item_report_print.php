<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$sname_logo=mysql_fetch_array(mysql_query("select * from ph_config_master where status='1'"));
?>

<?php
function convert_number_to_words($no)
{   
 $words = array('0'=> '' ,'1'=> 'One' ,'2'=> 'Two' ,'3' => 'Three','4' => 'Four','5' => 'Five','6' => 'Six','7' => 'Seven','8' => 'Eight','9' => 'Nine','10' => 'Ten','11' => 'Eleven','12' => 'Twelve','13' => 'Thirteen','14' => 'Fouteen','15' => 'Fifteen','16' => 'Sixteen','17' => 'Seventeen','18' => 'Eighteen','19' => 'Nineteen','20' => 'Twenty','30' => 'Thirty','40' => 'Fourty','50' => 'Fifty','60' => 'Sixty','70' => 'Seventy','80' => 'Eighty','90' => 'Ninty','100' => 'Hundred &','1000' => 'Thousand','100000' => 'Lakh','10000000' => 'Crore');
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
 var divElements1 = document.getElementById('topprint').innerHTML;
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
<div align="center"><a href="ph_item_report.php">Back</a></div>
<div id="topprint">


<div id="b" class="page">
<table width="450" border="0" align="center" cellpadding="5" cellspacing="0">


<tr>
<td width="70" class="style2"><img src="<?php echo "logo1/".$sname_logo['sch_img']; ?>" width="100" height="30"/></td>
  <td width="410" class="style2"><div style="text-align:left; margin-left:60px;"><!--CASH MEMO--></div></td>
  
  </tr>
</table>
<table width="450" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
   
    <div style="font-size:28px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?></div>
   <div style="font-size:18px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">Footware</div>
   
     
    <div style="font-size:14px; line-height:30px;font-weight:bold; text-align:center; text-transform:capitalize; padding-top:1px;"><?php echo $sname_logo['address'] ; ?>
   
 <div style="line-height:10px; margin-bottom:5px;"> Ph: <?php echo $sname_logo['mobile'] ; ?> <span style="text-transform:lowercase;"><?php echo $sname_logo['email'] ; ?></span></div>
 
    </td>
  </tr>
</table>
<br/>
<table align="center" width="754" border="1" cellpadding="5" cellspacing="0" style="font-size:13px;">
   <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Item Name</strong></th>
      <th colspan="3"><strong>Total Purchased Qty</strong></th>
      <th colspan="3"><strong>Purchased Return</strong></th>
      <th colspan="3"><strong>Total Sale Qty</strong></th>
      <th colspan="3"><strong>Sale Return</strong></th>
      <th colspan="3"><strong>Qty in Hand</strong></th>
      
    </tr>
        </tbody>
<tbody>           
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      
    </tr>

<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;
$sum9=0;
$sum10=0;
$sum11=0;
$sum12=0;
$sum13=0;
$sum14=0;
$sum15=0;
$c=1;

$sqli = "SELECT DISTINCT medicine_id FROM ph_purchase_master";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$medicine_id=$rowi['medicine_id'];

$sql="SELECT * FROM ph_purchase_master where medicine_id='$medicine_id'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
}
					
$sql2="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql41="select SUM(qty)as totp_pqtymale from ph_purchase_master where medicine_id='$medicine_id' and for_type='1'";
$res41=mysql_query($sql41);
while($row41=mysql_fetch_array($res41))
{
$totp_pqtymale=$row41['totp_pqtymale'];
}
$sql42="select SUM(qty)as totp_pqtyfemale from ph_purchase_master where medicine_id='$medicine_id' and for_type='0'";
$res42=mysql_query($sql42);
while($row42=mysql_fetch_array($res42))
{
$totp_pqtyfemale=$row42['totp_pqtyfemale'];
}
$sql4="select SUM(qty)as totp_pqty from ph_purchase_master where medicine_id='$medicine_id'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$totp_pqty=$row4['totp_pqty'];
}
$tot_purch_qty=$totp_pqty;


$sql51="select SUM(return_qty)as totpp_returnmale from ph_purchase_return where medicine_id='$medicine_id' and for_type='Male'";
$res51=mysql_query($sql51);
while($row51=mysql_fetch_array($res51))
{
$totpp_returnmale=$row51['totpp_returnmale'];
}
$sql52="select SUM(return_qty)as totpp_returnfemale from ph_purchase_return where medicine_id='$medicine_id' and for_type='Female'";
$res52=mysql_query($sql52);
while($row52=mysql_fetch_array($res52))
{
$totpp_returnfemale=$row52['totpp_returnfemale'];
}
$sql5="select SUM(return_qty)as totpp_return from ph_purchase_return where medicine_id='$medicine_id'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$totpp_return=$row5['totpp_return'];
}

$sql61="select SUM(sale_qty)as tot_saleppmale from ph_sales_master where medicine_id='$medicine_id' and for_type='Male'";
$res61=mysql_query($sql61);
while($row61=mysql_fetch_array($res61))
{
$tot_saleppmale=$row61['tot_saleppmale'];
}
$sql62="select SUM(sale_qty)as tot_saleppfemale from ph_sales_master where medicine_id='$medicine_id' and for_type='Female'";
$res62=mysql_query($sql62);
while($row62=mysql_fetch_array($res62))
{
$tot_saleppfemale=$row62['tot_saleppfemale'];
}
$sql6="select SUM(sale_qty)as tot_salepp from ph_sales_master where medicine_id='$medicine_id'";
$res6=mysql_query($sql6);
while($row6=mysql_fetch_array($res6))
{
$tot_salepp=$row6['tot_salepp'];
}

$sql71="select SUM(return_qty)as tot_sale_returnmale from ph_sale_return where medicine_id='$medicine_id' and for_type='Male'";
$res71=mysql_query($sql71);
while($row71=mysql_fetch_array($res71))
{
$tot_sale_returnmale=$row71['tot_sale_returnmale'];
}
$sql72="select SUM(return_qty)as tot_sale_returnfemale from ph_sale_return where medicine_id='$medicine_id' and for_type='Female'";
$res72=mysql_query($sql72);
while($row72=mysql_fetch_array($res72))
{
$tot_sale_returnfemale=$row72['tot_sale_returnfemale'];
}
$sql7="select SUM(return_qty)as tot_sale_return from ph_sale_return where medicine_id='$medicine_id'";
$res7=mysql_query($sql7);
while($row7=mysql_fetch_array($res7))
{
$tot_sale_return=$row7['tot_sale_return'];
}
$tot_manes=$totpp_return+$tot_salepp;
$tot_qty_hand=$tot_purch_qty+$tot_sale_return-$tot_manes;

$tot_manesmale=$totpp_returnmale+$tot_saleppmale;
$tot_qty_handmale=$totp_pqtymale+$tot_sale_returnmale-$tot_manesmale;

$tot_manesfemale=$totpp_returnfemale+$tot_saleppfemale;
$tot_qty_handfemale=$totp_pqtyfemale+$tot_sale_returnfemale-$tot_manesfemale;

if($tot_qty_hand>0)
{
$sum=$sum+$totp_pqtymale;
$sum2=$sum2+$totp_pqtyfemale;
$sum3=$sum3+$tot_purch_qty;
$sum4=$sum4+$totpp_returnmale;
$sum5=$sum5+$totpp_returnfemale;
$sum6=$sum6+$totpp_return;
$sum7=$sum7+$tot_saleppmale;
$sum8=$sum8+$tot_saleppfemale;
$sum9=$sum9+$tot_salepp;
$sum10=$sum10+$tot_sale_returnmale;
$sum11=$sum11+$tot_sale_returnfemale;
$sum12=$sum12+$tot_sale_return;
$sum13=$sum13+$tot_qty_handmale;
$sum14=$sum14+$tot_qty_handfemale;
$sum15=$sum15+$tot_qty_hand;
?>             
<tr>
      <td><div align="right"><?php echo $c;?></div></td>
      <td><?php echo $row2["medici_name"]; ?></td>
      <td><div align="right"><?php echo $totp_pqtymale; ?></div></td>
      <td><div align="right"><?php echo $totp_pqtyfemale; ?></div></td>
      <td><div align="right"><?php echo $tot_purch_qty; ?></div></td>
      <td><div align="right"><?php echo $totpp_returnmale; ?></div></td>
      <td><div align="right"><?php echo $totpp_returnfemale; ?></div></td>
      <td><div align="right"><?php echo $totpp_return; ?></div></td>
      <td><div align="right"><?php echo $tot_saleppmale; ?></div></td>
      <td><div align="right"><?php echo $tot_saleppfemale; ?></div></td>
      <td><div align="right"><?php echo $tot_salepp; ?></div></td>
      <td><div align="right"><?php echo $tot_sale_returnmale; ?></div></td>
      <td><div align="right"><?php echo $tot_sale_returnfemale; ?></div></td>
      <td><div align="right"><?php echo $tot_sale_return; ?></div></td>
      <td><div align="right"><?php echo $tot_qty_handmale; ?></div></td>
      <td><div align="right"><?php echo $tot_qty_handfemale; ?></div></td>
      <td><div align="right"><?php echo $tot_qty_hand; ?></div></td>
      </tr>
<?php 
$c=$c+1;
}
}
}
?>
<tr>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><div align="right"><strong><?php echo $sum; ?></strong></div>.</th>
      <th><div align="right"><strong><?php echo $sum2; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum3; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum4; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum5; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum6; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum7; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum8; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum9; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum10; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum11; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum12; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum13; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum14; ?></strong></div></th>
      <th><div align="right"><strong><?php echo $sum15; ?></strong></div></th>
      
    </tr>


</tbody>   
</table>	




</div>
<br />
<table align="center" border="0">
  <tr>
    <td><div align="center" id="button"><input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/></div></td>
    </tr> 
</table>
<br />
</div>

</body>
</html>
