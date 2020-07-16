<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>

<?php
if($_POST["submit"])
{
$po_no=$_POST["po_no"];
$po_num=$_POST["po_num"];
$po_date=$_POST["po_date"];
$sup_id=$_POST["sup_id"];
$bill_date=$_POST["bill_date"];
$medicine_id=$_POST["medicine_id"];
//$unit=$_POST["unit"];
$batch=$_POST["batch"];
$mfg_date=$_POST["mfg_date"];
$exp_date=$_POST["exp_date"];
$mrp=$_POST["mrp"];
$ptr=$_POST["ptr"];
$base_type=$_POST["base_type"];
//$type_id=$_POST["type_id"];
$t_spq=$_POST["t_spq"];
$nts=$_POST["nts"];
$free_qty=$_POST["free_qty"];
$tax_type=$_POST["tax_type"];
$tax_per=$_POST["tax_per"];
$ed_per=$_POST["ed_per"];
$dico_per=$_POST["dico_per"];

$sqlu="SELECT * FROM ph_medicine_master where id='$medicine_id'";
$resultu=mysql_query($sqlu);
while($rowu=mysql_fetch_array($resultu))
{
$unit=$rowu["unit"];
$type_id=$rowu["type_id"];
$rack_no=$rowu["rack_no"];
}

 $gross_rate=$t_spq*$ptr;
 $vv_pp=$tax_per+$ed_per;
 
$gross_rate1=$t_spq*$mrp;
$sqlnt="select*from ph_medicine_master where id ='$medicine_id'";
$resnt=mysql_query($sqlnt);
$rownt=mysql_fetch_assoc($resnt);
$categ_id=$rownt["categ_id"];

$sqlnt2="select*from ph_category_master where id ='$categ_id'";
$resnt2=mysql_query($sqlnt2);
$rownt2=mysql_fetch_assoc($resnt2);
$medi_tax=$rownt2["medi_tax"]; 
if($medi_tax==1)
{
$vat_amt=$gross_rate1*$vv_pp/100;
if($free_qty!='')
$vat_amt=$vat_amt+($free_qty*$mrp * $vv_pp/100);

}
else{ 
 $vat_amt=$gross_rate*$vv_pp/100;
}


 
 $tot_rate1=$gross_rate+$vat_amt;
 $dis_amt=$gross_rate*$dico_per/100;
 $net_rate=$tot_rate1-$dis_amt;

if($base_type==0)
 {
 $tot_qty=$t_spq*$nts;
 $each_qty_rate=$ptr/$nts;
 }
 else
 {
 $tot_qty=$t_spq;
 $each_qty_rate=$ptr;
 }
 if($base_type==0)
 {
$tot_strtb_qty=$t_spq+$free_qty;
$tot_stablet_qty=$tot_strtb_qty*$nts;
$mrp_each_tab=$mrp/$nts;
 }
 else
 {
$tot_strtb_qty=0;
$tot_stablet_qty=$t_spq+$free_qty;
$mrp_each_tab=$mrp;
}

$dd=(date("Y-m-d"));

$sql="INSERT INTO ph_purchase_order (po_no,po_num,po_date,sup_id,bill_date,medicine_id,unit,batch,mfg_date,exp_date,mrp,ptr,base_type,type_id,t_spq,nts,free_qty,tax_type,tax_per,ed_per,dico_per,gross_rate,vat_amt,dis_amt,net_rate,tot_qty,each_qty_rate,tot_strtb_qty,tot_stablet_qty,mrp_each_tab,status,viewclick,master_upd,date)
VALUES ('$po_no','$po_num','$po_date','$sup_id','$bill_date','$medicine_id','$unit','$batch','$mfg_date','$exp_date','$mrp','$ptr','$base_type','$type_id','$t_spq','$nts','$free_qty','$tax_type','$tax_per','$ed_per','$dico_per','$gross_rate','$vat_amt','$dis_amt','$net_rate','$tot_qty','$each_qty_rate','$tot_strtb_qty','$tot_stablet_qty','$mrp_each_tab','1','0','0','$dd')";
$result=mysql_query($sql);
$last_id = mysql_insert_id();

if($result>0)
{
$sql2="INSERT INTO ph_purchase_master (po_no,grn_no,p_order_id,voucher_no,voucher_date,sup_id,bill_date,medicine_id,rack_no,unit,batch,mfg_date,exp_date,mrp,ptr,base_type,type_id,t_spq,nts,free_qty,tax_type,tax_per,ed_per,dico_per,gross_rate,vat_amt,dis_amt,net_rate,tot_qty,each_qty_rate,tot_strtb_qty,tot_stablet_qty,mrp_each_tab,status,date)
VALUES ('$po_no','','$last_id','$voucher_no','$voucher_date','$sup_id','$bill_date','$medicine_id','$rack_no','$unit','$batch','$mfg_date','$exp_date','$mrp','$ptr','$base_type','$type_id','$t_spq','$nts','$free_qty','$tax_type','$tax_per','$ed_per','$dico_per','$gross_rate','$vat_amt','$dis_amt','$net_rate','$tot_qty','$each_qty_rate','$tot_strtb_qty','$tot_stablet_qty','$mrp_each_tab','0','$dd')";
$result2=mysql_query($sql2);

$msg="<div class='alert alert-info fade in'>
		<strong>Add Successfully</strong>
	 </div>";
}
}
?>

<?php
if($_POST["submit2"])
{
$sql_update = "UPDATE ph_purchase_order SET status='0' WHERE status='1'";
					$qry_update= mysql_query($sql_update);
}
?>
<?php
if($_POST["submit3"])
{
?>
<script>window.location="purchase_order_print.php"</script>
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
    
<script>
function showHintASP(str)
{
if (str.length==0)
  { 
   document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
	document.getElementById("livesearch").style.backgroundColor ="";
  return;
  }
var xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
   document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
   document.getElementById("livesearch").style.border="1px solid #A5ACB2";
   document.getElementById("livesearch").style.backgroundColor ="#fff";
<!--   style="z-index:100000000; overflow:auto; position:absolute; height:250px; padding:3px; background-color:#fff;"-->
    }
  }
xmlhttp.open("GET","ajax_medicine_listing.php?q="+str+"&medici_name="+$("#medici_name").val(),true);
xmlhttp.send();
}
</script>

<script>
function selectedbox(id,val)
{
 //document.getElementById("business_search").selectedIndex=id;
 $('#medicine_id').val(id);
 document.getElementById("livesearch").innerHTML="";
 document.getElementById("business_live_search").value=val;
 document.getElementById("livesearch").style.border="0px";
 document.getElementById("livesearch").style.backgroundColor ="";

}
</script>
<script type="text/javascript">
function showPlan2ready()
	{
	
	
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
		//document.getElementById("a2").style.display="none";
		
		//document.getElementById("c2").style.display="block";
	
		document.getElementById("medicine_id").innerHTML=xmlhttp.responseText;
		document.getElementById("medicine_id").value='';
		}
	  }
	  //alert(xmlhttp.responseText);
	xmlhttp.open("GET","ajex_showmedicine.php",true);
	xmlhttp.send();
	}
</script>
<script>
$( document ).ready(function() {	
	showPlan2ready();
	<?php
	if($_POST["submit"])
	{
	?>
	document.getElementById("business_live_search").focus();
	<?php
	}
	?>
		
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
function add_value(val){

var po_no=document.getElementById("po_no").value;
var amt_of_adj=document.getElementById("amt_of_adj").value;
//alert('Success');
//window.location='purchase_master.php?po_no=<?php //echo $id;?>';
$.ajax({ type: "POST",url: "ajax_adjest_value.php",async: false,data: "po_no="+encodeURIComponent(po_no)+"&amt_of_adj="+encodeURIComponent(amt_of_adj)+"&add_status="+val, success: function(data)
//$.ajax({ type: "POST",url: "ajax_vourch_update.php",async: false,data: "voucher_no="+encodeURIComponent(voucher_no)+"&voucher_date="+encodeURIComponent(voucher_date)+"&id="+id, success: function(data)
		{
		
		}
	})	
	
	
	return false;

}
</script>


<script language="javascript">
	function checkpackages()
	{
		if(document.form1.sup_id.value=="")
	{
		alert("Please enter the Supplier Name!");
		document.form1.sup_id.focus();
		return false;
	}
	
	

	
	
	return true;
	}
</script>

<script type="text/javascript">
function confirm1(id)
{
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='purchase_order.php?id='+id;
     }
	
	 return false;
}
</script>

<script>
function clonethis(obj){

	console.log(obj);
    var cloned = obj.parentNode.parentNode;
   
	var count=document.getElementById('submitalltest').value;
    var obj1 = document.getElementById("packagetypetr"+count);
	obj1.appendChild(cloned);
	$("#packagetypetr"+count).show();
	document.getElementById("submitalltest").value=parseInt(count)+1;
}
</script>
<!-- Header End====================================================================== -->

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
<div id="mainBody">
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
	
<!-- Sidebar end=============================================== -->

<!--*********************************-->
		<div class="span12">		
			<div class="well well-small">
			<h4 style="margin-top:0px; font-size:15px;">Purchase Order <small class="pull-right">&nbsp;</small></h4>
            <div align="center"><?php echo $msg;?>
	  </div>
			<div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
            
			<div id="sidebar" class="span12">
            <form  action="purchase_reorder.php" name="form1" id="form1" method="post" enctype="multipart/form-data" >
            <table class="table table-hover table-striped table-bordered">
<?php
$sqln="select max(id) as mid from ph_purchase_order where status ='1'";
$resn=mysql_query($sqln);
$rown=mysql_fetch_assoc($resn);

$mid=$rown["mid"];

$sqln2="select * from ph_purchase_order where id ='$mid'";
$resn2=mysql_query($sqln2);
$rown2=mysql_fetch_assoc($resn2);
//$pn=$rown2["po_no"];

$sqln3="select max(id) as mmid from ph_purchase_order where status ='0'";
$resn3=mysql_query($sqln3);
$rown3=mysql_fetch_assoc($resn3);
$mmid=$rown3["mmid"];

$sqln4="select * from ph_purchase_order where id ='$mmid'";
$resn4=mysql_query($sqln4);
$rown4=mysql_fetch_assoc($resn4);
$pn4=$rown4["po_num"];

?>            
        
   
    <tr>
      <td style="padding:3px 5px;display:none;"><strong>P.O. No.</strong></td>
      <td  style="padding:3px 5px;display:none;"><input type="text" name="po_no" id="po_no" value="<?php
if($mmid==0)
{
echo $a='MMC/10001/15-16';	
}
else
{
//echo $a='MMC'.'/'.$pn4+'1'.'/'.'15-16';
echo $a='MMC/'.($rown4['po_num']+1).'/15-16';
}
?>" style=" margin-bottom:0px;" readonly/>

<input type="hidden" name="po_num" id="po_num" value="<?php if($mmid==0){echo $a=10001;	}else{echo $a=($rown4['po_num']+1);}?>" style=" margin-bottom:0px;" readonly/>
</td>
      <td  style="padding:3px 5px;display:none;"><strong>P.O. Date</strong></td>
      <td  style="padding:3px 5px;display:none;"><input type="text" name="po_date" id="datepicker" value="<?php echo $date_date;?>" style=" margin-bottom:0px;"/></td>
      <td  style="padding:3px 5px;"><strong>Supplier Name</strong></td>
<?php
$s_id=$rown2["sup_id"];

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
    <!-- <tr>
      <td style="padding:3px 5px;"><strong>Bill Date</strong></td>
      <td  style="padding:3px 5px;"><input type="text" name="bill_date" value="<?php //echo $date_date;?>" id="datepicker1" style=" margin-bottom:0px;"/></td>
      <td style="padding:3px 5px;" colspan="2"></td>
      <td style="padding:3px 5px;" colspan="2"></td>
    </tr>-->
     
    
  </table>
	<?php /*?><table width="100%" border="0" cellpadding="1" cellspacing="0" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
    <!--<td bgcolor="#eee"><strong>Medicine Barcode</strong></td>-->
    <td bgcolor="#eee"><strong>Medicine Name</strong></td>
   
    <td bgcolor="#eee"><strong>Base Type</strong></td>
    <!--<td bgcolor="#eee"><strong>Base</strong></td>-->
    <td bgcolor="#eee"><strong>T/SPQ</strong></td>
    <td id="tr1" style="display:none;" bgcolor="#eee"><strong>NTS</strong></td>
   
    <td bgcolor="#eee">-</td>
  </tr>
  <tr>
    <!--<td bgcolor="#eee"><input type="text" style="width:100px; margin-bottom:0px;"/></td>-->
    <td bgcolor="#eee"> <span id="c2" style="display:none;"><select name="medicine_id" id="medicine_id" style="width:220px; margin-left:1px;" >
		  <option value="">--Select--</option>
		  </select></span><input type="text" style="width:100px; margin-bottom:0px;" id="business_live_search" name="business_live_search"  onKeyUp="showHintASP(this.value)" autocomplete = "off" value=""/><div id="livesearch" style="z-index:100000000; overflow:auto; position:absolute; width:auto; height:250px; padding:3px; margin-left:180px; text-align:left; "></div></td>
   
   </td>-->
   <td bgcolor="#eee"><select name="base_type" id="show_tr5"  style=" margin-bottom:0px; width:80px;" onchange="check_val_tr5();"> 
     <option value="1">Pieces</option>
     <option value="0">Strip / Box</option>
      </select></td>
      
     <!-- <td  bgcolor="#eee">
      <select name="type_id" id="type_id" style=" margin-bottom:0px; width:80px;">
        <option value="">--Select--</option>
<?php
$sql4 = "SELECT * FROM ph_type_master";
$result4 = mysql_query($sql4);
while($row4 = mysql_fetch_array($result4)){
?>
              <option value="<?php //echo $row4['id']?>"><?php //echo $row4['type_name']?></option>
<?php
}
?>
            </select>
      </td>-->
      <td bgcolor="#eee"><input type="text" name="t_spq" id="t_spq" style="width:30px; margin-bottom:0px;"/></td>
      <td id="tr2" style="display:none;" bgcolor="#eee"><input type="text" name="nts" id="nts" style="width:30px; margin-bottom:0px;"/></td>
    
    <td bgcolor="#eee"><input type="submit" name="submit" class="btn btn-info" value="Add" style="padding:2px 2px;"/></td>
  </tr>
</table><?php */?>

	<div id="description" style="padding:0px; width:100%; height:200px; border-bottom:solid 1px #ccc;">
  <table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="12" cellspacing="8" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Medicine</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Date of Purchase</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Stock In Hand</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Reorder Level</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Reorder Quantity</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;" colspan="2"><div align="center"><strong>Option</strong></div></td>
  </tr>
  <tr>
    <td colspan="6">
    <!--<table class="table table-hover table-striped table-bordered">-->
    <!--<tr>
    <td width="3%"><strong>-</strong></td>
    <td width="24%"><strong>Sub Type</strong></td>
    <td width="24%"><strong>Range</strong></td>
    <td width="24%"><strong>Unit</strong></td>
    <td width="24%"><strong>Days</strong></td>
    <td>&nbsp;</td>
    </tr>-->
    <!-- </table>-->
   <?php
	for($i=1;$i<20;$i++){
	?>
    <table width="100%" class="table table-hover table-striped table-bordered" id="packagetypetr<?php echo $i;?>" style="display:none;">
 
</table>
   <?php
	}
	?>
    </td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-primary" name="submit7" id="submit7" value="Add" onClick="return checkpackages();"/></td>
  </tr>
 <div class="control-group" style="display:none;">
<INPUT type="button" value="Add New" onclick="addOTcharge('text')" /><input type="hidden" id="submitalltest" name="submitalltest" value="<?php echo '1';?>"><input type="hidden" id="submitalltestsubmit" name="submitalltestsubmit"  value="<?php echo '20';?>">
 </div>
</table>

 </div>
	
</form>
	</div>
    
    
  
			  </div>
		</div>
		
	<table class="table table-hover table-striped table-bordered" width="100%" border="0" cellpadding="12" cellspacing="8" style="margin-top:3px; font-size:12px; text-align:center;">
  <tr>
   
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><strong>Medicine</strong></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Date of Purchase</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Stock In Hand</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Reorder Level</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;"><div align="center"><strong>Reorder Quantity</strong></div></td>
    <td style="background-color:#009900; color:#fff; padding:2px 4px;" colspan="2"><div align="center"><strong>Option</strong></div></td>
  </tr>
<?php
list($day, $month, $year) = split('[/.-]', $date_date);
$date1 = "$year-$month-$day";
$reorderlist=array();	

$sqli = "SELECT ph_purchase_master.*,ph_medicine_master.medici_name,ph_medicine_master.drug_name,ph_medicine_master.reorder_level,ph_supplier_master.sup_name FROM ph_purchase_master left join  ph_medicine_master on ph_purchase_master.medicine_id=ph_medicine_master.id left join ph_supplier_master on ph_purchase_master.sup_id=ph_supplier_master.id  where ph_purchase_master.date <= '$date1' order by ph_purchase_master.date desc";
$resulti = mysql_query($sqli);
while($rowi = mysql_fetch_array($resulti))
{
    $purchase_id=$rowi['id'];	
	
	$sqlsmaster="SELECT * from ph_sales_master where purchase_id='$purchase_id' and date <= '$date1' ";
	$resultsmater=mysql_query($sqlsmaster);
	
	while($rowsmaster=mysql_fetch_array($resultsmater)){
	$issue_quantity=$rowsmaster['iss_qty'];
	}
	
	$sqlpreturn="SELECT * from ph_purchase_return where ph_purchase_id='$purchase_id' and date <= '$date1' ";
	$resultpreturn=mysql_query($sqlpreturn);
	$return_purchase_quantity=0;
	while($rowpreturn=mysql_fetch_array($resultpreturn)){
	$return_purchase_quantity=$return_purchase_quantity+$rowpreturn['return_qty'];
	}
	
	$sqlsreturn="SELECT ph_sales_return.* from ph_sales_return left join ph_sales_master on ph_sales_return.ph_sales_id=ph_sales_master.id where ph_sales_master.id='$purchase_id' and ph_sales_return.date <= '$date1'";
	$resultsreturn=mysql_query($sqlsreturn);
	$return_sales_quantity=0;
	while($rowsreturn=mysql_fetch_array($resultsreturn)){
	$return_sales_quantity=$return_sales_quantity+$rowsreturn['return_qty'];
	}
	$stockinhand=$rowi["tot_qty"]-$return_purchase_quantity-$issue_quantity+$return_sales_quantity;;
?> 
<?php 
//$sum2=$sum2+$rowi["each_qty_rate"]; 
//$sum3=$sum3+($rowi["each_qty_rate"]*($rowi["tot_qty"]-$issue_quantity-$return_purchase_quantity+$return_sales_quantity)); 
//$c=$c+1;
array_push($reorderlist,array($rowi["medicine_id"]=>$stockinhand));
}
$final=array();
foreach($reorderlist as $list){
foreach($list as $key=>$value){
$final[$key] +=$value;
}
}
$otherlist='';
foreach($final as $key=>$value){
$finalsql="select * from ph_medicine_master where id='$key'";
$result=mysql_query($finalsql);
while($row=mysql_fetch_array($result)){

if($row['reorder_level']<$value){
?>

  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $row["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=dateofpurchase'<?php echo $row[id];?>' id=dateofpurchase'<?php echo $row[id];?>' value="" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=stockinhand'<?php echo $row[id];?>' id=stockinhand'<?php echo $row[id];?>' value="<?php echo $value;?>" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type="text" name="reord<?php echo $row[id];?>" value="<?php echo $row["reorder_level"]; ?>" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=reorderlevel'<?php echo $row[id];?>' id=reorderlevel'<?php echo $row[id];?>' value="" required/></strong></div></td>
    <td style="padding:2px 4px;"><input onclick="clonethis(this);" type="checkbox" id="checkbox<?php echo $c;?>" name="allbox2[]" value="<?php echo $row[id];?>" />Reorder&nbsp;&nbsp;<a href='#' onclick="return confirm1('<?php echo $row['id'];?>');">Delete</a></td>
  </tr>

<?php

}//if
$otherlist.=$key.',';
}//while

}//foreach
$otherlist=substr($otherlist,0,strlen($otherlist)-1);
?>
<?php
$othersql="select * from ph_medicine_master where id not in ($otherlist)";
$resultother=mysql_query($othersql);
while($rowother=mysql_fetch_array($resultother)){


?>

  <tr>
    <td style="padding:2px 4px;"><span style="text-transform:uppercase; font-weight:bold;"><?php echo $rowother["medici_name"]; ?></span></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=dateofpurchase'<?php echo $rowother[id];?>' id=dateofpurchase'<?php echo $row[id];?>' value="" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=stockinhand'<?php echo $rowother[id];?>' id=stockinhand'<?php echo $row[id];?>' value="0" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type="text" name="reord<?php echo $rowother[id];?>" value="<?php echo $rowother["reorder_level"]; ?>" readonly/></strong></div></td>
    <td style="padding:2px 4px;"><div align="center"><strong><input type=text name=reorderlevel'<?php echo $rowother[id];?>' id=reorderlevel'<?php echo $rowother[id];?>' value="" required/></strong></div></td>
    <td style="padding:2px 4px;"><input onclick="clonethis(this);" type="checkbox" id="checkbox<?php echo $c;?>" name="allbox2[]" value="<?php echo $rowother[id];?>" />Reorder&nbsp;&nbsp;<a href='#' onclick="return confirm1('<?php echo $rowother['id'];?>');">Delete</a></td>
  </tr>

<?php

}

?>
</table>		  	

		</div>
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php include('footer.php'); ?>
	<!-- Themes switcher section ============================================================================================= -->


</body>
</html>