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
if (isset($_POST['button2']))
		{
 
 $pati_id=$_REQUEST["pati_id"];



$sqlvoice="select max(invoice_no) as inv from ph_sales_master where update_invoice=1";
$rowvoice=mysql_query($sqlvoice);
while($row21=mysql_fetch_array($rowvoice))
{
 $max_id=$row21["inv"];
}
$sqlvoice11="select * from ph_sales_master where invoice_no='$max_id' and update_invoice='1'";
$rowvoice11=mysql_query($sqlvoice11);
while($row11=mysql_fetch_array($rowvoice11))
{
 $invoice=($row11["invoice_no"]+1);
 $receipt_no='MERRY/SALE/'.date('Y').'/'.$invoice;
}
$valuearr='';
foreach($_REQUEST['allbox2'] as $key=>$value)
	{ 
	
$sql="UPDATE ph_sales_master SET pati_id='$pati_id' WHERE id='$value'";
$result=mysql_query($sql);

$sql_update2 ="UPDATE ph_sales_master SET invoice_no='$invoice',receipt_no='$receipt_no',update_invoice='1' WHERE id='$value'";
$qry_update2= mysql_query($sql_update2);

$valuearr.=$value.',';
}
$valuearr=substr($valuearr,0,strlen($valuearr)-1);

$sql_update3 ="UPDATE ph_sales_payment SET invoice_no='$invoice' WHERE sale_id='$valuearr'";//,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,
$qry_update3= mysql_query($sql_update3);

//}
?>
<script>window.location="sales_details_print3.php?invoice_no=<?php echo $invoice;?>"</script>
<?php
}
//$com=arr=expolode(,$com);
?>

<?php include('header.php'); ?>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->
		<div class="span12">		
			<div class="well well-small">
			<h4>Cash Sales Details <small class="pull-right">&nbsp;</small></h4>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
          <!-- <div id="description" style="padding:0px; width:100%; height:150px; border-bottom:solid 0px #ccc;">-->
<form  action="" name="form" id="form" method="post" enctype="multipart/form-data">		
  <table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Select Print</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Items Name</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Base</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Qty</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="right"><strong>MRP</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Batch No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Expire Date</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Bill Date</strong></div></td>
  </tr>
<?php
$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sales_id=$row["id"];
$m_id=$row["medicine_id"];
$bbase=$row["base"];
if($bbase==0)
{
$bb='Strip';
}
else{
$bb='Pieces';
}

$sql2="SELECT * FROM ph_medicine_master where id='$m_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{

?> 
  <tr>
    <td style="padding:2px 4px;"><div align="center"><strong><input type="checkbox" name="allbox2[]" id="allbox2[]" value="<?php echo $row["id"]; ?>" /><?php //echo $row["id"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row2["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $bb; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["iss_qty"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="right"><strong><?php echo $row["mrp"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["batch"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["exp_date"]; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $row["bill_date"]; ?></strong></div></td>
  </tr>
<?php 
}
}
?>
</table>
<br />
<table class="table table-hover table-striped table-bordered">
<tr>
<td  style="padding:3px 5px;"><strong>Patient Name</strong></td>
      <td  style="padding:3px 5px;">
      <select name="pati_id" id="pati_id" style=" margin-bottom:0px;">
        <option value="">--Select--</option>
<?php
$sql3 = "SELECT * FROM ph_patient_master";
$result3 = mysql_query($sql3);
while($row3 = mysql_fetch_array($result3)){
?>
              <option value="<?php echo $row3['id']?>"><?php echo $row3['pati_name']?></option>
<?php
}
?>
            </select>
      </td>
      <td><input type="submit" name="button2" class="btn btn-info" value="Save & Print" style="padding:2px 2px;"/></td>
      </tr>
      </table>
</form>
<!-- </div>-->
               
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