<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $patiname = $_GET['patiname'];
 
if($patiname!='')
{
$saleids='';
$sql="SELECT * FROM ph_sales_master where status='1'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
$bill_date=$row['bill_date'];
$pati_type=$row['pati_type'];
$pati_id=$row['pati_id'];
$patient_id=$row['patient_id'];
$bed_no=$row['bed_no'];
$refer_id=$row['refer_id'];
$purchase_id=$row['purchase_id'];
$medicine_id=$row['medicine_id'];
$type_id=$row['type_id'];
$base=$row['base'];
$qty_inhand=$row['qty_inhand'];
$iss_qty=$row['iss_qty'];
$unit=$row['unit'];
$mrp=$row['mrp'];
$dico_per=$row['dico_per'];
$batch=$row['batch'];
$exp_date=$row['exp_date'];
$gross_amt=$row['gross_amt'];
$dis_amt=$row['dis_amt'];
$batch=$row['batch'];
$invoice_no=$row['invoice_no'];
$receipt_no=$row['receipt_no'];
$update_invoice=$row['update_invoice'];
$status=$row['status'];
$dd=$row['date'];

if(isset($_SESSION['payandprint']))
$payandprint=1;
else
$payandprint=0;

$saleids.=$row['id'].',';


$sqlinsert="INSERT INTO ph_temp_sales_master (bill_date,pati_type,pati_id,pati_name,patient_id,bed_no,refer_id,purchase_id,medicine_id,type_id,base,qty_inhand,iss_qty,unit,mrp,dico_per,batch,exp_date,gross_amt,dis_amt,invoice_no,receipt_no,update_invoice,status,payandprint,date)
VALUES ('$bill_date','$pati_type','$pati_id','$patiname','$patient_id','$bed_no','$refer_id','$purchase_id','$medicine_id','$type_id','$base','$qty_inhand','$iss_qty','$unit','$mrp','$dico_per','$batch','$exp_date','$gross_amt','$dis_amt','$invoice_no','$receipt_no','$update_invoice','$status','$payandprint','$dd')";
$resultinsert=mysql_query($sqlinsert);


}
$saleids=substr($saleids,0,strlen($saleids)-1);
$delquery="DELETE from ph_sales_master where id in ($saleids)";
mysql_query($delquery);

unset($_SESSION['pati_type']);
unset($_SESSION['business_live_search_patient']);
unset($_SESSION['pati_id']);
unset($_SESSION['patient_id']);
unset($_SESSION['bed_no']);
unset($_SESSION['refer_id']);
if(isset($_SESSION['payandprint']))
unset($_SESSION['payandprint']);
	
}
echo '1';

?>