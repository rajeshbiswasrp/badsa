<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$id=$_REQUEST['id'];
$select=mysql_fetch_array(mysql_query("select * from ph_supplier_master where id ='".$_REQUEST['id']."'"));
?>

<?php
if (isset($_POST['button2']))
		{
 
 $sup_name=$_REQUEST["sup_name"];
 $address=$_REQUEST["address"];
 $city=$_REQUEST["city"];
 $state=$_REQUEST["state"];
 $cperson_name=$_REQUEST["cperson_name"];
 $mobile=$_REQUEST["mobile"];
 $email=$_REQUEST["email"];
 $bank_name=$_REQUEST["bank_name1"];
 $acc_no=$_REQUEST["acc_no1"];
 $bank_name2=$_REQUEST["bank_name2"];
 $acc_no2=$_REQUEST["acc_no2"];
 $bank_name3=$_REQUEST["bank_name3"];
 $acc_no3=$_REQUEST["acc_no3"];
 $cst_no=$_REQUEST["cst_no"];
 $gst_no=$_REQUEST["gst_no"];


$dd=(date("Y-m-d"));

$sql="UPDATE ph_supplier_master SET sup_name='$sup_name',address='$address',city='$city',state='$state',cperson_name='$cperson_name',mobile='$mobile',email='$email',bank_name='$bank_name',acc_no='$acc_no',bank_name2='$bank_name2',acc_no2='$acc_no2',bank_name3='$bank_name3',acc_no3='$acc_no3',cst_no='$cst_no',gst_no='$gst_no',date='$dd' WHERE id='$id'";
$result=mysql_query($sql);
?>
<script>window.location="ph_supplier_master.php"</script>
<?php
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
 
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        <form  action="" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Supplier Master Edit<small class="pull-right">&nbsp;</small></h4>
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
     <td><strong>Supplier Name</strong></td>
     <td><input type="text" name="sup_name" id="sup_name" value="<?php echo $select['sup_name']; ?>"/></td>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address" value="<?php echo $select['address']; ?>"/></td>
     <td><strong>City</strong></td>
     <td><input type="text" name="city" id="city" value="<?php echo $select['city']; ?>"/></td>
    </tr>
    <tr>
     <td><strong>State</strong></td>
     <td><input type="text" name="state" id="state" value="<?php echo $select['state']; ?>"/></td>
     <td><strong>Contact Person Name</strong></td>
     <td><input type="text" name="cperson_name" id="cperson_name" value="<?php echo $select['cperson_name']; ?>"/></td>
     <td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile" value="<?php echo $select['mobile']; ?>"/></td>
    </tr>
    <tr>
     <td><strong>Email Address</strong></td>
     <td><input type="text" name="email" id="email" value="<?php echo $select['email']; ?>"/></td>
     <td><strong>Gst No.</strong></td>
     <td><input type="text" name="gst_no" id="gst_no" value="<?php echo $select['gst_no']; ?>"/></td>
     <td><strong>Cst No.</strong></td>
     <td><input type="text" name="cst_no" id="cst_no" value="<?php echo $select['cst_no']; ?>"/></td>
    </tr>
    <tr>
     <td><strong>Bank Name 1</strong></td>
     <td><input type="text" name="bank_name1" id="bank_name1" value="<?php echo $select['bank_name']; ?>"/></td>
     <td><strong>Account No. 1</strong></td>
     <td><input type="text" name="acc_no1" id="acc_no1" value="<?php echo $select['acc_no']; ?>"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td><strong>Bank Name 2</strong></td>
     <td><input type="text" name="bank_name2" id="bank_name2" value="<?php echo $select['bank_name2']; ?>"/></td>
     <td><strong>Account No. 2</strong></td>
     <td><input type="text" name="acc_no2" id="acc_no2" value="<?php echo $select['acc_no2']; ?>"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td><strong>Bank Name 3</strong></td>
     <td><input type="text" name="bank_name3" id="bank_name3" value="<?php echo $select['bank_name3']; ?>"/></td>
     <td><strong>Account No. 3</strong></td>
     <td><input type="text" name="acc_no3" id="acc_no3" value="<?php echo $select['acc_no3']; ?>"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
  </table>
		
		
		<br/>
			
	</div>
    
    
    <hr/>
<div align="center">
     <input type="submit" name="button2"  class="btn btn-success" value="Update" />
   
     </div>
			  </div>
		</div>
</form>		
			  	
  

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>