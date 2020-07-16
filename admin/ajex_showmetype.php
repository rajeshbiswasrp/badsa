<?php
require_once('config/db.php');
session_start();
?>
<?php
$sub = "select * from  ph_type_master"; 
$qry = mysql_query($sub);
$display='';

$display.='<option value="">--Select--</option>';
while($rs=mysql_fetch_array($qry))
{

$display.='<option value="'.$rs['id'].'">'.$rs['type_name'].'</option>';

 }
 echo $display;
 ?>


      
	  