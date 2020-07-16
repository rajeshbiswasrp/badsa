<?php
require_once('config/db.php');
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
<img width="150" title="MERRYLAND NURSING HOME" alt="MERRYLAND NURSING HOME" src="<?php echo "logo1/".$sname_logo['sch_img']; ?>"></a><br/>
<h1 style="text-align:center; color:#fff; font-size:30px; text-transform:uppercase;"><span style="text-transform:capitalize; font-size:30px; font-style:oblique;">Welcome To</span><br/> MERRYLAND NURSING HOME </h1>
</nav>
</div>
</header>

<section class="login">
<form id="key-form" name="key-form"  method="post" action="index.php">
    <h4>This Software only rung on our preferred usb device.<br> Please check our usb device properly inserted in your system.Then try again to login</h4>
<div class="password-container">
<!--<input type="password" placeholder="Enter your key here" tabindex="21" name="key">-->
    <a href="index.php">Please Login here</a>
</div>

   </form>
</section>



<div style="text-align:center; font-size:12px;">
<strong><?php echo $sname_logo['com_name'] ; ?></strong><br/>
Address :  <?php echo $sname_logo['address'] ; ?><br/>
Ph: <?php echo $sname_logo['mobile'] ; ?>

</div>

</body>

</html>