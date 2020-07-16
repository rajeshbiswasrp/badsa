<?php
require_once('config/db.php');
session_start();
$sname_logo=mysql_fetch_array(mysql_query("select * from ph_config_master where status='1'"));
?>
	<div  id="footerSection">
	<div class="container">
		
		<p class="pull-right">&copy;&nbsp;<span style="font-size:13px; font-weight:bold; text-align:center; text-transform:uppercase; padding-top:5px;"><?php echo $sname_logo['com_name'] ; ?> </span></p>
</div><!-- Container End -->
	</div>
<!-- Placed at the end of the document so the pages load faster ============================================= -->
	<!--<script src="../themes/js/jquery.js" type="text/javascript"></script>-->
	<script src="../themes/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../themes/js/google-code-prettify/prettify.js"></script>
	
	<script src="../themes/js/bootshop.js"></script>
    <script src="../themes/js/jquery.lightbox-0.5.js"></script>