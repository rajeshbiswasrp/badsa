<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>

<?php include('header.php'); ?>

<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<link rel="stylesheet" href="../themes/base/jquery.ui.all.css">
	<script src="js/jquery-1.7.2.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.datepicker.js"></script>

<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
	$(function() {
		$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
function opensuprepotdoc(dt,dt1){
window.location="ph_item_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>  
 
<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        		
			<div class="well well-small">
			<h4>Stock / Item Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
<br />	
 <div id="txtHint">
</div> 
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Item Name</strong></th>
      <th colspan="3"><strong>Total Purchased Qty</strong></th>
      <th colspan="3"><strong>Purchased Return</strong></th>
      <th colspan="3"><strong>Total Sale Qty</strong></th>
      <th colspan="3"><strong>Sale Return</strong></th>
      <th colspan="3"><strong>Qty in Hand</strong></th>
      
    </tr>
        </tbody>
<tbody>           
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      <th><strong>Male</strong></th>
      <th><strong>Female</strong></th>
      <th><strong>Total</strong></th>
      
    </tr>
	

<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;
$sum9=0;
$sum10=0;
$sum11=0;
$sum12=0;
$sum13=0;
$sum14=0;
$sum15=0;
$c=1;

$sqli = "SELECT DISTINCT medicine_id FROM ph_purchase_master";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$medicine_id=$rowi['medicine_id'];

$sql="SELECT * FROM ph_purchase_master where medicine_id='$medicine_id'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
}
					
$sql2="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql41="select SUM(qty)as totp_pqtymale from ph_purchase_master where medicine_id='$medicine_id' and for_type='1'";
$res41=mysql_query($sql41);
while($row41=mysql_fetch_array($res41))
{
$totp_pqtymale=$row41['totp_pqtymale'];
}
$sql42="select SUM(qty)as totp_pqtyfemale from ph_purchase_master where medicine_id='$medicine_id' and for_type='0'";
$res42=mysql_query($sql42);
while($row42=mysql_fetch_array($res42))
{
$totp_pqtyfemale=$row42['totp_pqtyfemale'];
}
$sql4="select SUM(qty)as totp_pqty from ph_purchase_master where medicine_id='$medicine_id'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$totp_pqty=$row4['totp_pqty'];
}
$tot_purch_qty=$totp_pqty;


$sql51="select SUM(return_qty)as totpp_returnmale from ph_purchase_return where medicine_id='$medicine_id' and for_type='Male'";
$res51=mysql_query($sql51);
while($row51=mysql_fetch_array($res51))
{
$totpp_returnmale=$row51['totpp_returnmale'];
}
$sql52="select SUM(return_qty)as totpp_returnfemale from ph_purchase_return where medicine_id='$medicine_id' and for_type='Female'";
$res52=mysql_query($sql52);
while($row52=mysql_fetch_array($res52))
{
$totpp_returnfemale=$row52['totpp_returnfemale'];
}
$sql5="select SUM(return_qty)as totpp_return from ph_purchase_return where medicine_id='$medicine_id'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$totpp_return=$row5['totpp_return'];
}

$sql61="select SUM(sale_qty)as tot_saleppmale from ph_sales_master where medicine_id='$medicine_id' and for_type='Male'";
$res61=mysql_query($sql61);
while($row61=mysql_fetch_array($res61))
{
$tot_saleppmale=$row61['tot_saleppmale'];
}
$sql62="select SUM(sale_qty)as tot_saleppfemale from ph_sales_master where medicine_id='$medicine_id' and for_type='Female'";
$res62=mysql_query($sql62);
while($row62=mysql_fetch_array($res62))
{
$tot_saleppfemale=$row62['tot_saleppfemale'];
}
$sql6="select SUM(sale_qty)as tot_salepp from ph_sales_master where medicine_id='$medicine_id'";
$res6=mysql_query($sql6);
while($row6=mysql_fetch_array($res6))
{
$tot_salepp=$row6['tot_salepp'];
}

$sql71="select SUM(return_qty)as tot_sale_returnmale from ph_sale_return where medicine_id='$medicine_id' and for_type='Male'";
$res71=mysql_query($sql71);
while($row71=mysql_fetch_array($res71))
{
$tot_sale_returnmale=$row71['tot_sale_returnmale'];
}
$sql72="select SUM(return_qty)as tot_sale_returnfemale from ph_sale_return where medicine_id='$medicine_id' and for_type='Female'";
$res72=mysql_query($sql72);
while($row72=mysql_fetch_array($res72))
{
$tot_sale_returnfemale=$row72['tot_sale_returnfemale'];
}
$sql7="select SUM(return_qty)as tot_sale_return from ph_sale_return where medicine_id='$medicine_id'";
$res7=mysql_query($sql7);
while($row7=mysql_fetch_array($res7))
{
$tot_sale_return=$row7['tot_sale_return'];
}
$tot_manes=$totpp_return+$tot_salepp;
$tot_qty_hand=$tot_purch_qty+$tot_sale_return-$tot_manes;

$tot_manesmale=$totpp_returnmale+$tot_saleppmale;
$tot_qty_handmale=$totp_pqtymale+$tot_sale_returnmale-$tot_manesmale;

$tot_manesfemale=$totpp_returnfemale+$tot_saleppfemale;
$tot_qty_handfemale=$totp_pqtyfemale+$tot_sale_returnfemale-$tot_manesfemale;

if($tot_qty_hand>0)
{
$sum=$sum+$totp_pqtymale;
$sum2=$sum2+$totp_pqtyfemale;
$sum3=$sum3+$tot_purch_qty;
$sum4=$sum4+$totpp_returnmale;
$sum5=$sum5+$totpp_returnfemale;
$sum6=$sum6+$totpp_return;
$sum7=$sum7+$tot_saleppmale;
$sum8=$sum8+$tot_saleppfemale;
$sum9=$sum9+$tot_salepp;
$sum10=$sum10+$tot_sale_returnmale;
$sum11=$sum11+$tot_sale_returnfemale;
$sum12=$sum12+$tot_sale_return;
$sum13=$sum13+$tot_qty_handmale;
$sum14=$sum14+$tot_qty_handfemale;
$sum15=$sum15+$tot_qty_hand;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $row2["medici_name"]; ?></td>
      <td><?php echo $totp_pqtymale; ?></td>
      <td><?php echo $totp_pqtyfemale; ?></td>
      <td><?php echo $tot_purch_qty; ?></td>
      <td><?php echo $totpp_returnmale; ?></td>
      <td><?php echo $totpp_returnfemale; ?></td>
      <td><?php echo $totpp_return; ?></td>
      <td><?php echo $tot_saleppmale; ?></td>
      <td><?php echo $tot_saleppfemale; ?></td>
      <td><?php echo $tot_salepp; ?></td>
      <td><?php echo $tot_sale_returnmale; ?></td>
      <td><?php echo $tot_sale_returnfemale; ?></td>
      <td><?php echo $tot_sale_return; ?></td>
      <td><?php echo $tot_qty_handmale; ?></td>
      <td><?php echo $tot_qty_handfemale; ?></td>
      <td><?php echo $tot_qty_hand; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
}
?>
<tr>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum; ?></strong></th>
      <th><strong><?php echo $sum2; ?></strong></th>
      <th><strong><?php echo $sum3; ?></strong></th>
      <th><strong><?php echo $sum4; ?></strong></th>
      <th><strong><?php echo $sum5; ?></strong></th>
      <th><strong><?php echo $sum6; ?></strong></th>
      <th><strong><?php echo $sum7; ?></strong></th>
      <th><strong><?php echo $sum8; ?></strong></th>
      <th><strong><?php echo $sum9; ?></strong></th>
      <th><strong><?php echo $sum10; ?></strong></th>
      <th><strong><?php echo $sum11; ?></strong></th>
      <th><strong><?php echo $sum12; ?></strong></th>
      <th><strong><?php echo $sum13; ?></strong></th>
      <th><strong><?php echo $sum14; ?></strong></th>
      <th><strong><?php echo $sum15; ?></strong></th>
      
    </tr>
    <tr>
      <td colspan="20" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensuprepotdoc('<?php echo $date;?>','<?php echo $date1;?>');" target="_blank" /></td>
             
  </tr>
</tbody>   
</table>	




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