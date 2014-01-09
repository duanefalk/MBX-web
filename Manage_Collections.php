<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<table id="structure">
    <tr>
            <td id="navigation">
                    <a href="Create_Collection.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Create a Collection</p></a>
                    <a href="Collection_Value_Lists.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Set up Collection Code Lists</p></a>
                    <a href="Update_Collection.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">View/Update Your Collections</p></a>
                    <a href="Delete_Collection.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Delete a Collection</p></a>
                    <a href="Collections_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Collections Menu</p></a>
                    <a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>	
            </td>
            <td id="page">
                <h2>Manage Your Collections</h2>



            </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>