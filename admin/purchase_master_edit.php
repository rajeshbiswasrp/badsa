<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
$id=$_REQUEST['id'];
$select=mysql_fetch_array(mysql_query("select * from ph_purchase_master where id ='".$_REQUEST['id']."'"));
$medicine_id=$select['medicine_id'];
?>

<?php
if (isset($_POST['button2']))
		{
$voucher_date=$_REQUEST["voucher_date"];
$sup_id=$_REQUEST["sup_id"];
$batch=$_REQUEST["batch"];
$mrp=$_REQUEST["mrp"];
$ptr=$_REQUEST["ptr"];
$base_type=$_REQUEST["base_type"];
$qty=$_REQUEST["t_spq"];
$nts=$_REQUEST["nts"];
$dis_status=$_POST["dis_status"];
$discount=$_POST["discount"];
$tax_status=$_POST["tax_status"];
$taxpm=$_POST["taxpm"];


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


$dd=(date("Y-m-d"));

$sql="UPDATE ph_purchase_master SET voucher_date='$voucher_date',sup_id='$sup_id',batch='$batch',mrp='$mrp',ptr='$ptr',base_type='$base_type',qty='$qty',nts='$nts',dis_status='$dis_status',discount='$discount',tax_status='$tax_status',taxpm='$taxpm',total_rate='$total_rate',total_rate_p='$total_rate_p',total_qty_p='$total_qty_p',dis_amt='$dis_amt',after_dis='$after_dis',tax_amt='$tax_amt',net_amt='$net_amt',dis_amtb='$dis_amtb',tax_amtb='$tax_amtb',net_amtb='$net_amtb',date='$dd' WHERE id='$id'";
$result=mysql_query($sql);
?>
<script>window.location="purchase_master.php"</script>
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
$( document ).ready(function() {	

	document.getElementById("batch").focus();
	
		
});
</script>
<!-- Header End====================================================================== -->

<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        <form  action="" name="form" id="form" method="post" enctype="multipart/form-data">		
			<div class="well well-small">
			<h4>Purchase Bill Edit<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
            <table class="table table-hover table-striped table-bordered">
        
   
    <tr>
      <td style="padding:3px 5px;"><strong>Voucher No.</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="voucher_no" id="voucher_no" value="<?php echo $select['voucher_no']; ?>" style=" margin-bottom:0px;" readonly/></td>
      <td  style="padding:3px 5px;"><strong>Voucher Date</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="voucher_date" id="datepicker" value="<?php echo $select['voucher_date']; ?>" style=" margin-bottom:0px;"/></td>
      <td  style="padding:3px 5px;"><strong>Supplier Name</strong></td>
<?php
$s_id=$select["sup_id"];

$sqln3="select * from ph_supplier_master where id ='$s_id'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
?>
      <td  style="padding:3px 5px;">
      <select name="sup_id" id="sup_id" style=" margin-bottom:0px;">
      <option value="<?php echo $rown3['id']?>"><?php echo $rown3['sup_name']?></option>
        <option value="">--Select--</option>
<?php
$sql3 = "SELECT * FROM ph_supplier_master";
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
     <!--<tr>
      <td style="padding:3px 5px;"><strong>Bill Date</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="bill_date" value="<?php //echo $date_date; ?>" id="datepicker1" style=" margin-bottom:0px;"/></td>
      <td style="padding:3px 5px;" colspan="2"></td>
      <td style="padding:3px 5px;" colspan="2"></td>
    </tr>-->
  </table>
  
	<table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
<?php
$b_type=$select['base_type'];
if($b_type==0)
{
$btype='Box';
}
else
{
$btype='Pieces';
}
?>
    <td bgcolor="#eee"><strong>Item Name</strong></td>
    <!--<td bgcolor="#eee"><strong>Unit</strong></td>-->
    <!--<td bgcolor="#eee"><strong>Batch No.</strong></td>-->
    <td bgcolor="#eee"><strong>Sale Price</strong></td>
    <td bgcolor="#eee"><strong>Purchase Price</strong></td>
    <td bgcolor="#eee"><strong>Purchased in</strong></td>
    <td bgcolor="#eee"><strong>Purchased Box / Pieces</strong></td>
<?php
if($b_type==0)
{
?>
    <td bgcolor="#eee"><strong>Pieces in Box</strong></td>
<?php 
}
?>    
    <td bgcolor="#eee"><strong>Discount <input type="radio" name="dis_status" id="dis_status" value="1" />Amt &nbsp;<input type="radio" name="dis_status" id="dis_status" value="0"  checked="checked"/>% </strong></td>
    <td bgcolor="#eee"><strong><input type="radio" name="tax_status" id="tax_status" value="1" checked="checked"/>VAT &nbsp;<input type="radio" name="tax_status" id="tax_status" value="0"  />CST </strong></td>
  </tr>
  <tr>
<?php
$m_id=$select["medicine_id"];
$sql5="SELECT * FROM ph_medicine_master where id ='$m_id'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
$medici_name=$row5["medici_name"];


?>
    <td bgcolor="#eee"><input type="text" name="medicine_id" id="medicine_id" value="<?php echo $row5['medici_name']; ?>" style="width:100px; margin-bottom:0px;" readonly/></td>
<?php }?>
       
   <!--<td bgcolor="#eee"><input type="text" name="batch" id="batch" value="<?php //echo $select['batch']; ?>" style="width:30px; margin-bottom:0px;"/></td>-->
   <td bgcolor="#eee"><input type="text" name="mrp" id="mrp" value="<?php echo $select['mrp']; ?>" style="width:90px; margin-bottom:0px;"/></td>
   <td bgcolor="#eee"><input type="text" name="ptr" id="ptr" value="<?php echo $select['ptr']; ?>" style="width:50px; margin-bottom:0px;"/></td>
   <td bgcolor="#eee"><select name="base_type" id="show_tr5"  style=" margin-bottom:0px; width:80px;" onchange="check_val_tr5();"> 
      <option value="<?php echo $b_type;?>"><?php echo $btype;?></option>
      <!--<option value="0">Box</option>
      <option value="1">Pieces</option>-->
      </select></td>
      <td bgcolor="#eee"><input type="text" name="t_spq" id="t_spq" value="<?php echo $select['qty']; ?>" style="width:30px; margin-bottom:0px;"/></td>
<?php
if($b_type==0)
{
?>
      <td bgcolor="#eee"><input type="text" name="nts" id="nts" value="<?php echo $select['nts']; ?>" style="width:30px; margin-bottom:0px;"/></td>
<?php 
}
?>
      <td bgcolor="#eee"><input type="text" name="discount" id="discount" value="<?php echo $select['discount']; ?>" style="width:60px; margin-bottom:0px;"/></td>
      <td bgcolor="#eee"><input type="text" name="taxpm" id="taxpm" value="<?php echo $select['taxpm']; ?>" style="width:60px; margin-bottom:0px;"/></td>
  </tr>
</table>
<br />
<br />
	
	
	</div>
<div align="center">
     <input type="submit" name="button2"  class="btn btn-success" value="Update" />
   
     </div>
			  </div>
		</div>
</form>		
			  	
  

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
	<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>