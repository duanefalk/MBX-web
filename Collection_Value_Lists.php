<?php require_once("includes/db_connection.php"); ?>
<?php include("includes/header.php"); ?>
<?php require_once("includes/functions.php"); ?>

<table id="structure">
    <tr>
            <td id="navigation">
                    <a href="Add_User_Coll_Value.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Add a New Seller or Location Code</p></a>
                    <a href="Updt_User_Coll_Value.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">View/Update Codes</p></a>
                    <a href="Del_User_Coll_Value.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Delete a Code</p></a>
                    <a href="Manage_Collections.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Manage Collections</p></a>
                    <a href="index.php"><p onmouseover="this.style.color='orange'" onmouseout="this.style.color='white'">Return to Main Page</p></a>	
            </td>
            <td id="page">
                <h2>Manage Your Code Lists</h2>
                <p>Collection code lists can speed up adding models to your collection by letting you select from a dropdown list of sellers and storage locations, </>
                <p>rather than having to type those in with each model. In the add/update/delete functions you will first be asked whether you want to work with</p>
                <p>'Sellers' or 'Locations'</p><br />

                <p>Sellers are, of course the people or companies from whom you buy your models. Typically there will be a core group of sellers you use repeatedly,</p>
                <p>so selecting them from a list will be quicker than typing out their names.</>
                <p>There are two fields to enter for sellers:</p>
                <p>a) Seller Name:   The name of the person or company</p>
                <p>b) Display Order: It is more convenient to have the most commonly used sellers at the front of the list. You can enter a number here to set the order</>
                <p>                  they display in the list. I would recommend leaving gaps in the numbers between eaxh seller for future additions.</p><br />

                <p>'Locations' refers to storage locations for your models. In the collection table you are given two fields for these, which allows you to enter a main</p>
                <p>location and a sublocation (e.g. storage unit1, shelf 3).</p>
                <p>As with sellers, there are two fields to enter:</p>
                <p>a) Location Name: What you call your storage locations. You need to include both main locations and sublocations in the list, if you have them.</p>
                <p>b) Display Order: As above, the order the locations display in the drop-down. You may want to group your main locations first, then you sub-locations.</p>

            </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>