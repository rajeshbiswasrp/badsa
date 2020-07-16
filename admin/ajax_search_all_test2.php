<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$search = $_GET['b'];
$searchfound=0;
$display='';

if($search!='')
{
 $query="SELECT  ph_purchase_master.*,ph_medicine_master.drug_name,ph_medicine_master.medici_name,ph_medicine_master.comp_name,ph_medicine_master.id as mm_id from ph_purchase_master left join ph_medicine_master on ph_purchase_master.medicine_id=ph_medicine_master.id where ph_medicine_master.medici_name LIKE '$search%' ORDER BY ph_purchase_master.id ASC";
$sql2=mysql_query($query);
//$query = "select * from blood_master where sub_type LIKE '$search%' group by id";
//$sql2=mysql_query($query);

$result2=mysql_num_rows($sql2);
?>

  
  <?php
$i=0;
if($result2==0)
{
$searchfound=0;
}
else
{ 
$display='<table class="table table-hover table-striped table-bordered">';
$display.='<tr>';
$display.='<td>Select</td>';
$display.='<td>Medicine Name</td>';
$display.='<td>Qty In Hand</td>';
$display.='<td>Batch No.</td>';
$display.='<td>Expiry Date</td>';
$display.='<td>Rate</td>';
$display.='</tr>';
//$display.='</table>';

while($row2=mysql_fetch_array($sql2))
{
$purchase_id=$row2["id"];
$tot_stablet_qty=$row2["tot_stablet_qty"];

$sql21="SELECT * FROM ph_sales_master where purchase_id='$purchase_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$sales_id=$row21['id'];
}

$sql13="select SUM(iss_qty)as ttot_iss from ph_sales_master where purchase_id ='$purchase_id'";
$res13=mysql_query($sql13);
while($row13=mysql_fetch_array($res13))
{
$ttot_iss=$row13['ttot_iss'];
}
$sql14="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id ='$sales_id'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$re_qty=$row14['re_qty'];
}
$sql16="select SUM(return_qty)as sre_qty from ph_purchase_return where ph_purchase_id ='$purchase_id'";
$res16=mysql_query($sql16);
while($row16=mysql_fetch_array($res16))
{
$sre_qty=$row16['sre_qty'];
}
$qih=$tot_stablet_qty+$re_qty-$ttot_iss-$sre_qty;


$display.='<tr>';
$display.='<td><input onclick="submitalltest.click()" type="checkbox" name="allbox2[]" id="allbox2[]" value='.$row2[id].' /></td>';
$display.='<td><input type=text name=medici_name'.$row2[id].' id=medici_name'.$row2[id].' value="'.$row2[medici_name].'" readonly=readonly/></td>';
$display.='<td><input type=text name=qihs'.$row2[id].' id=qihs'.$row2[id].' value="'.$qih.'" readonly=readonly/></td>';
$display.='<td><input type=text name=batch'.$row2[id].' id=batch'.$row2[id].' value="'.$row2[batch].'" readonly=readonly/></td>';
$display.='<td><input type=text name=exp_date'.$row2[id].' id=exp_date'.$row2[id].' value="'.$row2[exp_date].'" readonly=readonly/></td>';
$display.='<td><input type=text name=mrp'.$row2[id].' id=mrp'.$row2[id].' value="'.$row2[mrp].'" style=width:80px; margin-bottom:0px; readonly=readonly/></td>';
$display.='</tr>';

$i++;
}
$searchfound=1;
?>
<?php
//$display.='</table>';
//echo $display;
}
/*else
{
	$display='<table class="table table-hover table-striped table-bordered">';
	$display.='<tr>';
	$display.='<td height="22" colspan="7" width="100%" align="center" valign="middle"><font color="#FF0000">No Record Found.</font></td></tr>';
	$display.='</table>';
	echo $display;
}*/

if(!$searchfound){
$display='<table class="table table-hover table-striped table-bordered">';
	$display.='<tr>';
	$display.='<td height="22" colspan="7" width="100%" align="center" valign="middle"><font color="#FF0000">No Record Found.</font></td></tr>';
	$display.='</table>';
	echo $display;
}
else
{
$display.='</table>';
echo $display;
}

 
 }
?>