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
$sql_del="delete from `ph_rate_info`";
mysql_query($sql_del);
}
?>

<?php
if($_POST["submitalltestsubmit"])
{
 $medici_name=$_POST["medici_name"];
 $mrp=$_POST["mrp"];
 $dd=(date("Y-m-d"));
 
foreach($_REQUEST['allbox2'] as $key=>$value)
	{ 

$sql="INSERT INTO ph_rate_info (purchase_id,medici_name,qihs,batch,exp_date,mrp,date)
VALUES ('$value','".$_REQUEST['medici_name'.$value]."','".$_REQUEST['qihs'.$value]."','".$_REQUEST['batch'.$value]."','".$_REQUEST['exp_date'.$value]."','".$_REQUEST['mrp'.$value]."','$dd')";
//echo $sql;

$result=mysql_query($sql);
$last_id = mysql_insert_id();
}
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
    <script>
	$(function() {
		$( "#datepicker2" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>


<script>
function showHintAllTest(str)
{
//alert(str);
if(str==""){
	//window.location="products.php";
	}
var xmlhttp;
if (str.length==0)
  { 
  
  document.getElementById("txtHint").innerHTML="";
  return;
  }
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
	document.getElementById("product-table").style.display='none';
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","ajax_search_all_test2.php?b="+str,true);
xmlhttp.send();
}
</script>


<!--scroll ########################-->
   <link rel="stylesheet" type="text/css" href="css/perfect-scrollbar.css">
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
    <script src="js/perfect-scrollbar.js"></script>
    <style>
      #description {
        border: 0px solid #34495e;
        height:311px;
        width: 100%;
		margin-left:0px;
        overflow: hidden;
		padding:0px;
        position: relative;
      }
	   
	   
	  .bbottom{ border-bottom:dotted 1px #ccc;}
    </style>
    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#description').perfectScrollbar();
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function ($) {
        $('#description1').perfectScrollbar();
      });
    </script>
   
    <!-- scroll########################-->
<script>
function check(){

var frmdata = $('form').serialize();

$.ajax({ type: "POST",url: "ajax_test_check_data2.php",data: frmdata, success: function(returndata)
		{
			if(returndata!='')
			{
					if(parseInt(returndata))
					{
						
						document.getElementById('hometestmsg').innerHTML="<span style='color:red'>Test Data Already Exist</span>";
						
					}
					else
					{
						
						form.submit();
						
					}
			}
			else
			{
				//alert('No data');
			}
			
		},
	})
return false;

}
</script>


<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {font-size: 12px; }
-->
</style>
<!--#######################PatientTestPayAmount######################-->





<!--#######################PatientTestPayAmount######################-->






<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<!-- Sidebar end=============================================== -->
<!--*********************************-->
		<div class="span12">		
			<div class="well well-small">
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
            <!--*********************************-->
<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#home" data-toggle="tab">Rate Chart</a></li>

</ul>
<div class="tab-content">
  <div class="tab-pane active" id="home">
 <table class="table table-hover table-striped table-bordered">
  <tbody>
      <tr>
      <th><strong>Medicine Name</strong></th>
      <th><strong>Rate</strong></th>
      <th><strong>Qty In Hand</strong></th>
      <th><strong>Batch No.</strong></th>
      <th><strong>Expiry Date</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `ph_rate_info` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_rate_info";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{
?>        
    <tr>
      <td><?php echo $row["medici_name"]; ?></td>
      <td><?php echo $row["mrp"]; ?></td>
      <td><?php echo $row["qihs"]; ?></td>
      <td><?php echo $row["batch"]; ?></td>
      <td><?php echo $row["exp_date"]; ?></td>
      <td><a href='rate_chart.php?id=<?php echo $row[id];?>'>Delete</a></td>
      
    </tr>
 <?php 
$c=$c+1;
}
$sql1="select SUM(mrp)as all_rate from ph_rate_info";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$all_rate=$row1['all_rate'];
}
$tot_rate=$all_rate;
?>
 <tr>
    </tr>
    <form  action="rate_chart.php" name="form2" id="form2" method="post" enctype="multipart/form-data">	
     <tr>
      <th><strong>Total Rate</strong></th>
      <th><strong><?php echo $tot_rate;?></strong></th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
     <th><input type="submit" name="submit" value="New" class="btn btn-primary"/></th>
    </tr>
    </form>
</table>
<div id="outer-autosuggest-menu">
         
<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Test" type="text"   onkeyup="showHintAllTest(this.value)" style="border:solid 1px #999;"/>
        </div>

 
<form action="rate_chart.php" name="form" id="pathology_form_test" method="post" enctype="multipart/form-data" >
<div id="hometestmsg">

</div>
<div id="txtHint">
</div>
<table class="table table-hover table-striped table-bordered" id="product-table" style="display:none;">
<tbody>
      <tr>
      <th><strong>Select</strong></th>
      <th><strong>Medicine Name</strong></th>
      <th><strong>Qty In Hand</strong></th>
      <th><strong>Batch No.</strong></th>
      <th><strong>Expiry Date</strong></th>
      <th><strong>Rate</strong></th>
    </tr>
        </tbody>
  </table> 



<div align="center" style="display:none;">
  <input type="submit" class="btn btn-primary" name="submitalltest" id="submitalltest" value="Add" /> 
  <input type="hidden" class="btn btn-primary" name="submitalltestsubmit" id="submitalltestsubmit" value="Submit" /> 
</div>
</form>
 

 
  </div>
 
  
  
</div>

<script>
  $(function () {
    $('#myTab a:first').tab('show')
  })
</script>
<!--*********************************-->
<br/>
</div>
</div>
</div>


		</div>
		</div>
	</div>
</div>
<?php include("referal.php");?>
<?php include("edit_pathology.php");?>
<?php include("add_test.php");?>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	
	<!-- Themes switcher section ============================================================================================= -->

</body>
</html>