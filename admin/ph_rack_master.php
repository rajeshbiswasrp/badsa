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
$rack_type_id=$_POST["rack_type_id"];
$rack_no=$_POST["rack_no"];
$dd=(date("Y-m-d"));

$sql="INSERT INTO ph_rack_master (rack_type_id,rack_no,status,date)
VALUES ('$rack_type_id','$rack_no','1','$dd')";
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
        window.location.href='ph_rack_master.php?id='+id;
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
        <form  action="ph_rack_master.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Rack Master <small class="pull-right">&nbsp;</small></h4>
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
<?php
$sqln="select max(id) as mid from ph_rack_master";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from ph_rack_master where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$c_id=$rown2["categ_id"];

$sqln3="select * from ph_racktype_master where id ='$c_id'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
?>
    <tr>
     <td><strong>Rack Type</strong></td>
     <td><select name="rack_type_id" id="rack_type_id" style="width:190px; margin-left:1px;">
     
      <option value="<?php echo $rown3['id'];?>"><?php echo $rown3['rack_type'];?></option>
     <?php
	 $sql="SELECT * FROM ph_racktype_master";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['rack_type'];?></option>
    <?php
	 }
	 ?>
      </select></td>
      <td><strong>Rack No.</strong></td>
     <td><input type="text" name="rack_no" id="rack_no"/></td>
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
      <th><strong>Rack Type</strong></th>
      <th><strong>Rack No.</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<?php
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_rack_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_rack_master where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$r_id=$row["rack_type_id"];
$sql2="SELECT * FROM ph_racktype_master where id='$r_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row2["rack_type"]; ?></td>
      <td><?php echo $row["rack_no"]; ?></td>
      <!--<td><a href='ph_rack_master_edit.php?id=<?php //echo $row[id];?>'>Edit</a></td>-->
      <td><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></td>
    </tr>
<?php 
$c=$c+1;
}
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