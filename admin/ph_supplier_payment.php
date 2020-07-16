<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");

$sup_id=$_REQUEST['sup_id'];
$select=mysql_fetch_array(mysql_query("select * from ph_supplier_master where id ='".$_REQUEST['sup_id']."'"));
?>

<?php
if($_POST["submit"])
{
$voucher_no1=$_POST["voucher_no1"];
$sup_id1=$_POST["sup_id"];
$pay_type=$_POST["pay_type"];
$remark=$_POST["remark"];
$less_pay=$_POST["less_pay"];

if($pay_type==0)
{
$cheque_no=$_POST["cheque_no"];
$cheque_date=$_POST["cheque_date"];
$bank_name=$_POST["bank_name"];
}
if($pay_type==2)
{
$cheque_no=$_POST["cheque_no2"];
$cheque_date=$_POST["cheque_date2"];
$bank_name=$_POST["bank_name2"];
}

$paydd=(date("Y-m-d"));
date_default_timezone_set("Asia/Kolkata");
$dtime=date("h:i:s  A");

$sql="INSERT INTO ph_supplier_payment (voucher_no,sup_id,pay_type,cheque_no,cheque_date,bank_name,remark,less_pay,status,date,time)
VALUES ('$voucher_no1','$sup_id1','$pay_type','$cheque_no','$cheque_date','$bank_name','$remark','$less_pay','1','$paydd','$dtime')";
$result=mysql_query($sql);

?>
<script>window.location="ph_supplier_view.php"</script>
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
function check_val_tr5()
{
if(document.getElementById('show_tr5').checked==true)
{
$('#tr4').hide('slow');
$('#tr5').hide('slow');
$('#tr1').show('slow');
$('#tr2').show('slow');
$('#tr3').show('slow');
}else 
{
$('#tr1').hide('slow');
$('#tr2').hide('slow');
$('#tr3').hide('slow');
}
}
</script>
<script type="text/javascript">
function check_val_tr6()
{
if(document.getElementById('show_tr6').checked==true)
{
$('#tr1').hide('slow');
$('#tr2').hide('slow');
$('#tr4').show('slow');
$('#tr5').show('slow');
}else 
{
$('#tr4').hide('slow');
$('#tr5').hide('slow');
}
}
</script>
<script language="javascript">
	function check_form()
	{
var less_pay=document.getElementById("less_pay").value;
var net_amt=document.getElementById("net_amt").value;


	
	if(document.form1.less_pay.value=="")
	{
		alert("Please Enter Less Payment!");
		document.form1.less_pay.focus();
		return false;
	}
	
if(parseInt(less_pay) > parseInt(net_amt))
{
alert("Less Payment should not be greater than Due Amount");
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
		document.getElementById('cheque_no').value=str[0].trim();
		//document.getElementById('s_price').value=str[1];
		}
	  }
	xmlhttp.open("GET","ajex_showaccount.php?y="+str,true);
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
			<div class="well well-small">
			<h4 style="margin-top:0px; font-size:15px;">Supplier Payment<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
            
<form  action="ph_supplier_payment.php" name="form1" id="form1" method="post" enctype="multipart/form-data"  onsubmit="javascript: return check_form();">
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<table width="100%" cellpadding="6" border="1" style="margin-top:5px; border:solid 1px #ccc; font-size:12px;">
  <tr>
    <td valign="top" width="35%">
    <div><strong>Payment Type:</strong> <input type="radio" name="pay_type" value="1" id="pay_type" checked="checked"/>Cash &nbsp;<input type="radio" name="pay_type" value="0" id="show_tr5" onClick="check_val_tr5();"/>Bank&nbsp;<input type="radio" name="pay_type" value="2" id="show_tr6" onClick="check_val_tr6();"/>Cheque / DD
    </div>
    <div style="border:solid 1px #ccc; padding:5px; background-color:#F9F9F9; margin-bottom:2px;">
    <table width="100%" border="0">
   <tr id="tr1" style="display:none;">
   <td><strong>Bank Name:</strong></td>
     <td><select name="bank_name" id="bank_name" style="width:110px; margin-left:1px;" onChange="javascript:showDuration(this.value);">
      <option value="0">..Select..</option>
      <option value="<?php echo $select['bank_name'];?>"><?php echo $select['bank_name'];?></option>
      <option value="<?php echo $select['bank_name2'];?>"><?php echo $select['bank_name2'];?></option>
      <option value="<?php echo $select['bank_name3'];?>"><?php echo $select['bank_name3'];?></option>
      </select></td>
    
    <td><strong>Date:</strong></td>
    <td><input type="text" name="cheque_date" id="datepicker" value="<?php echo $date_date;?>" style="width:100px; margin-bottom:0px;"/></td>
  </tr>
  <tr id="tr4" style="display:none;">
   <td><strong>Bank Name:</strong></td>
     <td><input type="text" name="bank_name2" id="bank_name2" style="width:100px; margin-bottom:0px;" /></td>
    
    <td><strong>Date:</strong></td>
    <td><input type="text" name="cheque_date2" id="datepicker1" value="<?php echo $date_date;?>" style="width:100px; margin-bottom:0px;"/></td>
  </tr>
   <tr id="tr5" style="display:none;">
    <td><strong>Cheque No.:</strong></td>
    <td><input type="text" name="cheque_no2" id="cheque_no2" style="width:100px; margin-bottom:0px;"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
  <tr id="tr2" style="display:none;">
    <td><strong>Cheque No.:</strong></td>
    <td><input type="text" name="cheque_no" id="cheque_no" style="width:100px; margin-bottom:0px;" readonly="readonly"/></td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
</table>


    </div>
    </td>
    <td valign="top" width="35%">
    <div style="border:solid 1px #ccc; padding:5px; background-color:#F9F9F9;">
    <table width="100%" border="0">
    <tr>
    <td valign="top"><strong>Remarks:</strong></td>
    <td colspan="3"><textarea name="remark" id="remark" style="height:190px; width:90%;"></textarea></td>
    </tr>

  
</table>

    </div>
    </td>
    <td valign="top" width="30%">
<?php
$sum=0;
$sum2=0;
$temp_voucher=0;
$oldtempvoucher='999999999999999999';
$sql="select * from ph_purchase_master where sup_id ='$sup_id'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$t_spq=$row["qty"];
$ptr=$row["ptr"];
//$mrp=$row["mrp"];
$vat=$row["taxpm"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];

$sql33vdn="select SUM(net_amt)as totnetpp from ph_purchase_master where sup_id='$sup_id'";
$res33vdn=mysql_query($sql33vdn);
while($row33vdn=mysql_fetch_array($res33vdn))
{
$totnetpp=$row33vdn['totnetpp'];
}
$sql3vdn="select SUM(ptr)as totnettpprr from ph_purchase_return where sup_id='$sup_id'";
$res3vdn=mysql_query($sql3vdn);
while($row3vdn=mysql_fetch_array($res3vdn))
{
$totnettpprr=$row3vdn['totnettpprr'];
}
$net_rate=$totnetpp-$totnettpprr;


if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$net_rate;
$gro_amt=$sum;

}
else
{
$sum=$net_rate;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}
$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where sup_id='$sup_id'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$gro_amt-$pay_amt;

//$due_amt2=round($due_amt1);

?>
    <table width="100%" border="0">
  <tr>
  <input type="hidden" name="voucher_no1" id="voucher_no1" value="<?php echo $voucher_no;?>" />
  <input type="hidden" name="sup_id" id="sup_id" value="<?php echo $sup_id;?>" />
    <td align="right"><strong>Net Total:</strong></td>
    <td align="right"><input type="text" name="gros_amt" id="gros_amt" value="<?php echo number_format ($gro_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right; font-weight:bold;" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right"><strong>Paid Amount:</strong></td>
    <td align="right"><input type="text" name="add_charge" id="add_charge" value="<?php echo number_format ($pay_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right"><strong>Due Amount</strong></td>
    <td align="right"><input type="text" name="net_amt" id="net_amt" value="<?php echo number_format ($due_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;  font-weight:bold;" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right"><strong>Less Payment</strong></td>
    <td align="right"><input type="text" name="less_pay" id="less_pay" style="width:100px; margin-bottom:0px; text-align:right;"/></td>
  </tr>
</table>
    </td>
  </tr>
</table>
<div style="text-align:right;"><input type="submit" name="submit" id="submit" class="btn btn-info" value="Pay" style="padding:2px 2px; margin-top:10px;"/></div>
  
			  </div>
</form>              
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