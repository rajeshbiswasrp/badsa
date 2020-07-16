<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$categ_id=$_GET['categ_id'];
$type_id=$_GET['type_id'];
$medici_name=urldecode($_GET['medici_name']);

$sqln="select * from ph_medicine_master where `categ_id` ='$categ_id' and `type_id` ='$type_id' and `medici_name` = '$medici_name' and `status` = '1' ";
$resn=mysql_query($sqln);

if(mysql_num_rows($resn)>0)
echo '1';
else
echo '0';

?>