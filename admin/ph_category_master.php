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
 $categ_name=$_POST["categ_name"];
 
$dd=(date("d-m-Y"));


$result=mysql_query("SELECT * FROM ph_category_master where categ_name='$categ_name'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg1="<div class='alert alert-block alert-error fade in'>
		<strong>Category Name Already Exist.</strong>
	 </div>";
}
else
{

$sql="INSERT INTO ph_category_master (categ_name,medi_tax,status,date)
VALUES ('$categ_name','0','1','$dd')";
$result=mysql_query($sql);


$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
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
<script language="javascript">
function check_form()
{
	if(document.form2.categ_name.value=="")
	{
		alert("Please enter the Category Name!");
		document.form2.categ_name.focus();
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
        <form  action="ph_category_master.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">		
			<div class="well well-small">
			<h4>Category Master <small class="pull-right">&nbsp;</small></h4>
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
      <td><strong>Category  Name</strong></td>
     <td><input type="text" name="categ_name" id="categ_name"/></td>
    
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
      <th colspan="2"><div align="center"><strong>Option</strong></div></th>
    </tr>
        </tbody>
<?php
if($_GET[id]!="")
{
?>

<?php
$sql_del="delete from `ph_category_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_category_master where status='1' ORDER BY categ_name ASC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{

?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row["categ_name"]; ?></td>
      <td><div align="center"><a href='ph_category_master_edit.php?id=<?php echo $row[id];?>'>Edit</a></div></td>
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