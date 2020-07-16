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
 $barcode=$_POST["barcode"];
 $purchase_id=$_POST["purchase_id"];
 $pati_id=$_POST["pati_id"];
 $medicine_id=$_POST["medicine_id"];
 $sale_id=$_POST["sale_id"];
 $invoice_no=$_POST["invoice_no"];
 $cus_name=$_POST["cus_name"];
 $mrp=$_POST["mrp"];
 $item_name=$_POST["item_name"];
 $for_type=$_POST["for_type"];
 $size_type=$_POST["size_type"];
 $return_qty=$_POST["return_qty"];
 
$sqln="select*from ph_sales_master where invoice_no='$invoice_no'";
$resn=mysql_query($sqln);
$nu_rows=mysql_num_rows($resn);
$rown=mysql_fetch_assoc($resn);

$sql1="select SUM(dis_amt)as disss_amt from ph_sales_payment where invoice_no='$invoice_no'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$disss_amt=$row1['disss_amt'];
}
$dis_amt=$disss_amt/$nu_rows;
 
 
$dd=(date("d-m-Y"));

$sql="INSERT INTO ph_sale_return (barcode,purchase_id,pati_id,medicine_id,sale_id,invoice_no,dis_amt,cus_name,mrp,item_name,for_type,size_type,return_qty,status,date)
VALUES ('$barcode','$purchase_id','$pati_id','$medicine_id','$sale_id','$invoice_no','$dis_amt','$cus_name','$mrp','$item_name','$for_type','$size_type','$return_qty','1','$dd')";
$result=mysql_query($sql);

$sql2="UPDATE barcod_master SET status='1' WHERE barcode='$barcode'";
$result2=mysql_query($sql2);


$msg="<div class='alert alert-info fade in'>
		<strong>Return Successfully</strong>
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
		document.getElementById('cus_name').value=str[0].trim();
		document.getElementById('mrp').value=str[1];
		document.getElementById('item_name').value=str[2];
		document.getElementById('for_type').value=str[3];
		document.getElementById('size_type').value=str[4];
		document.getElementById('purchase_id').value=str[5];
		document.getElementById('pati_id').value=str[6];
		document.getElementById('medicine_id').value=str[7];
		document.getElementById('sale_id').value=str[8];
		document.getElementById('invoice_no').value=str[9];
		}
	  }
	xmlhttp.open("GET","ajex_show_sreturn.php?y="+str,true);
	xmlhttp.send();
	}
</script> 



<script type="text/javascript">
//function showDuration123(str2)
//	{
//	alert(str2);
//	var qtyih=document.getElementById("qtyih").value;
//	if(qtyih==0)
//	{
//	alert("Hello");
//	}
//	}
</script> 



<script language="javascript">
	function check_form()
	{
var barcode=document.getElementById("barcode").value;

	if(document.form1.barcode.value=="")
	{
		alert("Please Enter Barcode!");
		document.form1.barcode.focus();
		return false;
	}
	
if(document.form1.mrp.value=="")
	{
		//alert("Are you Ready!");
		document.form1.mrp.focus();
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
        <form  action="sale_return.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">		
			<div class="well well-small">
			<h4>Sale Return<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
            <table class="table table-hover table-striped table-bordered">
        
    <tr>
      <td><strong>Item Barcode</strong></td>
     <td><input type="password" name="barcode" id="barcode" onChange="javascript:showDuration(this.value);"/></td>
     <td><strong>Customer  Name</strong></td>
     <td><input type="text" name="cus_name" id="cus_name" readonly="readonly"/></td>
     <td><strong>Sale Price</strong></td>
     <td><input type="text" name="mrp" id="mrp" readonly="readonly"/></td>
    </tr>
     <tr>
      <td><strong>Item Name</strong></td>
     <td><input type="text" name="item_name" id="item_name" readonly="readonly"/></td>
     <td><strong>For</strong></td>
     <td><input type="text" name="for_type" id="for_type" readonly="readonly"/></td>
     <td><strong>Size</strong></td>
     <td><input type="text" name="size_type" id="size_type" readonly="readonly"/></td>

    </tr>
    <tr>
     <td><strong>Return Qty</strong></td>
     <td><input type="text" name="return_qty" id="return_qty" value="1" readonly="readonly"/></td>
     <input type="hidden" name="purchase_id" id="purchase_id" value="" />
     <input type="hidden" name="pati_id" id="pati_id" value="" />
     <input type="hidden" name="medicine_id" id="medicine_id" value="" />
     <input type="hidden" name="invoice_no" id="invoice_no" value="" />
     <input type="hidden" name="sale_id" id="sale_id" value="" />
     <td colspan="4">&nbsp;</td>
    </tr>
  </table>
		
		
		<br/>
			
	</div>
    
    
    <hr/>
<div style="width:400px; margin-left:auto; margin-right:auto; margin-top:10px;"><input type="submit" name="submit" value="Return" class="btn btn-primary" style="width:100%;"/></div>
			  </div>
		</div>
</form>		
			  	
  <table class="table table-hover table-striped table-bordered">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Item Name</strong></th>
      <th><strong>Return Qty</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>

<?php
$sql="SELECT * FROM ph_sale_return where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
$c=1;
while($row=mysql_fetch_array($result))
{

?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $row["date"]; ?></td>
      <td><?php echo $row["cus_name"]; ?></td>
      <td><?php echo $row["item_name"]; ?></td>
      <td><?php echo $row["return_qty"]; ?></td>
      <td><a href='sales_return_print.php?return_no=<?php echo $row["id"];?>'>Print</a></td>
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