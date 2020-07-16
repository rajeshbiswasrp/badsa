<?php
/* $DEVID="5B820D00452C";
//$DEVID="0019E06B71015A880C030001";
$a = new COM('WScript.Shell');
try{
if (!($regcount = $a->RegRead("HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\USBSTOR\Enum\Count"))) {
   // throw new Exception("Cannot access registry.");
}
}
catch(Exception $e){
   echo "error access device";
   
}
$usbfound=0;
if(isset($regcount) && $regcount>0){
for($i=0;$i<$regcount;$i++)
{
  if(!($usbdevice = $a->RegRead("HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Services\USBSTOR\Enum\\".$i))) {
    //throw new Exception("Cannot access registry.");
   }
   
   if(strpos($usbdevice,$DEVID))
   {
       $usbfound=1;
       break;
   }
}
}

if(!$usbfound)
{
?>
<script>
window.location="not_support_system.php"
</script>
<?php
}
 */
ob_start();
require_once('config/db.php');
session_start();
$date_date=date("d/m/Y");


//Get the ipconfig details using system commond
system('ipconfig /all');

// Capture the output into a variable
$mycomsys=ob_get_contents();

// Clean (erase) the output buffer
ob_clean();

$find_mac = "Physical";
//find the "Physical" & Find the position of Physical text

$pmac = strpos($mycomsys, $find_mac);
// Get Physical Address

$macaddress=substr($mycomsys,($pmac+36),17);
//Display Mac Address


$password = $macaddress;


// Generate a random IV using mcrypt_create_iv(),
// openssl_random_pseudo_bytes() or another suitable source of randomness
//$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

//$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);


if(isset($_POST['submitkey']) && $_POST['submitkey']!="")
{
	$salt=$_POST['key'];
	$hashadd= md5($password.$salt);
	
	$sql="INSERT INTO `key` ( `key`, `time`) VALUES ('$hashadd', CURRENT_TIMESTAMP)";
	$result=mysql_query($sql);
	$msg="Key Successfully installed";
	
}

?>
<?php
$sname_logo=mysql_fetch_array(mysql_query("select * from ph_config_master where status='1'"));
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title><?php echo $sname_logo['com_name'] ; ?></title>

    <link rel="stylesheet" href="../login/css/style.css" media="screen" type="text/css" />
	<link rel="shortcut icon" href="../themes/images/logo_icon.png"/>
</head>

<body class="profile-login">


<header class="global-header">
<div>
<nav class="global-nav">
<a class="logo" data-analytics="site logo" href="/">
<img width="100" title="<?php echo $sname_logo['com_name'] ; ?>" alt="<?php echo $sname_logo['com_name'] ; ?>" src="<?php echo "logo1/".$sname_logo['sch_img']; ?>"></a><br/>
<h1 style="text-align:center; color:#fff; font-size:30px; text-transform:uppercase;"><span style="text-transform:capitalize; font-size:30px; font-style:oblique;">Welcome To</span><br/><?php echo $sname_logo['com_name'] ; ?></h1>
</nav>
</div>
</header>
<?php


$iterations = '1000';
$hash= md5($password.$iterations);


$sql="select * from `key` where 1";
$result=mysql_query($sql);
if(mysql_num_rows($result)==0)
{
?>
<section class="login">
<form id="key-form" name="key-form"  method="post" action="index.php">
<h1>New Registration</h1>
<div class="password-container">
<input type="password" placeholder="Enter your key here" tabindex="21" name="key">
</div>

<input type="hidden" value="submit" class="button submit" name="submitkey">
<button class="button submit" data-analytics="sign-in"  onclick="keyform.submit();" type="submit">Register Key</button>

   </form>
</section>

<?php 
}
else 
{
	$sql1="Select * from `key` where `key`='$hash'";
	$result1=mysql_query($sql1);
	if(mysql_num_rows($result1)==0)
	{
	?>
	<section class="login">
	<form id="login-form" method="post" action="index.php">
	<h1>Message</h1>
	
    <div class="password-container">
	Your software is pirated.Please buy a valid key.
	</div>
	
	</form>
	</section>
	
	<?php 
	}
	else
	{
	?>
	<section class="login">
	<form id="login-form" method="post" action="login_check.php">
	<h1>User Login</h1>
	<?php if(isset($msg)) echo $msg;?>
	<input type="text" value="" placeholder="Username" tabindex="20" name="username">
	  <div class="password-container">
	<input type="password" placeholder="Password" tabindex="21" name="password">
	</div>
	
	<button class="button submit" data-analytics="sign-in" type="submit">Login</button>
	   <span><a href="forgot_pass.html">forgot password?</a></span>
	   </form>
	</section>
	<?php 
	}
}

?>

<div style="text-align:center; font-size:12px;">
<strong><?php echo $sname_logo['com_name'] ; ?></strong><br/>
Address :  <?php echo $sname_logo['address'] ; ?><br/>


</div>

</body>

</html>