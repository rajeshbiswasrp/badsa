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
$bill_date=$_POST["bill_date"];
$ph_emp_id=$_POST["ph_emp_id"];
$pati_id=$_POST["pati_id"];
$barcode=$_POST["barcode"];
$purchase_id=$_POST["purchase_id"];
$medicine_id=$_POST["medicine_id"];
$mrp=$_POST["mrp"];
$item_name=$_POST["item_name"];
$size_type=$_POST["size_type"];
$for_type=$_POST["for_type"];
$qtyih=$_POST["qtyih"];
$sale_qty=$_POST["sale_qty"];



$gross_amt=$sale_qty*$mrp;


$dd=(date("Y-m-d"));

$sql="INSERT INTO ph_sales_master (bill_date,ph_emp_id,pati_id,barcode,purchase_id,medicine_id,mrp,item_name,size_type,for_type,qtyih,sale_qty,gross_amt,invoice_no,receipt_no,update_invoice,status,date)
VALUES ('$bill_date','$ph_emp_id','$pati_id','$barcode','$purchase_id','$medicine_id','$mrp','$item_name','$size_type','$for_type','$qtyih','$sale_qty','$gross_amt','0','0','0','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();

$sql2="UPDATE barcod_master SET status='0' WHERE barcode='$barcode'";
$result2=mysql_query($sql2);




$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
	 
	 
if($pati_type==1)
{
	$_SESSION['pati_type']=$pati_type;
	$_SESSION['business_live_search_patient']=$_POST["business_live_search_patient"];
	$_SESSION['pati_id']=$pati_id;
	$_SESSION['patient_id']=$patient_id;
	$_SESSION['bed_no']=$bed_no;
	$_SESSION['refer_id']=$refer_id;
}
else
if($pati_type==0)
{
	$_SESSION['pati_type']=$pati_type;
	$_SESSION['business_live_search_patient']=$_POST["business_live_search_patient"];
	$_SESSION['pati_id']=$pati_id;
	$_SESSION['refer_id']=$refer_id;
}

}
?>

<?php
if($_POST["submit2"])
{

$sqlvoice="select max(id) as inv from ph_sales_master where update_invoice=1";
$rowvoice=mysql_query($sqlvoice);
while($row21=mysql_fetch_array($rowvoice))
{
 $max_id=$row21["inv"];
}
$sqlvoice11="select invoice_no from ph_sales_master where id='$max_id' and update_invoice='1'";
$rowvoice11=mysql_query($sqlvoice11);
while($row11=mysql_fetch_array($rowvoice11))
{
 $invoice=($row11["invoice_no"]+1);
 $receipt_no='BA/SALE/'.date('Y').'/'.$invoice;

$sql_update2 ="UPDATE ph_sales_master SET invoice_no='$invoice',receipt_no='$receipt_no',update_invoice='1' WHERE status='1'";
$qry_update2= mysql_query($sql_update2);
}

$pay_type=$_POST["pay_type"];
$dis_status=$_POST["dis_status"];
$discount=$_POST["discount"];
$cheque_no=$_POST["cheque_no"];
$cheque_date=$_POST["cheque_date"];
$bank_name=$_POST["bank_name"];
$remark=$_POST["remark"];
$gros_amt=$_POST["gros_amt"];
$vat=$_POST["taxpm"];
$credit_amt=$_POST["credit_amt"];

if($dis_status==0)
{
$dis_amt=$gros_amt*$discount/100;
}
else
{
$dis_amt=$discount;
}

$net_amt=$_POST["net_amt"];

$paydd=(date("Y-m-d"));
date_default_timezone_set("Asia/Kolkata");
$dtime=date("h:i:s  A");

$sql="INSERT INTO ph_sales_payment (invoice_no,pay_type,dis_status,discount,dis_amt,credit_amt,cheque_no,cheque_date,bank_name,remark,gros_amt,vat,totgg_amt,net_amt,status,date,time)
VALUES ('$invoice','$pay_type','$dis_status','$discount','$dis_amt','$credit_amt','$cheque_no','$cheque_date','$bank_name','$remark','$gros_amt','$vat','$totgg_amt','$net_amt','1','$paydd','$dtime')";
$result=mysql_query($sql);

$sql31 = "SELECT * FROM ph_sales_master where invoice_no='$invoice'";
$result31 = mysql_query($sql31);
while($row31 = mysql_fetch_array($result31))
{
$tot_ratess=$row31['gross_amt'];
$sss_id=$row31['id'];

$vat_amt2=$tot_ratess*$vat/100;
$totgg_amt2=$tot_ratess+$vat_amt2;

if($dis_status==0)
{
$dis_amt2=$tot_ratess*$discount/100;
}
else
{
$dis_amt2=$discount;
}
$net_amt2=$totgg_amt2-$dis_amt2;

$sql_update = "UPDATE ph_sales_master SET vat='$vat',vat_amt='$vat_amt2',totgg_amt='$totgg_amt2',dis_status='$dis_status',discount='$discount',dis_amt='$dis_amt2',net_amt='$net_amt2' WHERE invoice_no='$invoice' and id='$sss_id'";
					$qry_update= mysql_query($sql_update);
}

if(!isset($_SESSION['payandprint']))
$_SESSION['payandprint']=1;
?>
<script>window.location="sales_details_print.php"</script>
<?php					
}
?>

<?php
if($_POST["submit3"])
{
$sql_update = "UPDATE ph_sales_master SET status='0' WHERE status='1'";
					$qry_update= mysql_query($sql_update);
unset($_SESSION['pati_type']);
unset($_SESSION['business_live_search_patient']);
unset($_SESSION['pati_id']);
unset($_SESSION['patient_id']);
unset($_SESSION['bed_no']);
unset($_SESSION['refer_id']);
unset($_SESSION['payandprint']);
}
?>

<?php
if($_POST["submit4"])
{
$id_list='';
$sql5="select *from ph_sales_master where status='1'";
$res5=mysql_query($sql5);
while($row5=mysql_fetch_array($res5))
{
$sale_id=$row5['id'];
$id_list.=$sale_id.',';
}
$id_list=substr($id_list,0,strlen($id_list)-1);
$pay_type=$_POST["pay_type"];
$cheque_no=$_POST["cheque_no"];
$cheque_date=$_POST["cheque_date"];
$bank_name=$_POST["bank_name"];
$remark=$_POST["remark"];
$gros_amt=$_POST["gros_amt"];
$add_charge=$_POST["add_charge"];
$less_dis=$_POST["less_dis"];
$net_amt=$_POST["net_amt"];
$less_pay=$_POST["less_pay"];

$paydd=(date("Y-m-d"));
date_default_timezone_set("Asia/Kolkata");
$dtime=date("h:i:s  A");

$sql="INSERT INTO ph_sales_payment (invoice_no,sale_id,pay_type,cheque_no,cheque_date,bank_name,remark,gros_amt,add_charge,less_dis,net_amt,less_pay,status,date,time)
VALUES ('0','$id_list','$pay_type','$cheque_no','$cheque_date','$bank_name','$remark','$gros_amt','$add_charge','$less_dis','$net_amt','$less_pay','1','$paydd','$dtime')";
$result=mysql_query($sql);

if(!isset($_SESSION['payandprint']))
$_SESSION['payandprint']=1;
?>
<!--<script>window.location="sales_details_print.php"</script>-->
<?php					
}
?>

<?php
if($_POST["submit5"])
{

$sqlvoice="select max(id) as inv from ph_sales_master where update_invoice=1";
$rowvoice=mysql_query($sqlvoice);
while($row21=mysql_fetch_array($rowvoice))
{
 $max_id=$row21["inv"];
}
$sqlvoice11="select invoice_no from ph_sales_master where id='$max_id' and update_invoice='1'";
$rowvoice11=mysql_query($sqlvoice11);
while($row11=mysql_fetch_array($rowvoice11))
{
 $invoice=($row11["invoice_no"]+1);
 $receipt_no='BA/SALE/'.date('Y').'/'.$invoice;

$sql_update2 ="UPDATE ph_sales_master SET invoice_no='$invoice',receipt_no='$receipt_no',update_invoice='1' WHERE pati_id='1' and update_invoice='0'";
$qry_update2= mysql_query($sql_update2);

$sql_update3 ="UPDATE ph_sales_payment SET invoice_no='$invoice' WHERE invoice_no='0'";
$qry_update3= mysql_query($sql_update3);
}
}?>

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


<script>
function showHintASPPATIENT(str)
{
if (str.length==0)
  { 
   document.getElementById("livesearchpatient").innerHTML="";
    document.getElementById("livesearchpatient").style.border="0px";
	document.getElementById("livesearchpatient").style.backgroundColor ="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("livesearchpatient").innerHTML=xmlhttp.responseText;
   document.getElementById("livesearchpatient").style.border="1px solid #A5ACB2";
   document.getElementById("livesearchpatient").style.backgroundColor ="#fff";
    }
  }
xmlhttp.open("GET","ajax_patient_listing.php?q="+str+"&patient_type="+$("#show_tr6").val(),true);
xmlhttp.send();
}
</script>



<script language="javascript">
function check_form()
{

var issq=document.getElementById("sale_qty").value;
var qih=document.getElementById("qtyih").value;
	
	//if(document.form1.ph_emp_id.value=="")
//	{
//		alert("Please enter the Emp Name!");
//		document.form1.ph_emp_id.focus();
//		return false;
//	}
	if(document.form1.pati_id.value=="")
	{
		alert("Please enter the Customer Name!");
		document.form1.pati_id.focus();
		return false;
	}
	if(document.form1.barcode.value=="")
	{
		alert("Please enter the Item Barcode!");
		document.form1.barcode.focus();
		return false;
	}
	//if(document.form1.mrp.value=="")
//	{
//		alert("Please enter the Sale Price!");
//		document.form1.mrp.focus();
//		return false;
//	}
	if(document.form1.mrp.value=="0")
	{
		alert("Sale Price should not be Zero!");
		document.form1.mrp.focus();
		return false;
	}
	if(document.form1.qtyih.value=="")
	{
		//alert("Are you Ready!");
		document.form1.qtyih.focus();
		return false;
	}

	
if(parseInt(issq) > parseInt(qih))
{
alert("Qty should be less than Q-I-H");
return false;
}
return true;
}
</script>

<script type="text/javascript">
function confirm1(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='sales_master.php?id='+id;
     }
	
	 return false;
}
</script>
<script type="text/javascript">
function holduser()
{
 <?php
 if(!isset($_SESSION['pati_type']) && !isset($_SESSION['pati_id'])){
 ?>
 alert('Please select a patient and add some medicine to hold');
 <?php
 }
 else
 {
 ?>
  var patiname=document.getElementById('business_live_search_patient').value;
  $.ajax({ type: "POST",url: "ajax_hold_patient.php?patiname="+patiname,success: function(returndata)
		{
			if(returndata!='')
			{
					if(parseInt(returndata))
					{
						
						alert('successfully holded');
						window.location="sales_master.php"
						
					}
					else
					{
						
						
						
					}
			}
			else
			{
				//alert('No data');
			}
			
		},
	})
 <?php
 }
 ?>
     
}
</script>

<script type="text/javascript">
function unholduser(val)
{
if(val=='')
return false;
var pidarr=val.split("-");
var pid=pidarr[0];
var ptype=pidarr[1];
 <?php
 if(!isset($_SESSION['pati_type']) && !isset($_SESSION['pati_id']) &&  !isset($_SESSION['payandprint'])){
 ?>
 var patiid=val;
  $.ajax({ type: "POST",url: "ajax_unhold_patient.php?patiid="+pid+"&patitype="+ptype,success: function(returndata)
		{
			if(returndata!='')
			{
					if(parseInt(returndata))
					{
						
						alert('successfully unholded');
						window.location="sales_master.php"
						
					}
					else
					{
						
						
						
					}
			}
			else
			{
				//alert('No data');
			}
			
		},
	})

 <?php
 }
 else
 {
 ?>
  alert('Please use either new button or hold this patient then unhold'); 
 <?php
 }
 ?>
     
}
</script>

<script>
function go_check()
{
//alert("hello");
var gros_amt=document.getElementById('gros_amt').value;
var credit_amt=document.getElementById('credit_amt').value;
var discount=document.getElementById('discount').value;
var dis_status=document.querySelector('input[name = "dis_status"]:checked').value;
var due=gros_amt;
		if((gros_amt!="") && (discount!="")&& (dis_status!=""))
		{
			
		  if(dis_status=='0')
		  {
		  var due14=due*discount/100;
			var due1=due-due14;
		 	due1=parseFloat(due1).toFixed();
			document.getElementById('net_amt').value=due1;
		  }
		  else
		  {
			var due1=due-discount;
			due1=parseFloat(due1).toFixed();
			document.getElementById('net_amt').value=due1;
			}
		}
		
if((gros_amt!="") && (credit_amt!=""))
		{
		  
		  var due166=due1-credit_amt;
			due3=parseFloat(due166).toFixed();
			document.getElementById('net_amt').value=due3;
		}

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
<script type="text/javascript">
function showDuration123(str)
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
		document.getElementById('mrp').value=str[0].trim();
		document.getElementById('item_name').value=str[1];
		document.getElementById('size_type').value=str[2];
		document.getElementById('for_type').value=str[3];
		document.getElementById('qtyih').value=str[4];
		document.getElementById('sale_qty').value=str[5];
		document.getElementById('purchase_id').value=str[6];
		document.getElementById('medicine_id').value=str[7];
		
		}
	  }
	xmlhttp.open("GET","ajex_show_sale.php?y="+str,true);
	xmlhttp.send();
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
	xmlhttp.open("GET","ajex_showcredit.php?q="+str,true);
	xmlhttp.send();
	}
</script>

<script type="text/javascript">
	function check_form2()
	{
	//alert('Return False!');
var credit_amt2=document.getElementById("credit_amt2").value;
var less_pay=document.getElementById("less_pay").value;
var net_amt=document.getElementById("net_amt").value;
//alert(credit_amt);
//alert(dis_amt);
var tot_amt=parseFloat(credit_amt2)+parseFloat(less_pay);

	
if(parseFloat(tot_amt) > parseFloat(net_amt))
{
alert("Credit Amt should not be greater than Net Amount");
return false;
}
//return true;
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
			<h4 style="margin-top:0px; font-size:15px;">Sales Bill <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
      
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
            <form  action="sales_master.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">
            <table class="table table-hover table-striped table-bordered">
<?php
$select2=mysql_fetch_array(mysql_query("select * from ph_sales_master where status ='1'"));
$ppp_id=$select2['pati_id'];
$emp_id=$select2['ph_emp_id'];
$select=mysql_fetch_array(mysql_query("select * from ph_patient_master where id ='$ppp_id'"));
$select3=mysql_fetch_array(mysql_query("select * from ph_employee_master where id ='$emp_id'"));
?>            
        
   
    <tr>
      <td style="padding:3px 5px;"><strong>B. Date</strong></td>
      <td style="padding:3px 5px;"><input type="text" name="bill_date" id="datepicker" value="<?php echo $date_date;?>" style=" margin-bottom:0px; width:100px;" readonly/></td>
       <td style="padding:3px 5px;"><strong>Emp Name</strong></td>
      <td style="padding:3px 5px;">
      <select name="ph_emp_id" id="ph_emp_id" style="width:190px; margin-left:1px;">
      <option value="<?php echo $select3['id'];?>"><?php echo $select3['emp_name'];?></option>
     <?php
	 $sql="SELECT * FROM ph_employee_master ORDER BY emp_name ASC";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['emp_name'];?></option>
    <?php
	 }
	 ?>
      </select></td>
          <td style="padding:3px 5px;"><strong>Customer Name</strong></td>
      <td  style="padding:3px 5px;"><select name="pati_id" id="pati_id" style=" margin-bottom:0px; width:200px;">
      <option value="<?php echo $select['id'];?>"><?php echo $select['pati_name'];?></option>
<?php
$sql3 = "SELECT * FROM ph_patient_master order by pati_name ASC";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3)){
?>
              <option value="<?php echo $row3['id']?>"><?php echo $row3['pati_name']?></option>
<?php
}
?>
            </select>
      </td>
      
      <td id="tr4" style="display:none; padding:3px 5px;"><strong>ID</strong></td>
      <td id="tr5" style="display:none; padding:3px 5px;"><input value="<?php if($_SESSION['patient_id']!='') echo $_SESSION['patient_id'];?>" type="text" name="patient_id" id="patient_id" style=" margin-bottom:0px; width:110px;" /></td>
      <td id="tr7" style="display:none; padding:3px 5px;"><strong>Bed No.</strong></td>
      <td id="tr8" style="display:none; padding:3px 5px;"><input value="<?php if($_SESSION['bed_no']!='') echo $_SESSION['bed_no'];?>" type="text" name="bed_no" id="bed_no" style=" margin-bottom:0px; width:50px;" /></td>
      
    
    </tr>
  </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td bgcolor="#eee"><strong>Item Barcode</strong></td>
    <td bgcolor="#eee"><strong>Sale Price</strong></td>
    <td bgcolor="#eee"><strong>Item Name</strong></td>
    <td bgcolor="#eee"><strong>Size</strong></td>
    <td bgcolor="#eee"><strong>For</strong></td>
    <td bgcolor="#eee"><strong>Q-I-H</strong></td>
    <td bgcolor="#eee"><strong>Sale Qty</strong></td>
    <td bgcolor="#eee">-</td>
  </tr>
  <tr>
    <td bgcolor="#eee"><input type="password" style="width:100px; margin-bottom:0px;" id="barcode" name="barcode" value="" onChange="javascript:showDuration123(this.value);"/></td>
    <td bgcolor="#eee"><input type="number" name="mrp" id="mrp" style="width:50px; margin-bottom:0px;"/></td>
    <td bgcolor="#eee"><input type="text" name="item_name" id="item_name" style="width:200px; margin-bottom:0px;" readonly="readonly"/></td>
    <td bgcolor="#eee"><input type="text" name="size_type" id="size_type" style="width:70px; margin-bottom:0px;" readonly/></td>
    <td bgcolor="#eee"><input type="text" name="for_type" id="for_type" style="width:50px; margin-bottom:0px;" readonly="readonly"/></td>
    <td bgcolor="#eee"><input type="text" name="qtyih" id="qtyih" style="width:100px; margin-bottom:0px;" readonly/></td>
    <td bgcolor="#eee"><input type="text" name="sale_qty" id="sale_qty" value="" style="width:100px; margin-bottom:0px;" readonly/></td>
    <input type="hidden" name="purchase_id" id="purchase_id" value="" />
    <input type="hidden" name="medicine_id" id="medicine_id" value="" />
    <td bgcolor="#eee"><input type="submit" name="submit" class="btn btn-info" value="Add" style="padding:2px 2px;"/></td>
  </tr>
</table>
</form>
	<div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
  <table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Size</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>For</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Price</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="right"><strong> Amount</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>
  </tr>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `ph_sales_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}
$sql="SELECT * FROM ph_sales_master where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$m_id=$row["medicine_id"];

?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row["item_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["size_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["for_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["mrp"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["sale_qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php echo number_format ($row["gross_amt"],'2','.','')?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Del</a></td>
  </tr>
<?php 
}
?>
</table>
 </div>
 <form  action="sales_master.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form2();">

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
$sqln3="select * from ph_sales_master where status='1'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
$p_id=$rown3['pati_id'];

$sql1="select SUM(gross_amt)as gro_amt from ph_sales_master where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt1=$row1['gro_amt'];
$gro_amt=round($gro_amt1,2);
}

$disss=$rown3['dis_amt'];

$netammtt=$gro_amt-$disss;

$sqln4="select * from ph_sales_payment where invoice_no='$invoice_no'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
?>
    <table width="100%" border="0">
  <tr>
    <td align="right"><strong>Gross Total:</strong></td>
    <td align="right"><input type="text" name="gros_amt" id="gros_amt" value="<?php echo number_format ($gro_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right; font-weight:bold;" readonly/></td>
  </tr>
  <tr>
     <td align="right"><strong>Dis <input type="radio" name="dis_status" id="dis_status" value="1" checked="checked" />Amt &nbsp;<input type="radio" name="dis_status" id="dis_status" value="0" />%</strong></td>
    <td align="right"><input type="text" name="discount" id="discount" value="<?php if($rown3['discount']==0){ echo '0'; } else { echo $rown3['discount'];?> <?php  }?>" <?php if($rown3['discount']!=0){ echo $rrroo; }?> onkeyup="go_check()" style="width:100px; margin-bottom:0px; text-align:right;"/></td>
  </tr>
   <tr>
    <td align="right"><strong>Credit Amt</strong></td>
    <td align="right"><input type="text" name="credit_amt" id="credit_amt" value="0" onkeyup="go_check()" style="width:100px; margin-bottom:0px; text-align:right;"/></td>
  </tr>

  <tr>
    <td align="right"><strong>Net Amount</strong></td>
    <td align="right"><input type="text" name="net_amt" id="net_amt" value="<?php echo number_format ($netammtt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;  font-weight:bold;" readonly/></td>
  </tr> 
 
 
</table>


    
    </td>
  </tr>
</table>
<div style="text-align:right;">
<?php 
$sqlpayprint="SELECT * FROM ph_sales_master where status='1'";
$resultpayprint=mysql_query($sqlpayprint);
if(mysql_num_rows($resultpayprint)>0) 
{
?>
<input type="submit" name="submit2" id="submit2" class="btn btn-info" value="Pay & Print" style="padding:2px 2px; margin-top:10px;"/>
<!--<input type="submit" name="submit4" id="submit4" class="btn btn-info" value="Cash" style="padding:2px 2px; margin-top:10px;"/>-->
<?php
} 
?>
<?php /*?><?php
if(mysql_num_rows($resultpayprint)<2) 
{
?>
<input type="submit" name="submit4" id="submit4" class="btn btn-info" value="Pay" style="padding:2px 2px; margin-top:10px;"/>
<?php }?><?php */?>
</div>
</form>	
	</div>
<form  action="sales_master.php" name="form" id="form" method="post" enctype="multipart/form-data">    
   <div style="text-align:center;"><?php if(isset($_SESSION['payandprint']) && $_SESSION['payandprint']==1) { ?><input type="submit" name="submit3" id="submit3" class="btn btn-info" value="New" style="padding:2px 2px; margin-top:10px;"/><?php } ?></div>
   
</form>
<?php 
$sqlcash="SELECT * FROM ph_sales_master where pati_id='1' and update_invoice='0'";
$resultcash=mysql_query($sqlcash);
if(mysql_num_rows($resultcash)>0) 
{
?>
<!--<form  action="sales_master.php" name="form" id="form" method="post" enctype="multipart/form-data"> 
<input type="submit" name="submit5" id="submit5" class="btn btn-info" value="Cash Update" style="padding:2px 2px; margin-top:10px;"/> 
</form>-->
<?php }?> 
			  </div>
              
		</div>
		
			  	

		</div>
		</div>
	</div>
</div>
<?php include("referal.php");?>
<?php include("patient.php");?>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>