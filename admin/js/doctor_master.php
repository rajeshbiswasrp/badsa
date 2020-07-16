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
 $join_date=$_POST["join_date"];
 $doctor_name=$_POST["doctor_name"];
 $mobile=$_POST["mobile"];
 $gender=$_POST["gender"];
 $dob=$_POST["dob"];
 $address=$_POST["address"];
 $email=$_POST["email"];
 $specialist=$_POST["specialist"];
 $qulifica=$_POST["qulifica"];
 $experi=$_POST["experi"];
 $fees=$_POST["fees"];
 

$dd=(date("Y-m-d"));
$code='MAA/DOC';

$sql="INSERT INTO doctor_master (doc_id,join_date,doctor_name,mobile,gender,dob,address,email,specialist,qulifica,experi,fees,status,date)
VALUES ('','$join_date','$doctor_name','$mobile','$gender','$dob','$address','$email','$specialist','$qulifica','$experi','$fees','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
if($result>0)
				{
					$doc_id=$code.'/'.$last_id;
					$sql_update = "UPDATE doctor_master SET doc_id='$doc_id' WHERE id='$last_id'";
					$qry_update= mysql_query($sql_update);


$msg="<div class='alert alert-info fade in'>
		<strong>Register Successfully</strong>
	 </div>";
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
 
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        <form  action="doctor_master.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Doctor Master <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
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
      <td><strong>Date Of Joining</strong></td>
     <td><input type="text" name="join_date" id="datepicker"/></td>
      <td><strong>Doctor Name </strong></td>
      <td><input type="text" name="doctor_name" id="doctor_name"/></td>
      <td><strong>Contact No.</strong></td>
      <td><input type="text" name="mobile" id="mobile"/></td>
    </tr>
    <tr>
      <td><strong>Gender</strong></td>
     <td><select name="gender" id="gender">
      <option value="1">M</option>
      <option value="0">F</option>
      
      </select></td>
      <td><strong>Date of Brith</strong></td>
      <td><input type="text" name="dob" id="datepicker1"/></td>
      <td><strong>Address</strong></td>
      <td><input type="text" name="address" id="address"/></td>
    </tr>
     <tr>
      <td><strong>Email</strong></td>
      <td><input type="text" name="email" id="email"/></td>
      <td><strong>Specialist In </strong></td>
      <td><input type="text" name="specialist" id="specialist"/></td>
      <td><strong>qualification</strong></td>
      <td><input type="text" name="qulifica" id="qulifica"/></td>
    </tr>
    <tr>
      <td><strong>Experience (in years)</strong></td>
      <td><input type="text" name="experi" id="experi"/></td>
      <td><strong>Fees</strong></td>
      <td><input type="text" name="fees" id="fees"/></td>
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
      <th><strong>Date of Joining</strong></th>
      <th><strong>Doctor Id</strong></th>
      <th><strong>Doctor Name</strong></th>
    </tr>
        </tbody>
<?php
//if($_GET[id]!="")
//{
//$sql_del="delete from `doctor_master` where `id`='$_GET[id]' ";
//mysql_query($sql_del);
//}
$sql="SELECT * FROM doctor_master where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["join_date"]; ?></td>
      <td><?php echo $row["doc_id"]; ?></td>
      <td><?php echo $row["doctor_name"]; ?></td>
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