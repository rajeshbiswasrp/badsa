<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
 $search = $_GET['q'];
 $patient=$_GET['patient_creator'];
 $search_type=$_GET['searchtype'];

if($patient==0)
{
 
if($search!='')
{
	$custarr='';
	$querycustid="SELECT * FROM ph_patient_master where pati_name LIKE '$search%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
$orsql="OR ( pati_id in ($custarr) and pati_type='0' )";
else
$orsql="";	

    $custarr='';
	$querycustid="SELECT * FROM patient_master where pati_name LIKE '$search%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
{
if(strlen($orsql)>0)
$orsql=$orsql." OR ( pati_id in ($custarr) and pati_type='1' )";
else
$orsql="OR ( pati_id in ($custarr) and pati_type='1' )";
}
else
{
if(strlen($orsql)==0)
$orsql="";	
}


}





if($search!='')
{

$sum=0;
$c=1;
$sqli = "SELECT DISTINCT invoice_no,receipt_no FROM ph_sales_master where receipt_no LIKE '$search%' $orsql";
$resulti = mysql_query($sqli);

?>

  
<?php
if(mysql_num_rows($resulti)==0)
{
$display='';
$display='<table class="table table-hover table-striped table-bordered" id="product-table">';
$display.='<tr>';
$display.='<td height="22" colspan="7" width="100%" align="center" valign="middle"><font color="#FF0000">No Record Found.</font></td></tr>';
$display.='</table>';
echo $display;
}
else
{ 
$display='';
$display='<table class="table table-hover table-striped table-bordered">';
$display.='<tbody>';
$display.='<tr>';
$display.='<tr>';
$display.='<th><strong>Sl No.</strong></th>';
$display.='<th><strong>Date</strong></th>';
$display.='<th><strong>Receipt No.</strong></th>';
$display.='<th><strong>Customer Name</strong></th>';
$display.='<th><strong>Gross Amount</strong></th>';
$display.='<th><strong>Add Charges</strong></th>';
$display.='<th><strong>Discount</strong></th>';
$display.='<th><strong>Paid Amount</strong></th>';
$display.='<th><strong>Due Amount</strong></th>';
$display.='<th><strong>Option</strong></th>';
$display.='</tr>';
$display.='</tbody>';

$sumgros=0;
$sumadd=0;
$sumdis=0;
$sumpay=0;
$sumdue=0;


while($rowi = mysql_fetch_array($resulti))
{
$inv=$rowi['invoice_no'];
$temp_voucher=0;
$oldtempvoucher='999999999999999999';

$sql="SELECT * FROM ph_sales_master where invoice_no='$inv'";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{

$pati_type=$row["pati_type"];

$temp_voucher=$row["invoice_no"];
$p_id=$row["pati_id"];
$date=$row["date"];

$sales_id=$row["id"];
$mrp=$row["mrp"];
$m_id=$row["medicine_id"];
$iss_qty=$row["iss_qty"];

$sql3="select SUM(return_qty)as re_qty from ph_sales_return where ph_sales_id='$sales_id'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$re_qty=$row3['re_qty'];
}
$tot_qty=$iss_qty-$re_qty;
$gross_amt=$tot_qty*$mrp;

if($temp_voucher==$oldtempvoucher || $temp_voucher==0)
{
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
else
{
//echo "555";
$sum=0;
$sum=$sum+$gross_amt;
$gro_amt=$sum;
}
$oldtempvoucher=$temp_voucher;
}

if($pati_type==0)
$sql21="SELECT * FROM ph_patient_master where id='$p_id'";
else
if($pati_type==1)
$sql21="SELECT * FROM patient_master where id='$p_id'";

$result21=mysql_query($sql21);
while($row21=mysql_fetch_array($result21))
{
$pati_name=$row21["pati_name"];
}

$sql2="select SUM(less_pay)as pay_amt from ph_sales_payment where invoice_no='$inv'";
$res2=mysql_query($sql2);
while($row2=mysql_fetch_array($res2))
{
$pay_amt=$row2['pay_amt'];
}
$sql3="select SUM(add_charge)as add_amt from ph_sales_payment where invoice_no='$inv'";
$res3=mysql_query($sql3);
while($row3=mysql_fetch_array($res3))
{
$add_amt=$row3['add_amt'];
}

$sql4="select SUM(less_dis)as dis_amt from ph_sales_payment where invoice_no='$inv'";
$res4=mysql_query($sql4);
while($row4=mysql_fetch_array($res4))
{
$dis_amt=$row4['dis_amt'];
}

$tot_amt=$gro_amt+$add_amt;
$due_amt=$tot_amt-$pay_amt-$dis_amt;



$display.='<tr>';
$display.='<td><div align="center">'.$c.'</div></td>';
$display.='<td><div align="center">'.$date.'</div></td>';
$display.='<td>'.$rowi["receipt_no"].'</td>';
$display.='<td>'.$pati_name.'</td>';
$display.='<td><div align="right">'.number_format($gro_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($add_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($dis_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($pay_amt,2).'</div></td>';
$display.='<td><div align="right">'.number_format($due_amt,2).'</div></td>';
$display.='<td><a href=ph_sales_stock_report.php?invoice_no='.$rowi["invoice_no"].' target="_blank">View</a></td>';
$display.='</tr>';



$c=$c+1;

$sumgros=$sumgros+$gro_amt;
$sumadd=$sumadd+$add_amt;
$sumdis=$sumdis+$dis_amt;
$sumpay=$sumpay+$pay_amt;
$sumdue=$sumdue+$due_amt;


}

$display.='<tr>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='<th><strong>Total</strong></th>';
$display.='<th><div align="right"><strong>'.number_format($sumgros,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumadd,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdis,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumpay,2).'</strong></div></th>';
$display.='<th><div align="right"><strong>'.number_format($sumdue,2).'</strong></div></th>';
$display.='<th><strong>&nbsp;</strong></th>';
$display.='</tr>';

$searchcriteria=$_GET['q'];
$display.='<tr>';
$display.='<td colspan="10" ><input  style="margin-left:550px;" type="button" name="submit1" id="submit1" value="Print" onclick="opensearchcusrepotdoc(&#39;'.$searchcriteria.'&#39;,&#39;'.$patient.'&#39;,&#39;'.$search_type.'&#39;);" target="_blank" /></td>';
$display.='</tr>';
?>
<?php
$display.='</table>';
echo $display;
 }
 
 }
?>


<?php
}
else
{
$hint="";
 $q = $_GET['q'];
 $patient=$_GET['patient_creator'];
 $search_type=$_GET['search_type'];

if($q!='')
{
	$custarr='';
	$querycustid="SELECT * FROM ph_patient_master where pati_name LIKE '$q%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
$orsql="( pati_id in ($custarr) and pati_type='0' )";
else
$orsql="";	

    $custarr='';
	$querycustid="SELECT * FROM patient_master where pati_name LIKE '$q%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	$custarr.=$rowcustid['id'].",";
	}

$custarr=substr($custarr,0,strlen($custarr)-1);
if(strlen($custarr)>0)
{
if(strlen($orsql)>0)
$orsql=$orsql." OR ( pati_id in ($custarr) and pati_type='1' )";
else
$orsql="( pati_id in ($custarr) and pati_type='1' )";
}
else
{
if(strlen($orsql)==0)
$orsql="";	
}




if(strlen($orsql)>0)
$OR='OR';
else
$OR='';

$orbedsql="$OR ( bed_no LIKE '$q%' )";


$referarr='';
	$queryreferid="SELECT * FROM refer_master where refer_name LIKE '$q%' and refer_type='DOC'";
	$resultreferid=mysql_query($queryreferid);
	while($rowreferid=mysql_fetch_array($resultreferid)){
	$referarr.=$rowreferid['id'].",";
	}

$referarr=substr($referarr,0,strlen($referarr)-1);
if(strlen($referarr)>0)
{
if(strlen($orbedsql)>0)
$OR1='OR';
else
$OR1='';
$orrefersql="$OR1 ( refer_id in ($referarr) )";
}
else
$orrefersql="";	

}

if($search!='')
{

$sum=0;
$c=1;
$sqli = "SELECT pati_id,pati_type,patient_id,refer_id,bed_no FROM ph_sales_master where $orsql $orbedsql $orrefersql group by pati_id,pati_type";
$resulti = mysql_query($sqli);

?>

  
<?php
if(mysql_num_rows($resulti)==0)
{
}
else
{
	$userlist=array();
	while($rowi = mysql_fetch_array($resulti))
	{
		if($rowi['pati_type']==0)
		$tablename='ph_patient_master';
		else
		if($rowi['pati_type']==1)
		$tablename='patient_master';
		
		$sqlname="SELECT * from $tablename where id='$rowi[pati_id]'";
		$resultname=mysql_query($sqlname);
		while($rowname=mysql_fetch_array($resultname)){
		$pati_name=$rowname["pati_name"];
			if($rowi['pati_type']==0)
			{
			$address=$rowname["address"];
			$mobile=$rowname["mobile"];
			$admissiondate=$rowname["date"];
			}
			else
			if($rowi['pati_type']==1)
			{
			$address=$rowname["full_add"];
			$mobile=$rowname["mobile"];
			$admissiondate=$rowname["resig_date"];
			}
		}
		if($rowi['pati_type']==1)
		{
			$sqlname="SELECT dis_date from discharge_patient where pmax_id='$rowi[pati_id]'";
			$resultname=mysql_query($sqlname);
			if(mysql_num_rows($resultname)==0)
			$dischargedate='';
			else
			{
				while($rowname=mysql_fetch_array($resultname)){
				$dischargedate=$rowname["dis_date"];	
				}
			}
		}
		
		$refer_id=$rowi['refer_id'];
		$sqlname1="SELECT refer_name from refer_master where id='$refer_id'";
		$resultname1=mysql_query($sqlname1);
		while($rowname1=mysql_fetch_array($resultname1)){
		$refer_name=$rowname1["refer_name"];
		
		}
		
		$bed_no=$rowi['bed_no'];
		
		//array_push($userlist,array("pati_id"=>$rowi['pati_id'],"pati_type"=>$rowi['pati_type'],"patient_id"=>$rowi['patient_id'],"pati_name"=>$pati_name,"refer_name"=>$refer_name,"bed_no"=>$rowi['bed_no'],"address"=>$address,"mobile"=>$mobile,"admissiondate"=>$admissiondate,"dischargedate"=>$dischargedate));
		array_push($userlist,array("pati_id"=>$rowi['pati_id'],"pati_type"=>$rowi['pati_type'],"patient_id"=>$rowi['patient_id'],"refer_id"=>$refer_id,"bed_no"=>$bed_no,"pati_name"=>$pati_name,"refer_name"=>$refer_name));
		$c=$c+1;
	}
}



if ($q!== "")
{ 
$q=strtolower($q); $len=strlen($q);
		foreach($userlist as $user)
		{ 
		
			if(strstr(strtolower($user['pati_name']),$q) || strstr(strtolower($user['bed_no']),$q) || strstr(strtolower($user['refer_name']),$q))
			  {
				 if ($hint=="") {
				 /* $hint="<a class='cc' onclick='selectedbox(&#39;".$user['pati_id'].'&#39;,'.'&#39;'.$user['pati_type'].'&#39;'.','.'&#39;'.$user['patient_id'].'&#39;'.','.'&#39;'.$user['refer_name'].'&#39;'.','.'&#39;'.$user['bed_no'].'&#39;'.','.'&#39;'.$user['pati_name'].'&#39;'.','.'&#39;'.$user['address'].'&#39;'.','.'&#39;'.$user['mobile'].'&#39;'.','.'&#39;'.$user['admissiondate'].'&#39;'.','.'&#39;'.$user['dischargedate'].'&#39;'.")' href='#' >" .
				  str_replace("'","",$user['patient_id']." - (".$user['pati_name'].")"). "</a>";*/
				 $hint="<a class='cc' onclick='selectedbox(&#39;".$user['pati_id'].'&#39;,'.'&#39;'.$user['pati_type'].'&#39;'.','.'&#39;'.$user['patient_id'].'&#39;'.','.'&#39;'.$user['refer_id'].'&#39;'.','.'&#39;'.$user['bed_no'].'&#39;'.','.'&#39;'.$user['pati_name'].'&#39;'.")' href='#' >" .
				  str_replace("'","",$user['patient_id']." - (".$user['pati_name'].")"). "</a>";
				} else {
				 /* $hint=$hint . "<br /><a class='cc' onclick='selectedbox(&#39;".$user['pati_id'].'&#39;,'.'&#39;'.$user['pati_type'].'&#39;'.','.'&#39;'.$user['patient_id'].'&#39;'.','.'&#39;'.$user['refer_name'].'&#39;'.','.'&#39;'.$user['bed_no'].'&#39;'.','.'&#39;'.$user['pati_name'].'&#39;'.','.'&#39;'.$user['address'].'&#39;'.','.'&#39;'.$user['mobile'].'&#39;'.','.'&#39;'.$user['admissiondate'].'&#39;'.','.'&#39;'.$user['dischargedate'].'&#39;'.")' href='#' >" .
				  str_replace("'","",$user['patient_id']." - (".$user['pati_name'].")"). "</a>";*/
				   $hint=$hint . "<br /><a class='cc' onclick='selectedbox(&#39;".$user['pati_id'].'&#39;,'.'&#39;'.$user['pati_type'].'&#39;'.','.'&#39;'.$user['patient_id'].'&#39;'.','.'&#39;'.$user['refer_id'].'&#39;'.','.'&#39;'.$user['bed_no'].'&#39;'.','.'&#39;'.$user['pati_name'].'&#39;'.")' href='#' >" .
				  str_replace("'","",$user['patient_id']." - (".$user['pati_name'].")"). "</a>";
				 
				}
				
				
			  }
	  }
}

echo $hint==="" ? "<font color='#FF0000'>no patient</font>" : $hint;
}

}
?>