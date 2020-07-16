<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$pati_namev=urldecode($_POST["pati_name"]);
$addressv=urldecode($_POST["address"]);
$mobilev=urldecode($_POST["mobile"]);
$emailv=urldecode($_POST["email"]);
$id=$_POST["id"];
 
 $dd=(date("Y-m-d"));

if($id==0){
$sql="INSERT INTO ph_patient_master (pati_name,address,mobile,email,status,date)
VALUES ('$pati_namev','$addressv','$mobilev','$emailv','1','$dd')";
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
$sql_specialist="UPDATE ph_patient_master SET pati_name='$pati_namev',address='$addressv',mobile='$mobilev',email='$emailv',date='$dd' WHERE id='$id'";
$result=mysql_query($sql_specialist);
if($result>0)
echo '1#'.$id;
else
echo '0#0';
}
?>