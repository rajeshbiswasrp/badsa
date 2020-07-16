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
			<h4>Profit / Loss Report<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_all_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
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
      <th><strong>Purchase</strong></th>
      <th><strong>Sale</strong></th>
    </tr>
        </tbody>
<tbody>           
	

       
    <tr>
      <td><table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Invoice No.</strong></th>
       <th><strong>Gross Purchased</strong></th>
      <th><strong>Purchased Returned</strong></th>
      <th><strong>Net Purchased</strong></th>
    </tr>
        </tbody>
<tbody>           

	

<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum33=0;
$sum34=0;
$sum35=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$c=1;
if($_GET[id]!="")
{
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);
}

$sqli = "SELECT DISTINCT voucher_no,invoice_no FROM ph_purchase_master where date between '$date' and '$date1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$vou_no=$rowi['voucher_no'];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM ph_purchase_master where voucher_no='$vou_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
//echo $vou_no=$row["voucher_no"];
//$tem_vono."<br>";
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$sup_id=$row["sup_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";

$t_spq=$row["qty"];
$ptr=$row["ptr"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["taxpm"];

$sql33="select SUM(total_rate)as totrate from ph_purchase_master where voucher_no='$temp_voucher'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}

$sql3="select SUM(ptr)as totreturn from ph_purchase_return where voucher_no='$temp_voucher'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}
$net_rate=$totrate-$totreturn;



if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;
$sum=$net_rate;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
$oldtempvoucher=$temp_voucher;
}
$sql21="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{



$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$vou_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$sum33=$sum33+$totrate;
$sum34=$sum34+$totreturn;
$sum35=$sum35+$net_rate;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><?php echo $rowi["invoice_no"]; ?></td>
      <td><div align="right"><?php echo number_format($totrate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totreturn,2); ?></div></td>
      <td><div align="right"><?php echo number_format($net_rate,2); ?></div></td>
      </tr>
<?php 
$c=$c+1;
}
}

?>  
<tr>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sum33,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum34,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum35,2); ?></strong></div></td>
        </tr>  


</tbody>   
</table></td>



      <td>
      <table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Receipt No.</strong></th>
      <th><strong>Customer Name</strong></th>
       <th><strong>Gross Amt</strong></th>
      <th><strong>Dis Amt</strong></th>
      <th><strong>Return Amt(-Dis)</strong></th>
      <th><strong>Net Amt</strong></th>
    </tr>
        </tbody>
<?php
$sum=0;
$sum546=0;
$sum547=0;
$sum548=0;
$sum549=0;
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


$sqln="select*from ph_sales_payment where invoice_no='$inv'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
$dis_amt=$rown["dis_amt"];

$net_rate=$tot_rate1-$dis_amt;
$gross_rate=$net_rate;


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

$sum546=$sum546+$totrate;
$sum547=$sum547+$dis_amt;
$sum548=$sum548+$totooretun;
$sum549=$sum549+$tot_rate1;
?>       
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $datess; ?></td>
      <td><?php echo $rowi["receipt_no"]; ?></td>
      <td><?php echo $pati_name; ?></td>
      <td><div align="right"><?php echo number_format($totrate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($dis_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totooretun,2); ?></div></td>
      <td><div align="right"><?php echo number_format($tot_rate1,2); ?></div></td>

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
      <td><div align="right"><strong><?php echo number_format($sum547,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum548,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum549,2); ?></strong></div></td>
        </tr>    
  </table>
      
      </td>
      </tr>  
</tbody>   
</table>
<br />
<table class="table table-hover table-striped table-bordered">
            <tbody>
      <tr>
      <th><strong>Total Purchase</strong></th>
      <th><strong>Total Sale</strong></th>
      <th><strong>Total Profit / Loss</strong></th>
   </tr>
        </tbody>
    <tr>
<?php
$pro=$sum549-$sum35;
?>
      <td><?php echo number_format($sum35,2); ?></td>
      <td><?php echo number_format($sum549,2); ?></td>
      <td><?php echo number_format($pro,2); ?></td>
    </tr>
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