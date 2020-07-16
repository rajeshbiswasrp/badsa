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
$voucher_date1=$_POST["voucher_date"];
$sup_id=$_POST["sup_id"];
$bill_date=$_POST["bill_date"];
$medicine_id=$_POST["medicine_id"];
$batch=$_POST["batch"];
$mrp=$_POST["mrp"];
$ptr=$_POST["ptr"];
$base_type=$_POST["base_type"];
$qty=$_POST["t_spq"];
$nts=$_POST["nts"];
$for_type=$_POST["for_type"];
$size_type=$_POST["size_type"];
$dis_status=$_POST["dis_status"];
$discount=$_POST["discount"];
$tax_status=$_POST["tax_status"];
$taxpm=$_POST["taxpm"];

$sqlnt="select*from ph_medicine_master where id ='$medicine_id'";
$resnt=mysql_query($sqlnt);
$rownt=mysql_fetch_assoc($resnt);
$type_id=$rownt["type_id"];
$unit=$rownt["unit"];

$total_rate=$qty*$ptr;
$total_rate_p=$ptr/$nts;
$total_qty_p=$qty*$nts;

if($dis_status==0)
{
$dis_amt=$total_rate*$discount/100;
}
else
{
$dis_amt=$discount;
}
$after_dis=$total_rate-$dis_amt;
$tax_amt=$after_dis*$taxpm/100;
$net_amt=$after_dis+$tax_amt;

if($dis_status==0)
{
$dis_amtb=$ptr*$discount/100;
}
else
{
$dis_amtb=$discount;
}
$after_disb=$ptr-$dis_amtb;
$tax_amtb=$after_disb*$taxpm/100;
$net_amtb=$after_disb+$tax_amtb;

$code='BA';


$dd=(date("Y-m-d"));

$result=mysql_query("SELECT * FROM ph_purchase_master where voucher_no='$voucher_no1' and status='0'");
$num_rows=mysql_num_rows($result);
if($num_rows) {
$msg="<div align='center' class='alert alert-error' style='color:red;'>Voucher No. Already Exist..</div>";
}
else
{
$sql="INSERT INTO ph_purchase_master (voucher_no,voucher_date,sup_id,bill_date,type_id,unit,medicine_id,for_type,size_type,batch,mrp,ptr,base_type,qty,nts,dis_status,discount,tax_status,taxpm,status,total_rate,total_rate_p,total_qty_p,dis_amt,after_dis,tax_amt,net_amt,dis_amtb,after_disb,tax_amtb,net_amtb,invoice_no,date)
VALUES ('$voucher_no1','$voucher_date1','$sup_id','$bill_date','$type_id','$unit','$medicine_id','$for_type','$size_type','$batch','$mrp','$ptr','$base_type','$qty','$nts','$dis_status','$discount','$tax_status','$taxpm','1','$total_rate','$total_rate_p','$total_qty_p','$dis_amt','$after_dis','$tax_amt','$net_amt','$dis_amtb','$after_disb','$tax_amtb','$net_amtb','0','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();


if($for_type==1)
{
$ft='M';
}
else
{
$ft='F';
}
$year=date("Y");

for($j=0;$j<$qty;$j++)
			{
			$sub1="INSERT INTO `barcod_master` (`purchase_id`,`quantity`,`size_type`,`medicine_id`,`barcode`,`status`, `date`) VALUES ('$last_id','$qty','$size_type','$medicine_id','0','1','$dd')";
$res10=mysql_query($sub1);
$last_id1 = mysql_insert_id();
if($res10>0)
				{
					
					$item_code=$code."/".$ft."/".$year."/".$last_id1;
					$sql_update = "UPDATE barcod_master SET barcode='$item_code' WHERE id='$last_id1'";
					$qry_update= mysql_query($sql_update);
					}
}

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



$sql_update = "UPDATE ph_purchase_master SET invoice_no='$invoice_no' WHERE voucher_no='$vou_no' and status='1'";
					$qry_update= mysql_query($sql_update);
}
?>

<?php
if($_POST["submit2"])
{
$sql_update = "UPDATE ph_purchase_master SET status='0' WHERE status='1'";
					$qry_update= mysql_query($sql_update);
}
?>
<?php
if($_POST["submit3"])
{
?>
<script>window.location="purchase_details_print.php"</script>
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
		$("#business_live_search").focus();
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
function showHintASP(str)
{
if (str.length==0)
  { 
   document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
	document.getElementById("livesearch").style.backgroundColor ="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
   document.getElementById("livesearch").style.border="1px solid #A5ACB2";
   document.getElementById("livesearch").style.backgroundColor ="#fff";
    }
  }
xmlhttp.open("GET","ajax_medicine_listing.php?q="+str+"&medici_name="+$("#medici_name").val(),true);
xmlhttp.send();
}
</script>

<script>
function selectedbox(id,val)
{
 //document.getElementById("business_search").selectedIndex=id;
 $('#medicine_id').val(id);
 document.getElementById("livesearch").innerHTML="";
 document.getElementById("business_live_search").value=val;
 document.getElementById("livesearch").style.border="0px";

}
</script>
<script type="text/javascript">
function showPlan2ready()
	{
	
	
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
		//document.getElementById("a2").style.display="none";
		
		//document.getElementById("c2").style.display="block";
	
		document.getElementById("medicine_id").innerHTML=xmlhttp.responseText;
		document.getElementById("medicine_id").value='';
		}
	  }
	  //alert(xmlhttp.responseText);
	xmlhttp.open("GET","ajex_showmedicine.php",true);
	xmlhttp.send();
	}
</script>
<script>
$( document ).ready(function() {	
	showPlan2ready();
		
});
</script>


<script type="text/javascript">
function check_val_tr5()
{
if(document.getElementById('show_tr5').value==false)
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

<script>
function disease_add(){

var voucher_no=document.getElementById("voucher_no").value;
var voucher_date=document.getElementById("datepicker").value;
var bill_date=document.getElementById("datepicker1").value;
var id=document.getElementById("po_no").value;

if(voucher_no=="")
	{
		alert("Please enter Voucher No!");
		document.getElementById('voucher_no').focus();
		return false;
	}
	if(voucher_date=="")
	{
		alert("Please enter Voucher Date!");
		document.getElementById('voucher_date').focus();
		return false;
	}
	if(bill_date=="")
	{
		alert("Please enter Bill Date!");
		document.getElementById('bill_date').focus();
		return false;
	}

alert('Success');
//window.location='purchase_master.php?po_no=<?php //echo $id;?>';
$.ajax({ type: "POST",url: "ajax_vourch_update.php",async: false,data: "voucher_no="+encodeURIComponent(voucher_no)+"&voucher_date="+encodeURIComponent(voucher_date)+"&bill_date="+encodeURIComponent(bill_date)+"&id="+id, success: function(data)
//$.ajax({ type: "POST",url: "ajax_vourch_update.php",async: false,data: "voucher_no="+encodeURIComponent(voucher_no)+"&voucher_date="+encodeURIComponent(voucher_date)+"&id="+id, success: function(data)
		{
		
		}
	})	
	
	
	return false;

}
</script>

<script>
function add_value(val){

var voucher_no=document.getElementById("voucher_no").value;
var amt_of_adj=document.getElementById("amt_of_adj").value;
//alert('Success');
//window.location='purchase_master.php?po_no=<?php //echo $id;?>';
$.ajax({ type: "POST",url: "ajax_adjest_value2.php",async: false,data: "voucher_no="+encodeURIComponent(voucher_no)+"&amt_of_adj="+encodeURIComponent(amt_of_adj)+"&add_status="+val, success: function(data)
//$.ajax({ type: "POST",url: "ajax_vourch_update.php",async: false,data: "voucher_no="+encodeURIComponent(voucher_no)+"&voucher_date="+encodeURIComponent(voucher_date)+"&id="+id, success: function(data)
		{
		
		}
	})	
	
	
	return false;

}
</script>

<script language="javascript">
	function check_form()
	{
//alert("hello");
var mrp=document.getElementById("mrp").value;
var ptr=document.getElementById("ptr").value;

if(document.form2.sup_id.value=="")
	{
		alert("Please enter the Supplier Name!");
		document.form2.sup_id.focus();
		return false;
	}

	if(document.form2.medicine_id.value=="")
	{
		alert("Please enter the Item Name!");
		document.form2.medicine_id.focus();
		return false;
	}
if(document.form2.for_type.value=="")
	{
		alert("Please enter the For!");
		document.form2.for_type.focus();
		return false;
	}
	
	if(document.form2.size_type.value=="")
	{
		alert("Please enter the Size!");
		document.form2.size_type.focus();
		return false;
	}
	
	if(document.form2.mrp.value=="")
	{
		alert("Please enter the Sale Price!");
		document.form2.mrp.focus();
		return false;
	}
	if(document.form2.ptr.value=="")
	{
		alert("Please enter the Purchase Price!");
		document.form2.ptr.focus();
		return false;
	}
	if(parseInt(ptr) > parseInt(mrp))
{
alert("Purchase Price should be less than Sale Price");
return false;
}
if(document.form2.t_spq.value=="")
	{
		alert("Please enter the Purchased Qty!");
		document.form2.t_spq.focus();
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
        window.location.href='purchase_master.php?id='+id;
     }
	
	 return false;
}
</script>
<script>
function go_check()
{
//alert("hello");
var tot_amt=document.getElementById('tot_amt').value;
var vat=document.getElementById('vat').value;
var discount=document.getElementById('discount').value;
var dis_status=document.querySelector('input[name = "dis_status"]:checked').value;
var b=document.getElementById('b').value;
var due=tot_amt;
//alert(tot_amt+'jj'+discount);
		document.getElementById('b').value=dis_status;
		if((tot_amt!="") && (discount!="")&& (dis_status!=""))
		{
			
		  if(dis_status=='0')
		  {
		  var due14=tot_amt*discount/100;
		  var due13=Math.round(due14);
		  //var due1=due-due12;
		  //alert(due13);
		  
		  //var test =due12;
		  var lastone = due13.toString().split('').pop();
			//alert(lastone); 
			var due12=due13-lastone;
			var due1=due-due12;
		 	due1=parseFloat(due1).toFixed();
			document.getElementById('b').value=due1;
		  }
		  else
		  {
		 // alert(tot_amt+'jj'+discount);
			var due1=due-discount;
			due1=parseFloat(due1).toFixed();
			document.getElementById('b').value=due1;
			}
		}
		
		if((tot_amt!="") && (vat!=""))
		{
		  
		  var due16=due1*vat/100;
			var due2=parseInt(due1)+parseInt(due16);
			due2=parseFloat(due2).toFixed();
			document.getElementById('b').value=due2;
		}


}
</script>
<script language="javascript">
function check_form3()
{
//alert("gg");
	if(document.form3.invoice_no.value=="0")
	{
		alert("Please enter the Invoice No.!");
		document.form3.invoice_no.focus();
		return false;
	}

return true;
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
			<h4 style="margin-top:0px; font-size:15px;">Purchase Bill <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<?php
$sqln="select max(id) as mid from ph_purchase_master where status ='1'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from ph_purchase_master where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
$iinn=$rown2["invoice_no"];
if(mysql_num_rows($resn2)<0)
{
$vvv='1';
}
else
{
$sqln0="select max(id) as mmid from ph_purchase_master where status ='0'";
$resn0=mysql_query($sqln0);
$rown0=mysql_fetch_assoc($resn0);

$mmid=$rown0["mmid"];

$sqln20="select * from ph_purchase_master where id ='$mmid'";
$resn20=mysql_query($sqln20);
$rown20=mysql_fetch_assoc($resn20);
$vvv=$rown20["voucher_no"]+1;
}

$sql5="SELECT * FROM ph_purchase_master where status ='1'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
$voucher_no1=$row5["voucher_no"];
}


$sqln4="select * from purchase_master_adj where voucher_no ='$voucher_no1'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
?> 
<form  action="purchase_master.php" name="form2" id="form2" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();"> 
 <table class="table table-hover table-striped table-bordered">

    <tr>
      <td style="padding:3px 5px;"><strong>Voucher / Bill No.</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="voucher_no" id="voucher_no" value="<?php echo $vvv;?>" style=" margin-bottom:0px;" readonly="readonly"/></td>
      <td  style="padding:3px 5px;"><strong>Voucher Date</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="voucher_date" id="datepicker" value=" <?php if($rown2["voucher_date"]!=''){ echo $rown2["voucher_date"];} else { echo $date_date; }?>" style=" margin-bottom:0px;"/></td>
      <td  style="padding:3px 5px;"><strong>Supplier Name</strong></td>
<?php
$s_id=$rown2["sup_id"];

$sqln3="select * from ph_supplier_master where id ='$s_id'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
?>
      <td  style="padding:3px 5px;">
      <select name="sup_id" id="sup_id" style=" margin-bottom:0px;">
      <option value="<?php echo $rown3['id']?>"><?php echo $rown3['sup_name']?></option>
        <option value="">--Select--</option>
<?php
$sql3 = "SELECT * FROM ph_supplier_master ORDER BY sup_name ASC";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3)){
?>
              <option value="<?php echo $row3['id']?>"><?php echo $row3['sup_name']?></option>
<?php
}
?>
            </select>
      </td>
    </tr>
     <tr>
      <td style="padding:3px 5px;"><strong>Bill Date</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="bill_date"  value="<?php if($rown2["bill_date"]!=''){ echo $rown2["bill_date"];} else { echo $date_date; }?>" id="datepicker1" style=" margin-bottom:0px;"/></td>
      <td style="padding:3px 5px;" colspan="2"></td>
      <td style="padding:3px 5px;" colspan="2"></td>
    </tr>
     
    
  </table>
	<table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <td bgcolor="#eee"><strong>Item Name</strong></td>
    <td bgcolor="#eee"><strong>For</strong></td>
    <td bgcolor="#eee"><strong>Size</strong></td>
    <td bgcolor="#eee"><strong>Sale Price</strong></td>
    <td bgcolor="#eee"><strong>Purchase Price</strong></td>
    <td bgcolor="#eee"><strong>Purchased Qty</strong></td>
    <td id="tr1" style="display:none;" bgcolor="#eee"><strong>Pieces in Box</strong></td>
<?php
if($iinn==0)
{
?>
    <td bgcolor="#eee">-</td>
<?php }?>
  </tr>
  <tr>
    <td bgcolor="#eee"> <span id="c2" style="display:none;"><select name="medicine_id" id="medicine_id" style="width:220px; margin-left:1px;" >
		  <option value="">--Select--</option>
		  </select></span><input type="text" style="width:130px; margin-bottom:0px;" id="business_live_search" name="business_live_search"  onKeyUp="showHintASP(this.value)" autocomplete = "off" value=""/><div id="livesearch" style="z-index:100000000; overflow:auto; position:absolute; width:auto; height:250px; padding:3px; margin-left:30px; text-align:left; left: 151px; top: 332px;"></div></td>
          <td bgcolor="#eee"><select style="width:130px;" name="for_type" id="for_type">
          <option value="">..Select..</option>
      <option value="1">Male</option>
      <option value="0">Female</option>
      </select></td>
       <td bgcolor="#eee"><select style="width:130px;" name="size_type" id="size_type">
      <option value="">..Select..</option>
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
     
   <td bgcolor="#eee"><input type="number" name="mrp" id="mrp" style="width:90px; margin-bottom:0px;"/></td>
   <td bgcolor="#eee"><input type="number" name="ptr" id="ptr" style="width:90px; margin-bottom:0px;"/></td>

      <td bgcolor="#eee"><input type="number" name="t_spq" id="t_spq" style="width:60px; margin-bottom:0px;"/></td>
      <td id="tr2" style="display:none;" bgcolor="#eee"><input type="text" name="nts" id="nts" style="width:60px; margin-bottom:0px;"/></td>
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
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Price</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchase Price</strong></div></td>
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
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);

$sql_del2="delete from `barcod_master` where `purchase_id`='$_GET[id]' ";
mysql_query($sql_del2);
}
$sql="SELECT * FROM ph_purchase_master where status='1' ORDER BY id DESC";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$m_id=$row["medicine_id"];
$t_id=$row["type_id"];

$b_type=$row["for_type"];
if($b_type==1)
{
$btype='Male';
}
else
{
$btype='Female';
}
$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

?> 
  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $btype; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["size_type"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["mrp"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["ptr"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["total_rate"]; ?></strong></div></td>
<?php
if($iinn==0)
{
?>
    <td style="padding:2px 4px;"><div align="center"><a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Del</a></div></td>
<?php }?>
  </tr>
<?php 
}
}
?>
</table>

 </div>
<?php
$sql1="select SUM(total_rate)as gro_amt from ph_purchase_master where status='1'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$gro_amt=$row1['gro_amt'];
}
$sql3="select SUM(dis_amt)as tot_disamt from ph_purchase_master where status='1'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$tot_disamt=$row3['tot_disamt'];
}
$sql4="select SUM(tax_amt)as tot_taxamt from ph_purchase_master where status='1'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$tot_taxamt=$row4['tot_taxamt'];
}

$sql12="select SUM(net_amt)as net_amt from ph_purchase_master where status='1'";
$res12=mysql_query($sql12);
while($row12=mysql_fetch_array($res12))
{
$net_amt=$row12['net_amt'];
}

$sqln3="select * from ph_purchase_master where status='1'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);

$invoice_no123=$rown3['invoice_no'];
?>
		<table width="100%" cellpadding="6" border="1" style="margin-top:5px; border:solid 1px #ccc; font-size:12px;">
<form  action="purchase_master.php" name="form3" id="form3" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form3();">
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" width="30%">
    <table width="100%" border="0">
  <tr>
    <td align="right"><strong>Total:</strong></td>
    <td align="right"><input type="text" name="tot_amt" id="tot_amt" value="<?php echo number_format ($gro_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly/></td>
  </tr>

  <tr>
    <td align="right"><strong>Invoice No.:</strong></td>
    <td align="right"><input type="text" name="invoice_no" id="invoice_no" value="<?php echo $rown3['invoice_no'];?>" <?php if($rown3['invoice_no']!=0){ echo $rrroo; }?> style="width:100px; margin-bottom:0px; text-align:right;"/></td>
  </tr>
  <input type="hidden" name="vou_no" id="vou_no" value="<?php echo $vvv;?>" style=" margin-bottom:0px;"/>
  <tr>
    <td align="right"><strong>Net Amount:</strong></td>
    <td align="right"><input type="text" name="b" id="b" value="<?php  echo number_format ($net_amt,'2','.','');?>" style="width:100px; margin-bottom:0px; text-align:right;" readonly/></td>
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
   <form  action="purchase_master.php" name="form" id="form" method="post" enctype="multipart/form-data">
    <td align="right"><input type="submit" name="submit3" class="btn btn-info" value="Print" style="padding:2px 2px;"/></td>
    </form>
    <form  action="purchase_master.php" name="form" id="form" method="post" enctype="multipart/form-data">
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