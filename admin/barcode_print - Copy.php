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
 <td colspan="4"><div align="center">Print Barcode</div></td>
 </tr>
 <tr>
  <td colspan="2">
  <table>
  <tr>
  <td height="90" width="67" valign="top">
  <div style="font-size:20px; font-weight:bold; text-align:center">Size<br/>5</div>  </td>
    <td width="157" valign="top"><span style="font-size:20px; font-weight:bold;">Badsa</span>(Sodepur Ghola)<br/>
      Article : L4602 - 67<br/>
      <span style="font-size:17px; font-weight:bold;">MRP : 250.00</span>
      <div style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;"> <img src="22.php" alt=""><br>
        <?php echo $rs2['barcode'];?>-<?php echo $rs3['mrp'];?>-<?php echo $rs3['size_type'];?> </div></td>
  
  </tr>
  </table>
  
  </td>
   <td width="180"><table>
     <tr>
       <td height="90" width="67" valign="top"><div style="font-size:20px; font-weight:bold; text-align:center">Size<br/>
         5</div></td>
       <td width="157" valign="top"><span style="font-size:20px; font-weight:bold;">Badsa</span>(Sodepur Ghola)<br/>
         Article : L4602 - 67<br/>
         <span style="font-size:17px; font-weight:bold;">MRP : 250.00</span>
         <div style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;"> <img src="22.php" alt=""><br>
          <?php echo $rs2['barcode'];?>-<?php echo $rs3['mrp'];?>-<?php echo $rs3['size_type'];?> </div></td>
     </tr>
   </table></td>
   <td width="180"><table>
     <tr>
       <td height="90" width="67" valign="top"><div style="font-size:20px; font-weight:bold; text-align:center">Size<br/>
         5</div></td>
       <td width="157" valign="top"><span style="font-size:20px; font-weight:bold;">Badsa</span>(Sodepur Ghola)<br/>
         Article : L4602 - 67<br/>
         <span style="font-size:17px; font-weight:bold;">MRP : 250.00</span>
         <div style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;"> <img src="22.php" alt=""><br>
          <?php echo $rs2['barcode'];?>-<?php echo $rs3['mrp'];?>-<?php echo $rs3['size_type'];?> </div></td>
     </tr>
   </table></td>
 </tr>
 

<?php  
$sub2 = "select * from  barcod_master where purchase_id ='$purchase_id' and status='1'"; 
$qry2 = mysql_query($sub2);
while($rs2=mysql_fetch_array($qry2))
{
 $barcode=$rs2["barcode"];
$_SESSION["bb_code"]=$barcode;
$sub3 = "select * from  ph_purchase_master where id ='$purchase_id'"; 
$qry3 = mysql_query($sub3);
while($rs3=mysql_fetch_array($qry3))
{
//echo $print_quenty;
//for($i=0;$i<$print_quenty;)
//{
?>
  <tr>
  <td height="90" width="67" valign="top">
  <div style="font-size:20px; font-weight:bold; text-align:center">Size<br/>5</div>  </td>
    <td width="157" valign="top"><span style="font-size:20px; font-weight:bold;">Badsa</span>(Sodepur Ghola)<br/>
      Article : L4602 - 67<br/>
      <span style="font-size:17px; font-weight:bold;">MRP : 250.00</span>
      <div style=" font-family:Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold;"> <img src="22.php" alt=""><br>
        <?php echo $rs2['barcode'];?>-<?php echo $rs3['mrp'];?>-<?php echo $rs3['size_type'];?> </div></td>
  </tr>
<?php 
//$i++;
//}
}
}
?>
<?php
}
?>
 
  <tr>
  <td colspan="4"><div align="center">
    <input type="submit" name="submit" id="submit" value="Print" onClick="print1();"/>    
  </div>    <div align="center" id="button"></div></td>
   </tr>
</table>
</div>
</body>