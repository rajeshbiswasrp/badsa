<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$voucher_no=$_REQUEST['voucher_no'];
//$sql_update = "UPDATE ph_purchase_return SET status='0' WHERE voucher_no='$voucher_no'";
					//$qry_update= mysql_query($sql_update);
?>

<?php
if($_POST["submit"])
{
$voucher_no1=$_POST["voucher_no1"];
//$ph_sales_id=$_POST["ph_sales_id"];

$return_no=$_POST["return_no"];


//die();
$dd=(date("Y-m-d"));
//$code='KAL/RET/'.date('Y');

foreach($_REQUEST['allbox2'] as $key=>$value)
	{ 
$ptr=$_POST['ptr'.$value];
$return_qty=$_POST['return_qty'.$value];
$tot_ramt=$return_qty*$ptr;

$medicine_id=$_POST['medicine_id'.$value];

$base_type=$_POST['base_type'.$value];
$nts=$_POST['nts'.$value];

if($base_type==0)
{
$tot_pices=$return_qty*$nts;
}
else
{
$tot_pices=$return_qty;
}




$dis_status=$_POST['dis_status'.$value];
$discount=$_POST['discount'.$value];
$tax_status=$_POST['tax_status'.$value];
$taxpm=$_POST['taxpm'.$value];

if($dis_status==0)
{
$dis_amt=$tot_ramt*$discount/100;
}
else
{
$dis_amt=$discount;
}
$after_dis=$tot_ramt-$dis_amt;
$tax_amt=$after_dis*$taxpm/100;
$net_amt=$after_dis+$tax_amt;

$sql="INSERT INTO ph_purchase_return (return_no,voucher_no,ph_purchase_id,medicine_id,base_type,return_qty,nts,tot_pices,ptr,tot_ramt,dis_status,discount,tax_status,taxpm,dis_amt,after_dis,tax_amt,net_amt,status,date)
VALUES ('$return_no','".$_REQUEST['voucher_no1'.$value]."','$value','".$_REQUEST['medicine_id'.$value]."','".$_REQUEST['base_type'.$value]."','".$_REQUEST['return_qty'.$value]."','".$_REQUEST['nts'.$value]."','$tot_pices','".$_REQUEST['ptr'.$value]."','$tot_ramt','".$_REQUEST['dis_status'.$value]."','".$_REQUEST['discount'.$value]."','".$_REQUEST['tax_status'.$value]."','".$_REQUEST['taxpm'.$value]."','$dis_amt','$after_dis','$tax_amt','$net_amt','1','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();

}

?>
<script>window.location="ph_supplier_view.php"</script>
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
				alert("Return Box should not be greater than Box In Hand");
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
			<h4>Purchase Return Details <small class="pull-right">&nbsp;</small></h4>
            <form  action="ph_purchase_return.php" name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="javascript: return check_form1();">
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">
  <table id="product-table" class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="10" cellspacing="5" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchase Price</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchased in</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Purchased Box / Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Pieces in Box</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Returned Box / Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Box</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Sale Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Total Sale Return Pieces</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Box In Hand</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Pieces In Hand</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Return Box / Pieces</strong></div></td>
  </tr>
<?php
if($_GET[id]!="")
{
$sql_del="delete from `ph_purchase_master` where `id`='$_GET[id]' ";
mysql_query($sql_del);

$sql_del2="delete from `ph_purchase_return` where `ph_purchase_id`='$_GET[id]' ";
mysql_query($sql_del2);
}

$sqlvoice="select max(id) as inv from ph_purchase_return where voucher_no='$voucher_no'";
$rowvoice=mysql_query($sqlvoice);
while($row21=mysql_fetch_array($rowvoice))
{
 $max_id=$row21["inv"];
}
$sqlvoice11="select * from ph_purchase_return where id='$max_id'";
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

$sql="SELECT * FROM ph_purchase_master where voucher_no='$voucher_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$pqty=$row["qty"];
$total_qty_p=$row["total_qty_p"];
$nts=$row["nts"];

$m_id=$row["medicine_id"];
$b_type=$row["base_type"];
if($b_type==0)
{
$btype='Box';
}
else
{
$btype='Pieces';
}

$purchase_id=$row["id"];

$sql3="select SUM(return_qty)as re_qty from ph_purchase_return where ph_purchase_id='$purchase_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$re_qtyinpieces=$re_qty*$nts;
$sql33="select SUM(iss_qty)as isb_qty from ph_sales_master where purchase_id='$purchase_id' and base='0'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$isb_qty=$row33['isb_qty'];
}
$isb_qtyinpp=$isb_qty*$nts;
$sql333="select SUM(iss_qty)as isp_qty from ph_sales_master where purchase_id='$purchase_id' and base='1'";
$res333=mysql_query($sql333);
while($row333=mysql_fetch_array($res333))
{
$isp_qty=$row333['isp_qty'];
}

$totsalepp=$isp_qty+$isb_qtyinpp;


$sql33r="select SUM(return_qty)as isb_return from ph_sales_return where purchase_id='$purchase_id' and base='0'";
$res33r=mysql_query($sql33r);
while($row33r=mysql_fetch_array($res33r))
{
$isb_return=$row33r['isb_return'];
}
$isb_rrrrinpp=$isb_return*$nts;
$sql333r="select SUM(return_qty)as isp_return from ph_sales_return where purchase_id='$purchase_id' and base='1'";
$res333r=mysql_query($sql333r);
while($row333r=mysql_fetch_array($res333r))
{
$isp_return=$row333r['isp_return'];
}
$totsalereturnpp=$isb_rrrrinpp+$isp_return;


$sql333rpr="select SUM(return_qty)as pppppprrrrr from ph_purchase_return where ph_purchase_id='$purchase_id' and base_type='1'";
$res333rpr=mysql_query($sql333rpr);
while($row333rpr=mysql_fetch_array($res333rpr))
{
$pppppprrrrr=$row333rpr['pppppprrrrr'];
}

$qtyinhandinpieces1=$pqty+$isp_return;
$qtyinhandinpieces=$qtyinhandinpieces1-$isp_qty-$pppppprrrrr;



$abc=$total_qty_p-$re_qtyinpieces;
$qtyinhand2=$abc-$totsalepp;
$qtyinhand1=$qtyinhand2+$totsalereturnpp;

$ttbbox1=$qtyinhand1/$nts;
$result123 = fmod($qtyinhand1,$nts);
$result1231=floor( $ttbbox1);
$qtyinhand=$result1231.'.'.$result123;

$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

?> 
  <tr class="product_row" >
  <input type="hidden" name="return_no" id="return_no" value="<?php echo $return_no; ?>" style="width:50px; margin-bottom:0px;" />
   <input type="hidden" name="voucher_no1<?php echo $row["id"];?>" id="voucher_no1<?php echo $row["id"];?>" value="<?php echo $voucher_no; ?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="allbox2[]" id="allbox2[]" value="<?php echo $row["id"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="base_type<?php echo $row["id"];?>" id="base_type<?php echo $row["id"];?>" value="<?php echo $row["base_type"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="ptr<?php echo $row["id"];?>" id="ptr<?php echo $row["id"];?>" value="<?php echo $row["ptr"];?>" style="width:50px; margin-bottom:0px;" />
  
  
  <input type="hidden" name="dis_status<?php echo $row["id"];?>" id="ptr<?php echo $dis_status["id"];?>" value="<?php echo $row["dis_status"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="discount<?php echo $row["id"];?>" id="discount<?php echo $row["id"];?>" value="<?php echo $row["discount"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="tax_status<?php echo $row["id"];?>" id="tax_status<?php echo $row["id"];?>" value="<?php echo $row["tax_status"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="taxpm<?php echo $row["id"];?>" id="taxpm<?php echo $row["id"];?>" value="<?php echo $row["taxpm"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="nts<?php echo $row["id"];?>" id="nts<?php echo $row["id"];?>" value="<?php echo $row["nts"];?>" style="width:50px; margin-bottom:0px;" />
  <input type="hidden" name="medicine_id<?php echo $row["id"];?>" id="medicine_id<?php echo $row["id"];?>" value="<?php echo $row["medicine_id"];?>" style="width:50px; margin-bottom:0px;" />
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["ptr"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $btype; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["nts"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $re_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $isb_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $isp_qty; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $totsalereturnpp; ?></strong></div></td>
<?php 
if($qtyinhand>'0')
{
?>
    <td style="padding:2px 4px;" class="inhand_value"><div align="center"><strong><input type="text" name="qtyinhand" id="qtyinhand" value="<?php echo $qtyinhand; ?>" readonly="readonly" style="width:50px; margin-bottom:0px;"  /></strong></div></td>
<?php 
}
else
{
?>
<td style="padding:2px 4px;" class="return_value"><div align="center"><strong>&nbsp;</strong></div></td>
<?php
}
?>
<?php 
if($qtyinhand==0)
{
?>
    <td style="padding:2px 4px;" class="inhand_value"><div align="center"><strong><input type="text" name="qtyinhand" id="qtyinhand" value="<?php echo $qtyinhandinpieces; ?>" readonly="readonly" style="width:50px; margin-bottom:0px;"  /></strong></div></td>
<?php 
}
else
{
?>
<td style="padding:2px 4px;" class="return_value"><div align="center"><strong>&nbsp;</strong></div></td>
<?php
}
?>
    <td style="padding:2px 4px;" class="return_value"><div align="center"><strong><input type="number" name="return_qty<?php echo $row["id"];?>" id="return_qty<?php echo $row["id"];?>" style="width:50px; margin-bottom:0px;" /></strong></div></td>
    <!--<td style="padding:2px 4px;"><div align="center"><strong><?php //echo $row["vat_amt"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php //echo $row["dico_per"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php //echo $row["gross_rate"]; ?></strong></div></td>-->
    <!--<td style="padding:2px 4px;"><div align="center"><a href='ph_purchase_return.php?id=<?php //echo $row[id];?>'>Del</a></div></td>-->
  </tr>
<?php 
}
}
?>
</table>
 </div>
           <div align="center">
             <input type="button" id="submit_form" name="submit" class="btn btn-info" value="Return" style="padding:2px 2px;"/>
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
$sqli = "SELECT DISTINCT return_no,date,voucher_no FROM ph_purchase_return where voucher_no='$voucher_no'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$re_no=$rowi['return_no'];

$sql2="select SUM(return_qty)as tot_rqty from ph_purchase_return where return_no='$re_no' and voucher_no='$voucher_no'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$tot_rqty=$row2['tot_rqty'];
}
?>        
    <tr>
      <td><?php echo $c;?></td>
      <td><?php echo $rowi["date"]; ?></td>
      <td><?php echo $rowi["return_no"]; ?></td>
      <td><?php echo $tot_rqty; ?></td>
      <td><a href='purchase_return_print.php?voucher_no=<?php echo $rowi["voucher_no"];?>&return_no=<?php echo $rowi["return_no"];?>'>Print</a></td>
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