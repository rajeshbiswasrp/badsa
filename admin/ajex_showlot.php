<?php
session_start();
require_once('config/db.php');
?>
<?php
$sub = "select * from  ph_purchase_master where medicine_id = '".$_GET['s']."'"; 
$qry = mysql_query($sub);
?>
<td>
<select name="purchase_id" style="width:155px; margin-left:3px;"  onChange="javascript:showDuration(this.value);">
<option value="">--Select--</option>
<?php while($rs=mysql_fetch_array($qry))
{
$b_type=$rs["for_type"];
if($b_type==1)
{
$btype='M';
}
else
{
$btype='F';
}
?>
<option value="<?php echo $rs['id']?>">Lot - <?php echo $rs['qty']; ?> , <?php echo $btype;?> , <?php echo $rs['size_type']; ?> , Batch -  <?php echo $rs['voucher_no']; ?></option>
<?php }?>
</select>
</td>

      
	  