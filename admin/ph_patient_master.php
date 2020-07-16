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
 $pati_name=$_POST["pati_name"];
 $address=$_POST["address"];
 $mobile=$_POST["mobile"];
 $email=$_POST["email"];
  $bank_name=$_POST["bank_name1"];
 $acc_no=$_POST["acc_no1"];
 $bank_name2=$_POST["bank_name2"];
 $acc_no2=$_POST["acc_no2"];
 $bank_name3=$_POST["bank_name3"];
 $acc_no3=$_POST["acc_no3"];
 
$dd=(date("Y-m-d"));
$code='B/CUS';

$result=mysql_query("SELECT * FROM ph_patient_master where pati_name='$pati_name'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg1="<div class='alert alert-block alert-error fade in'>
		<strong>Invalid Patient</strong>
	 </div>";
}
else
{

$sql="INSERT INTO ph_patient_master (pati_name,customer_id,address,mobile,email,bank_name,acc_no,bank_name2,acc_no2,bank_name3,acc_no3,status,date)
VALUES ('$pati_name','0','$address','$mobile','$email','$bank_name','$acc_no','$bank_name2','$acc_no2','$bank_name3','$acc_no3','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
if($result>0)
				{
					$customer_id=$code.'/'.$last_id;
					$sql_update = "UPDATE ph_patient_master SET customer_id='$customer_id' WHERE id='$last_id'";
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
	$(document).ready(function(){
		
		var chember_id=1;
		$(document).on('click','.add_chember',function(e){
			var prev=chember_id;
			chember_id=chember_id+1;
			if(chember_id>3)
			{
				alert('Bank Name Cannot be grater than 3 !');
				return false;
			}
			var text_area='<tr>';
       text_area+='<td>';
		text_area+='<strong>Bank Name '+chember_id+'</strong>'
		text_area+='';
		
	  text_area+='</td>';
      text_area+='<td><input type="text" name="bank_name'+chember_id+'" id="bank_name'+chember_id+'"/></td>';
	  //text_area+='<strong>	Account No. '+chember_id+'</strong>'
	  text_area+='<td><strong>Account No. '+chember_id+'</strong></td>';
	  text_area+='<td><input type="text" name="acc_no'+chember_id+'" id="acc_no'+chember_id+'"/></td>';
       text_area+='<td></td>';
      text_area+='<td></td>';
      text_area+='<td></td>';
    text_area+='</tr>';
			$(this).parent().parent().parent().append(text_area);
		});
	});
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>

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
        window.location.href='ph_patient_master.php?id='+id;
     }
	
	 return false;
}
</script>
<script language="javascript">
function check_form()
{
	if(document.form2.pati_name.value=="")
	{
		alert("Please enter the Customer Name!");
		document.form2.pati_name.focus();
		return false;
	}
	if(document.form2.mobile.value=="")
	{
		alert("Please enter the Mobile No.!");
		document.form2.mobile.focus();
		return false;
	}

return true;
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
        <form  action="ph_patient_master.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">		
			<div class="well well-small">
			<h4>Customer Master <small class="pull-right">&nbsp;</small></h4>
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
     <td><input type="text" name="pati_name" id="pati_name"/></td>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address"/></td>
     <td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile"/></td>
    </tr>
    <tr>
     <td><strong>Email</strong></td>
     <td><input type="text" name="email" id="email"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
     <tr>
     <td><strong>Bank Name 1</strong></td>
     <td><input type="text" name="bank_name1" id="bank_name1"/></td>
     <td><strong>Account No. 1</strong></td>
     <td><input type="text" name="acc_no1" id="acc_no1"/></td>
     <td><button type="button" class="btn btn-warning add_chember"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;ADD NEW</button></td>
     <td><strong>&nbsp;</strong></td>
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
      <th><strong>Customer Id</strong></th>
      <th><strong>Address</strong></th>
      <th><strong>Mobile No.</strong></th>
      <th><strong>Email</strong></th>
      <th colspan="2"><div align="center"><strong>Option</strong></div></th>
    </tr>
        </tbody>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `ph_patient_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_patient_master where status='1' ORDER BY pati_name DESC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{
$mdate=$row["date"];
list($year, $month, $day) = split('[/.-]', $mdate);
$dt="$day-$month-$year";
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $dt; ?></td>
      <td><?php echo $row["pati_name"]; ?></td>
       <td><?php echo $row["customer_id"]; ?></td>
      <td><?php echo $row["address"]; ?></td>
      <td><?php echo $row["mobile"]; ?></td>
      <td><?php echo $row["email"]; ?></td>
      <td><a href='ph_patient_master_edit.php?id=<?php echo $row[id];?>'>Edit</a></td>
      <td><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></td>
    </tr>
<?php 
$c=$c+1;
}
?>
  </table>
<br />	
		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>