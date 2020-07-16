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
			<h4>Fast Moving Medicine Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_fast_moving_medi_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
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
      <th><strong>Date of Sale </strong></th>
      <th><strong>Medicine Name </strong></th>
      <th><strong>Patient Name </strong></th>
      <th><strong>GRN No </strong></th>
      <th><strong>Supplier Name </strong></th>
      <th><strong>Sale Qty</strong></th>
      <th><strong>Sale Price</strong></th>
      <th><strong>Total Amount</strong></th>
      <th><strong>Purchase Price</strong></th>
      <th><strong>Expire Date</strong></th>
<!--      <th><strong>Qty In Hand</strong></th>-->
      <th><strong>Reorder Level</strong></th>
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
$sql="SELECT ph_sales_master.id as sale_id,ph_sales_master.iss_qty,ph_sales_master.date as sale_date,ph_sales_master.mrp as mrpsale,ph_sales_master.gross_amt as gross_amt_sale,ph_purchase_master.*,ph_patient_master.pati_name,ph_medicine_master.medici_name,ph_medicine_master.reorder_level from ph_sales_master left join ph_purchase_master on ph_sales_master.purchase_id = ph_purchase_master.id left join ph_patient_master on ph_sales_master.pati_id=ph_patient_master.id  left join ph_medicine_master on ph_sales_master.medicine_id=ph_medicine_master.id where ph_sales_master.date between '$date' and '$date1' group by ph_sales_master.medicine_id order by ph_medicine_master.medici_name asc";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
$sale_id=$row["$sale_id"];
$sup_id=$row["sup_id"];
$medicine_id=$row["medicine_id"];
$jd=$row['sale_date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
/*					
$sql2="SELECT * FROM ph_medicine_master where id = '$medicine_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
    $reorderlevel=$row2["reorder_level"];
    $medicine_name=$row2["medici_name"];
}*/
$reorderlevel=$row["reorder_level"];
$medicine_name=$row["medici_name"];
    
    
$sql3="SELECT * FROM ph_supplier_master where id = '$sup_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
    $supplier_name=$row3["sup_name"];
}
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $medicine_name; ?></td>
      <td><?php echo $row["pati_name"]; ?></td>
      <td><?php echo $row["grn_no"]; ?></td>
      <td><?php echo $supplier_name; ?></td>
      <td><?php echo $row["iss_qty"]; ?></td>
      <td><?php echo $row["mrpsale"]; ?></td>
      <td><?php echo $row["gross_amt_sale"]; ?></td>
      <td><?php echo $row["ptr"]; ?></td>
      <td><?php echo $row["exp_date"]; ?></td>
<!--      <td><?php //echo $qih; ?></td>-->
      <td><?php echo $reorderlevel; ?></td>
      </tr>
<?php 
$c=$c+1;

}
?>  


  
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