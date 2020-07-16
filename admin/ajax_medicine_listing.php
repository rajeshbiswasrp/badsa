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
//$criteria = $_GET['medici_name'];

$sql="SELECT  ph_medicine_master.*,ph_type_master.type_name from ph_medicine_master left join ph_type_master on ph_medicine_master.type_id=ph_type_master.id ORDER BY ph_medicine_master.id ASC";

//$sql="SELECT * FROM ph_medicine_master where status='1' ORDER BY id ASC";
$result=mysql_query($sql);

$referlist=array();
while($row=mysql_fetch_array($result)){
$m_id=$row['id'];

/*$sql1="select * from drug_master where medicine_id='$m_id'";
$res1=mysql_query($sql1);
while($row1=mysql_fetch_array($res1))
{

array_push($referlist,array("medici_name"=>$row['medici_name'],"name"=>$row1['drug_name']));
}*/
array_push($referlist,array("medici_id"=>$row['id'],"medici_name"=>$row['medici_name'],"type_name"=>$row['type_name']));
}

if ($q!== "")
{ 
$q=strtolower($q); $len=strlen($q);
		foreach($referlist as $refer)
		{ 
		
			if(stristr($q, strtolower(substr($refer['medici_name'],0,$len))) )
			  {
				 if ($hint=="") {
				  $hint="<a onclick='selectedbox(&#39;".$refer['medici_id'].'&#39;,'.'"'.str_replace("'","",$refer['medici_name']).'"'.")' href='#' >" .
				  str_replace("'","",$refer['medici_name']). " - "." &nbsp;&nbsp;&nbsp;".$refer['type_name']. "</a>";
				
				} else {
				  $hint=$hint . "<br /><a onclick='selectedbox(&#39;".$refer['medici_id'].'&#39;,'.'"'.str_replace("'","",$refer['medici_name']).'"'.")' href='#' >" .
				  str_replace("'","",$refer['medici_name']). " - "." &nbsp;&nbsp;&nbsp;".$refer['type_name']. "</a>";
				 
				}
				
				
			  }
	  }
}

echo $hint==="" ? "No Item" : $hint;



?>
