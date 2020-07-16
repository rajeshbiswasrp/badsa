<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$hint="";
$q = $_GET['q'];
//$criteria = $_GET['medici_name'];

$sql="SELECT  ph_purchase_master.*,ph_medicine_master.medici_name,ph_medicine_master.id as mm_id from ph_purchase_master left join ph_medicine_master on ph_purchase_master.medicine_id=ph_medicine_master.id ORDER BY ph_purchase_master.id ASC";
$result=mysql_query($sql);

$referlist=array();
while($row=mysql_fetch_array($result)){

$purchase_id = $row['id'];
$r = $row['base_type'];


$sub1 = "select * from  ph_purchase_master where id ='$purchase_id' ORDER BY id DESC"; 
$qry1 = mysql_query($sub1);
?>
 
<?php while($rs1=mysql_fetch_array($qry1))
{
$pid=$rs1['id'];
$tot_strtb_qty1=$rs1['qty'];
$tot_stablet_qty1=$rs1['total_qty_p'];
$unit=$rs1['unit'];
$mrp=$rs1['mrp'];
$nts=$rs1['nts'];
$mrp_each_tab=$rs1['total_rate_p'];
$batch=$rs1['batch'];
}

$sql2="SELECT * FROM ph_sales_master where purchase_id='$pid'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sales_id=$row2['id'];
}

$sql12="select SUM(iss_qty)as stot_iss from ph_sales_master where purchase_id ='$purchase_id' and base='0'";
$res12=mysql_query($sql12);
while($row12=mysql_fetch_array($res12))
{
$stot_iss=$row12['stot_iss'];
}
$mm=$stot_iss*$nts;


$sql13="select SUM(iss_qty)as ttot_iss from ph_sales_master where purchase_id ='$purchase_id' and base='1'";
$res13=mysql_query($sql13);
while($row13=mysql_fetch_array($res13))
{
$ttot_iss=$row13['ttot_iss'];
}
$sql14="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id ='$sales_id' and base='1'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$re_qty=$row14['re_qty'];
}
$sql15="select SUM(return_qty)as re_qty1 from ph_sales_return where ph_sales_id ='$sales_id' and base='0'";
$res15=mysql_query($sql15);
while($row15=mysql_fetch_array($res15))
{
$re_qty1=$row15['re_qty1'];
}

$sql17="select SUM(return_qty)as sre_qty1 from ph_purchase_return where ph_purchase_id ='$pid' and base_type='0'";
$res17=mysql_query($sql17);
while($row17=mysql_fetch_array($res17))
{
$sre_qty1=$row17['sre_qty1'];
}


$tot_strtb_qty=$tot_strtb_qty1-($ttot_iss/$nts)+$re_qty1-$sre_qty1;
$tot_stablet_qty=$tot_stablet_qty1-$ttot_iss-$mm+$re_qty-$sre_qty;

$is_medicine_expire=0;
list($day, $month, $year) = split('[/.-]', $exp_date);
$exp_format_date = "$year-$month-$day";
//if(strtotime($exp_date)<strtotime('+90 days', time()))
if(strtotime($exp_format_date)<time())
{
	$is_medicine_expire=1;
}

?> 
<?php
if($r==0)
{
if($tot_strtb_qty>0)
array_push($referlist,array("purchase_id"=>$row['id'],"medici_name"=>$row['medici_name'],"batch"=>$row['batch'],"mrp"=>$row['mrp'],"unit"=>$row['unit']));
}
else
{
if($tot_strtb_qty1>0)
array_push($referlist,array("purchase_id"=>$row['id'],"medici_name"=>$row['medici_name'],"batch"=>$row['batch'],"mrp"=>$row['mrp'],"unit"=>$row['unit']));
}
?>
<?php


}

if ($q!== "")
{ 
$q=strtolower($q); $len=strlen($q);

$hint='<table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Items</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>MRP</strong></div></td>
	<td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Unit</strong></div></td>
    </tr>';
foreach($referlist as $refer)
{ 
		
if(stristr($q, strtolower(substr($refer['medici_name'],0,$len))) )
{	
$hint.='<tr>
    <td style="padding:2px 4px;"><div align="center"><strong><a  onclick="selectedbox(&#39;'.$refer['purchase_id'].'&#39;,'.'&#39;'.str_replace("'","",$refer['medici_name']).''.'&#39;)" href=# >'.$refer['medici_name'].'</a> </strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong>'.$refer['batch'].'</strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong>'.$refer['mrp'].'</strong></div></td>
	<td style="padding:2px 4px;"><div align="center"><strong>'.$refer['unit'].'</strong></div></td>';
	
$hint.='</tr>';
}
//else
//{
//$hint.="No Medicine";
//}	

}
$hint.='</table>';
}

echo $hint==="" ? "No Item" : $hint;


?>
