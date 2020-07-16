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
 <script>
function showHint(str)
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
xmlhttp.open("GET","ajax_search_customer.php?q="+str+"&patient_creator="+$('input:radio[name=patient_creator]').filter(":checked").val()+"&searchtype="+$('input:radio[name=searchtype]').filter(":checked").val(),true);
xmlhttp.send();
}
</script> 
<script>
function showHintASP(str)
{
if (str.length==0)
  { 
   document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
   document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","ajax_search_customer.php?q="+str+"&patient_creator="+$('input:radio[name=patient_creator]').filter(":checked").val()+"&searchtype="+$('input:radio[name=searchtype]').filter(":checked").val(),true);
xmlhttp.send();
}
</script>
<script>
function selectedbox(id,patient_type,patient_id,referid,bed_no,patient_name)
{
showcustomerdetails(id,patient_type,patient_id,referid,bed_no);
 document.getElementById("livesearch").innerHTML="";
 document.getElementById("business_live_search").value=patient_name;
 document.getElementById("livesearch").style.border="0px";
}
</script>
<script>
//function showcustomerdetails(id,patient_type,patient_id,refername,bed_no,patient_name,address,mobile,admissiondate,dischargedate){
function showcustomerdetails(id,patient_type,patient_id,referid,bed_no){
if(id==""){
	//window.location="products.php";
	}
var xmlhttp;
if (id.length==0)
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
//xmlhttp.open("GET","ajax_search_customer1.php?pati_id="+id+"&patient_type="+patient_type+"&patient_id="+encodeURIComponent(patient_id)+"&refername="+encodeURIComponent(refername)+"&bed_no="+encodeURIComponent(bed_no)+"&patient_name="+encodeURIComponent(patient_name)+"&address="+encodeURIComponent(address)+"&mobile="+encodeURIComponent(mobile)+"&admissiondate="+encodeURIComponent(admissiondate)+"&dischargedate="+encodeURIComponent(dischargedate),true);
xmlhttp.open("GET","ajax_search_customer1.php?pati_id="+id+"&patient_type="+patient_type+"&patient_id="+encodeURIComponent(patient_id)+"&referid="+referid+"&bed_no="+encodeURIComponent(bed_no)+"&searchtype="+$('input:radio[name=searchtype]').filter(":checked").val(),true);
xmlhttp.send();
}
</script>
<script>
function showdiv(val){
if(val==1)
{
	$("#txtHint").val('');
	$("#datesearch").hide('slow');
	$("#serachindividualtype").show('slow');
	$("#product-table").hide('slow');
	$("#business_live_search").show();
	$("#autosuggest_menu_input").hide();
	
}
else
if(val==0)
{
	$("#livesearch").val('');
	$("#txtHint").val('');
	$("#datesearch").show('slow');
	$("#serachindividualtype").hide('slow');
	$("#product-table").show('slow');
	$("#business_live_search").hide();
	$("#autosuggest_menu_input").show();
}

}
</script>

<script>
function opencusrepotdoc(dt,dt1){
window.location="ph_cus_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>
<script>
function opensearchcusrepotdoc(searchval,patient,searchtype){
window.location="ph_cus_report_print.php?searchcustomer="+encodeURIComponent(searchval)+"&patient="+patient+"&searchtype="+searchtype;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>
<script>
function opensearchcusrepotdoc1(pati_id,patient_type,patient_id,referid,bed_no,search_type){
window.location="ph_cus_report_print1.php?pati_id="+pati_id+"&patient_type="+patient_type+"&patient_id="+patient_id+"&referid="+referid+"&bed_no="+bed_no+"&search_type="+search_type;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
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
			<h4>Patient Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_cus_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
All Patients<input style="margin-right:5px;" checked="checked" onchange="showdiv(this.value);" type="radio" name="patient_creator" id="patient_creator" value="0">Individual<input onchange="showdiv(this.value);" type="radio" name="patient_creator" id="patient_creator1" value="1">
<table class="table table-hover table-striped table-bordered" id="datesearch">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
 
		
		
		<br/>
			
	</div>
<div id="serachindividualtype" style="display:none;">
<label>Search Patient</label>
Summary Report<input checked="checked" style="margin-right:5px;" type="radio" name="searchtype" id="searchtype" value="0">Details Report<input type="radio" name="searchtype" id="searchtype1" value="1">
</div>
<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Search Patient Name or Receipt No" type="text"   onkeyup="showHint(this.value)" style="width:250px;border:solid 1px #999;"/>
 <input style="display:none;width:250px;" type="text" id="business_live_search" name="business_live_search"  onKeyUp="showHintASP(this.value)" autocomplete = "off" placeholder="Search Patient or Bed no or Doctor Name"/>
<div id="livesearch"></div> 
<br />	
 <div id="txtHint">
</div> 
 </form>
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong><!--Invoice No.-->Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Add Charges</strong></th>
      <th><strong>Discount</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<tbody>         
    <?php
if($_POST["submit"])
{

$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $dt=$date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $dt1=$date1 = "$year-$month-$day";
?>

<?php
$sum=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where date between '$date' and '$date1'";
$resulti = mysql_query($sqli);

$sumgros=0;
$sumadd=0;
$sumdis=0;
$sumpay=0;
$sumdue=0;


while($rowi = mysql_fetch_array($resulti))
{
$inv=$rowi['invoice_no'];
$temp_voucher=0;
$oldtempvoucher='999999999999999999';

$sql="SELECT * FROM ph_sales_master where invoice_no='$inv'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$pati_type=$row["pati_type"];

$temp_voucher=$row["invoice_no"];
$p_id=$row["pati_id"];
$date=$row["date"];

$sales_id=$row["id"];
$mrp=$row["mrp"];
$m_id=$row["medicine_id"];
$iss_qty=$row["iss_qty"];

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tot_qty=$iss_qty-$re_qty;
$gross_amt=$tot_qty*$mrp;

if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
else
{
//echo "555";
$sum=0;
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}

if($pati_type==0)
$sql21="SELECT * FROM ph_patient_master where id='$p_id'";
else
if($pati_type==1)
$sql21="SELECT * FROM patient_master where id='$p_id'";

$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$pati_name=$row21["pati_name"];
}

$sql2="select SUM(less_pay)as pay_amt from ph_sales_payment where invoice_no='$inv'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$pay_amt=$row2['pay_amt'];
}
$sql3="select SUM(add_charge)as add_amt from ph_sales_payment where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$add_amt=$row3['add_amt'];
}

$sql4="select SUM(less_dis)as dis_amt from ph_sales_payment where invoice_no='$inv'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$dis_amt=$row4['dis_amt'];
}

$tot_amt=$gro_amt+$add_amt;
$due_amt=$tot_amt-$pay_amt-$dis_amt;
?>       
    <tr>
      <td><div align="left"><?php echo $c;?></div></td>
      <td><div align="left"><?php echo $date; ?></div></td>
      <td><?php //echo $rowi["invoice_no"]; ?><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><div align="right"><?php echo number_format($gro_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($add_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($dis_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($pay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($due_amt,2); ?></div></td>
      <td><a href='ph_sales_stock_report.php?invoice_no=<?php echo $rowi["invoice_no"];?>' target="_blank">View</a></td>
      </tr>
<?php 
$c=$c+1;

$sumgros=$sumgros+$gro_amt;
$sumadd=$sumadd+$add_amt;
$sumdis=$sumdis+$dis_amt;
$sumpay=$sumpay+$pay_amt;
$sumdue=$sumdue+$due_amt;
}
?>    
   <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
     <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sumgros,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumadd,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumdis,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumpay,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sumdue,2); ?></strong></div></td>
      <td>&nbsp;</td>
  </tr>
  
<tr>
<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opencusrepotdoc('<?php echo $dt;?>','<?php echo $dt1;?>');" target="_blank" /></td>
</tr>  
  
  
<?php 
}
?>
</tbody>     
</table>			 

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