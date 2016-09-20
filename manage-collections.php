<?php
	ob_start();
	session_start();
	$pageTitle = "Manage Collection";
	$pageDescription = "Create and configure your Matchbox University matchbox car collection.";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	include("includes/header.php");
?>
            
<section class="row">
	<div class="large-12 columns">
		<h2>Create/Configure Your Collections</h2>
		<div class="row actionButtons">			
			<?php
			    $User=$_SESSION['Username'];
			    $result=0;
			    $query=("SELECT * FROM Matchbox_User_Collections WHERE Username='$User'");
			    $result=mysql_query($query);
			    if ($result) {
					$rows=mysql_num_rows($result);
					
					if ($rows > 0) {
					    $row = mysql_fetch_array($result);
					    
					    if ($row['User_Coll_Inactiv_Flag']=="1") { ?>
					    	<!-- has collection but it is inactive, show link to create collection button -->
							<div class="large-6 medium-6 columns">
								<a href="Create_Collection.php" class="button dark">Create a Collection</a>
							</div>
							<?php } else { ?>
						    <!-- has collection, show link to create collection button -->
						    <?php $Coll_ID = $row['User_Coll_ID']; ?>
						    
						    <div class="large-6 medium-6 columns">   
						        <a href="Updt_Coll.php" class="button dark">View / Update / Delete Your <strong><em><?php echo $Coll_ID; ?></em></strong> Collection</a>
						    </div> 
					    <?php }
					} else { ?>
						<!-- no collection, link to create button -->
					    <div class="large-6 medium-6 columns">
							<a href="Create_Collection.php" class="button dark">Create a Collection</a>
						</div>
					<?php }	
			    }		    
			?>
	 	              
		    <div class="large-6 medium-6 columns">
		    	<a href="Collection_Code_Lists.php" class="button dark">Set up Collection Code Lists</a>
		    </div>
		</div>
		<p><em>*Currently each user can have only one collection.</em></p>
	</div>
</section>

<!-- Sub Menu -->
<div class="row" id="subNav">
	<div class="large-12 columns">
		<p class="tip">related pages:</p>
		<a href="manage-collections.php">Manage Collection</a>
		<a href="index.php">Return to Main Page</a>
	</div>
</div>	

<?php include("includes/footer.php"); ?>