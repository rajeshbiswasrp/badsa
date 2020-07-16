<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$ccvalue=urldecode($_POST["categ_name"]);
$id=$_POST["id"];
 
 $dd=(date("Y-m-d"));

if($id==0){
$sql="INSERT INTO ph_category_master (categ_name,status,date)
VALUES ('$ccvalue','1','$dd')";
$result=mysql_query($sql);
if($result){
$last_id = mysql_insert_id();
echo '1#'.$last_id;
}
else
{
echo "0#0";
}

}
else
{
$sql_specialist="UPDATE ph_category_master SET categ_name='$ccvalue',date='$dd' WHERE id='$id'";
$result=mysql_query($sql_specialist);
if($result>0)
echo '1#'.$id;
else
echo '0#0';
}
?>