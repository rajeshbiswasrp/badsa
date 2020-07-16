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
function opensuprepotdoc(dt,dt1){
window.location="quickbill_all_report_print.php?dt="+dt+"&dt1="+dt1;
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
			<h4>All Size Wise Report<small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?><?php echo $msg1;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
<form  action="test_all_report.php" name="form" id="form" method="post" enctype="multipart/form-data">
<table class="table table-hover table-striped table-bordered">
    <tr>
      <td><strong>Size</strong></td>
     <td bgcolor="#eee"><select style="width:130px;" name="size_type" id="size_type">
      <option value="0">..Select..</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
      <option value="32">32</option>
      <option value="33">33</option>
      <option value="34">34</option>
      <option value="35">35</option>
      <option value="36">36</option>
      <option value="37">37</option>
      <option value="38">38</option>
      <option value="39">39</option>
      <option value="40">40</option>
      <option value="41">41</option>
      <option value="42">42</option>
      <option value="43">43</option>
      <option value="44">44</option>
      <option value="45">45</option>
      <option value="46">46</option>
      <option value="47">47</option>
      <option value="48">48</option>
      <option value="49">49</option>
      <option value="50">50</option>
      </select></td>
    <td><strong>For</strong></td>
     <td bgcolor="#eee"><select style="width:130px;" name="for_type" id="for_type">
      <option value="">..Select..</option>
      <option value="1">Male</option>
      <option value="0">Female</option>
      </select></td>
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
<table class="table table-hover table-striped table-bordered" id="product-table">
            <tbody>
      <tr>
      <th><strong>Sl No.</strong></th>
      <th><strong>P.Date</strong></th>
      <th><strong>Bill No.</strong></th>
      <th><strong>S.Name</strong></th>
      <th><strong>Category</strong></th>
      <th><strong>Brand</strong></th>
      <th><strong>Items</strong></th>
      <th><strong>Size</strong></th>
      <th><strong>For</strong></th>
      <th><strong>P.Price</strong></th>
      <th><strong>p.Qty</strong></th>
      <th><strong>R.Qty</strong></th>
      <th><strong>S.Qty</strong></th>
      <th><strong>Q.I.H</strong></th>
    </tr>
        </tbody>
<tbody>           
<?php
if($_POST["submit"])
{
$size_type=$_POST['size_type'];
$for_type=$_POST['for_type'];
?>
	

<?php
$c=1;

$sql="SELECT * FROM ph_purchase_master where size_type='$size_type' and for_type='$for_type'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$temp_voucher=$row["voucher_no"];
$purchase_id=$row["id"];
$medicine_id=$row["medicine_id"];
$sup_id=$row["sup_id"];
$jd=$row['date'];
list($year,$month,$day)=split('[-.]',$jd);
                    $date4 = "$day-$month-$year";
					
$forttt=$row["for_type"];
if($forttt==1)
{
$btype='Male';
}
else
{
$btype='Female';
}

$sqln="select*from barcod_master where purchase_id='$purchase_id' and status='2'";
$resn=mysql_query($sqln);
$nofp_return=mysql_num_rows($resn);

$sqln2="select*from barcod_master where purchase_id='$purchase_id' and status='0'";
$resn2=mysql_query($sqln2);
$nofp_sale=mysql_num_rows($resn2);

$sqln3="select*from barcod_master where purchase_id='$purchase_id' and status='1'";
$resn3=mysql_query($sqln3);
$nofp_inhand=mysql_num_rows($resn3);
					
$sql2="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sql3="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
$categ_id=$row3["categ_id"];
$type_id=$row3["type_id"];

$sql4="SELECT * FROM ph_category_master where id='$categ_id'";
$result4=mysql_query($sql4);
while($row4=mysql_fetch_array($result4))
{
$sql5="SELECT * FROM ph_type_master where id='$type_id'";
$result5=mysql_query($sql5);
while($row5=mysql_fetch_array($result5))
{
?>       
    <tr>
      <td><div align="center"><?php echo $c;?></div></td>
      <td><?php echo $date4; ?></td>
      <td><?php echo $row["voucher_no"]; ?></td>
      <td><?php echo $row2["sup_name"]; ?></td>
      <td><?php echo $row4["categ_name"]; ?></td>
      <td><?php echo $row5["type_name"]; ?></td>
      <td><?php echo $row3["medici_name"]; ?></td>
      <td><?php echo $row["size_type"]; ?></td>
      <td><?php echo $btype; ?></td>
      <td><?php echo $row["ptr"]; ?></td>
      <td><?php echo $row["qty"]; ?></td>
      <td><?php echo $nofp_return; ?></td>
      <td><?php echo $nofp_sale; ?></td>
      <td><?php echo $nofp_inhand; ?></td>
      </tr>
<?php 
$c=$c+1;
}
}
}
}
}
?>  
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