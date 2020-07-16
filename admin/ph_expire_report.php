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
			<h4>Medicine Expire Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_expire_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
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
    

<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Medicine Name</strong></th>
      <th><strong>Purchase Date</strong></th>
      <th><strong>Expire Date</strong></th>
      <th><strong>Purchase Qty</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>No. of Days to Expired</strong></th>
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
$sql="SELECT * FROM ph_purchase_master where date between '$date' and '$date1'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$medicine_id=$row["medicine_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day/$month/$year";
$exp_date=$row["exp_date"];
list($day, $month, $year) = split('[/.-]', $exp_date);
$exp_format_date = "$year-$month-$day";

$sql2="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql3="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{

if(((strtotime($exp_format_date)-time())/(60 * 60 * 24))<90)
{
$nod=((strtotime($exp_format_date)-time())/(60 * 60 * 24));
$nod1=round($nod);
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $row3["medici_name"]; ?></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $row["exp_date"]; ?></td>
      <td><?php echo $row["tot_qty"]; ?></td>
      <td><?php echo $row2["sup_name"]; ?></td>
<?php
if($nod1<30)
{
?>
      <td style="color:#FF0000;"><?php echo $nod1; ?></td>
<?php
}
else
{
?>
      <td><?php echo $nod1; ?></td>
<?php }?>
      </tr>
<?php 
$c=$c+1;
}
else
{
}
}
}
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