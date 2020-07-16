<?php
require_once('config/db.php');
$sql4="select * from ph_type_master where categ_id='".$_GET['k']."'";
$res4=mysql_query($sql4);

?>
<td>
<option value="">--Select--</option>
<?php 
while($row4=mysql_fetch_array($res4))
{
?>
<option value="<?php echo $row4['id']?>"><?php echo $row4['type_name']; ?></option>
<?php }  ?>
</td>
