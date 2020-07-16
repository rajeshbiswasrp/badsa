<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
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
			<h4>Purchase Order Details <small class="pull-right">&nbsp;</small></h4>
            <!--*********************************-->
<ul class="nav nav-tabs" id="myTab" style="margin-bottom:2px;">
  <li class="active"><a href="#new" data-toggle="tab">New</a></li>
  <li><a href="#updated" data-toggle="tab">Updated</a></li>
  <!--<li><a href="#aa" data-toggle="tab">Messages</a></li>-->

</ul>

<div class="tab-content">
  <div class="tab-pane active" id="new">
  
  <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
  <table class="table table-hover table-striped table-bordered">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Sl.No.</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Date</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>P.O.No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Supplier Name</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>
  </tr>
<?php
$c=1;
$sql3="SELECT DISTINCT po_no FROM ph_purchase_order where master_upd='0'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
$po_no=$row3["po_no"];

$sql="SELECT * FROM ph_purchase_order where po_no='$po_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sup_id=$row["sup_id"];
$po_date=$row["po_date"];
$viewclick=$row["viewclick"];
}
$sql2="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sup_name=$row2["sup_name"];
}
?> 
  <tr>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $c; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $po_date; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $po_no; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $sup_name; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><a href='purchase_master.php?po_no=<?php echo $row3["po_no"];?>'>View</a>
<?php
if($viewclick==0){
?>
<i class="icon-eye-open blink" style="color:#000; font-size:16px;"></i>
<?php
}?>
    </div>
    </td>
  </tr>
<?php 
$c=$c+1;
}
?>
</table>

 </div>
			  </div>
              </div>
              
  <div class="tab-pane" id="updated">
  <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div >
  <table class="table table-hover table-striped table-bordered">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Sl.No.</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Date</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>P.O.No.</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Supplier Name</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Option</strong></div></td>
  </tr>
<?php
$c=1;
$sql3="SELECT DISTINCT po_no FROM ph_purchase_order where master_upd='1'";
$result3=mysql_query($sql3);
while($row3=mysql_fetch_array($result3))
{
$po_no=$row3["po_no"];

$sql="SELECT * FROM ph_purchase_order where po_no='$po_no'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
$sup_id=$row["sup_id"];
$po_date=$row["po_date"];
$viewclick=$row["viewclick"];
}
$sql2="SELECT * FROM ph_supplier_master where id='$sup_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
$sup_name=$row2["sup_name"];
}
?> 
  <tr>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $c; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $po_date; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $po_no; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><?php echo $sup_name; ?></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><a href='purchase_master.php?po_no=<?php echo $row3["po_no"];?>'>View</a>
<?php
if($viewclick==0){
?>
<i class="icon-eye-open blink" style="color:#000; font-size:16px;"></i>
<?php
}?>
    </div>
    </td>
  </tr>
<?php 
$c=$c+1;
}
?>
</table>

 </div>
  </div>
  </div>
  
  <!--<div class="tab-pane" id="aa">
  <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
           <div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
  Cras justo odio,  egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
  </div>
  </div>
  </div>-->


<script>
  $(function () {
    $('#myTab a:first').tab('show')
  })
</script>
<!--*********************************-->
            
			
              
              
              
              
              
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