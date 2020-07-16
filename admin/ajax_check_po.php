<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$sqln="select * from ph_purchase_order where status ='1'";
$resn=mysql_query($sqln);

if(mysql_num_rows($resn)>0)
echo '1';
else
echo '0';

?>