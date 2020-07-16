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
$voucher_no=$_POST["voucher_no"];
 $return_no=$_POST["return_no"];
 $barcode=$_POST["barcode"];
 $purchase_id=$_POST["purchase_id"];
 $sup_id=$_POST["sup_id"];
 $medicine_id=$_POST["medicine_id"];
 $sup_name=$_POST["sup_name"];
 $ptr=$_POST["ptr"];
 $item_name=$_POST["item_name"];
 $for_type=$_POST["for_type"];
 $size_type=$_POST["size_type"];
 $qtyih=$_POST["qtyih"];
 $return_qty=$_POST["return_qty"];
 $tot_amt=$ptr*$return_qty;
 
 
$dd=(date("d-m-Y"));

$result=mysql_query("SELECT * FROM ph_purchase_return where sup_id!='$sup_id' and status='1'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg="<div align='center' class='alert alert-error' style='color:red;'>Please click New </div>";
}
else
{

$sql="INSERT INTO ph_purchase_return (voucher_no,return_no,barcode,purchase_id,sup_id,medicine_id,sup_name,ptr,item_name,for_type,size_type,qtyih,return_qty,tot_amt,status,date)
VALUES ('$voucher_no','$return_no','$barcode','$purchase_id','$sup_id','$medicine_id','$sup_name','$ptr','$item_name','$for_type','$size_type','$qtyih','$return_qty','$tot_amt','1','$dd')";
$result=mysql_query($sql);

$sql2="UPDATE barcod_master SET status='2' WHERE barcode='$barcode'";
$result2=mysql_query($sql2);

$msg="<div class='alert alert-info fade in'>
		<strong>Return Successfully</strong>
	 </div>";
}
}
?>


<?php
if($_POST["submit2"])
{
$sql_update = "UPDATE ph_purchase_return SET status='0' WHERE status='1'";
					$qry_update= mysql_query($sql_update);
}
?>
<?php
if($_POST["submit3"])
{
?>
<script>window.location="purchase_return_print.php"</script>
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
<script type="text/javascript">
	//item_name
	$(document).ready(function(){
		$("#barcode").focus();
	});
</script>
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
	$(function() {
		$( "#datepicker3" ).datepicker({
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
        window.location.href='purchase_return.php?id='+id;
     }
	
	 return false;
}
</script>

<script language="javascript">
function check_form()
{
	if(document.form2.barcode.value=="")
	{
		alert("Please enter the Item Barcode!");
		document.form2.barcode.focus();
		return false;
	}
	if(document.form2.ptr.value=="")
	{
		//alert("Are you Ready!");
		document.form2.ptr.focus();
		return false;
	}

return true;
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
		document.getElementById('sup_name').value=str[0].trim();
		document.getElementById('ptr').value=str[1];
		document.getElementById('item_name').value=str[2];
		document.getElementById('for_type').value=str[3];
		document.getElementById('size_type').value=str[4];
		document.getElementById('qtyih').value=str[5];
		document.getElementById('return_qty').value=str[6];
		document.getElementById('purchase_id').value=str[7];
		document.getElementById('sup_id').value=str[8];
		document.getElementById('medicine_id').value=str[9];
		document.getElementById('voucher_no').value=str[10];
		}
	  }
	xmlhttp.open("GET","ajex_show_preturn.php?y="+str,true);
	xmlhttp.send();
	}
</script>

<!-- Header End====================================================================== -->

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">		
			<div class="well well-small">
			<h4 style="margin-top:0px; font-size:15px;">Purchase Return<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<?php
$sqln="select max(id) as mid from ph_purchase_return where status ='1'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from ph_purchase_return where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);

if(mysql_num_rows($resn2)<0)
{
$vvv='1';
}
else
{
$sqln0="select max(id) as mmid from ph_purchase_return where status ='0'";
$resn0=mysql_query($sqln0);
$rown0=mysql_fetch_assoc($resn0);

$mmid=$rown0["mmid"];

$sqln20="select * from ph_purchase_return where id ='$mmid'";
$resn20=mysql_query($sqln20);
$rown20=mysql_fetch_assoc($resn20);
$vvv=$rown20["return_no"]+1;
}
$sqlnn="select*from ph_purchase_return where status='1'";
$resnn=mysql_query($sqlnn);
$nofpn=mysql_num_rows($resnn);
$rownn=mysql_fetch_assoc($resnn);
?> 
<form  action="purchase_return.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();"> 
 <table class="table table-hover table-striped table-bordered">

    <tr>
      <td style="padding:3px 5px;"><strong>Return No.</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="return_no" id="return_no" value="<?php echo $vvv;?>" style=" margin-bottom:0px;" readonly="readonly"/></td>
     
    </tr>
   
  </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td bgcolor="#eee"><strong>Item Barcode</strong></td>
    <td bgcolor="#eee"><strong>Supplier Name</strong></td>
    <td bgcolor="#eee"><strong>Purchase Price</strong></td>
    <td bgcolor="#eee"><strong>Item Name</strong></td>
    <td bgcolor="#eee"><strong>For</strong></td>
    <td bgcolor="#eee"><strong>Size</strong></td>
    <td bgcolor="#eee"><strong>Qty in Hand</strong></td>
    <td bgcolor="#eee"><strong>Return Qty</strong></td>
    <td bgcolor="#eee"><strong>-</strong></td>
  </tr>
  <tr>
   <td bgcolor="#eee"><input type="password" name="barcode" id="barcode" style="width:110px; margin-bottom:0px;" onChange="javascript:showDuration(this.value);"/></td>
   <td bgcolor="#eee"><input type="text" name="sup_name" id="sup_name" value="<?php echo $rownn["sup_name"]; ?>" style="width:150px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="ptr" id="ptr" style="width:90px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="item_name" id="item_name" style="width:130px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="for_type" id="for_type" style="width:50px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="size_type" id="size_type" style="width:50px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="qtyih" id="qtyih" style="width:50px; margin-bottom:0px;" readonly="readonly"/></td>
   <td bgcolor="#eee"><input type="text" name="return_qty" id="return_qty" style="width:50px; margin-bottom:0px;" value="" readonly="readonly"/></td>
   <input type="hidden" name="purchase_id" id="purchase_id" value="" />
     <input type="hidden" name="sup_id" id="sup_id" value="" />
     <input type="hidden" name="medicine_id" id="medicine_id" value="" />
     <input type="hidden" name="voucher_no" id="voucher_no" value="" />

   <td bgcolor="#eee"><input type="submit" name="submit" id="submit" class="btn btn-info" value="Add" style="padding:2px 2px;"/></td>
  </tr>
</table>
</form>
	<div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
<div id="showPlan">
</div>	
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <!--<td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Supplier Name</strong></td>-->
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Item Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>For</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Size</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchase Price</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Return Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Amount</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>
  </tr>
<?php
if($_GET[id]!="")
{
$sqln21="select * from ph_purchase_return where `id`='$_GET[id]'";
$resn21=mysql_query($sqln21);
$rown21=mysql_fetch_assoc($resn21);
$barcoderrr=$rown21["barcode"];

$sql_del="delete from `ph_purchase_return` where `id`='$_GET[id]'";
mysql_query($sql_del);

$sqlru="UPDATE barcod_master SET status='1' WHERE barcode='$barcoderrr' and status='2'";
$resultru=mysql_query($sqlru);
}
$sql="SELECT * FROM ph_purchase_return where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

?> 
  <tr>
  <!--<td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php //echo $row["sup_name"]; ?></span></td>-->
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row["item_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["for_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["size_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["ptr"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["return_qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["tot_amt"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Del</a></td>
  </tr>
<?php 
}

?>
</table>

 </div>
<?php
$sql1="select SUM(tot_amt)as gro_amt from ph_purchase_return where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}
?>
		<table width="100%" cellpadding="6" border="1" style="margin-top:5px; border:solid 1px #ccc; font-size:12px;">
<form  action="purchase_return.php" name="form1" id="form" method="post" enctype="multipart/form-data">
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" width="30%">
    <table width="100%" border="0">
  <tr>
    <td align="right"><strong>Total:</strong></td>
    <td align="right"><input type="text" name="tot_amt" id="tot_amt" value="<?php echo number_format ($gro_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly/></td>
  </tr>

 
</form>  
<?php
if($nofpn>0)
{
?>  
 <tr>
   <form  action="purchase_return.php" name="form" id="form" method="post" enctype="multipart/form-data">
    <td align="right"><input type="submit" name="submit3" class="btn btn-info" value="Print" style="padding:2px 2px;"/></td>
    </form>
    <form  action="purchase_return.php" name="form" id="form" method="post" enctype="multipart/form-data">
    <td align="right"><input type="submit" name="submit2" class="btn btn-info" value="New" style="padding:2px 2px;"/> &nbsp;<!--<button id="add_disease" onclick="return disease_add();" type="button" class="btn btn-success">Update</button>--></td>
    </form>
    
  </tr>
<?php }?> 
</table>    </td>
  </tr>
</table>
	
	</div>
    
    
  
			  </div>
		</div>
		
			  	

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>