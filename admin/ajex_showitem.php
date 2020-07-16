<?php
require_once('config/db.php');

$sub = "select * from  ph_category_master where id = '".$_GET['q']."'"; 
 $qry = mysql_query($sub);
 while($cres=mysql_fetch_assoc($qry))
 {
 $c_id=$cres['id'];
 }
 $sql4="select*from ph_medicine_master where categ_id='$c_id'";
$res4=mysql_query($sql4);

?>
<td>
<select name="medicine_id" style="width:155px; margin-left:3px;" onchange="javascript:showPlan2(this.value);">
<option value="">--Select--</option>
<?php 
while($row4=mysql_fetch_array($res4))
{
?>
<option value="<?php echo $row4['id']?>"><?php echo $row4['medici_name']; ?></option>
<?php }?>
</select>
</td>
