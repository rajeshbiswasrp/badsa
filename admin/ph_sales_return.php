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

$return_no=$_POST["return_no"];
$dd=(date("Y-m-d"));

foreach($_REQUEST['allbox2'] as $key=>$value)
	{ 
$base=$_POST['base'.$value];
$purchase_id=$_POST['return_qty'.$purchase_id];	
$return_qty=$_POST['return_qty'.$value];
$mrp=$_POST['mrp'.$value];
$tot_sramt=$return_qty*$mrp;

$medicine_id=$_POST['medicine_id'.$value];	
$nts=$_POST['nts'.$value];	

if($base==0)
{
$tot_pices=$return_qty*$nts;
}
else
{
$tot_pices=$return_qty;
}



$taxpm=$_POST['taxpm'.$value];
$tax_amt=$tot_sramt*$taxpm/100;
$net_amt=$tot_sramt+$tax_amt;
	
$sql="INSERT INTO ph_sales_return (return_no,invoice_no,ph_sales_id,purchase_id,base,return_qty,medicine_id,nts,tot_pices,mrp,tot_sramt,taxpm,tax_amt,net_amt,status,date)
VALUES ('$return_no','".$_REQUEST['invoice_no1'.$value]."','$value','".$_REQUEST['purchase_id'.$value]."','".$_REQUEST['base'.$value]."','".$_REQUEST['return_qty'.$value]."','".$_REQUEST['medicine_id'.$value]."','".$_REQUEST['nts'.$value]."','$tot_pices','".$_REQUEST['mrp'.$value]."','$tot_sramt','".$_REQUEST['taxpm'.$value]."','$tax_amt','$net_amt','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();
}
?>
<script>window.location="ph_patient_view.php"</script>
<?php
}
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
 
 <script language="javascript">
function check_form()
{
/*var return_qty=document.getElementById("return_qty1").value;
var qtyinhand=document.getElementById("qtyinhand").value;

if(parseInt(return_qty) > parseInt(qtyinhand))
{
alert("Return Box should not be greater than Box In Hand");
return false;
}
return true;*/
  // alert('hi');

}
$(document).ready(function(){
	$("#submit_form").click(function(e){
		
		var flag=0;
		
		$(".product_row").each(function(){
			var inhand_amount=$(this).find('.inhand_value').find('div').find('strong').find('input').val();
		var return_value=$(this).find('.return_value').find('div').find('strong').find('input').val();
			
			if(parseInt(return_value)>parseInt(inhand_amount))
			{
				alert("Return Qty should not be greater than Qty");
				flag=1;
			}
		});
		
		if(parseInt(flag)==0)
		{
			//alert('kk');
			
			$("#submit_form1").click();
		}
		else
		  return false;
	});
});
</script>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->
		<div class="span12">		
			<div class="well well-small">
			<h4>Sales Return Details <small class="pull-right">&nbsp;</small></h4><br /><div align="center" style="color:#FF0000; font-size:16px;">Note :-  If items are purchased in boxes than it should return boxes only and purchased in pieces than it should return in pieces only.</div>
            <form  action="ph_sales_return.php" name="form" id="form" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form();">
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Base</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Returned Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Return Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="right"><strong>MRP</strong></div></td>
    <!--<td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Dis%</strong></div></td>-->
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch No.</strong></div></td>
<!--    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Expire Date</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="right"><strong> Amount</strong></div></td>-->
    <!--<td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>-->
  </tr>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `ph_sales_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);

$sql_del2="delete from `ph_sales_return` where `ph_sales_id`='$_GET[id]' ";
mysql_query($sql_del2);
}

$sqlvoice="select max(id) as inv from ph_sales_return where invoice_no='$invoice_no'";
$rowvoice=mysql_query($sqlvoice);
while($row21=mysql_fetch_array($rowvoice))
{
 $max_id=$row21["inv"];
}
$sqlvoice11="select * from ph_sales_return where id='$max_id'";
$rowvoice11=mysql_query($sqlvoice11);
$num1=mysql_num_rows($rowvoice11);
while($row11=mysql_fetch_array($rowvoice11))
{
$return_no=($row11["return_no"]+1);
} 
if($num1==0)
{
$return_no=1;
}

$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sales_id=$row["id"];
$m_id=$row["medicine_id"];
$bbase=$row["base"];
if($bbase==0)
{
$bb='Box';
}
else{
$bb='Pieces';
}

$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
?> 
  <tr class="product_row">
  <input type="hidden" name="return_no" id="return_no" value="<?php echo $return_no; ?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="invoice_no1<?php echo $row["id"];?>" id="invoice_no1<?php echo $row["id"];?>" value="<?php echo $invoice_no; ?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="allbox2[]" id="allbox2[]" value="<?php echo $row["id"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="base<?php echo $row["id"];?>" id="base<?php echo $row["id"];?>" value="<?php echo $row["base"];?>" style="width:50px; margin-bottom:0px;" />
   <input type="hidden" name="mrp<?php echo $row["id"];?>" id="mrp<?php echo $row["id"];?>" value="<?php echo $row["mrp"];?>" style="width:50px; margin-bottom:0px;" />
   <input type="hidden" name="purchase_id<?php echo $row["id"];?>" id="purchase_id<?php echo $row["id"];?>" value="<?php echo $row["purchase_id"];?>" style="width:50px; margin-bottom:0px;" />
      <input type="hidden" name="taxpm<?php echo $row["id"];?>" id="taxpm<?php echo $row["id"];?>" value="<?php echo $row["taxpm"];?>" style="width:50px; margin-bottom:0px;" />
      <input type="hidden" name="medicine_id<?php echo $row["id"];?>" id="medicine_id<?php echo $row["id"];?>" value="<?php echo $row["medicine_id"];?>" style="width:50px; margin-bottom:0px;" />
      <input type="hidden" name="nts<?php echo $row["id"];?>" id="nts<?php echo $row["id"];?>" value="<?php echo $row["nts"];?>" style="width:50px; margin-bottom:0px;" />
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $bb; ?></strong></div></td>
    <td style="padding:2px 4px;" class="inhand_value"><div align="center"><strong><input type="text" name="qtyinhand" id="qtyinhand" value="<?php echo $row["iss_qty"]; ?>"readonly="readonly" style="width:50px; margin-bottom:0px;"/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;" class="return_value"><div align="center"><strong><input type="number" name="return_qty<?php echo $row["id"];?>" id="return_qty<?php echo $row["id"];?>" style="width:50px; margin-bottom:0px;" /></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php echo number_format($row["mrp"],2); ?></strong></div></td>
    <!--<td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["dico_per"]; ?></strong></div></td>-->
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
<!--    <td style="padding:2px 4px;"><div align="center"><strong><?php //echo $row["exp_date"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php //echo $row["gross_amt"]; ?></strong></div></td>-->
    <!--<td style="padding:2px 4px;"><div align="center"><a href='ph_sales_return.php?id=<?php //echo $row[id];?>'>Del</a></div></td>-->
  </tr>
<?php 
}
}
?>
</table>
 </div>
           <div align="center">
             <input type="submit" id="submit_form" name="submit" class="btn btn-info" value="Return" style="padding:2px 2px;"/>
             <input type="submit" id="submit_form1" name="submit" class="btn btn-info" value="Return" style="padding:2px 2px;display:none"/>
           </div>
			</div>
</form>              
              
<br />
<table class="table table-hover table-striped table-bordered">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Return No.</strong></th>
      <th><strong>Returned Qty</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>

<?php
$c=1;
$sqli = "SELECT DISTINCT return_no,date FROM ph_sales_return where invoice_no='$invoice_no'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$re_no=$rowi['return_no'];

$sql2="select SUM(return_qty)as tot_rqty from ph_sales_return where return_no='$re_no'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$tot_rqty=$row2['tot_rqty'];
}?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowi["date"]; ?></td>
      <td><?php echo $rowi["return_no"]; ?></td>
      <td><?php echo $tot_rqty; ?></td>
      <td><a href='sales_return_print.php?invoice_no=<?php echo $row["invoice_no"];?>&return_no=<?php echo $rowi["return_no"];?>'>Print</a></td>
    </tr>
<?php 
$c=$c+1;
}
?>
  </table>              
              
              
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