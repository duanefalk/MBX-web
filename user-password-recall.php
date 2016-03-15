<?php
	ob_start();
	// we must never forget to start the session
	session_start();
	$_SESSION['Sec_Lvl']=1;
	$pageTitle = "Lost Password";
	$pageDescription = "Recall your Matchbox University collector's account.";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");	
	include("includes/header.php");
?>

<div class="row" id="login">
	<div class="large-6 large-centered columns">
		<h2>Retrieve My Password</h2>
			        
        <?php        
			// If User ID & Password fields have entry
	        if (isset($_POST['txtUserId'])) {
	            
	            //username and password variables
	            $userIdentity = mysql_real_escape_string($_POST['txtUserId']);
	         
	            // check if the user id exists in User ID column
	            // FIX THIS!
	            $query = ("SELECT * FROM MBXU_User_Accounts WHERE (Username = '$userIdentity') OR (User_Email= '$userIdentity')");   
	            $result = mysql_query($query);
	            $rows_count_id = mysql_num_rows($result);
		    $userAcctInfo =mysql_fetch_array($result);
	            
	            if ($rows_count_id == 0) {
		            //User ID does not exist
	                echo "<p class='error'>Sorry, this Username and Email doesn't exist in our records.</p>";
	            } else {
		            // found user id or email address, now send password by email
		            $userEmail= $userAcctInfo["User_Email"];
			    $password= $userAcctInfo["Password"];
			    echo $userEmail." ".$password;
		            // email logic
	          
	                // after login we move to the main page
	                //redirect_to('index.php');
	                
	                //exit;
	            } 
	        }
        ?>
        
        <form method="post" name="frmLogin" id="frmLogin" data-parsley-validate>
	        <div class="row">
		        <div class="large-12 medium-12 columns">
			        <p>Enter your username or email address to retrieve your password. We'll send it to you by email.</p>
			        <div class="formRow">
				        <label for="txtUserId">Username or Email Address</label>
					    <input name="txtUserId" type="text" id="txtUserId" required>
					</div>
		        </div>
	        </div>       	
			<div class="row">
				<div class="large-6 medium-6 small-6 columns">
			    	<input class="button" type="submit" name="btnSendPassword" value="Send Password">
			    </div>
			</div>
        </form>
	</div>
	
</div>
    
<?php include("includes/footer.php"); ?>