<?php 
	ob_start();
	session_start();
	$pageTitle = "Verify Your Humanity";
	$pageDescription = "Please verify you're human before creating a Matchbox University account.";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">

		<h2>Verification for Account</h2>
		
		<?php
			//check to see if they got the answer right; if so send to acct creation, if not exit
		    if (isset($_POST['submit'])) {
				$VerAnswer=$_POST['VerAnswer'];
				$CorrAns=$_POST['CorrAns'];
				$CorrAns= strtoupper($CorrAns);
				$VerAnswer=strtoupper($VerAnswer);
				//echo $VerAnswer . "  " . $CorrAns;
				//exit;
				
				if ($VerAnswer==$CorrAns) {
					redirect_to("Create_User_Account_Form.php");
				} else {
					echo "<h4>Incorrect. Please try again in order to advance to account creation.</h4>";
					//exit;
				}
		    }
		?>


		<p>To verify you are not a bot, read the lines below and answer the question.</p>
		<?php
			//starts out with a test line in case bot just reads first pic
			$testPic = WEB_IMAGE_PATH . "testPic.jpg";
			echo "<p>This is a test ". "<img src=" . $testPic. " width=\"200\"></p>";
			
			//look up all questions and display text and photo for each line
			$query = ("SELECT * FROM Verification");
			$result = mysql_query($query);
			$rows = mysql_num_rows($result);
			for ($i=1; $i<=$rows; $i++) {
				$row =mysql_fetch_array($result);
				$picture = WEB_IMAGE_PATH . $row["VerPic"];
				echo "<p>".$row["VerTxt"]."<img src=" . $picture. " width=\"200\"></p>";
			}
			//select one of the questions to ask
			$verRecord= rand(1,$rows);
			$query2= ("SELECT * FROM Verification WHERE VerNo LIKE '$verRecord'");
			$result2= mysql_query($query2);
			$row2 =mysql_fetch_array($result2);
			$VerQuest= $row2["VerQuest"];
			$VerAns= $row2["VerAns"];
		?>
	
			<form action="verification.php" method="post" id="Verify" data-parsley-validate>		
				<div class="row">
					<div class="large-6 medium-6 columns">
					        <div class="formRow">
							<label for="VerAnswer">"<?php echo $VerQuest; ?>"</label>
							<input type="text" name="VerAnswer" value="" maxlength="30" id="VerAnswer" required>
						</div>		
					</div>
				</div>
				
				<input type="hidden" name="CorrAns" id="CorrAns" value="<?php echo $VerAns; ?>">
				
				<div class="row">	
					<div class="large-2 small-6 columns">
						<input type="submit"  name="submit" class="button dark" value="Submit"/>
					</div>
					<div class="large-2 small-6 columns end">
						<a class="button dark cancel" href="verification.php">Reset</a>
					</div>
				</div>
			</form>
	
	</div>
</div>

<?php require("includes/footer.php"); ?>		