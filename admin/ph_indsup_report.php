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
 

<!-- Header End====================================================================== --><div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">
        		
			<div class="well well-small">
			<h4>Indivdual Supplier Report<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="ph_indsup_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>Supplier Name</strong></td>
     <td><select name="sup_id" id="sup_id" style=" margin-bottom:0px;">
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
            </select></td>
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
$sup_id=$_POST['sup_id'];
$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";

$sql22="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result22=mysql_query($sql22);
while($row22=mysql_fetch_array($result22))
{
$sup_name=$row22["sup_name"];
$supplier_id=$row22["supplier_id"];
}
?>
<table class="table table-hover table-striped table-bordered" id="product-table">

            <tbody>
      
    <tr>
      <th><strong>Supplier Name</strong></th>
      <th><strong><?php echo $sup_name; ?></strong></th>
      <th><strong>Supplier Id</strong></th>
      <th><strong><?php echo $supplier_id; ?></strong></th>
      <th><strong>Date Range</strong></th>
      <th><strong><?php echo $dtt;  ?> - <?php echo $dtt1;  ?></strong></th>
    </tr>
        </tbody>
<tbody>           
</tbody>
</table>
	
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>Date</strong></th>
      <th><strong>Voucher No.</strong></th>
      <th><strong>Gross Purchased</strong></th>
      <th><strong>Purchased Returned</strong></th>
      <th><strong>Net Purchased</strong></th>
    </tr>
        </tbody>
<tbody>   

<?php
$c=1;
$sum1=0;
$sum2=0;
$sum3=0;
$sqli = "SELECT DISTINCT voucher_no FROM ph_purchase_master where sup_id='$sup_id'";
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

$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";

$t_spq=$row["qty"];
$ptr=$row["ptr"];
$dis_status=$row["dis_status"];
$discount=$row["discount"];
$vat=$row["taxpm"];



$sql33="select SUM(total_rate)as totrate from ph_purchase_master where voucher_no='$vou_no'";
$res33=mysql_query($sql33);
while($row33=mysql_fetch_array($res33))
{
$totrate=$row33['totrate'];
}
$sql3="select SUM(ptr)as totreturn from ph_purchase_return where voucher_no='$vou_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}
$tot_rate1=$totrate-$totreturn;


}
$sum1=$sum1+$totrate;
$sum2=$sum2+$totreturn;
$sum3=$sum3+$tot_rate1;
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["voucher_no"]; ?></td>
      <td><div align="right"><?php echo number_format($totrate,2); ?></div></td>
      <td><div align="right"><?php echo number_format($totreturn,2); ?></div></td>
      <td><div align="right"><?php echo number_format($tot_rate1,2); ?></div></td>
      <!--<td><a href='ph_purchase_stock_report.php?voucher_no=<?php //echo $rowi["voucher_no"];?>'>View</a></td>-->
      </tr>
<?php 
$c=$c+1;
}
?>  
<tr>
      <td><strong>&nbsp;</strong></td>
      <td><strong>&nbsp;</strong></td>
      <td><strong>Total</strong></td>
      <td><div align="right"><strong><?php echo number_format($sum1,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum2,2); ?></strong></div></td>
      <td><div align="right"><strong><?php echo number_format($sum3,2); ?></strong></div></td>
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