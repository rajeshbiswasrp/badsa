<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$id=$_REQUEST['id'];
$select=mysql_fetch_array(mysql_query("select * from ph_category_master where id ='".$_REQUEST['id']."'"));
?>

<?php
if (isset($_POST['button2']))
		{
 
$categ_name=$_REQUEST["categ_name"];


$dd=(date("Y-m-d"));

$sql="UPDATE ph_category_master SET categ_name='$categ_name',date='$dd' WHERE id='$id'";
$result=mysql_query($sql);
?>
<script>window.location="ph_category_master.php"</script>
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
			<h4>Category Master Edit<small class="pull-right">&nbsp;</small></h4>
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
      <td><strong>Category Name</strong></td>
     <td><input type="text" name="categ_name" id="categ_name" value="<?php echo $select['categ_name']; ?>"/></td>
    
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