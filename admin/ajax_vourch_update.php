<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
echo $voucher_nos=urldecode($_POST["voucher_no"]);
echo $voucher_dates=urldecode($_POST["voucher_date"]);
echo $bill_dates=urldecode($_POST["bill_date"]);
echo $id=$_POST["id"];

$sql2="SELECT * FROM ph_purchase_order where po_no='$id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$po_num=$row2["po_num"];
}
echo $grn_no='MMC/GRN/'.$po_num.'/15-16';

//echo $grn_no='MMC/GRN/10001/15-16';
 
echo $sql_update = "UPDATE ph_purchase_order SET status='0',master_upd='1' WHERE po_no='$id'";
					$qry_update= mysql_query($sql_update);

echo $sql_specialist="UPDATE ph_purchase_master SET voucher_no='$voucher_nos',voucher_date='$voucher_dates',bill_date='$bill_dates',grn_no='$grn_no' WHERE po_no='$id' and status='1'";
$result=mysql_query($sql_specialist);
if($result>0)
echo '1';
else
echo '0';
?>