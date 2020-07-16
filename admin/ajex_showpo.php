<?php
require_once('config/db.php');
session_start();
?>
<?php
$po_no = $_GET['p'];
$sql_update = "UPDATE ph_purchase_master SET status='1' WHERE po_no='$po_no' and status='0'";
					$qry_update= mysql_query($sql_update);

if(qry_update)
{
echo '1';
}
else
{
echo '0';
}
?>      
	  
