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
 $emp_name=$_POST["emp_name"];
 $mobile=$_POST["mobile"];
 $email=$_POST["email"];
 $address=$_POST["address"];
 $salary=$_POST["salary"];
 
$dd=(date("d-m-Y"));
$code='B/EMP';

$result=mysql_query("SELECT * FROM ph_employee_master where emp_name='$emp_name'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg1="<div class='alert alert-block alert-error fade in'>
		<strong>Employee Name Already Exist.</strong>
	 </div>";
}
else
{

$sql="INSERT INTO ph_employee_master (emp_name,employee_id,mobile,email,address,salary,status,date)
VALUES ('$emp_name','0','$mobile','$email','$address','$salary','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
if($result>0)
				{
					$employee_id=$code.'/'.$last_id;
					$sql_update = "UPDATE ph_employee_master SET employee_id='$employee_id' WHERE id='$last_id'";
					$qry_update= mysql_query($sql_update);

$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
}
}
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
        window.location.href='ph_employee_master.php?id='+id;
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
        <form  action="ph_employee_master.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Employee Master <small class="pull-right">&nbsp;</small></h4>
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
     <td><strong>Emp Name</strong></td>
     <td><input type="text" name="emp_name" id="emp_name"/></td>
     <td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile"/></td>
     <td><strong>Email</strong></td>
     <td><input type="text" name="email" id="email"/></td>
    </tr>
    <tr>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address"/></td>
     <td><strong>Salary</strong></td>
     <td><input type="text" name="salary" id="salary"/></td>
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
      <th><strong>Emp Name</strong></th>
      <th><strong>Emp Id</strong></th>
      <th><strong>Mobile no.</strong></th>
      <th><strong>Email</strong></th>
      <th><strong>Address</strong></th>
      <th><strong>Salary</strong></th>
      <th colspan="2"><div align="center"><strong>Option</strong></div></th>
    </tr>
        </tbody>
<?php
if($_GET[id]!="")
{
?>

<?php
$sql_del="delete from `ph_employee_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_employee_master where status='1' ORDER BY emp_name ASC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{

?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row["emp_name"]; ?></td>
      <td><?php echo $row["employee_id"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><?php echo $row["address"]; ?></td>
      <td><?php echo $row["salary"]; ?></td>
      <td><div align="center"><a href='ph_employee_master_edit.php?id=<?php echo $row[id];?>'>Edit</a></div></td>
      <td><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></div></td>
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