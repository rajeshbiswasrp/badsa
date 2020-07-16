<?php
date_default_timezone_set('Asia/Kolkata');
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$user_id=$_SESSION["user_id"];
$u_type=$_SESSION["u_type"];


		
?>
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
<div id="topprint">
<table align="center" width="950" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td valign="top" class="btop bleft bbottom" width="100"><div align="center"><img src="img/logo.png" width="90" height="90"/></div></td>
    <td valign="top" class="btop bleft bbottom bright" width="620">
    <div style="font-size:20px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;">SMART GARMENTS</div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;">dANKUNI</div>
    <div style="font-size:14px; font-weight:bold; text-align:center; text-transform:lo; padding-top:5px;"><span style="font-size:14px; font-weight:bold; text-align:center; text-transform:capitalize; padding-top:5px;"> HOWRAH</span></div>
    </td>
  </tr>
</table>
<table align="center" width="950" border="1" cellpadding="2" cellspacing="0">
  
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date of Purchase </strong></th>
      <th><strong>Medicine Name </strong></th>
      <th><strong>Purchase Qty</strong></th>
      <th><strong>Purchase Re Qty</strong></th>
      <th><strong>PTR</strong></th>
      <th><strong>Total Amt</strong></th>
      <th><strong>Expire Date</strong></th>
      <th><strong>MRP</strong></th>
      <th><strong>Issue Qty</strong></th>
      <th><strong>Total Sale Amt</strong></th>
      <th><strong>Qty In Hand</strong></th>
      <th><strong>Total Stock Amt</strong></th>
      <th><strong>Profit %</strong></th>
      <th><strong>Profit Amt</strong></th>
    </tr>
      
   <?php
if($_POST["submit1"])
{
$dtt=$_POST['date'];
	  
$dtt1 = $_POST['date2'];

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
}
    

$c=1;
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;

$sql="SELECT * FROM ph_purchase_master where date between '$date' and '$date1'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$medicine_id=$row["medicine_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
$sql2="SELECT * FROM ph_medicine_master where id = '$medicine_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql4="SELECT SUM(return_qty)as tot_srqty FROM ph_purchase_return where ph_purchase_id = '$purchase_id'";
$result4=mysql_query($sql4);
while($row4=mysql_fetch_array($result4))
{
$tot_srqty=$row4["tot_srqty"];
}

$sql5="SELECT SUM(iss_qty)as tot_issqty FROM ph_sales_master where purchase_id = '$purchase_id'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
$tot_issqty=$row5["tot_issqty"];
}
$tot_use_qty=$tot_srqty+$tot_issqty;

$sql1="SELECT * FROM ph_sales_master where purchase_id = '$purchase_id'";
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
$sale_id=$row1["id"];
}

$sql6="SELECT SUM(return_qty)as tot_salerqty FROM ph_sales_return where ph_sales_id = '$sale_id'";
$result6=mysql_query($sql6);
while($row6=mysql_fetch_array($result6))
{
$tot_salerqty=$row6["tot_salerqty"];
}

$p_qty=$row["tot_qty"];
$all_qty=$p_qty+$tot_salerqty;
$qih=$all_qty-$tot_use_qty;

$iss_qty=$p_qty-$qih;
$mrp=$row["mrp"];
$tot_sale_amt=$mrp*$iss_qty;
$tot_stock_amt=$qih*$mrp;

$ptr=$row["ptr"];

$profit_amt=$mrp-$ptr;
$profit_per=$profit_amt*100/$ptr;

$sum=$sum+$p_qty;
$tot_amm=$row["gross_rate"];
$sum2=$sum2+$tot_amm;
$sum3=$sum3+$iss_qty;
$sum4=$sum4+$tot_sale_amt;
$sum5=$sum5+$qih;
$sum6=$sum6+$tot_stock_amt;
$sum7=$sum7+$profit_amt;
$sum8=$sum8+$tot_srqty;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $row2["medici_name"]; ?></td>
      <td align="center"><?php echo $row["tot_qty"]; ?></td>
      <td align="center"><?php echo $tot_srqty; ?></td>
      <td align="center"><?php echo $row["ptr"]; ?></td>
      <td align="center"><?php echo $row["gross_rate"]; ?></td>
      <td align="center"><?php echo $row["exp_date"]; ?></td>
      <td align="center"><?php echo $row["mrp"]; ?></td>
      <td align="center"><?php echo $iss_qty; ?></td>
      <td align="center"><?php echo $tot_sale_amt; ?></td>
      <td align="center"><?php echo $qih; ?></td>
      <td align="center"><?php echo $tot_stock_amt; ?></td>
      <td align="center"><?php echo $profit_per; ?></td>
      <td align="center"><?php echo $profit_amt; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>  
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum; ?></strong></th>
      <th><strong><?php echo $sum8; ?></strong></th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum2; ?></strong></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum3; ?></strong></th>
      <th><strong><?php echo $sum4; ?></strong></th>
      <th><strong><?php echo $sum5; ?></strong></th>
      <th><strong><?php echo $sum6; ?></strong></th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum7; ?></strong></th>
    </tr>

    <tr>
      <td colspan="15" align="center" id="button">
      <input  type="button" align="center" name="Print" value="Print" onClick="print1();">
      </td>
      </tr>
  </table>
</tbody>   
</table>	
    
    
     
 





</div>
