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
<form  action="ph_all_medi_sup_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
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
    
<?php /*?><input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Search Actions" type="text"   onkeyup="showHint(this.value)" style="border:solid 1px #999;"/>
<?php */?>
<br />	
 <div id="txtHint">
</div> 
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date of purchase </strong></th>
      <th><strong>Medicine Name </strong></th>
      <th><strong>GRN No </strong></th>
      <th><strong>Supplier Name </strong></th>
      <th><strong>Drug Name</strong></th>
      <th><strong>Purchase Amount</strong></th>
       <th><strong>Quantity</strong></th>
      <th><strong>Total Amount</strong></th>
      <th><strong>Expire Date</strong></th>
      <th><strong>Reorder Level</strong></th>
     <!-- <th><strong>Option</strong></th>-->
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
$sum=0;
$sum2=0;
$sum3=0;

$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}

$sqli = "SELECT ph_purchase_master.*,ph_medicine_master.medici_name,ph_medicine_master.drug_name,ph_medicine_master.reorder_level,ph_supplier_master.sup_name FROM ph_purchase_master left join  ph_medicine_master on ph_purchase_master.medicine_id=ph_medicine_master.id left join ph_supplier_master on ph_purchase_master.sup_id=ph_supplier_master.id  where ph_purchase_master.date <= '$date1' order by ph_purchase_master.date desc";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
    $purchase_id=$rowi['id'];	
	
	$sqlsmaster="SELECT * from ph_sales_master where purchase_id='$purchase_id' and date <= '$date1' ";
	$resultsmater=mysql_query($sqlsmaster);
	
	while($rowsmaster=mysql_fetch_array($resultsmater)){
	$issue_quantity=$rowsmaster['iss_qty'];
	}
	
	$sqlpreturn="SELECT * from ph_purchase_return where ph_purchase_id='$purchase_id' and date <= '$date1' ";
	$resultpreturn=mysql_query($sqlpreturn);
	$return_purchase_quantity=0;
	while($rowpreturn=mysql_fetch_array($resultpreturn)){
	$return_purchase_quantity=$return_purchase_quantity+$rowpreturn['return_qty'];
	}
	
	$sqlsreturn="SELECT ph_sales_return.* from ph_sales_return left join ph_sales_master on ph_sales_return.ph_sales_id=ph_sales_master.id where ph_sales_master.id='$purchase_id' and ph_sales_return.date <= '$date1'";
	$resultsreturn=mysql_query($sqlsreturn);
	$return_sales_quantity=0;
	while($rowsreturn=mysql_fetch_array($resultsreturn)){
	$return_sales_quantity=$return_sales_quantity+$rowsreturn['return_qty'];
	}
   //$issue_quantity=$return_purchase_quantity=$return_sales_quantity=0;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $rowi['date']; ?></td>
      <td><?php echo $rowi["medici_name"]; ?></td>
      <td><?php echo $rowi["grn_no"]; ?></td>
      <td><?php echo $rowi["sup_name"]; ?></td>
      <td><?php echo $rowi["drug_name"]; ?></td>
      <td><div align="right"><?php echo number_format(($rowi["each_qty_rate"]),2); ?></div></td>
      <td><div align="right"><?php echo $rowi["tot_qty"]-$return_purchase_quantity-$issue_quantity+$return_sales_quantity; ?></div></td>
      <td><div align="right"><?php echo number_format(($rowi["each_qty_rate"]*($rowi["tot_qty"]-$return_purchase_quantity-$issue_quantity+$return_sales_quantity)),2); ?></div></td>
      <td><?php echo $rowi["exp_date"]; ?></td>
      <td><?php echo $rowi["reorder_level"]; ?></td>
     
      </tr>
<?php
$sum2=$sum2+$rowi["each_qty_rate"]; 
$sum3=$sum3+($rowi["each_qty_rate"]*($rowi["tot_qty"]-$issue_quantity-$return_purchase_quantity+$return_sales_quantity)); 
$c=$c+1;

}

?>  
<tr>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sum2,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum3,2); ?></strong></div></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
    </tr>  

<tr>
      <td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensuprepotdoc('<?php echo $date;?>','<?php echo $date1;?>');" target="_blank" /></td>
             
  </tr>


  
<?php 
}
?> 
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