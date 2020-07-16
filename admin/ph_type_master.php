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
$categ_id=$_POST["categ_id"];
$type_name=$_POST["type_name"];
$dd=(date("d-m-Y"));

//$result=mysql_query("SELECT * FROM ph_type_master where type_name='$type_name'");
//$num_rows=mysql_num_rows($result);
//if($num_rows) {
//$msg1="<div class='alert alert-block alert-error fade in'>
		//<strong>Invalid Type</strong>
	 //</div>";
//}
//else
//{
$sql="INSERT INTO ph_type_master (categ_id,type_name,status,date)
VALUES ('$categ_id','$type_name','1','$dd')";
$result=mysql_query($sql);

$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
//}
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
        window.location.href='ph_type_master.php?id='+id;
     }
	
	 return false;
}
</script>
<script language="javascript">
function check_form()
{
	if(document.form2.categ_id.value=="")
	{
		alert("Please enter the Category!");
		document.form2.categ_id.focus();
		return false;
	}
if(document.form2.type_name.value=="")
	{
		alert("Please enter the Brand Name!");
		document.form2.type_name.focus();
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
        <form  action="ph_type_master.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">		
			<div class="well well-small">
			<h4>Brand  Master <small class="pull-right">&nbsp;</small></h4>
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
$sqln="select max(id) as mid from ph_type_master";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from ph_type_master where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$c_id=$rown2["categ_id"];

$sqln3="select * from ph_category_master where id ='$c_id'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
?>
    <tr>
     <td><strong>Select Category</strong></td>
     <td><select name="categ_id" id="categ_id" style="width:190px; margin-left:1px;">
     
      <option value="<?php echo $rown3['id'];?>"><?php echo $rown3['categ_name'];?></option>
     <?php
	 $sql="SELECT * FROM ph_category_master ORDER BY categ_name ASC";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['categ_name'];?></option>
    <?php
	 }
	 ?>
      </select></td>
      <td><strong>Brand Name</strong></td>
     <td><input type="text" name="type_name" id="type_name"/></td>
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
      <th><strong>Category Name</strong></th>
      <th><strong>Brand Name</strong></th>
      <th colspan="2"><div align="center"><strong>Option</strong></div></th>
    </tr>
        </tbody>
<?php
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_type_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_type_master where status='1' ORDER BY type_name ASC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$c_id=$row["categ_id"];
$sql2="SELECT * FROM ph_category_master where id='$c_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row2["categ_name"]; ?></td>
      <td><?php echo $row["type_name"]; ?></td>
      <td><div align="center"><a href='ph_type_master_edit.php?id=<?php echo $row[id];?>'>Edit</a></div></td>
      <td><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></div></td>
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