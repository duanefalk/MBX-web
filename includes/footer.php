
    <?php
        // 5. close connection
         if (isset($connection)) {
            mysql_close($connection);
         }
    ?>
    
    <footer id="footer">
    
    	<p>Copyright &copy; <?php echo date("Y"); ?> Matchbox University / Duane Falk, All Rights Reserved.</p>
    
    </footer>
    
    
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>

</body>
</html>