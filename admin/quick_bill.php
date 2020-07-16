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
$voucher_no1=$_POST["voucher_no"];
$cus_name=$_POST["cus_name"];
$mobile=$_POST["mobile"];
$email=$_POST["email"];
$address=$_POST["address"];
$item_name=$_POST["item_name"];
$for_type=$_POST["for_type"];
$size_type=$_POST["size_type"];
$rate=$_POST["rate"];
$qty=$_POST["qty"];
$tot_amt=$qty*$rate;


$dd=(date("Y-m-d"));

$result=mysql_query("SELECT * FROM quick_bill where voucher_no='$voucher_no1' and status='0'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg="<div align='center' class='alert alert-error' style='color:red;'>Voucher No. Already Exist..</div>";
}
else
{
$sql="INSERT INTO quick_bill (voucher_no,cus_name,mobile,email,address,item_name,for_type,size_type,rate,qty,tot_amt,dis_status,discount,dis_amt,invoice_no,status,date)
VALUES ('$voucher_no1','$cus_name','$mobile','$email','$address','$item_name','$for_type','$size_type','$rate','$qty','$tot_amt','0','0','0','0','1','$dd')";
$result=mysql_query($sql);

$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
}
}
?>

<?php
if($_POST["submit4"])
{
$vou_no=$_POST["vou_no"];
$invoice_no=$_POST["invoice_no"];
$tot_amt=$_POST["tot_amt"];
//$dis_amt=$_POST["dis_amt"];
$less_pay=$_POST["less_pay"];
$dis_status=$_POST["dis_status"];
$discount=$_POST["discount"];

if($dis_status==0)
{
$dis_amt=$tot_amt*$discount/100;
}
else
{
$dis_amt=$discount;
}


$sql_update = "UPDATE quick_bill SET invoice_no='$invoice_no',dis_status='$dis_status',discount='$discount',dis_amt='$dis_amt' WHERE voucher_no='$vou_no' and status='1'";
					$qry_update= mysql_query($sql_update);
}
?>

<?php
if($_POST["submit2"])
{
$sql_update = "UPDATE quick_bill SET status='0' WHERE status='1'";
					$qry_update= mysql_query($sql_update);
}
?>
<?php
if($_POST["submit3"])
{
?>
<script>window.location="quick_bill_print.php"</script>
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
		$("#item_name").focus();
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
        window.location.href='quick_bill.php?id='+id;
     }
	
	 return false;
}
</script>

<script>
function go_check()
{
//alert("hello");
var tot_amt=document.getElementById('tot_amt').value;
var discount=document.getElementById('discount').value;
var dis_status=document.querySelector('input[name = "dis_status"]:checked').value;
var due=tot_amt;
		if((tot_amt!="") && (discount!="")&& (dis_status!=""))
		{
			
		  if(dis_status=='0')
		  {
		  var due14=due*discount/100;
			var due1=due-due14;
		 	due1=parseFloat(due1).toFixed();
			document.getElementById('b').value=due1;
		  }
		  else
		  {
			var due1=due-discount;
			due1=parseFloat(due1).toFixed();
			document.getElementById('b').value=due1;
			}
		}
		


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
			<h4 style="margin-top:0px; font-size:15px;">Quick Bill <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<?php
$sqln="select max(id) as mid from quick_bill where status ='1'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from quick_bill where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$iinn=$rown2["invoice_no"];
if(mysql_num_rows($resn2)<0)
{
$vvv='1';
}
else
{
$sqln0="select max(id) as mmid from quick_bill where status ='0'";
$resn0=mysql_query($sqln0);
$rown0=mysql_fetch_assoc($resn0);

$mmid=$rown0["mmid"];

$sqln20="select * from quick_bill where id ='$mmid'";
$resn20=mysql_query($sqln20);
$rown20=mysql_fetch_assoc($resn20);
$vvv=$rown20["voucher_no"]+1;
}

$sql5="SELECT * FROM quick_bill where status ='1'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
$voucher_no1=$row5["voucher_no"];
}


$sqln4="select * from quick_bill_adj where voucher_no ='$voucher_no1'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
?> 
<form  action="quick_bill.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();"> 
 <table class="table table-hover table-striped table-bordered">

    <tr>
      <td style="padding:3px 5px;"><strong>Bill No.</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="voucher_no" id="voucher_no" value="<?php echo $vvv;?>" style=" margin-bottom:0px;" readonly="readonly"/></td>
      <td  style="padding:3px 5px;"><strong>Customer Name</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="cus_name" id="cus_name" value=" <?php if($rown2["cus_name"]!=''){ echo $rown2["cus_name"];} else {  }?>" style=" margin-bottom:0px;"/></td>
      <td  style="padding:3px 5px;"><strong>Mobile No.</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="mobile" id="mobile" value=" <?php if($rown2["mobile"]!=''){ echo $rown2["mobile"];} else {  }?>" style=" margin-bottom:0px;"/></td>
    </tr>
     <tr>
      <td style="padding:3px 5px;"><strong>Email</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="email"  value="<?php if($rown2["email"]!=''){ echo $rown2["email"];} else {  }?>" id="email" style=" margin-bottom:0px;"/></td>
      <td style="padding:3px 5px;"><strong>Address</strong></td>
      <td style="padding:3px 5px;" colspan="4"><textarea name="address" id="address" style="width:640px;"><?php echo $rown2["address"]; ?></textarea></td>
    </tr>
     
    
  </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td bgcolor="#eee"><strong>Item Name</strong></td>
    <td bgcolor="#eee"><strong>For</strong></td>
     <td bgcolor="#eee"><strong>Size</strong></td>
    <td bgcolor="#eee"><strong>Rate</strong></td>
    <td bgcolor="#eee"><strong>Quantity (IN PAIR)</strong></td>
    <td bgcolor="#eee"><strong>-</strong></td>
  </tr>
  <tr>
   <td bgcolor="#eee"><input type="text" name="item_name" id="item_name" style="width:90px; margin-bottom:0px;"/></td>
   <td bgcolor="#eee"><select style="width:130px;" name="for_type" id="for_type">
      <option value="1">Male</option>
      <option value="0">Female</option>
      </select></td>
      <td bgcolor="#eee"><select style="width:130px;" name="size_type" id="size_type">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
      <option value="32">32</option>
      <option value="33">33</option>
      <option value="34">34</option>
      <option value="35">35</option>
      <option value="36">36</option>
      <option value="37">37</option>
      <option value="38">38</option>
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>
      <option value="43">43</option>
      <option value="44">44</option>
      <option value="45">45</option>
      <option value="46">46</option>
      <option value="47">47</option>
      <option value="48">48</option>
      <option value="49">49</option>
      <option value="50">50</option>
      </select></td>
   <td bgcolor="#eee"><input type="text" name="rate" id="rate" style="width:90px; margin-bottom:0px;"/></td>
   <td bgcolor="#eee"><input type="text" name="qty" id="qty" style="width:60px; margin-bottom:0px;"/></td>
<?php
if($iinn==0)
{
?>
   <td bgcolor="#eee"><input type="submit" name="submit" id="submit" class="btn btn-info" value="Add" style="padding:2px 2px;"/></td>
<?php }?>
  </tr>
</table>
</form>
	<div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
<div id="showPlan">
</div>	
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>For</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Size</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Rate</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Quantity</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Amount</strong></div></td>
<?php
if($iinn==0)
{
?>
    <td colspan="2" style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>
<?php }?>
  </tr>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `quick_bill` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM quick_bill where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$b_type=$row["for_type"];
if($b_type==1)
{
$btype='Male';
}
else
{
$btype='Female';
}
?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row["item_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $btype; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["size_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["rate"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["tot_amt"]; ?></strong></div></td>
<?php
if($iinn==0)
{
?>
    <td style="padding:2px 4px;"><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Del</a></div></td>
<?php }?>
  </tr>
<?php 
}

?>
</table>

 </div>
<?php
$sqln3="select * from quick_bill where status='1'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);

$invoice_no123=$rown3['invoice_no'];

$sql1="select SUM(tot_amt)as gro_amt from quick_bill where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}
$disss=$rown3['dis_amt'];

$netammtt=$gro_amt-$disss;
?>
		<table width="100%" cellpadding="6" border="1" style="margin-top:5px; border:solid 1px #ccc; font-size:12px;">
<form  action="quick_bill.php" name="form1" id="form" method="post" enctype="multipart/form-data">
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" width="30%">
    <table width="100%" border="0">
  <tr>
    <td align="right"><strong>Total:</strong></td>
    <td align="right"><input type="text" name="tot_amt" id="tot_amt" value="<?php echo number_format ($gro_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly/></td>
  </tr>
<input type="hidden" name="invoice_no" id="invoice_no" value="123" style="width:100px; margin-bottom:0px; text-align:right;"/>
  <input type="hidden" name="vou_no" id="vou_no" value="<?php echo $vvv;?>" style=" margin-bottom:0px;"/>
   <tr>
     <td align="right"><strong>Dis <input type="radio" name="dis_status" id="dis_status" value="1" checked="checked" />Amt &nbsp;<input type="radio" name="dis_status" id="dis_status" value="0" />%</strong></td>
    <td align="right"><input type="text" name="discount" id="discount" value="<?php if($rown3['discount']==0){ echo '0'; } else { echo $rown3['discount'];?> <?php  }?>" <?php if($rown3['discount']!=0){ echo $rrroo; }?> onkeyup="go_check()" style="width:100px; margin-bottom:0px; text-align:right;"/></td>
  </tr>
  <tr>
    <td align="right"><strong>Net Amount:</strong></td>
    <td align="right"><input type="text" name="b" id="b" value="<?php  echo number_format ($netammtt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly/></td>
  </tr>
 
<?php
if($invoice_no123==0)
{
?>  
<tr>
    <td align="right"><input type="submit" name="submit4" class="btn btn-info" value="Submit" style="padding:2px 2px;"/></td>
    <td align="right">&nbsp;</td>
    
  </tr>
</form>  
<?php
}
else
{
?> 
 <tr>
   <form  action="quick_bill.php" name="form" id="form" method="post" enctype="multipart/form-data">
    <td align="right"><input type="submit" name="submit3" class="btn btn-info" value="Print" style="padding:2px 2px;"/></td>
    </form>
    <form  action="quick_bill.php" name="form" id="form" method="post" enctype="multipart/form-data">
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