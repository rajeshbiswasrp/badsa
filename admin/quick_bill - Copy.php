<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>

<?php
if($_POST["submit"])
{
 $cus_name=$_POST["cus_name"];
 $mobile=$_POST["mobile"];
 $email=$_POST["email"];
 $address=$_POST["address"];
 $for_type=$_POST["for_type"];
 $item_name=$_POST["item_name"];
 $rate=$_POST["rate"];
 $qty=$_POST["qty"];
 $discount=$_POST["discount"];
 $tot_amt=$_POST["tot_amt"];
 $less_pay=$_POST["less_pay"];
 
$dd=(date("d-m-Y"));



$sql="INSERT INTO quick_bill (cus_name,mobile,email,address,for_type,item_name,rate,qty,discount,tot_amt,less_pay,status,date)
VALUES ('$cus_name','$mobile','$email','$address','$for_type','$item_name','$rate','$qty','$discount','$tot_amt','$less_pay','1','$dd')";
$result=mysql_query($sql);


$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
}
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
        window.location.href='quick_bill.php?id='+id;
     }
	
	 return false;
}
</script>

<script>
function go_check()
{
//alert("hello");
var rate=document.getElementById('rate').value;
var qty=document.getElementById('qty').value;
var discount=document.getElementById('discount').value;
var due=rate*qty;
		if((rate!="") && (qty!="")&& (discount!=""))
		{
			
		 
			var due1=due-discount;
			due1=parseFloat(due1).toFixed();
			document.getElementById('tot_amt').value=due1;
			}
	

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
        <form  action="quick_bill.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Quick Bill Master <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
            <table class="table table-hover table-striped table-bordered">
            <!--<tbody>
      <tr>
        <th colspan="7" style="background-color:#298C00; text-align:center; font-size:18px; color:#fff; text-transform:uppercase;">Patient Registration</th>
        </tr>
        </tbody>-->
        
    <tr>
     <td><strong>Customer Name</strong></td>
     <td><input type="text" name="cus_name" id="cus_name"/></td>
     <td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile"/></td>
     <td><strong>Email</strong></td>
     <td><input type="text" name="email" id="email"/></td>
    </tr>
    <tr>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address"/></td>
     <td><strong>For</strong></td>
     <td><select style="width:130px;" name="for_type" id="for_type">
      <option value="1">Male</option>
      <option value="0">Female</option>
      </select></td>
     <td><strong>Item Name</strong></td>
     <td><input type="text" name="item_name" id="item_name"/></td>
    </tr>
    <tr>
     <td><strong>Rate</strong></td>
     <td><input type="text" name="rate" id="rate" onkeyup="go_check()"/></td>
     <td><strong>Quantity</strong></td>
     <td><input type="text" name="qty" id="qty" onkeyup="go_check()"/></td>
     <td><strong>Discount</strong></td>
     <td><input type="text" name="discount" id="discount" value="0" onkeyup="go_check()"/></td>
    </tr>
    <tr>
     <td><strong>Total Amount</strong></td>
     <td><input type="text" name="tot_amt" id="tot_amt" readonly="readonly"/></td>
     <td><strong>Less Pay</strong></td>
     <td><input type="text" name="less_pay" id="less_pay"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
  </table>
		
		
		<br/>
			
	</div>
    
    
    <hr/>
<div style="width:400px; margin-left:auto; margin-right:auto; margin-top:10px;"><input type="submit" name="submit" value="Submit" class="btn btn-primary" style="width:100%;"/></div>
			  </div>
		</div>
</form>		
			  	
  <table class="table table-hover table-striped table-bordered">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Mobile no.</strong></th>
      <th><strong>Item Name</strong></th>
      <th><strong>Rate</strong></th>
      <th><strong>Quantity</strong></th>
      <th><strong>Discount</strong></th>
      <th><strong>Total Amount</strong></th>
      <th><strong>Less Pay</strong></th>
      <th><div align="center"><strong>Option</strong></div></th>
    </tr>
        </tbody>
<?php
if($_GET[id]!="")
{
?>

<?php
$sql_del="delete from `quick_bill` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM quick_bill where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{

?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row["cus_name"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo $row["item_name"]; ?></td>
      <td><?php echo $row["rate"]; ?></td>
      <td><?php echo $row["qty"]; ?></td>
      <td><?php echo $row["discount"]; ?></td>
      <td><?php echo $row["tot_amt"]; ?></td>
      <td><?php echo $row["less_pay"]; ?></td>
      <td><div align="center"><a href='#'>Print</a></div></td>
    </tr>
<?php 
$c=$c+1;
}
?>
  </table>

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>