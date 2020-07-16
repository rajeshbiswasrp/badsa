<?php
require_once('config/db.php');

$sql1="select SUM(dis_amt)as disss_amt from ph_return_credit where for_witch='1' and pati_id='".$_GET['q']."'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$disss_amt=$row1['disss_amt'];
}

$sql4="select SUM(mrp)as tot_retun_amt from ph_return_credit where for_witch='1' and pati_id='".$_GET['q']."'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$tot_retun_amt=$row4['tot_retun_amt'];
}
$sql5="select SUM(mrp)as tot_sale_amt from ph_return_credit where for_witch='0' and pati_id='".$_GET['q']."'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$tot_sale_amt=$row5['tot_sale_amt'];
}
$totcredit_amt=$tot_retun_amt-$tot_sale_amt-$disss_amt;

?>
<td>
<input type="text" name="credit_amt" id="credit_amt" style="width:70px; margin-bottom:0px;" value="<?php echo $totcredit_amt; ?>" readonly="readonly" />
</td>
