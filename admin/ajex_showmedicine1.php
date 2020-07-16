<?php
require_once('config/db.php');
session_start();
?>
<?php
$sub="SELECT  ph_purchase_master.*,ph_medicine_master.drug_name,ph_medicine_master.medici_name,ph_medicine_master.id as mm_id from ph_purchase_master left join ph_medicine_master on ph_purchase_master.medicine_id=ph_medicine_master.id ORDER BY ph_purchase_master.id ASC";
 
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
	  