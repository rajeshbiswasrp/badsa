<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
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
        window.location.href='ph_employee_master.php?id='+id;
     }
	
	 return false;
}
</script>

<script type="text/javascript">
function showPlan(str)
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
		document.getElementById("a1").style.display="none";
		
		document.getElementById("c1").style.display="block";
	
		document.getElementById("c1").innerHTML=xmlhttp.responseText;
		}
	  }
	  //alert(xmlhttp.responseText);
	xmlhttp.open("GET","ajex_showitem.php?q="+str,true);
	xmlhttp.send();
	}
</script>
<script type="text/javascript">
function showPlan2(str)
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
		document.getElementById("a2").style.display="none";
		
		document.getElementById("c2").style.display="block";
	
		document.getElementById("c2").innerHTML=xmlhttp.responseText;
		}
	  }
	  //alert(xmlhttp.responseText);
	xmlhttp.open("GET","ajex_showlot.php?s="+str,true);
	xmlhttp.send();
	}
</script>
<script type="text/javascript">
function showDuration(str)
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
		var str=xmlhttp.responseText.split('^');
		document.getElementById('qty').value=str[0].trim();
		document.getElementById('qtyih').value=str[1];
		}
	  }
	xmlhttp.open("GET","ajex_showall1.php?y="+str,true);
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
        <form  action="barcode_print.php" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Item Barcode <small class="pull-right">&nbsp;</small></h4>
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
     <td><select name="categ_id" id="categ_id" style="width:155px; margin-left:3px;" onchange="javascript:showPlan(this.value);">
        <option value="">--Select--</option>
<?php
$sql1 = "SELECT * FROM ph_category_master";
$result1 = mysql_query($sql1);
while($row1 = mysql_fetch_array($result1)){
?>
              <option value="<?php echo $row1['id']?>"><?php echo $row1['categ_name']?></option>
<?php
}
?>
            </select></td>
     <td><strong>Select Item</strong></td>
     <td id="a1"><select name="medicine_id" id="medicine_id" style="width:155px; margin-left:3px;" onchange="javascript:showPlan2(this.value);">
		  <option value="">--Select--</option>
		  </select></td>
    <td id="c1" style="display:none;"></td>
     <td><strong>Select Lot</strong></td>
     <td id="a2"><select name="purchase_id" id="purchase_id" style="width:155px; margin-left:3px;" onChange="javascript:showDuration(this.value);">
		  <option value="">--Select--</option>
		  </select></td>
    <td id="c2" style="display:none;"></td>
    </tr>
    <tr>
     <td><strong>Purchase Quantity</strong></td>
     <td><input type="text" name="qty" id="qty" readonly="readonly"/></td>
     <td><strong>Quantity in hand</strong></td>
     <td><input type="text" name="qtyih" id="qtyih" readonly="readonly"/></td>
     <!--<td><strong>Print Quantity</strong></td>
     <td><input type="text" name="print_quenty" id="print_quenty"/></td>-->
    </tr>
  </table>
		
		
		<br/>
			
	</div>
    
    
    <hr/>
<div style="width:400px; margin-left:auto; margin-right:auto; margin-top:10px;"><input type="submit" name="submit" value="Print" class="btn btn-primary" style="width:100%;"/></div>
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