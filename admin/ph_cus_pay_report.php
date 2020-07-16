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
xmlhttp.open("GET","ajax_search_supplier.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function opensuprepotdoc(dt,dt1){
window.location="ph_sup_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>
<script>
function opensearchsuprepotdoc(searchval){
window.location="ph_sup_report_print.php?searchsupplier="+encodeURIComponent(searchval);
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
			<h4>Daily Sale Report<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_cus_pay_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker" value="<?php echo $date_date;?>"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1" value="<?php echo $date_date;?>"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
  </form>
<br/>		
	  			
		
			
	</div>
    
<!--<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Search Actions" type="text"   onkeyup="showHint(this.value)" style="border:solid 1px #999;"/>-->
<br />	
 <div id="txtHint">
</div> 
	
<?php
if($_POST["submit"])
{

$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
?>

<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sale</strong></th>
    </tr>
        </tbody>
<tbody>           
	

       
    <tr>
      <td>
      <table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Dis Amount</strong></th>
       <th><strong>Return Amount (-Dis)</strong></th>
      <th><strong>Net Amount</strong></th>
      <th><strong>Pay by Credit</strong></th>
      <th><strong>Pay by Cash</strong></th>
      <th><strong>Pay by Bank</strong></th>
      <th><strong>Total Paid Amount</strong></th>
     <!-- <th><strong>Due Amount</strong></th>-->
    </tr>
        </tbody>
<?php
$sum=0;
$sum546=0;
$sum8=0;
$sum9=0;
$sum10=0;
$sum11=0;
$sum12=0;
$sum13=0;
$sum14=0;
$sum15=0;
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_sales_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}

$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where date between '$date' and '$date1'";
$resulti = mysql_query($sqli);
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
$bill_date=$row["bill_date"];
$sales_id=$row["id"];
$mrp=$row["mrp"];
$iss_qty=$row["iss_qty"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["vat"];

$sjd=$row['date'];
list($year,$month,$day)=split('[-.]',$sjd);
                    $datess = "$day-$month-$year";

$sql33="select SUM(gross_amt)as totrate from ph_sales_master where invoice_no='$inv'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}

$sql3="select SUM(tot_amt)as totreturn from ph_sale_return where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}

$sql31="select SUM(dis_amt)as disreturn from ph_sale_return where invoice_no='$inv'";
$res31=mysql_query($sql31);
while($row31=mysql_fetch_array($res31))
{
$disreturn=$row31['disreturn'];
}
$totooretun1=$totreturn-$disreturn;
$totooretun=round($totooretun1);
$tot_rate1=$totrate-$totreturn-$totooretun;


$net_rate=$totrate;
$gross_rate=$totrate;


if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$gross_rate;
$gro_amt=$sum;
}
else
{
//echo "555";
$sum=0;
$sum=$gross_rate;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}

if($pati_type)
$sql21="SELECT * FROM patient_master where id='$p_id'";
else
$sql21="SELECT * FROM ph_patient_master where id='$p_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$pati_name=$row21["pati_name"];
}

$sql2="select SUM(net_amt)as pay_amt from ph_sales_payment where invoice_no='$inv'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$pay_amt=$row2['pay_amt'];
}
$sql3="select SUM(credit_amt)as pay_credit from ph_sales_payment where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$pay_credit=$row3['pay_credit'];
}
$tot_payment=$pay_amt+$pay_credit-$totooretun;

$sql24="select SUM(dis_amt)as totdis_amt from ph_sales_payment where invoice_no='$inv'";
$res24=mysql_query($sql24);
while($row24=mysql_fetch_array($res24))
{
$totdis_amt=$row24['totdis_amt'];
}

$due_amt=$gro_amt-$tot_payment-$totdis_amt;
$sum546=$sum546+$gro_amt;

$sql22="select SUM(net_amt)as cashpay_amt from ph_sales_payment where invoice_no='$inv' and pay_type='1'";
$res22=mysql_query($sql22);
while($row22=mysql_fetch_array($res22))
{
$cashpay_amt=$row22['cashpay_amt'];
}
$sql23="select SUM(net_amt)as bankpay_amt from ph_sales_payment where invoice_no='$inv' and pay_type='0'";
$res23=mysql_query($sql23);
while($row23=mysql_fetch_array($res23))
{
$bankpay_amt=$row23['bankpay_amt'];
}




$sum8=$sum8+$cashpay_amt;
$sum9=$sum9+$bankpay_amt;
$sum12=$sum12+$pay_credit;
$sum13=$sum13+$totdis_amt;
$sum10=$sum10+$tot_payment;
$sum11=$sum11+$due_amt;
$sum14=$sum14+$totooretun;
$sum15=$sum15+$tot_rate1;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $datess; ?></td>
      <td><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><div align="right"><?php echo number_format($gro_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totdis_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totooretun,2); ?></div></td>
      <td><div align="right"><?php echo number_format($tot_rate1,2); ?></div></td>
      <td><div align="right"><?php echo number_format($pay_credit,2); ?></div></td>
      <td><div align="right"><?php echo number_format($cashpay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($bankpay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($tot_payment,2); ?></div></td>
      <!--<td><div align="right"><?php //echo number_format($due_amt,2); ?></div></td>-->
      </tr>
<?php 
$c=$c+1;
}
?>  
<tr>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sum546,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum13,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum14,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum15,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum12,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum8,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum9,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum10,2); ?></strong></div></td>
      <!--<td><div align="right"><strong><?php //echo number_format($sum11,2); ?></strong></div></td>-->
        </tr>    
  </table>      </td>
      </tr>  
</tbody>   
</table>


  
<?php 
}
?> 

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