<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php

$sql_del="delete from `$_POST[table]` where `id`='$_POST[id]' ";
$result=mysql_query($sql_del);
if($result)
echo '1';
else
echo '0';
?>