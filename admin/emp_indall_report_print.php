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
<div align="center"><a href="emp_indall_report.php">Back</a></div>
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
<?php
$date = $_GET['dt'];
$date1 = $_GET['dt1'];
$ph_emp_id = $_GET['ph_emp_id'];
$sqln="select*from ph_employee_master where id ='$ph_emp_id'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
?>
<table align="center" width="754" border="1" cellpadding="5" cellspacing="0" style="font-size:13px;">
            <tbody>
      <tr>
      <th><strong>Emp Name - </strong></th>
      <th><strong><?php echo $rown["emp_name"];?></strong></th>
      <th><strong>Emp Id - </strong></th>
      <th><strong><?php echo $rown["employee_id"];?></strong></th>
      <th><strong>From - <?php echo $date;?></strong></th>
      <th><strong>To - <?php echo $date1;?></strong></th>
    </tr>
        </tbody>
        </table> 
<table align="center" width="754" border="1" cellpadding="5" cellspacing="0" style="font-size:13px;">
    <tbody>
     <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>S.Date</strong></th>
      <th><strong>Bill No.</strong></th>
      <th><strong>C.Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Discount Amt</strong></th>
      <th><strong>Return Amount (-Dis)</strong></th>
      <th><strong>Net Amount</strong></th>
    </tr>
   </tbody>
<tbody>  



<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no FROM ph_sales_master where ph_emp_id='$ph_emp_id' and date between '$date' and '$date1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$invoice_no=$rowi["invoice_no"];

$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$pati_id=$row["pati_id"];

$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
}	
$sql1="select SUM(mrp)as tot_amt from ph_sales_master where invoice_no='$invoice_no'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$tot_amt=$row1['tot_amt'];
}
$sqln="select*from ph_sales_payment where invoice_no='$invoice_no'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
$dis_amt=$rown["dis_amt"];

$sql3="select SUM(tot_amt)as totreturn from ph_sale_return where invoice_no='$invoice_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}

$sql31="select SUM(dis_amt)as disreturn from ph_sale_return where invoice_no='$invoice_no'";
$res31=mysql_query($sql31);
while($row31=mysql_fetch_array($res31))
{
$disreturn=$row31['disreturn'];
}
$totooretun1=$totreturn-$disreturn;
$totooretun=round($totooretun1);
$tot_rate1=$tot_amt-$totreturn-$totooretun;

$sum=$sum+$tot_amt;
$sum2=$sum2+$dis_amt;
$sum3=$sum3+$totooretun;
$sum4=$sum4+$tot_rate1;
				
$sql2="SELECT * FROM ph_patient_master where id='$pati_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["invoice_no"]; ?></td>
      <td><?php echo $row2["pati_name"]; ?></td>
      <td><div align="right"><?php echo $tot_amt; ?></div></td>
      <td><div align="right"><?php echo $tot_amt; ?></div></td>
      <td><div align="right"><?php echo $totooretun; ?></div></td>
      <td><div align="right"><?php echo $tot_rate1; ?></div></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>
<tr>
      <th>&nbsp;</th>
       <th>&nbsp;</th>
       <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><div align="right"><strong><?php echo $sum; ?></strong></strong></th>
      <th><div align="right"><strong><?php echo $sum2; ?></strong></strong></th>
      <th><div align="right"><strong><?php echo $sum3; ?></strong></strong></th>
      <th><div align="right"><strong><?php echo $sum4; ?></strong></strong></th>
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
