<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$voucher_no=$_REQUEST['voucher_no'];
?>


<?php include('header.php'); ?>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->
		<div class="span12">		
			<div class="well well-small">
			<h4>Stock / Supplier Stock Reports Details <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Garments Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>PTR</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Base Type</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Box</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>NTS</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Total Box (Pieces)</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Returned Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Issued Qty</strong></div></td>
    <!--<td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Issu Returned Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Qty in Hand</strong></div></td>-->
  </tr>
<?php
$sql="SELECT * FROM ph_purchase_master where voucher_no='$voucher_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$purchase_qty=$row["qty"];
$total_qty_p=$row["total_qty_p"];
$nts=$row["nts"];
$purchase_id=$row["id"];
$m_id=$row["medicine_id"];
$b_type=$row["base_type"];
if($b_type==0)
{
$btype='Box';
}
else
{
$btype='Pieces';
}

$sql21="SELECT * FROM ph_sales_master where purchase_id='$purchase_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$sales_id=$row21["id"];
}



$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$re_qtyp=$re_qty*$nts;

$sql4="select SUM(iss_qty)as totiss_qty from ph_sales_master where purchase_id='$purchase_id' and base='0'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$totiss_qty=$row4['totiss_qty'];
}
$sql4p="select SUM(iss_qty)as totiss_qtyp from ph_sales_master where purchase_id='$purchase_id' and base='1'";
$res4p=mysql_query($sql4p);
while($row4p=mysql_fetch_array($res4p))
{
$totiss_qtyp=$row4p['totiss_qtyp'];
}
$gg=$totiss_qty*$nts;
$gg2=$gg+$totiss_qtyp;
$ttbbox1=$gg2/$nts;
$result123 = fmod($gg2,$nts);
$result1231=floor( $ttbbox1);
$iittbbox2=$result1231.'.'.$result123;

$sql5="select SUM(return_qty)as issre_qty from ph_sales_return where ph_sales_id='$sales_id' and base='0'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$issre_qty=$row5['issre_qty'];
}
$sql5p="select SUM(return_qty)as issre_qtyp from ph_sales_return where ph_sales_id='$sales_id' and base='1'";
$res5p=mysql_query($sql5p);
while($row5p=mysql_fetch_array($res5p))
{
$issre_qtyp=$row5p['issre_qtyp'];
}
$totinhand=$purchase_qty-$re_qty-$totiss_qty+$issre_qty;
$totinhandp=$total_qty_p-$re_qtyp-$totiss_qtyp+$issre_qtyp;


$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
	if($totinhand>0){
?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["ptr"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $btype; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["nts"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $purchase_qty; ?> (<?php echo $total_qty_p;?>)</strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $iittbbox2; ?> (<?php echo $gg2;?>)</strong></div></td>
    <!--<td style="padding:2px 4px;"><div align="center"><strong><?php //echo $issre_qty; ?> (<?php //echo $issre_qtyp;?>)</strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php //echo $totinhand; ?> (<?php //echo $totinhandp;?>)</strong></div></td>-->
  </tr>
<?php 
}
}
}
?>
</table>
 </div>
           
			</div>
              
              
              
              
		</div>
		
			  	

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>