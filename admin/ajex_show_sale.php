<?php
session_start();
require_once('config/db.php');
?>
<?php
$sub1 = "select * from  barcod_master where barcode='".$_GET['y']."' and status='1'"; 
$qry1 = mysql_query($sub1);
?>
 
<?php while($rs1=mysql_fetch_array($qry1))
{
$purchase_id=$rs1['purchase_id'];
}

$sql3="select*from ph_purchase_master where id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$medicine_id=$row3['medicine_id'];
$mrp=$row3['mrp'];
$size_type=$row3['size_type'];
$for_type=$row3['for_type'];
if($for_type==1)
{
$ftype='Male';
}
else
{
$ftype='Female';
}
}


$sql5="select*from ph_medicine_master where id='$medicine_id'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$medici_name=$row5['medici_name'];
}
$sqln="select*from barcod_master where purchase_id='$purchase_id' and status='1'";
$resn=mysql_query($sqln);
$nofp=mysql_num_rows($resn);
$rown=mysql_fetch_assoc($resn);

$sale_qty='1';
?> 

<?php echo $mrp.'^'.$medici_name.'^'.$size_type.'^'.$ftype.'^'.$nofp.'^'.$sale_qty.'^'.$purchase_id.'^'.$medicine_id; ?>
