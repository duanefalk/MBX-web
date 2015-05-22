<?php
	// 5. close connection
    if (isset($connection)) {
    	mysql_close($connection);
    }
?>
    
<footer id="footer">
	<div class="row">
		<div class="large-12 columns">
			<p>Copyright &copy; <?php echo date("Y"); ?> Matchbox University / D. Falk, All Rights Reserved.</p>
			<p>MBX-U.com is in no way affiliated with Mattel, Inc. The MATCHBOX&copy; name and logo are the sole properties of Mattel, Inc.</p>
			<!--p><a href="<?php ROOTURL; ?>/website_feedback.php">Have Feedback on the Website? Its great to hear your feedback, shoot us a message.</a></p-->
		</div>
	</div>  
</footer>
    
<script src="js/vendor/jquery.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/parsley.min.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/utility.js"></script>

<script>
	$(document).foundation();
</script>

</body>
</html>