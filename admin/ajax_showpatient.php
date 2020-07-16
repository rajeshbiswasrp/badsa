<?php
require_once('config/db.php');
session_start();
?>
<?php
if(isset($_GET['s']) && $_GET['s']!='')
{
if($_GET['s']=='0')	
$sub = "select * from  ph_patient_master"; 
else
$sub = "select * from  patient_master";
}
$qry = mysql_query($sub);

$display='';

$display.='<option value="">--Select--</option>';
while($rs=mysql_fetch_array($qry))
{

$display.='<option value="'.$rs['id'].'">'.$rs['pati_name'].'</option>';

 }
 echo $display;
 ?>
	  