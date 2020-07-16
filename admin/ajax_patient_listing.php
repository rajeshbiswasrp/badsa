<?php
require_once('config/db.php');
session_start();
if(!isset($_SESSION['ss_name']))
header("location: index.php");
else{}
$date_date=date("d/m/Y");
?>
<?php
$hint="";
$q = $_GET['q'];
$criteria = $_GET['patient_type'];
if($criteria)
$tablename='patient_master';
else
$tablename='ph_patient_master';

if($criteria)
$sql="SELECT `$tablename`.*,bed_master.bed_no,refer_master.id as referid FROM `$tablename` left join bed_master on `$tablename`.bed_id=bed_master.id left join refer_master on `$tablename`.refer_id=refer_master.refer_id ORDER BY `$tablename`.id DESC";
else
$sql="SELECT `$tablename`.* FROM `$tablename` ORDER BY `$tablename`.id DESC";

$result=mysql_query($sql);

$patilist=array();
while($row=mysql_fetch_array($result)){
array_push($patilist,array("id"=>$row['id'],"name"=>$row['pati_name'],"patient_id"=>$row['patient_id'],"bed_no"=>$row['bed_no'],"refer_id"=>$row['referid']));
}

if ($q!== "")
{ 
$q=strtolower($q); $len=strlen($q);
		foreach($patilist as $patient)
		{ 
		
			if(stristr($q, strtolower(substr($patient['id']." - (".$patient['name'].")",0,$len))) || strstr(strtolower($patient['name']),$q) )
			  {
				 if ($hint=="") {
				  $hint="<a onclick='selectedboxpatient(&#39;".$patient['id'].'&#39;,'.'"'.$patient['name'].'"'.','.'"'.$patient['patient_id'].'"'.','.'"'.$patient['bed_no'].'"'.','.'"'.$patient['refer_id'].'"'.")' href='#' >" .
				  str_replace("'","",$patient['name']). "</a>";
				
				} else {
				  $hint=$hint . "<br /><a onclick='selectedboxpatient(&#39;".$patient['id'].'&#39;,'.'"'.$patient['name'].'"'.','.'"'.$patient['patient_id'].'"'.','.'"'.$patient['bed_no'].'"'.','.'"'.$patient['refer_id'].'"'.")' href='#' >" .
				  str_replace("'","",$patient['name']). "</a>";
				 
				}
				
				
			  }
	  }
}

echo $hint==="" ? "No Customer" : $hint;



?>
