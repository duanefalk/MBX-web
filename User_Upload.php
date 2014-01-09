<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
<tr>
	<td id="navigation">
	
	<a href="Main_Page"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p</a>
	</td>
	<td id="page">
		<h2>Upload a File</h2>		

		<form action="User_Upload_Record.php" method="post" enctype="multipart/form-data">
			<p>Your Name:     	  <input type="text" name="user_name" value="" size="50" id="user_name"</p>
			<p>Comment:     </p>
				<textarea name="user_comment" cols="45" rows="4">	
				</textarea>
			<br />	
			<label for="file">Filename:</label>
			<input type="file" name="upload" id="file" <br />
			<input type="submit" name="submit" id="submit" value="Upload">
			<br />	
		</form>
		<a href="User_Upload.php">Cancel</a>
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>