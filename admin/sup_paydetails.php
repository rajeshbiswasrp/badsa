<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$sup_id=$_REQUEST['sup_id'];
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
<script type="text/javascript">
function confirm1(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='ph_category_master.php?id='+id;
     }
	
	 return false;
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
<?php
$sqln2="select*from ph_supplier_master where id ='$sup_id'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
?>
			<h4 style="margin-top:0px; font-size:15px;">Purchase View<small class="pull-right">&nbsp;</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Supplier Name - <?php echo $rown2["sup_name"];?></h4>
            
      
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<table class="table table-hover table-striped table-bordered">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Paid Amount</strong></th>
    </tr>
        </tbody>

<?php
$sql="SELECT * FROM ph_supplier_payment where sup_id='$sup_id'";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{

$sql16="select SUM(less_pay)as tot_amt from ph_supplier_payment where sup_id='$sup_id'";
$res16=mysql_query($sql16);
while($row16=mysql_fetch_array($res16))
{
$tot_amt=$row16['tot_amt'];
}

?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row["voucher_no"]; ?></td>
      <td><?php echo $row["less_pay"]; ?></td>
    </tr>
<?php 
$c=$c+1;
}
?>
<tr>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $tot_amt;?></strong></th>
    </tr>
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