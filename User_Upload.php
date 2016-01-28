<?php 
	$pageTitle = "Upload a File";
	$pageDescription = "Contribute to the Matchbox University matchbox car database by uploading your own car photos.";
	include("includes/header.php");
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
?>

<div class="row">
	<div class="large-12 columns">
		<h2>Upload a File</h2>		

		<form action="User_Upload_Record.php" method="post" enctype="multipart/form-data">
			<label for="user_name">Your Name:</label>
			<input type="text" name="user_name" value="" size="50" id="user_name">
			
			<label for="comment">Comment:</label>
			<textarea id="comment" name="user_comment"></textarea>
				
			<label for="file">Filename:</label>
			<input type="file" name="upload" id="file">
			
			<input type="submit" name="submit" id="submit" value="Upload" class="button dark">
			<a class="button cancel" href="User_Upload.php">Cancel</a>
		</form>
	</div>
</div>

<?php require("includes/footer.php"); ?>