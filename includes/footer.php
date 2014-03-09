
    <?php
        // 5. close connection
         if (isset($connection)) {
            mysql_close($connection);
         }
    ?>
    
    <footer id="footer">
    	<div class="row">
    		<div class="large-12 columns">
    			<p>Copyright &copy; <?php echo date("Y"); ?> Matchbox University / Duane Falk, All Rights Reserved.</p>
    		</div>
    	</div>  
    </footer>
    
    
<script src="js/vendor/jquery.js"></script>
<script src="js/vendor/fastclick.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

<script src="js/jquery.bxslider.min.js"></script>
<script src="js/utility.js"></script>



</body>
</html>