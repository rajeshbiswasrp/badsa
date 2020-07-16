<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$id=urldecode($_POST["referertableid"]);
$refer_type=urldecode($_POST["refer_type"]);
 $join_date=urldecode($_POST["join_date"]);
 $refer_name=urldecode($_POST["refer_name"]);
 $under_super=urldecode($_POST["under_super"]);
 $employee_id=urldecode($_POST["employee_id"]);
 $mobile=urldecode($_POST["mobile"]);
 $gender=urldecode($_POST["gender"]);
 $dob=urldecode($_POST["dob"]);
 $address=urldecode($_POST["address"]);
 $email=urldecode($_POST["email"]);
 
 $dd=(date("Y-m-d"));
$code='KAL/';

if($id==0){
$sql="INSERT INTO refer_master (refer_id,refer_type,join_date,refer_name,under_super,employee_id,mobile,gender,dob,address,email,status,date)
VALUES ('','$refer_type','$join_date','$refer_name','$under_super','$employee_id','$mobile','$gender','$dob','$address','$email','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
if($result>0)
				{
					$refer_id=$code.$refer_type.'/'.$last_id;
					$sql_update = "UPDATE refer_master SET refer_id='$refer_id' WHERE id='$last_id'";
					$qry_update= mysql_query($sql_update);


echo '1#'.$last_id;
}else echo '0#0';
}
else
{
$sql_referer="UPDATE refer_master SET refer_type='$refer_type',refer_name='$refer_name',under_super='$under_super',employee_id='$employee_id',mobile='$mobile',gender='$gender',dob='$dob',address='$address',email='$email',date='$dd' WHERE id='$id'";
$result=mysql_query($sql_referer);
if($result>0)
echo '1#$id';
else
echo '0#0';
}
?>