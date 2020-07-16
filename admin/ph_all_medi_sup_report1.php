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
function showHint(str)
{
//alert(str);
if(str==""){
	//window.location="products.php";
	}
var xmlhttp;
if (str.length==0)
  { 
  
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("product-table").style.display='none';
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_search_supplier.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function opensuprepotdoc(dt,dt1){
window.location="ph_sup_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>
<script>
function opensearchsuprepotdoc(searchval){
window.location="ph_sup_report_print.php?searchsupplier="+encodeURIComponent(searchval);
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
			<h4>Stock Medicine Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_all_medi_sup_report1.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
  </form>
<br/>		
	  			
		
			
	</div>
    
<!--<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Search Actions" type="text"   onkeyup="showHint(this.value)" style="border:solid 1px #999;"/>-->
<br />	
 <div id="txtHint">
</div> 
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date of Purchase </strong></th>
      <th><strong>Medicine Name </strong></th>
      <th><strong>Purchase Qty</strong></th>
      <th><strong>Purchase Re Qty</strong></th>
      <th><strong>PTR</strong></th>
      <th><strong>Net Amt</strong></th>
      <th><strong>Expire Date</strong></th>
      <th><strong>MRP</strong></th>
      <th><strong>Issue Qty</strong></th>
      <th><strong>Total Sale Amt</strong></th>
      <th><strong>Qty In Hand</strong></th>
      <th><strong>Total Stock Amt</strong></th>
      <th><strong>Profit %</strong></th>
      <th><strong>Profit Amt</strong></th>
    </tr>
        </tbody>
<tbody>           
<?php
if($_POST["submit"])
{

$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
?>
	

<?php
$c=1;
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;

$sql="SELECT * FROM ph_purchase_master where date between '$date' and '$date1'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$medicine_id=$row["medicine_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
$sql2="SELECT * FROM ph_medicine_master where id = '$medicine_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql4="SELECT SUM(return_qty)as tot_srqty FROM ph_purchase_return where ph_purchase_id = '$purchase_id'";
$result4=mysql_query($sql4);
while($row4=mysql_fetch_array($result4))
{
$tot_srqty=$row4["tot_srqty"];
}

$sql5="SELECT SUM(iss_qty)as tot_issqty FROM ph_sales_master where purchase_id = '$purchase_id'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
$tot_issqty=$row5["tot_issqty"];
}
$tot_use_qty=$tot_srqty+$tot_issqty;

$sql1="SELECT * FROM ph_sales_master where purchase_id = '$purchase_id'";
$result1=mysql_query($sql1);
while($row1=mysql_fetch_array($result1))
{
$sale_id=$row1["id"];
}

$sql6="SELECT SUM(return_qty)as tot_salerqty FROM ph_sales_return where ph_sales_id = '$sale_id'";
$result6=mysql_query($sql6);
while($row6=mysql_fetch_array($result6))
{
$tot_salerqty=$row6["tot_salerqty"];
}

$p_qty=$row["tot_qty"];
$all_qty=$p_qty+$tot_salerqty;
$qih=$all_qty-$tot_use_qty;

$iss_qty=$p_qty-$qih-$tot_srqty;
$mrp=$row["mrp"];
$tot_sale_amt=$mrp*$iss_qty;
$tot_stock_amt=$qih*$mrp;

$ptr=$row["ptr"];

$profit_amt=$mrp-$ptr;
$profit_per=$profit_amt*100/$ptr;

$sum=$sum+$p_qty;
$tot_amm=$row["gross_rate"];
$sum2=$sum2+$tot_amm;
$sum3=$sum3+$iss_qty;
$sum4=$sum4+$tot_sale_amt;
$sum5=$sum5+$qih;
$sum6=$sum6+$tot_stock_amt;
$sum7=$sum7+$profit_amt;
$sum8=$sum8+$tot_srqty;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $row2["medici_name"]; ?></td>
      <td><?php echo $row["tot_qty"]; ?></td>
      <td><?php echo $tot_srqty; ?></td>
      <td><?php echo $row["ptr"]; ?></td>
      <td><?php echo $row["gross_rate"]; ?></td>
      <td><?php echo $row["exp_date"]; ?></td>
      <td><?php echo $row["mrp"]; ?></td>
      <td><?php echo $iss_qty; ?></td>
      <td><?php echo $tot_sale_amt; ?></td>
      <td><?php echo $qih; ?></td>
      <td><?php echo $tot_stock_amt; ?></td>
      <td><?php echo $profit_per; ?></td>
      <td><?php echo $profit_amt; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>  
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum; ?></strong></th>
      <th><strong><?php echo $sum8; ?></strong></th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum2; ?></strong></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum3; ?></strong></th>
      <th><strong><?php echo $sum4; ?></strong></th>
      <th><strong><?php echo $sum5; ?></strong></th>
      <th><strong><?php echo $sum6; ?></strong></th>
      <th>&nbsp;</th>
      <th><strong><?php echo $sum7; ?></strong></th>
    </tr>

  
<?php 
}
?> 
</tbody>   
</table>	

 <br />
   <tr>
    <form action="ph_all_medi_sup_report1_print.php" method="post" target="_blank">
      <td colspan="10" ><input type="hidden" name="date" value="<?php echo $dtt;?>" ><input type="hidden" name="date2" value="<?php echo $dtt1;?>"> <input  style="margin-left:400px;" type="submit" name="submit1" id="submit1" value="Print"  target="_blank" /></td>
    </form>        
   </tr>


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