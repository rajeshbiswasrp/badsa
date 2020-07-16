<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$id=urldecode($_POST["id"]);
$table=urldecode($_POST["table"]);
$sql="SELECT * FROM `$table` WHERE id='$id'";
$result=mysql_query($sql);
if($result){
while($row=mysql_fetch_array($result)){
echo '1?#?'.$row[refer_type].'#@#'.$row[refer_name].'#@#'.$row[under_super].'#@#'.$row[employee_id].'#@#'.$row[mobile].'#@#'.$row[gender].'#@#'.$row[dob].'#@#'.$row[address].'#@#'.$row[email].'';
}
}
else
{
	echo '0?#?0';
}

?>