<?php
	ob_start();
	session_start();
	$_SESSION['Sec_Lvl']=1;
	$pageTitle = "Log In";
	$pageDescription = "Log in to your Matchbox University collector's account.";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");	
	include("includes/header.php");
?>

<title>Basic Login</title>

<div class="row" id="login">
	<div class="large-6 large-centered columns">
		<h2>Log in</h2>
			        
        <?php
        	//$Message = $_GET["msg"];
			//echo $Message;
        
			// If User ID & Password fields have entry
	        if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
	            
	            //username and password variables
	            $userId = mysql_real_escape_string($_POST['txtUserId']);
	            $password = mysql_real_escape_string($_POST['txtPassword']);
	         
	            // check if the user id and password combination exist in database
	            $query = ("SELECT * FROM MBXU_User_Accounts WHERE Username = '$userId' AND Password = '$password'");   
	            $result = mysql_query($query);
	            $rows_count= mysql_num_rows($result);
	            
	            if ($rows_count == 0) {
	                echo "<small class='error'>Sorry, wrong user id / password.</small>";	               
		    // the user id and password match, 
		    // set the session	            
	            } else {
	                $_SESSION['db_is_logged_in'] = true;
	                // get sec lvl from db
	                $row = mysql_fetch_array($result);
	                
	                $_SESSION['Username'] = $row["Username"];
	                $_SESSION['Sec_Lvl'] = $row["Sec_Lvl"];
	                $_SESSION['Veh_Cond_Scheme'] = $row["Veh_Cond_Scheme"];
	                $_SESSION['Pkg_Cond_Scheme'] = $row["Pkg_Cond_Scheme"];
	                $_SESSION['Code2_Pref'] = $row["Code2_Pref"];
			$_SESSION['First_Name'] = $row["First_Name"];
	                
	                //echo $userId . $password . "<br />";
	                //echo $rows_count . ' ' . $row[Username] . ' ' . $row[Password] . " " . $row[Sec_Lvl];
	          
	                // after login we move to the main page
	                redirect_to('index.php');
	                
	                exit;
	            } 
	          
	        }
        ?>
        
        <form method="post" name="frmLogin" id="frmLogin" data-parsley-validate>
	        <div class="row">
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
				        <label for="txtUserId">Username</label>
					    <input name="txtUserId" type="text" id="txtUserId" required>
					</div>
		        </div>
		        <div class="large-6 medium-6 columns">
			        <div class="formRow">
				        <label for="txtPassword">Password</label>
						<input name="txtPassword" type="password" id="txtPassword" required>
					</div>
		        </div>
	        </div>       	
			<div class="row">
				<div class="large-6 medium-6 small-6 columns">
			    	<input class="button" type="submit" name="btnLogin" value="Login">
			    </div>
			    <div class="large-6 medium-6 small-6 columns">
				    <!--a href="REPLACE" class="forgot">I forgot my password</a-->
				    <a href="user-password-recall.php" class="forgot">I forgot my password.</a>
			    </div>
			</div>
        </form>
        
        <!--a href="guest-login.php">Log in as Guest</a-->
	</div>
	
</div>
    
<?php include("includes/footer.php"); ?>