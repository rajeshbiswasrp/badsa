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
 $name=$_POST["name"];
 $com_name=$_POST["com_name"];
 $address=$_POST["address"];
 $mobile=$_POST["mobile"];
 $email=$_POST["email"];

 
$dd=(date("Y-m-d"));



$time=time();
			 $sch_img=$time."_".$_FILES ["sch_img"]["name"];
			 $sql11="select * from ph_config_master";
			 $sql12=mysql_query($sql11);
			 $sql=mysql_num_rows($sql12);
	          if($sql<1)
	         {
			 $ok=copy($_FILES ["sch_img"]["tmp_name"],"logo1/".$sch_img);
			 if($ok)
			 {
              	
			 		 
			   $ins_sql=mysql_query("INSERT INTO ph_config_master VALUES ('','$name','$com_name','$address','$mobile','$email','$sch_img','1','$dd')");
			   if($ins_sql)
			   {
				 $msg="Insertion Successfull";
			   }
			 }
	       
 	}else
	{
	          $res=mysql_fetch_array($sql12);
			 
	               
                $ok=copy($_FILES ["sch_img"]["tmp_name"],"logo1/".$sch_img);
			 if($ok)
			 {
				   $upd_sql=mysql_query("UPDATE ph_config_master SET name='$name',com_name='$com_name',address='$address',mobile='$mobile',email='$email',sch_img='$sch_img',date='$date' where status='1'");
				   
				   if($upd_sql)
			   {
			     unlink("logo1/".$res['sch_logo']);
				 $msg="Updation Successfull";
			   }
	 }
	} 


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
        window.location.href='ph_config_master.php?id='+id;
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
        <form  action="ph_config_master.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Configuration Master <small class="pull-right">&nbsp;</small></h4>
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
     <td><strong>Name</strong></td>
     <td><input type="text" name="name" id="name"/></td>
     <td><strong>Company Name</strong></td>
     <td><input type="text" name="com_name" id="com_name"/></td>
     <td><strong>Address</strong></td>
     <td><input type="text" name="address" id="address"/></td>
    </tr>
    <tr>
	<td><strong>Mobile No.</strong></td>
     <td><input type="text" name="mobile" id="mobile"/></td>
     <td><strong>Email</strong></td>
     <td><input type="text" name="email" id="email"/></td>
     <td><strong>Logo</strong></td>
     <td><input type="file" name="sch_img" id="sch_img"/></td>
    </tr>
  </table>
		
		
		<br/>
			
	</div>
    
    
    <hr/>
<div style="width:400px; margin-left:auto; margin-right:auto; margin-top:10px;"><input type="submit" name="submit" value="Submit" class="btn btn-primary" style="width:100%;"/></div>
			  </div>
		</div>
</form>	

			  	
  
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