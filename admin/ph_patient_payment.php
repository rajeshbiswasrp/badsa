<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");

$invoice_no=$_REQUEST['invoice_no'];
?>

<?php
if($_POST["submit"])
{
$invoice_no1=$_POST["invoice_no1"];
$dis_amt=$_POST["dis_amt"];
$cheque_no=$_POST["cheque_no"];
$cheque_date=$_POST["cheque_date"];
$bank_name=$_POST["bank_name"];
$remark=$_POST["remark"];
$less_pay=$_POST["less_pay"];

$paydd=(date("Y-m-d"));
date_default_timezone_set("Asia/Kolkata");
$dtime=date("h:i:s  A");

$sql="INSERT INTO ph_sales_payment (invoice_no,dis_amt,cheque_no,cheque_date,bank_name,remark,gros_amt,vat,totgg_amt,net_amt,less_pay,status,date,time)
VALUES ('$invoice_no1','$dis_amt','$cheque_no','$cheque_date','$bank_name','$remark','0','0','0','0','$less_pay','1','$paydd','$dtime')";
$result=mysql_query($sql);

?>
<script>window.location="ph_patient_view.php"</script>
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
	xmlhttp.open("GET","ajex_showaccount_patient.php?y="+str,true);
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
			<h4 style="margin-top:0px; font-size:15px;">Customer Payment<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
            
<form  action="ph_patient_payment.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">

<?php
$select2=mysql_fetch_array(mysql_query("select * from ph_sales_master where invoice_no='$invoice_no'"));
$ppp_id=$select2['pati_id'];
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where id ='$ppp_id'"));
?>

			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<table width="100%" cellpadding="6" border="1" style="margin-top:5px; border:solid 1px #ccc; font-size:12px;">
  <tr>
    <td valign="top" width="35%">
    <div><strong>Payment Type:</strong> <input type="radio" name="pay_type" value="1" id="pay_type" checked="checked"/>Cash &nbsp;<input type="radio" name="pay_type" value="0" id="show_tr5" onClick="check_val_tr5();"/>Bank
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
    <td><input type="text" name="cheque_date" id="datepicker1" value="<?php echo $date_date;?>" style="width:100px; margin-bottom:0px;"/></td>
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
//$gross_amt=0;
$c=1;
$sql="select * from ph_sales_master where invoice_no='$invoice_no'";
$res=mysql_query($sql);
$nu_rows = mysql_num_rows($res);
while($row=mysql_fetch_array($res))
{
$sales_id=$row["id"];
$mrp=$row["mrp"];
$iss_qty=$row["iss_qty"];
$vat=$row["taxpm"];

$sql33="select SUM(gross_amt)as totrate from ph_sales_master where invoice_no='$invoice_no'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}

$sql3="select SUM(tot_sramt)as totreturn from ph_sales_return where invoice_no='$invoice_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}
$tot_rate1=$totrate-$totreturn;



$net_rate=$tot_rate1;

$gross_rate=$net_rate;

$sql14="select SUM(less_pay)as paid_amt from ph_sales_payment where invoice_no='$invoice_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$paid_amt=$row14['paid_amt'];
}


$sqln4="select*from ph_sales_payment where invoice_no='$invoice_no'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
$dis_amt=$rown4['dis_amt'];

$due_amt=$gross_rate-$paid_amt-$dis_amt;
}
?>
    <table width="100%" border="0">
  <tr>
  <input type="hidden" name="invoice_no1" id="invoice_no1" value="<?php echo $invoice_no;?>" />
    <td align="right"><strong>Net Total:</strong></td>
    <td align="right"><input type="text" name="gros_amt" id="gros_amt" value="<?php echo number_format($gross_rate,2);?>" style="width:100px; margin-bottom:0px; text-align:right; font-weight:bold;" readonly="readonly"/></td>
  </tr>
  <!--<tr>
    <td align="right"><strong>VAT Amt:</strong></td>
    <td align="right"><input type="text" name="add_charge" id="add_charge" value="<?php //echo number_format($tottaxxxx,2);?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly="readonly"/></td>
  </tr>-->
  <tr>
    <td align="right"><strong>Paid Amount:</strong></td>
    <td align="right"><input type="text" name="add_charge" id="add_charge" value="<?php echo number_format($paid_amt,2);?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right"><strong>Discount Amt:</strong></td>
    <td align="right"><input type="text" name="dis_amt" id="dis_amt" value="<?php echo number_format($dis_amt,2);?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly="readonly"/></td>
  </tr>

  <tr>
    <td align="right"><strong>Due Amount</strong></td>
    <td align="right"><input type="text" name="net_amt" id="net_amt" value="<?php echo number_format($due_amt,2);?>" style="width:100px; margin-bottom:0px; text-align:right;  font-weight:bold;" readonly="readonly"/></td>
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