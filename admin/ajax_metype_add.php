<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$civalue=urldecode($_POST["categ_id"]);
$tyvalue=urldecode($_POST["type_name"]);
$id=$_POST["id"];
 
 $dd=(date("Y-m-d"));

if($id==0){
$sql="INSERT INTO ph_type_master (categ_id,type_name,status,date)
VALUES ('$civalue','$tyvalue','1','$dd')";
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
$sql_specialist="UPDATE ph_type_master SET categ_id='$civalue',type_name='$tyvalue',date='$dd' WHERE id='$id'";
$result=mysql_query($sql_specialist);
if($result>0)
echo '1#'.$id;
else
echo '0#0';
}
?>