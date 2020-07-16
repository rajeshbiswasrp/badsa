<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$id=$_REQUEST['id'];
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where id ='".$_REQUEST['id']."'"));
?>

<?php
if (isset($_POST['button2']))
		{
 
 $pati_name=$_REQUEST["pati_name"];
 $address=$_REQUEST["address"];
 $mobile=$_REQUEST["mobile"];
 $email=$_REQUEST["email"];
 $bank_name=$_REQUEST["bank_name1"];
 $acc_no=$_REQUEST["acc_no1"];
 $bank_name2=$_REQUEST["bank_name2"];
 $acc_no2=$_REQUEST["acc_no2"];
 $bank_name3=$_REQUEST["bank_name3"];
 $acc_no3=$_REQUEST["acc_no3"];


$dd=(date("Y-m-d"));

$sql="UPDATE ph_patient_master SET pati_name='$pati_name',address='$address',mobile='$mobile',email='$email',bank_name='$bank_name',acc_no='$acc_no',bank_name2='$bank_name2',acc_no2='$acc_no2',bank_name3='$bank_name3',acc_no3='$acc_no3',date='$dd' WHERE id='$id'";
$result=mysql_query($sql);
?>
<script>window.location="ph_patient_master.php"</script>
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
			<h4>Customer Master Edit<small class="pull-right">&nbsp;</small></h4>
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
     <td><input type="text" name="pati_name" id="pati_name" value="<?php echo $select['pati_name']; ?>"/></td>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address" value="<?php echo $select['address']; ?>"/></td>
     <td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile" value="<?php echo $select['mobile']; ?>"/></td>
    </tr>
    <tr>
     <td><strong>Email</strong></td>
     <td><input type="text" name="email" id="email" value="<?php echo $select['email']; ?>"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
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