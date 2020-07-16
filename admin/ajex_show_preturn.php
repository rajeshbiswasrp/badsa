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
$sup_id=$row3['sup_id'];
$medicine_id=$row3['medicine_id'];
$ptr=$row3['ptr'];
$for_type=$row3['for_type'];
$size_type=$row3['size_type'];
$voucher_no=$row3['voucher_no'];

if($for_type==1)
{
$ftype='Male';
}
else
{
$ftype='Female';
}

}

$sql4="select*from ph_supplier_master where id='$sup_id'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$sup_name=$row4['sup_name'];
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
$return_qty='1';
?> 

<?php echo $sup_name.'^'.$ptr.'^'.$medici_name.'^'.$ftype.'^'.$size_type.'^'.$nofp.'^'.$return_qty.'^'.$purchase_id.'^'.$sup_id.'^'.$medicine_id.'^'.$voucher_no; ?>
