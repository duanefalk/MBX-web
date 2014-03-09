<div id="utilityNav">
	<!--a href="Search_Models_Menu.php">Search Models</a>
	<a href="Search_Releases_Menu.php">Search Releases</a-->
	
	<?php
	
		// code 1 = guest
		if ($_SESSION['Sec_Lvl'] == 1) {
			echo "<a href='Create_User_Account_Form.php'>Create an Account</a>";
			echo "<a href='Authenticate-test.php'>Login</a>";					
		}
		
		//code 2,3 = users with profiles
		if ($_SESSION['Sec_Lvl'] > 1) {
			
			//code 3 = Dad
			if ($_SESSION['Sec_Lvl'] == 3) {
				echo "<em>Hello, Duane</em>";
				echo "<a href='Edit_Account_Form.php'>Edit Account (needs a page)</a>";
				echo "<a href='Add_Menu.php'>Add a New Record</a>";						
			}
			
			echo "<a href='Collections_Menu.php'>Create / Manage Your Collections</a>";
			echo "<a href='User_Upload.php'>Upload Photo or Comments</a>";
			echo "<a href='logout.php'>Logout</a>";					
		}				
	?>
	
</div>