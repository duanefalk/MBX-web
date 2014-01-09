<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<table id="structure">
				<tr>
					<td id="navigation">
                                        <p>Select Record Type to Add:</p>
					<a href="Add_Model_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Model</p></a>
					<a href="Add_Version_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Version</p></a>
					<a href="Add_Variation_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Variation</p></a>
					<a href="Add_Release_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Release</p></a>
                                        <a href="Add_Package_Type_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Package Type</p></a>
                                        <a href="Add_Wheel_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Wheel Type</p></a>
					<a href="Add_Reference_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Reference</p></a>
                                        <a href="Add_Value_List_Item_Form.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Value List Item</p></a>
					<br />
					<a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>
					</td>
					<td id="page">
						<h2>Welcome to the Online Matchbox Database!!</h2>
						<p>This site is for Matchbox collectors and anyone interested in Matchbox models</p>
						 						
					</td>
				</tr>
			</table>
<?php require("includes/footer.php"); ?>