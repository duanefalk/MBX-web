<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<table id="structure">
    <tr>
            <td id="navigation">
                    <a href="Manage_Collections.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collections</p></a>
                    <a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>	
            </td>
            <td id="page">
                <h2>View/Update Your Collections</h2>



                <a href="Updt_User_Coll_Value.php">Cancel</a>
            </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>