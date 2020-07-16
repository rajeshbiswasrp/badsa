<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $patiid = $_GET['patiid'];
 $patitype=$_GET['patitype'];
 
if($patiid!='' && $patitype!='')
{
$saleids='';
$sql="SELECT * FROM ph_temp_sales_master where status='1' and pati_id='$patiid' and pati_type='$patitype'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result)){
$bill_date=$row['bill_date'];
$pati_type=$row['pati_type'];
$pati_id=$row['pati_id'];
$pati_name=$row['pati_name'];
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
$payandprint=$row['payandprint'];

$saleids.=$row['id'].',';

$sqlinsert="INSERT INTO ph_sales_master (bill_date,pati_type,pati_id,patient_id,bed_no,refer_id,purchase_id,medicine_id,type_id,base,qty_inhand,iss_qty,unit,mrp,dico_per,batch,exp_date,gross_amt,dis_amt,invoice_no,receipt_no,update_invoice,status,date)
VALUES ('$bill_date','$pati_type','$pati_id','$patient_id','$bed_no','$refer_id','$purchase_id','$medicine_id','$type_id','$base','$qty_inhand','$iss_qty','$unit','$mrp','$dico_per','$batch','$exp_date','$gross_amt','$dis_amt','$invoice_no','$receipt_no','$update_invoice','$status','$dd')";
$resultinsert=mysql_query($sqlinsert);


}
$saleids=substr($saleids,0,strlen($saleids)-1);
$delquery="DELETE from ph_temp_sales_master where id in ($saleids)";
mysql_query($delquery);

if($pati_type==1)
{
	$_SESSION['pati_type']=$pati_type;
	$_SESSION['business_live_search_patient']=$pati_name;
	$_SESSION['pati_id']=$pati_id;
	$_SESSION['patient_id']=$patient_id;
	$_SESSION['bed_no']=$bed_no;
	$_SESSION['refer_id']=$refer_id;
}
else
if($pati_type==0)
{
	$_SESSION['pati_type']=$pati_type;
	$_SESSION['business_live_search_patient']=$pati_name;
	$_SESSION['pati_id']=$pati_id;
	$_SESSION['refer_id']=$refer_id;
}

if($payandprint)
$_SESSION['payandprint']=1;
	
}
echo '1';

?>