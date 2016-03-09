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
	            $userId = mysql_real_escape_string($_POST['txtUserId']);
	            $userEmail = mysql_real_escape_string($_POST['txtUserId']);
	         
	            // check if the user id exists in User ID column
	            // FIX THIS!
	            $query = ("SELECT * FROM MBXU_User_Accounts WHERE Username = '$userId' AND Password = '$password'");   
	            $result = mysql_query($query);
	            $rows_count_id = mysql_num_rows($result);
	            
	            if ($rows_count_id == 0 && $rows_count_email == 0) {
		            //User ID does not exist
	                echo "<p class='error'>Sorry, this User ID or Email doesn't exist in our records.</p>";
	            } else {
		            // found user id or email address, now send password by email
		            
		            if ($userRetrievedEmail == an email address) {
			            $to = $userRetrievedEmail;    
		            } else {
			            //input is equal to a username, so now we must
			            //retrieve email address from username, and assign to $to
			            $to = $userRetrievedEmail;
		            }
		            $subject = "MBX-U.com: Retrieve Password";
				    $message = "Here is your lost password: " . $userRetrievedPassword . ".\r\n\r\nKeep it safe!\r\n\r\n\r\n\r\nLog in to http://mbx-u.com.";		   
				    $headers = 'From:info@mbx-u.com' . "\r\n" . 'Reply-To:info@mbx-u.com';
				    
			        mail($to,$subject,$message,$headers);
			        
			        //redirect_to("Authenticate-test.php");
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