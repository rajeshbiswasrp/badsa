﻿<?php
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
function showHint()
{

var xmlhttp;

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
xmlhttp.open("GET","ajax_search_indi_supplier.php?sup_id="+document.getElementById('supp_id').value+"&dt1="+document.getElementById('datepicker').value+"&dt2="+document.getElementById('datepicker1').value,true);
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
xmlhttp.open("GET","ajax_search_supplier_list.php?q="+str,true);
xmlhttp.send();
}
</script>
<script>
function selectedbox(id,supplier_name)
{

 document.getElementById("livesearch").innerHTML="";
 document.getElementById("business_live_search").value=supplier_name;
 document.getElementById("supp_id").value=id;
 document.getElementById("livesearch").style.border="0px";
  document.getElementById("fromtotable").style.display="block";
}
</script>
<script>
function dateinit(){
document.getElementById('fromtotable').style.display='none';
document.getElementById('datepicker').value="";
document.getElementById('datepicker1').value="";
}
</script>
<script>
function opensuprepotdoc(dt,dt1){
window.location="ph_indi_sup_report_print.php?dt="+dt+"&dt1="+dt1;
//window.open("ph_sup_report_print.php?dt="+dt+"&dt1="+dt1,'_blank');
}
</script>
<script>
function opensearchindisuprepotdoc(searchval,startdate,enddate){
window.location="ph_indi_sup_report_print.php?searchsupplier="+encodeURIComponent(searchval)+"&startdate="+encodeURIComponent(startdate)+"&enddate="+encodeURIComponent(enddate);
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
			<h4>Individual Stock / Supplier Reports<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<?php /*?><div id="sidebar" class="span12">
<form  action="ph_sup_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="submit" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/></td>
    </tr>
  </table>
  </form>
<br/>		
	  			
		
			
	</div><?php */?>
    
 <input  type="text" id="business_live_search" name="business_live_search"  onclick="return dateinit();" onKeyUp="showHintASP(this.value)" autocomplete = "off" placeholder="Search Supplier Name"/>
 <input type="hidden" name="supp_id" id="supp_id" value="">
<div id="livesearch"></div> 
<table class="table table-hover table-striped table-bordered" id="fromtotable" style="display:none;">
    <tr>
      <td><strong>From Date</strong></td>
     <td><input type="text" name="date" id="datepicker"/></td>
    <td><strong>To Date</strong></td>
     <td><input type="text" name="date2" id="datepicker1"/></td>
     <td><input type="button" name="submit" value="Go" class="btn btn-primary" style="width:100%;"/ onclick="return showHint();"></td>
    </tr>
  </table>

<br />	
 <div id="txtHint">
</div> 

<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Tax Amount</strong></th>
      <th><strong>Discount Amount</strong></th>
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
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
?>
	

<?php
$sum=0;
$sum2=0;
$sum3=0;
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

$sqli = "SELECT DISTINCT voucher_no FROM ph_purchase_master where date between '$date' and '$date1'";
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
$t_spq=$row["t_spq"];
$ptr=$row["ptr"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tax_per=$row["tax_per"];
$ed_per=$row["ed_per"];
$vat_tax=$tax_per+$ed_per;
$tot_qty=$t_spq-$re_qty;
$gross_amt=$tot_qty*$ptr;
$vat_amt1=$gross_amt*$vat_tax/100;

if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$gross_amt;
$gro_amt=$sum;

$sum2=$sum2+$vat_amt1;
$vat_amt=$sum2;
}
else
{
//echo "555";
$sum=0;
$sum2=0;

$sum=$sum+$gross_amt;
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

$sql13="select SUM(dis_amt)as dis_amt from ph_purchase_master where voucher_no='$vou_no'";
$res13=mysql_query($sql13);
while($row13=mysql_fetch_array($res13))
{
$disco_amt=$row13['dis_amt'];
}

$tot_amt=$gro_amt+$vat_amt-$disco_amt;

$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where voucher_no='$vou_no'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$tot_amt-$pay_amt;
$sum3=$sum3+$due_amt;
$sum4=$sum4+$pay_amt;
$sum5=$sum5+$disco_amt;
$sum6=$sum6+$vat_amt;
$sum7=$sum7+$gro_amt;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><?php echo $row21["sup_name"]; ?></td>
      <td><div align="right"><?php echo number_format($gro_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($vat_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($disco_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($pay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($due_amt,2); ?></div></td>
      <td><a href='ph_purchase_stock_report.php?voucher_no=<?php echo $rowi["voucher_no"];?>'>View</a></td>
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
      <td><div align="right"><strong><?php echo number_format($sum7,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum6,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum5,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum4,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum3,2); ?></strong></div></td>
      <td><strong>&nbsp;</strong></td>
    </tr>  

<tr>
      <td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensuprepotdoc('<?php echo $date;?>','<?php echo $date1;?>');" target="_blank" /></td>
             
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