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
function opensuprepotdoc(ph_emp_id,dt,dt1){
window.location="emp_indall_report_print.php?ph_emp_id="+ph_emp_id+"&dt="+dt+"&dt1="+dt1;
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
			<h4>Emp Report<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="emp_indall_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>Emp</strong></td>
     <td bgcolor="#eee"><select name="ph_emp_id" id="ph_emp_id" style="width:190px; margin-left:1px;">
      <option value="0">...Select...</option>
     <?php
	 $sql="SELECT * FROM ph_employee_master ORDER BY emp_name ASC";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['emp_name'];?> - <?php echo $row['employee_id'];?></option>
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
$ph_emp_id=$_POST['ph_emp_id'];
$dtt=$_POST['date'];
	   $_SESSION["cus_dt"]=$dtt;

		list($day, $month, $year) = split('[/.-]', $dtt);
        $date = "$year-$month-$day";
	    $dtt1=$_POST['date2'];
		$_SESSION["cus_dt1"]=$dtt1;
		list($day, $month, $year) = split('[/.-]', $dtt1);
        $date1 = "$year-$month-$day";
		
$sqln="select*from ph_employee_master where id ='$ph_emp_id'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
?>
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Emp Name - </strong></th>
      <th><strong><?php echo $rown["emp_name"];?></strong></th>
      <th><strong>Emp Id - </strong></th>
      <th><strong><?php echo $rown["employee_id"];?></strong></th>
      <th><strong>From - <?php echo $dtt;?></strong></th>
      <th><strong>To - <?php echo $dtt1;?></strong></th>
    </tr>
        </tbody>
        </table> 
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>S.Date</strong></th>
      <th><strong>Bill No.</strong></th>
      <th><strong>C.Name</strong></th>
      <th><strong>Gross Amount</strong></th>
      <th><strong>Discount Amt</strong></th>
      <th><strong>Return Amount (-Dis)</strong></th>
      <th><strong>Net Amount</strong></th>
      <th><strong>Option</strong></th>
    </tr>
        </tbody>
<tbody>           

<?php
$sum=0;
$sum2=0;
$sum3=0;
$sum4=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no FROM ph_sales_master where ph_emp_id='$ph_emp_id' and date between '$date' and '$date1'";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
$invoice_no=$rowi["invoice_no"];

$sql="SELECT * FROM ph_sales_master where invoice_no='$invoice_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$pati_id=$row["pati_id"];

$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
}	
$sql1="select SUM(mrp)as tot_amt from ph_sales_master where invoice_no='$invoice_no'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{
$tot_amt=$row1['tot_amt'];
}


$sqln="select*from ph_sales_payment where invoice_no='$invoice_no'";
$resn=mysql_query($sqln);
$nu_rows = mysql_num_rows($res);
$rown=mysql_fetch_assoc($resn);
$dis_amt=$rown["dis_amt"];

$sql3="select SUM(tot_amt)as totreturn from ph_sale_return where invoice_no='$invoice_no'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$totreturn=$row3['totreturn'];
}

$sql31="select SUM(dis_amt)as disreturn from ph_sale_return where invoice_no='$invoice_no'";
$res31=mysql_query($sql31);
while($row31=mysql_fetch_array($res31))
{
$disreturn=$row31['disreturn'];
}
$totooretun1=$totreturn-$disreturn;
$totooretun=round($totooretun1);
$tot_rate1=$tot_amt-$totreturn-$totooretun;

$sum=$sum+$tot_amt;
$sum2=$sum2+$dis_amt;
$sum3=$sum3+$totooretun;
$sum4=$sum4+$tot_rate1;
				
$sql2="SELECT * FROM ph_patient_master where id='$pati_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $rowi["invoice_no"]; ?></td>
      <td><?php echo $row2["pati_name"]; ?></td>
      <td><?php echo $tot_amt; ?></td>
      <td><?php echo $dis_amt; ?></td>
      <td><?php echo $totooretun; ?></td>
      <td><?php echo $tot_rate1; ?></td>
      <td><div align="center"><a href='emp_indall_report_view.php?invoice_no=<?php echo $rowi["invoice_no"];?>'>View</a></div></td>
      </tr>
<?php 
$c=$c+1;
}
}
?>
<tr>
      <th>&nbsp;</th>
       <th>&nbsp;</th>
       <th>&nbsp;</th>
      <th><strong>Total</strong></th>
      <th><strong><?php echo $sum; ?></strong></th>
      <th><strong><?php echo $sum2; ?></strong></th>
      <th><strong><?php echo $sum3; ?></strong></th>
      <th><strong><?php echo $sum4; ?></strong></th>
       <th>&nbsp;</th>
    </tr>  
     <tr>
      <td colspan="9" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensuprepotdoc('<?php echo $ph_emp_id;?>','<?php echo $date;?>','<?php echo $date1;?>');" target="_blank" /></td>
             
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