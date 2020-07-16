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
 $type_id=$_POST["type_id"];
 $medici_name=$_POST["medici_name"];
 
$dd=(date("Y-m-d"));

$result1=mysql_query("SELECT * FROM ph_medicine_master where categ_id='$categ_id' and type_id='$type_id' and medici_name='$medici_name'");
$num_rows=mysql_num_rows($result1);
if($num_rows) {
$msg1="<div class='alert alert-block alert-error fade in'>
		<strong>Garments Item Name Already Exist.</strong>
	 </div>";
}
else
{

$sql="INSERT INTO ph_medicine_master (categ_id,type_id,medici_name,status,date)
VALUES ('$categ_id','$type_id','$medici_name','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
if($result>0)
				{
				if($_POST['otchargecount']-1!=0){
					
					for($i=1;$i<$_POST['otchargecount'];$i++){
					$otname=$_POST['otchargename'.$i];
					$otvalue=$_POST['otchargevalue'.$i];
					
					
					$sqlot="INSERT INTO  drug_master (medicine_id,drug_name,drug_value,status) VALUES('$last_id','$otname','$otvalue','1')";
					$resultot=mysql_query($sqlot);
					}
					
					}


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

<script>
function addOTcharge(type){
   var count=document.getElementById('otchargecount').value;
   var element = document.createElement("input");
 
    //Assign different attributes to the element.
    element.setAttribute("type", type);
    element.setAttribute("value", '');
    element.setAttribute("name", "otchargename"+count);
    element.setAttribute("id", "otchargename"+count);
 
    var obj = document.getElementById("otchargetdname"+count);
 
    //Append the element in page (in span).
    obj.appendChild(element);
	
	 var element1 = document.createElement("input");
 
    //Assign different attributes to the element.
	element1.setAttribute("style", 'display:none');
    element1.setAttribute("type", type);
    element1.setAttribute("value", '');
    element1.setAttribute("name", "otchargevalue"+count);
	element1.setAttribute("id", "otchargevalue"+count);
	element1.setAttribute("onchange", "counttotalotcharge()");
 
 
    var obj1 = document.getElementById("otchargetdvalue"+count);
 
    //Append the element in page (in span).
    obj1.appendChild(element1);
	
	$("#otchargetr"+count).show();
	document.getElementById("otchargecount").value=parseInt(count)+1;
	
	
}
</script>
 
 <script language="javascript">
	function check_form()
	{
	
	if(document.form1.categ_id.value=="")
	{
		alert("Please enter Category!");
		document.form1.categ_id.focus();
		return false;
	}
	if(document.form1.type_id.value=="")
	{
		alert("Please enter Brand Type!");
		document.form1.type_id.focus();
		return false;
	}
	if(document.form1.medici_name.value=="")
	{
		alert("Please enter Items Name!");
		document.form1.medici_name.focus();
		return false;
	}
	
	
		/*if(document.form1.reorder_level.value=="")
	{
		alert("Please enter Reorder level!");
		document.form1.reorder_level.focus();
		return false;
	}*/
	/*if(document.form1.rack_no.value=="")
	{
		alert("Please enter Rack No.!");
		document.form1.rack_no.focus();
		return false;
	}*/
var categ_id = document.form1.categ_id.value;
var type_id = document.form1.type_id.value;
var medici_name = document.form1.medici_name.value;
var flag=1;
$.ajax({ type: "POST",url: "ajax_check_medicine.php?categ_id="+categ_id+"&type_id="+type_id+"&medici_name="+encodeURIComponent(medici_name),async:false, success: function(returndata)
		{
			if(returndata!='')
			{
					if(parseInt(returndata))
					{
						
						flag=1;
                                                alert('Garments Item Name already exist');
					}
					else
					{
						
						flag=0;
						
					}
			}
					
		},
	});
        
if(flag==1)	
return false;
else
return true;

}
</script>
<script type="text/javascript">
function confirm1(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='ph_medicine_master.php?id='+id;
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
        <form  action="ph_medicine_master.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">		
			<div class="well well-small">
			<h4>Item Master <small class="pull-right">&nbsp;</small></h4>
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
      <option value="">..Select..</option>
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
     
     <td id="a5"><select name="type_id" id="type_id" style="width:190px; margin-left:1px;">
		  <option value="">--Select--</option>
		  </select><!--<span style="font-size:19px; margin-left:5px; padding-top:5px;"><a href="#metype" role="button" data-toggle="modal" style="color:#009900;"><i class="fa fa-plus-circle"></i></a></span>--></td>
      <td id="c5" style="display:none;"></td>
     <td><strong>Items Name</strong></td>
     <td><input type="text" name="medici_name" id="medici_name"/></td>
    </tr>
   
    
    <!--<tr>
    <td><strong>Maximum level</strong></td>
     <td><input type="text" name="max_level" id="max_level"/></td>
     <!--<td><strong>Reorder level</strong></td>
     <td><input type="text" name="reorder_level" id="reorder_level"/></td>
     <td><strong>Rack No.</strong></td>
     <td><input type="text" name="rack_no" id="rack_no"/></td>
    </tr>-->
     <!--<tr id="otchargetr<?php //echo '1';?>" >
    
    <td><strong>Drug Name</strong></td>
    <td id="otchargetdname<?php //echo '1';?>"><input id="otchargename1" name="otchargename1" value="" type="text"></td>
    <td><INPUT type="button" value="Add More Drug" onclick="addOTcharge('text')"/><input type="hidden" id="otchargecount" name="otchargecount" value="<?php //echo '2';?>"><input type="hidden" id="otchargecounttotal" name="otchargecounttotal" value="<?php //echo '20';?>"></td>
    <td id="otchargetdvalue<?php// echo '1';?>"><input onchange="counttotalotcharge()" id="otchargevalue1" name="otchargevalue1" value="" type="text" style="display:none;"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>-->
    <tr>
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
      <th><strong>S No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Category</strong></th>
      <th><strong>Brand Name</strong></th>
      <th><strong>Item Name</strong></th>
 <th colspan="2"><strong>Option</strong></th>
    </tr>
        </tbody>
<?php
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_medicine_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_medicine_master where status='1' ORDER BY medici_name ASC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$categ_id=$row["categ_id"];
$type_id=$row["type_id"];
$mdate=$row["date"];
list($year, $month, $day) = split('[/.-]', $mdate);
$dt="$day-$month-$year";

$sql2="SELECT * FROM ph_category_master where id='$categ_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql3="SELECT * FROM ph_type_master where id='$type_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $dt; ?></td>
      <td><?php echo $row2["categ_name"]; ?></td>
      <td><?php echo $row3["type_name"]; ?></td>
      <td><?php echo $row["medici_name"]; ?> - <?php echo $row3["type_name"];?></td>
      <td><a href='ph_medicine_master_edit.php?id= <?php echo $row[id];?>'> Edit</a></td>
      <td><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></td>
    </tr>
<?php 
$c=$c+1;
}
}
}
?>
  </table>
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