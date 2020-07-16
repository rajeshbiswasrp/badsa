<?php
session_start();
require_once('config/db.php');
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
?>

<?php
if($_POST["submit"])
{
 $print_quenty=$_REQUEST["print_quenty"];
 $purchase_id=$_REQUEST["purchase_id"];
 $qtyih=$_REQUEST["qtyih"];
$_SESSION["pp_id"]=$purchase_id;
?>
<script>
function print1()
{
document.getElementById("button").innerHTML='';
 var divElements1 = document.getElementById('a').innerHTML;
document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements1 + "</body>";
window.print();
return false;
//document.getElementById("button").style.display='block';
}
</script>
<body>
<div align="center"><a href="item_barcode.php">Back</a></div>
<br>
<br>
<br>
<div id="a">
<table align="center" width="600" border="0">
 <tr>
 <td colspan="4"><div align="center"><!--Print Barcode--></div></td>
 </tr>
 

<?php  
$sql="SELECT a.*,b.size_type,b.mrp,c.medici_name FROM barcod_master a LEFT JOIN ph_purchase_master b ON a.purchase_id=b.id LEFT JOIN ph_medicine_master c ON b.medicine_id=c.id WHERE a.purchase_id='$purchase_id' AND a.status='1'";
$query=mysql_query($sql) or die(mysql_error());
$n=mysql_num_rows($query);
$code=array();
$barcode=array();
$index=0;
while($r=mysql_fetch_assoc($query))
{

	$barcode[]=$r;
	
}



for($i=0;$i<sizeof($barcode);$i+=3)
{
	echo '<tr>';
	for($j=$i;$j<$i+3;$j++)
	{
		if($j<sizeof($barcode))
		{
			echo '<td style="padding:20px; border:solid 2px #333; width:260px;">';
?>
			<!--<div style="font-size:20px; font-weight:bold; text-align:center">Size<br/><?php //echo $barcode[$j]['size_type'];?></div>-->
			<span style="font-size:20px; font-weight:bold;">Badsa</span>(Sodepur Ghola)<br/>
            <span style="font-size:17px; font-weight:bold;">Article :<?php echo $barcode[$j]['medici_name'];?></span><br/>
 <span style="font-size:22px; font-weight:bold;">Size :<?php echo $barcode[$j]['size_type'];?></span><br/>            

<span style="font-size:17px; font-weight:bold;">MRP : <?php echo number_format($barcode[$j]['mrp'],'2','.','');?></span>
<span style="font-size:17px; font-weight:bold;"></span>
<div style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;"> <img src="22.php?bb_code=<?php echo $barcode[$j]['barcode'];  ?>" alt=""><br>
<?php echo $barcode[$j]['barcode'];?></div>
<?php
			echo '</td>';
		}
		else
		{
			echo '</td> &nbsp; </td>';
		}
	}
	echo '</tr>';
}
}
?>
			

  <tr>
  <td colspan="4"><div align="center">
    <!--<input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/>-->    
  </div>    <div align="center" id="button"></div></td>
   </tr>
</table>
</div>
</body>