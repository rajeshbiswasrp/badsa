<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");

$id=$_REQUEST['id'];
$select=mysql_fetch_array(mysql_query("select * from ph_medicine_master where id ='".$_REQUEST['id']."'"));
?>

<?php
if (isset($_POST['button2']))
		{

 $categ_id=$_REQUEST["categ_id"];
 $type_id=$_REQUEST["type_id"];
 $medici_name=$_REQUEST["medici_name"];

$dd=(date("Y-m-d"));

$sql="UPDATE ph_medicine_master SET categ_id='$categ_id',type_id='$type_id',medici_name='$medici_name',date='$dd' WHERE id='$id'";
$result=mysql_query($sql);
?>
<script>window.location="ph_medicine_master.php"</script>
<?php
}
?>

<?php include('header.php'); ?>

<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<link rel="stylesheet" href="../themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/font-awesome.css">
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
function showPlan5(str)
	{
	//alert(str);
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("type_id").innerHTML=xmlhttp.responseText;
		}
	  }
	  //alert(xmlhttp.responseText);
	xmlhttp.open("GET","ajex_showtype.php?k="+str,true);
	xmlhttp.send();
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
        <form  action="" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Item Master Edit<small class="pull-right">&nbsp;</small></h4>
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
     <td><strong>Select Category</strong></td>
      <td><select name="categ_id" id="categ_id" style="width:190px; margin-left:1px;" onchange="javascript:showPlan5(this.value);">
<?php
$c_id=$select['categ_id'];
$sqln="select*from ph_category_master where id ='$c_id'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);
?>
        <option value="<?php echo $rown['id']; ?>"><?php echo $rown['categ_name']; ?></option>
     <?php
	 $sql="SELECT * FROM ph_category_master ORDER BY categ_name ASC";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['categ_name'];?></option>
    <?php
	 }
	 ?>
      </select><!--<span style="font-size:19px; margin-left:5px; padding-top:5px;"><a href="#category" role="button" data-toggle="modal" style="color:#009900;"><i class="fa fa-plus-circle"></i></a></span>--></td>
     <td><strong>Brand  Type</strong></td>
     <td><select name="type_id" id="type_id" style="width:190px; margin-left:1px;">
<?php
$t_id=$select['type_id'];
$sqln="select*from ph_type_master where id ='$t_id'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);
?>
        <option value="<?php echo $rown['id']; ?>"><?php echo $rown['type_name']; ?></option>
     <?php
	 $sql="SELECT * FROM ph_type_master where status=1 ORDER BY type_name ASC";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['type_name'];?></option>
    <?php
	 }
	 ?>
      </select><!--<span style="font-size:19px; margin-left:5px; padding-top:5px;"><a href="#metype" role="button" data-toggle="modal" style="color:#009900;"><i class="fa fa-plus-circle"></i></a></span>--></td>
     <td><strong>Items Name</strong></td>
     <td><input type="text" name="medici_name" id="medici_name" value="<?php echo $select['medici_name']; ?>" required/></td>
    </tr>
<?php
$m_id=$select["medicine_id"];
$sqln4="select * from ph_medicine_master where id ='$s_id'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
?>

    <tr>
    <!--<td><strong>Rack No.</strong></td>
     <td><input type="text" name="rack_no" id="rack_no" value="<?php //echo $select['rack_no']; ?>" /></td>-->
     <td>&nbsp;</td>
     <td>&nbsp;</td>
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

<br />	
		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include("category.php");?>
<?php include("metype.php");?>
	<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>