<?php
require_once('config/db.php');
session_start();
?>
<?php
$sub="SELECT * from ph_medicine_master";
 
$qry = mysql_query($sub);
?>
<?php
$val ='<option value="">--Select--</option>';
?>
<?php while($rs=mysql_fetch_array($qry))
{
?>
<?php
$val.= '<option value="'.$rs["id"].'">'.$rs["medici_name"].'</option>';
?>
<?php }?>
<?php
echo $val;
?>     
	  