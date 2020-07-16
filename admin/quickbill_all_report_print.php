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
<div align="center"><a href="quickbill_all_report.php">Back</a></div>
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
      <th><div align="center"><strong>Sl No.</strong></div></th>
      <th><div align="center"><strong>Date</strong></div></th>
      <th><div align="center"><strong>Bill No.</strong></div></th>
      <th><div align="center"><strong>Customer Name</strong></div></th>
      <th><div align="center"><strong>Total Amount</strong></div></th>
      <th><div align="right"><strong>Discount Amount</strong></div></th>
<!--      <th><div align="right"><strong>Paid Amount</strong></div></th>
-->    </tr>
   </tbody>
<tbody>  


<?php
if(isset($_GET['dt']) && isset($_GET['dt1']))
{
$date = $_GET['dt'];
$date1 = $_GET['dt1'];
}
else
if(isset($_GET['searchsupplier'])){
 $search = urldecode($_GET['searchsupplier']);
 
if($search!='')
{
	$supparr='';
	$querysuppid="SELECT * FROM ph_supplier_master where sup_name LIKE '$search%'";
	$resultsuppid=mysql_query($querysuppid);
	while($rowsuppid=mysql_fetch_array($resultsuppid)){
	$supparr.=$rowsuppid['id'].",";
	
	}
	
$supparr=substr($supparr,0,strlen($supparr)-1);
if(strlen($supparr)>0)
$orsql="OR sup_id in ($supparr)";
else
$orsql="";	
	
}
 	
}
$sum=0;
$sum2=0;
$sum3=0;
$sum33=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$c=1;
/*if($_GET[id]!="")
{
$sql_del="delete from `quick_bill` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}*/
if(isset($_GET['dt']) && isset($_GET['dt1']))
{
$sqli = "SELECT DISTINCT voucher_no FROM quick_bill where date between '$date' and '$date1'";
}
else
if(isset($_GET['searchsupplier'])){
$sqli = "select DISTINCT voucher_no from quick_bill where voucher_no LIKE '$search%' $orsql";	
}


$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$vou_no=$rowi['voucher_no'];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM quick_bill where voucher_no='$vou_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
//echo $vou_no=$row["voucher_no"];
//$tem_vono."<br>";
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$dis_amt=$row["dis_amt"];
$less_pay=$row["less_pay"];
$cus_name=$row["cus_name"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";


$sql33="select SUM(tot_amt)as totrate from quick_bill where voucher_no='$temp_voucher'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}


if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
$oldtempvoucher=$temp_voucher;
}

$sum33=$sum33+$totrate;
$sum3=$sum3+$dis_amt;
$sum4=$sum4+$less_pay;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><div align="center"><?php echo $date4; ?></div></td>
      <td><div align="center"><?php echo $rowi["voucher_no"]; ?></div></td>
      <td><div align="center"><?php echo $cus_name; ?></div></td>
      <td><div align="right"><?php echo number_format($totrate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($dis_amt,2); ?></div></td>
      <!--<td><div align="right"><?php //echo number_format($less_pay,2); ?></div></td>-->
      </tr>
<?php 
$c=$c+1;
}
?>  
<tr>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><div align="right"><strong>Total</strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum33,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum3,2); ?></strong></div></td>
      <!--<td><div align="right"><strong><?php //echo number_format($sum4,2); ?></strong></div></td>-->
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
