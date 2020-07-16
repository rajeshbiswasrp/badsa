<?php
session_start();
require_once('config/db.php');
$uname=$_REQUEST["username"];
$pssd=$_REQUEST["password"];

$sql1="SELECT * FROM test where id='1'";
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
$log_date=$row1["date"];
}
$dd=(date("Y-m-d"));

if($dd<$log_date)
{

$sql="SELECT * FROM employee_master WHERE user_name='$uname' and user_psswd='$pssd'";
$result=mysql_query($sql) or die(mysql_error());
$i=mysql_num_rows($result);
if($i)
{
	$row=mysql_fetch_assoc($result);
	$nm=$row["user_name"];
	$_SESSION["ss_name"]=$nm;
	//echo $_SESSION["ss_name"];
	//exit();
	$jtyp=$row["job_role"];
	$_SESSION["ss_jrole"]=$jtyp;
	
	$user_id=$row["emp_id"];
	$_SESSION["user_id"]=$user_id;
	
	$u_type=$row["user_type"];
	$_SESSION["u_type"]=$u_type;
	

	if($jtyp=="user")
	{
		header("location: ../user/dashboard.php");
	}
	
	elseif($jtyp=="admin")
	{
		//$_SESSION['check']=$ps;
		header("location: pharmacy_management.php");
	}
	
	else
	{
		header("location: index.php");
	}
}
else
{
	header("location: index.php");
}
}
else
{
	header("location: index.php");
}
?>
