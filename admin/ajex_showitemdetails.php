<?php
session_start();
require_once('config/db.php');

$r = $_GET['r'];
$purchase_id = $_GET['purchase_id'];
?>
<?php
$sub1 = "select * from  ph_purchase_master where id = '".$_GET['purchase_id']."'ORDER BY id DESC"; 
$qry1 = mysql_query($sub1);
?>
 
<?php while($rs1=mysql_fetch_array($qry1))
{
$pid=$rs1['id'];
$tot_strtb_qty1=$rs1['qty'];
$tot_stablet_qty1=$rs1['total_qty_p'];
$unit=$rs1['unit'];
$mrp=$rs1['mrp'];
$ptr=$rs1['ptr'];
$nts=$rs1['nts'];
$taxpm=$rs1['taxpm'];
$mrp_each_tab=$rs1['total_rate_p'];
$batch=$rs1['batch'];
$base_type=$rs1['base_type'];
}

$sql2="SELECT * FROM ph_sales_master where purchase_id='$pid'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sales_id=$row2['id'];
}

$sql12="select SUM(iss_qty)as stot_iss from ph_sales_master where purchase_id ='".$_GET['purchase_id']."' and base='0'";
$res12=mysql_query($sql12);
while($row12=mysql_fetch_array($res12))
{
$stot_iss=$row12['stot_iss'];
}
$mm=$stot_iss*$nts;


$sql13="select SUM(iss_qty)as ttot_iss from ph_sales_master where purchase_id ='".$_GET['purchase_id']."' and base='1'";
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
$re_qtybb1=$re_qty1*$nts;

$sql17="select SUM(return_qty)as sre_qty1 from ph_purchase_return where ph_purchase_id ='$pid' and base_type='0'";
$res17=mysql_query($sql17);
while($row17=mysql_fetch_array($res17))
{
$sre_qty1=$row17['sre_qty1'];
}

$sql171="select SUM(return_qty)as pr_re from ph_purchase_return where ph_purchase_id ='$pid' and base_type='1'";
$res171=mysql_query($sql171);
while($row171=mysql_fetch_array($res171))
{
$pr_re=$row171['pr_re'];
}
$sql141="select SUM(return_qty)as salere_qty from ph_sales_return where purchase_id ='$pid' and base='1'";
$res141=mysql_query($sql141);
while($row141=mysql_fetch_array($res141))
{
$salere_qty=$row141['salere_qty'];
}



$sre_qty=$nts*$sre_qty1;


$tot_strtb_qty=$tot_strtb_qty1-$stot_iss-$sre_qty1;
$tot_stablet_qty=$tot_stablet_qty1-$ttot_iss-$mm-$sre_qty;


$ttbbox1=$tot_stablet_qty/$nts;
$result123 = fmod($tot_stablet_qty,$nts);
$result1231=floor( $ttbbox1);
$ttbbox2=$result1231.'.'.$result123;


$ttbbox=$ttbbox2+$re_qty1;
$tot_stablet_qty123=$tot_stablet_qty+$re_qtybb1;

$qtyinhandtotpeices=$tot_strtb_qty1-$pr_re+$salere_qty-$ttot_iss;

?> 
<?php
if($base_type==0)
{
if($r==0)
{
//echo $tot_strtb_qty.'^'.$unit.'^'.$ptr.'^'.$ptr.'^'.$batch;
echo $ttbbox.'^'.$unit.'^'.$mrp.'^'.$taxpm.'^'.$ptr.'^'.$batch;
}
else
{
echo $tot_stablet_qty123.'^'.$unit.'^'.$mrp_each_tab.'^'.$taxpm.'^'.$ptr.'^'.$batch;
}
}




else
{
if($r==0)
{
//echo $tot_strtb_qty.'^'.$unit.'^'.$ptr.'^'.$ptr.'^'.$batch;
echo $ttbbox.'^'.$unit.'^'.$mrp.'^'.$taxpm.'^'.$ptr.'^'.$batch;
}
else
{
echo $qtyinhandtotpeices.'^'.$unit.'^'.$mrp.'^'.$taxpm.'^'.$ptr.'^'.$batch;
}

}
?>
