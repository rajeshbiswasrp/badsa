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
	window.location="ph_supplier_view.php";
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
xmlhttp.open("GET","ajax_search_supplier_view.php?q="+str,true);
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
			<h4 style="margin-top:0px; font-size:15px;">View Supplier <small class="pull-right">&nbsp;</small></h4>
            
      
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
<input aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" id="autosuggest_menu_input" name="autosuggest_menu" placeholder="Search Actions" type="text"   onkeyup="showHint(this.value)" style="border:solid 1px #999;"/>
<br />	
 <div id="txtHint">
</div> 
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Supplier Name</strong></th>
      <th><strong>Supplier Id</strong></th>
      <th><strong>Gross Purchased</strong></th>
      <th><strong>Purchased Returned</strong></th>
      <th><strong>Net Purchased</strong></th>
      <th><strong>Paid Amount</strong></th>
      <th><strong>Due Amount</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<tbody>           
<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum33=0;
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

$sqli = "SELECT DISTINCT sup_id FROM ph_purchase_master where voucher_no!='' ORDER BY id DESC";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$sup_id=$rowi["sup_id"];
$temp_voucher=0;
$oldtempvoucher='9999999';

$sql="SELECT * FROM ph_purchase_master where sup_id='$sup_id'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";

$t_spq=$row["qty"];
$ptr=$row["ptr"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["taxpm"];

$sql33="select SUM(total_rate)as totrate from ph_purchase_master where sup_id='$sup_id'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}
$sql3="select SUM(ptr)as totreturn from ph_purchase_return where sup_id='$sup_id'";
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
$sum6=$sum6+$vat_amt1;
}
$sql21="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{



$sql14="select SUM(less_pay)as pay_amt from ph_supplier_payment where sup_id='$sup_id'";
$res14=mysql_query($sql14);
while($row14=mysql_fetch_array($res14))
{
$pay_amt=$row14['pay_amt'];
}
$due_amt=$gro_amt-$pay_amt;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $row21["sup_name"]; ?></td>
      <td><?php echo $row21["supplier_id"]; ?></td>
      <td><div align="right"><?php echo number_format($totrate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totreturn,2); ?></div></td>
      <td><div align="right"><?php echo number_format($net_rate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($pay_amt,2); ?></div></td>
      <td><div align="right"><?php echo number_format($due_amt,2); ?></div></td>
     <td><a href='ph_supplier_payment.php?sup_id=<?php echo $rowi["sup_id"];?>'>Pay</a></td>
      </tr>
<?php 
$c=$c+1;
}
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