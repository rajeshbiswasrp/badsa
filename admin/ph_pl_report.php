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
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        		
			<div class="well well-small">
			<h4>P / L Reports<small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_pl_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered" id="datesearch">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
 
		
		
		<br/>
			
	
<div id="serachindividualtype" style="display:none;">
<label>Search Patient</label>
Summary Report<input checked="checked" style="margin-right:5px;" type="radio" name="searchtype" id="searchtype" value="0">Details Report<input type="radio" name="searchtype" id="searchtype1" value="1">
</div>
 </form>
<br />
<?php
if($_POST["submit"])
{

$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $dt=$date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $dt1=$date1 = "$year-$month-$day";
?>
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">PURCHASE DETAILS</span></td>
      <td><span style="font-weight: bold">Date Range</span></td>
      <td><span style="font-weight: bold"><?php echo $dtt;  ?> - <?php echo $dtt1;  ?></span></td>
    </tr>
  </table>
<br />
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Purchase Date</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Net Amt.</strong></th>
<!--      <th><strong>Tax Amt.</strong></th>
      <th><strong>Gross Amt.</strong></th>-->
    </tr>
        </tbody>
<tbody>         


<?php
$sum=0;
$sumt=0;
$sumn=0;
$c=1;
$sqli = "SELECT DISTINCT voucher_no,sup_id,date FROM ph_purchase_master where date between '$date' and '$date1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$sup_id=$rowi['sup_id'];
$voucher_no=$rowi['voucher_no'];

$sql = "SELECT * FROM ph_supplier_master where id='$sup_id'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$sql2="select SUM(net_rate)as tot_rate from ph_purchase_master where voucher_no='$voucher_no'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$tot_rate=$row2['tot_rate'];
}
$sum=$sum+$tot_rate;
$sql2t="select SUM(vat_amt)as tax_rate from ph_purchase_master where voucher_no='$voucher_no'";
$res2t=mysql_query($sql2t);
while($row2t=mysql_fetch_array($res2t))
{
$tax_rate=$row2t['tax_rate'];
}

$net_rate=$tot_rate+$tax_rate;

//$sumt=$sumt+$tax_rate;
$sumn=$sumn+$tot_rate;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowi["date"]; ?></td>
      <td><?php echo $row["sup_name"]; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><?php echo $tot_rate; ?></td>
      <!--<td><?php //echo $tax_rate; ?></td>
      <td><?php // echo $net_rate; ?></td>-->
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum;?></strong></th>
    </tr>
</tbody>     
</table>	
<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">PURCHASE RETURN DETAILS</span></td>
    </tr>
  </table>
<br />	
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Return Date</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Return No.</strong></th>
      <th><strong>Return Qty</strong></th>
      <th><strong>Return Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum2=0;
$c=1;

$sql3 = "SELECT * FROM  ph_purchase_return where date between '$date' and '$date1' and return_qty!='0'";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3))
{
$ph_purchase_id=$row3['ph_purchase_id'];

$sqlii = "SELECT * FROM ph_purchase_master where id='$ph_purchase_id'";
$resultii = mysql_query($sqlii);
while($rowii = mysql_fetch_array($resultii))
{
$sup_id=$rowii['sup_id'];
$voucher_no=$rowii['voucher_no'];
$ptr=$rowii['ptr'];
$r_qty=$row3["return_qty"];
$retu_amt=$ptr*$r_qty;
$sum2=$sum2+$retu_amt;

$sql = "SELECT * FROM ph_supplier_master where id='$sup_id'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row3["date"]; ?></td>
      <td><?php echo $row["sup_name"]; ?></td>
      <td><?php echo $rowii["voucher_no"]; ?></td>
      <td><?php echo $row3["return_no"]; ?></td>
      <td><?php echo $row3["return_qty"]; ?></td>
      <td><?php echo $retu_amt; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum2;?></strong></th>
    </tr>

</tbody>     
</table>	 
<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">PURCHASE DISCOUNT</span></td>
    </tr>
  </table>
<br />	
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Purchase Date</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Discount Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum3=0;
$c=1;
$sqlid = "SELECT DISTINCT voucher_no,sup_id,date FROM ph_purchase_master where date between '$date' and '$date1' and dico_per!=''";
$resultid = mysql_query($sqlid);
while($rowid = mysql_fetch_array($resultid))
{
$sup_id=$rowid['sup_id'];
$voucher_no=$rowid['voucher_no'];

$sql = "SELECT * FROM ph_supplier_master where id='$sup_id'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$sql2="select SUM(dis_amt)as dis_rate from ph_purchase_master where voucher_no='$voucher_no'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$dis_rate=$row2['dis_rate'];
}
$sum3=$sum3+$dis_rate;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowid["date"]; ?></td>
      <td><?php echo $row["sup_name"]; ?></td>
      <td><?php echo $rowid["voucher_no"]; ?></td>
      <td><?php echo $dis_rate; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum3;?></strong></th>
    </tr>
</tbody>     
</table>
<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">PURCHASE PAYMENT</span></td>
    </tr>
  </table>
<br />
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Payment Date</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Payment Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum4=0;
$c=1;
$sqlip = "SELECT * FROM ph_supplier_payment where date between '$date' and '$date1'";
$resultip = mysql_query($sqlip);
while($rowip = mysql_fetch_array($resultip))
{

$voucher_no=$rowip['voucher_no'];

$sqlm = "SELECT * FROM ph_purchase_master where voucher_no='$voucher_no'";
$resultm = mysql_query($sqlm);
while($rowm = mysql_fetch_array($resultm))
{
$sup_id=$rowm['sup_id'];
}

$sqls = "SELECT * FROM ph_supplier_master where id='$sup_id'";
$results = mysql_query($sqls);
while($rows = mysql_fetch_array($results))
{
$tot_pay=$rowip["less_pay"];
$sum4=$sum4+$tot_pay;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowip["date"]; ?></td>
      <td><?php echo $rows["sup_name"]; ?></td>
      <td><?php echo $rowip["voucher_no"]; ?></td>
      <td><?php echo $rowip["less_pay"]; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum4;?></strong></th>
    </tr>
</tbody>     
</table>

<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">SALE DETAILS</span></td>
    </tr>
  </table>
<br />

<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Sale Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Receipt Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum5=0;
$c=1;
$sqlips = "SELECT DISTINCT invoice_no,pati_id,date,receipt_no FROM ph_sales_master where date between '$date' and '$date1'";
$resultips = mysql_query($sqlips);
while($rowips = mysql_fetch_array($resultips))
{
$pati_id=$rowips['pati_id'];
$invoice_no=$rowips['invoice_no'];
$receipt_no=$rowips['receipt_no'];

$sqlp = "SELECT * FROM ph_patient_master where id='$pati_id'";
$resultp = mysql_query($sqlp);
while($rowp = mysql_fetch_array($resultp))
{
$sql2="select SUM(gross_amt)as tot_rate from ph_sales_master where invoice_no='$invoice_no'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$tot_ratess=$row2['tot_rate'];
}
$sum5=$sum5+$tot_ratess;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowips["date"]; ?></td>
      <td><?php echo $rowp["pati_name"]; ?></td>
      <td><?php echo $rowips["receipt_no"]; ?></td>
      <td><?php echo $tot_ratess; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum5;?></strong></th>
    </tr>
</tbody>     
</table>

<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">SALE RETURN DETAILS</span></td>
    </tr>
  </table>
<br />	

<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Return Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Return No.</strong></th>
      <th><strong>Return Qty</strong></th>
      <th><strong>Return Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum6=0;
$c=1;

$sql3r = "SELECT * FROM  ph_sales_return where date between '$date' and '$date1'";
$result3r = mysql_query($sql3r);
while($row3r = mysql_fetch_array($result3r))
{
$ph_sales_id=$row3r['ph_sales_id'];

$sqliir = "SELECT * FROM ph_sales_master where id='$ph_sales_id'";
$resultiir = mysql_query($sqliir);
while($rowiir = mysql_fetch_array($resultiir))
{
$pati_id=$rowiir['pati_id'];
$invoice_no=$rowiir['invoice_no'];
$receipt_no=$rowiir['receipt_no'];
$mrp=$rowiir['mrp'];
$r_qtys=$row3r["return_qty"];
$retu_amts=$mrp*$r_qtys;
$sum6=$sum6+$retu_amts;

$sql = "SELECT * FROM ph_patient_master where id='$pati_id'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row3r["date"]; ?></td>
      <td><?php echo $row["pati_name"]; ?></td>
      <td><?php echo $rowiir["receipt_no"]; ?></td>
      <td><?php echo $row3r["return_no"]; ?></td>
      <td><?php echo $row3r["return_qty"]; ?></td>
      <td><?php echo $retu_amts; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum6;?></strong></th>
    </tr>

</tbody>     
</table>
<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">SALE DISCOUNT</span></td>
    </tr>
  </table>
<br />	
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Sale Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Discount Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum7=0;
$c=1;
$sqlids = "SELECT DISTINCT invoice_no,pati_id,date,receipt_no FROM ph_sales_master where date between '$date' and '$date1' and dico_per!=''";
$resultids = mysql_query($sqlids);
while($rowids = mysql_fetch_array($resultids))
{
$pati_id=$rowids['pati_id'];
$invoice_no=$rowids['invoice_no'];

$sql = "SELECT * FROM ph_patient_master where id='$pati_id'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
{
$sql2s="select SUM(dis_amt)as dis_rate from ph_sales_master where invoice_no='$invoice_no'";
$res2s=mysql_query($sql2s);
while($row2s=mysql_fetch_array($res2s))
{
$dis_rates=$row2s['dis_rate'];
}
$sum7=$sum7+$dis_rates;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowids["date"]; ?></td>
      <td><?php echo $row["pati_name"]; ?></td>
      <td><?php echo $rowids["receipt_no"]; ?></td>
      <td><?php echo $dis_rates; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum7;?></strong></th>
    </tr>
</tbody>     
</table>

<br />
<table class="table table-hover table-striped table-bordered">
    <tr>
    <td colspan="2"><span style="font-weight: bold">SALE PAYMENT</span></td>
    </tr>
  </table>
<br />
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Payment Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Invoice No.</strong></th>
      <th><strong>Payment Amt.</strong></th>
    </tr>
        </tbody>
<tbody>         


<?php
$sum8=0;
$c=1;
$sqlipp = "SELECT * FROM ph_sales_payment where date between '$date' and '$date1'";
$resultipp = mysql_query($sqlipp);
while($rowipp = mysql_fetch_array($resultipp))
{

$invoice_no=$rowipp['invoice_no'];

$sqlms = "SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$resultms = mysql_query($sqlms);
while($rowms = mysql_fetch_array($resultms))
{
$pati_id=$rowms['pati_id'];
}

$sqls = "SELECT * FROM ph_patient_master where id='$pati_id'";
$results = mysql_query($sqls);
while($rows = mysql_fetch_array($results))
{
$tot_pays=$rowipp["less_pay"];
$sum8=$sum8+$tot_pays;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowipp["date"]; ?></td>
      <td><?php echo $rows["pati_name"]; ?></td>
      <td><?php echo $rowipp["invoice_no"]; ?></td>
      <td><?php echo $rowipp["less_pay"]; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>    
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum8;?></strong></th>
    </tr>
</tbody>     
</table>
<br />
<table class="table table-hover table-striped table-bordered">
 <tr>
<td colspan="4"><div align="right"><strong>Total Purchase Amount</strong></div></td>
<td><strong><?php echo $tot_pp=$sumn-$sum2-$sum3;?></strong></td>
 </tr> 
 
 <tr>
<td colspan="4"><div align="right"><strong>Total Supplier Paid Amount</strong></div></td>
<td><strong><?php echo $sum4;?></strong></td>
    </tr> 
    
    <tr>
<td colspan="4"><div align="right"><strong>Total Supplier Due Amount</strong></div></td>
<td><strong><?php echo $totsdue=$tot_pp-$sum4;?></strong></td>
    </tr> 
<tr>
<td colspan="4"><div align="right"><strong>Total Sale Amount</strong></div></td>
<td><strong><?php echo $totsamt=$sum5-$sum6-$sum7;?></strong></td>
    </tr>
<tr>
<td colspan="4"><div align="right"><strong>Net Profit Amount</strong></div></td>
<td><strong><?php echo $totprofit=$totsamt-$tot_pp;?></strong></td>
    </tr>  
  </table>
<?php 
}
?>	
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