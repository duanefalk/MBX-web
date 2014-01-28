<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
				<tr>
					<td id="navigation">
						<a href="Add_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Add New Record</p></a>
						<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>			
					</td>
					<td id="page">

						<head>

						</head>						
						<h2>Add a Microvariation</h2>
						<p></p>

				<!-- fields:
				RefType
				RefCode
				RefName
				RefDetails
				RefComment
				-->		
				
		<form action="Add_Microvariation_Process.php" method="post">
			<p>UMID:     	  <input type="text" name="UMID" value="" size="6" id="UMID"</p>
			<p>Microvariation:     	</p>
				<textarea name="Microvariation" cols="45" rows="4">			
				</textarea>
			<p>Update Date:          <input type="date" name="Microvar_Updt_Dt" </p>

			<input type="submit" name="submit" value="Submit"/>
		</form>			
		<a href="Add_Microvariation.php">Cancel</a>						 						
	</td>
</tr>
</table>
<?php require("includes/footer.php"); ?>