<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<table id="structure">
    <tr>
            <td id="navigation">
                    <a href="Dir_Add_Mdl_to_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Add a Model</p></a>
                    <a href="Updt_Coll_Mdl.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">View/Update a Model</p></a>
                    <a href="Del_Mdls_in_Coll.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Delete a Model</p></a>
                    <a href="Collections_Menu.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Collections Menu</p></a>
                    <a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>	
            </td>
            <td id="page">
                <h2>Manage the Models in Your Collection</h2>



            </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>