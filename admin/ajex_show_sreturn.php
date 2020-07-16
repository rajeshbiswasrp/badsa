<?php
session_start();
require_once('config/db.php');
?>
<?php
$sub1 = "select * from  barcod_master where barcode='".$_GET['y']."' and status='0'"; 
$qry1 = mysql_query($sub1);
?>
 
<?php while($rs1=mysql_fetch_array($qry1))
{
$purchase_id=$rs1['purchase_id'];
}

$sql3="select*from ph_sales_master where barcode='".$_GET['y']."'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$sale_id=$row3['id'];
$pati_id=$row3['pati_id'];
$medicine_id=$row3['medicine_id'];
$mrp=$row3['mrp'];
$size_type=$row3['size_type'];
$for_type=$row3['for_type'];
$invoice_no=$row3['invoice_no'];
}

$sql4="select*from ph_patient_master where id='$pati_id'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$pati_name=$row4['pati_name'];
}

$sql5="select*from ph_medicine_master where id='$medicine_id'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$medici_name=$row5['medici_name'];
}
$return_qty='1';
?> 

<?php echo $pati_name.'^'.$mrp.'^'.$medici_name.'^'.$for_type.'^'.$size_type.'^'.$return_qty.'^'.$purchase_id.'^'.$pati_id.'^'.$medicine_id.'^'.$sale_id.'^'.$invoice_no; ?>
