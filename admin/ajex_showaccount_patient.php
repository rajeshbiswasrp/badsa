<?php
session_start();
require_once('config/db.php');
$bank_name=$_GET['y'];
?>

<?php
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where bank_name ='".$_GET['y']."'"));
?>
<?php echo $select['acc_no']; ?>

<?php
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where bank_name2 ='".$_GET['y']."'"));
?>
<?php echo $select['acc_no2']; ?>

<?php
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where bank_name3 ='".$_GET['y']."'"));
?>
<?php echo $select['acc_no3']; ?>
