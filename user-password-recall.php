<?php
	ob_start();
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
		
		<?php if (isset($_POST['btnSendPassword'])) { ?>
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
			            ?>
			            <p class='error'>Sorry, this Username and Email doesn't exist in our records.</p>
			            <p><a href="<?php ROOTURL; ?>user-password-recall.php">Try again</a>.</p>
			            <?php
				            
		            } else {
			            // found user id or email address, now send password by email
			            $userEmail = $userAcctInfo["User_Email"];
					    $password = $userAcctInfo["Password"];
					    
					    ?>
					    <p>We sent your password to your email address on file. Please check for the email and then <a href="<?php ROOTURL; ?>Authenticate-test.php">log in here</a>.</p>
						<p>If you have any issues, reach out to us at <a href="mailto:info@mbx-u.com">info@mbx-u.com</a>.</p>
			            <?php
				            
			            //Mail inputs
					    $to = $userEmail;
					    $subject = "MBX-U: Password Reset";
					    $message = "Your mbx-u.com password is " . $password . ".\r\n\r\n";
					    $headers = 'From: Matchbox University <info@mbx-u.com>' . "\r\n" . 'Reply-To:info@mbx-u.com' . 'Bcc:info@mbx-u.com';
					    
				        mail($to,$subject,$message,$headers);
			            
			            //after login we move to the main page
		                //redirect_to('index.php');
		                
		                //exit;
		            } 
		        }
	        ?>	
		
		
		<?php } else { ?>
			<form action="user-password-recall.php" method="post" name="frmLogin" id="frmLogin" data-parsley-validate>
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
		<?php } ?>
	</div>
</div>
    
<?php include("includes/footer.php"); ?>