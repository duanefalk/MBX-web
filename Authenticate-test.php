<?php
// we must never forget to start the session
session_start();
$_SESSION['Sec_Lvl']=1;
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header-login.php"); ?>

<title>Basic Login</title>

<div class="row">

	<div class="large-8 large-centered columns">

		<div id="login">

			<h2>Log In</h2>    
		        
		        <?php
		        	$Message = $_GET["msg"];
					echo $Message;
		        
			        if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
			            $userId = $_POST['txtUserId'];
			            $password = $_POST['txtPassword'];
			         
			            // check if the user id and password combination exist in database
			            $query = ("SELECT * 
			                    FROM Test_MBXU_User_Accounts
			                    WHERE Username = '$userId'
			                    AND Password = '$password'");   
			            $result = mysql_query($query);
			            $rows_count= mysql_num_rows($result);
			            
			            if ($rows_count == 0) {
			                echo "<small class='error'>Sorry, wrong user id / password.</small>";
			                //redirect_to("Authenticate-test.php?msg=sorry, wrong username or password, pls try again");
			            
			            
			            // the user id and password match, 
			            // set the session
			            
			            } else {
			                $_SESSION['db_is_logged_in'] = true;
			                // get sec lvl from db
			                $row=mysql_fetch_array($result);
			                $_SESSION['Username']=$row["Username"];
			                $_SESSION['Sec_Lvl']=$row["Sec_Lvl"];
			                $_SESSION['Veh_Cond_Scheme']=$row["Veh_Cond_Scheme"];
			                $_SESSION['Pkg_Cond_Scheme']=$row["Pkg_Cond_Scheme"];
			                $_SESSION['Code2_Pref']=$row["Code2_Pref"];
					$_SESSION['First_Name']=$row["First_Name"];
			                echo $userId.$password."<br />";
			                echo $rows_count. ' '.$row[Username].' '.$row[Password]." ".$row[Sec_Lvl];
			          
			                // after login we move to the main page
			                redirect_to("index.php");
					//header('Location: index.php');
			                exit;
			            } 
			           include 'includes/close_db_connection.php';
			        }
		        ?>
		
		        <?php if ($errorMessage != '') { ?>
		        	<p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
		        <?php } ?> 
		        
		        <form method="post" name="frmLogin" id="frmLogin">
		        	<div class="row">
						<div class="large-12 columns">
					    	<label for="txtUserId">User ID</label>
					    	<input name="txtUserId" type="text" id="txtUserId" placeholder="User ID">
					    </div>
					</div>
					<div class="row">
						<div class="large-12 columns">
					    	<label for="txtPassword">Password</label>
					    	<input name="txtPassword" type="password" id="txtPassword" placeholder="Password">
					    </div>
					</div>
					<div class="row">
						<div class="large-12 large-centered columns">
					    	<input class="button" type="submit" name="btnLogin" value="Login">
					    </div>
					</div>
		        </form>
		        
		        <a href="guest_login.php">Log in as Guest</a>
		
		</div>
         
	</div>
	
</div>
    
<?php include("includes/footer.php"); ?>