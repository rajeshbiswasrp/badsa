<?php
session_start();
require_once('config/db.php');
?>
<?php
$sub1 = "select * from  barcod_master where purchase_id = '".$_GET['y']."' and status='1'"; 
$qry1 = mysql_query($sub1);
$nu_rows = mysql_num_rows($qry1);
?>
 
<?php while($rs1=mysql_fetch_array($qry1))
{
$quantity=$rs1['quantity'];
}

?> 

<?php echo $quantity.'^'.$nu_rows; ?>
