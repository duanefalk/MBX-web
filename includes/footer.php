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
			<p><a href="<?php ROOTURL; ?>website-feedback.php">Have Feedback on the Website? Its great to hear your feedback, shoot us a message.</a></p>
		</div>
	</div>  
</footer>

<div id="announcement-popup" class="modal">
	<h4>ATTENTION:</h4>
	<p>We are currently working with an individual to take over and maintain the site. Please stay tuned for info on that changeover.</p>
	<p>(Due to a number of circumstances I will no longer be updating or maintaining the MBX-U website after the end of 2020. I will leave the site running as it stands for several months to allow folks time to do some final lookups or print/export their collections if desired.)</p>
	<p>Note &mdash;</p>
	<p>I am selling my collection. If you are interested in purchasing a large collection, or even just some particular models, contact me at <a href="info@mbx-u.com">info@mbx-u.com</a> with your wish-list.</p>
	<p>Thank you to everyone who's been supportive of the site!</p>
	<p>Regards,<br>Duane</p>
</div>

<script>
	$(document).foundation();
</script>

</body>
</html>