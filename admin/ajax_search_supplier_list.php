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

if($q!='')
{
	$supparr=array();
	$querycustid="SELECT * FROM ph_supplier_master where sup_name LIKE '$q%'";
	$resultcustid=mysql_query($querycustid);
	while($rowcustid=mysql_fetch_array($resultcustid)){
	array_push($supparr,array("id"=>$rowcustid['id'],"sup_name"=>$rowcustid['sup_name']));
	}


if ($q!= "")
{ 
$q=strtolower($q); $len=strlen($q);
		foreach($supparr as $user)
		{ 
		
			if ($hint=="") {
				 $hint="<a class='cc' onclick='selectedbox(&#39;".$user['id'].'&#39;'.",&#39;".$user['sup_name'].'&#39;'.")' href='#' >" .
				 $user['sup_name']."</a>";
				} else {
				 $hint.="<a class='cc' onclick='selectedbox(&#39;".$user['id'].'&#39;'.",&#39;".$user['sup_name'].'&#39;'.")' href='#' >" .
				 $user['sup_name']."</a>";
				}
				
				
			
	  }
}

echo $hint==="" ? "<font color='#FF0000'>no patient</font>" : $hint;
}


?>