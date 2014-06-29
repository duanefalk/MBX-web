<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<!-- fields:
    Username
    Password
    Sec_Lvl
    First_Name
    Last_Name
    User_Email
    User_Url
    User_Address
    User_Phone
    Areas_of_Interest
    User_is_Dealer
    User_Memberships
-->

<?php
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $Sec_Lvl=2;
    $First_Name=$_POST['First_Name'];
    $Last_Name=$_POST['Last_Name'];
    $User_Email=$_POST['User_Email'];
    $User_Url=$_POST['User_Url'];
    $User_Address=$_POST['User_Address'];
    $User_Phone=$_POST['User_Phone'];
    $Areas_of_Interest=$_POST['Areas_of_Interest'];
        if(isset($Areas_of_Interest)) {
            $InterestString='';
            foreach ($Areas_of_Interest as $key => $value) { 
                $InterestString .= $value.", "; 
            }}
        else
            {
              $InterestString='';
            }
  
    $User_is_Dealer=$_POST['User_is_Dealer'];
    $User_Memberships= $_POST['User_Memberships'];
    $User_Veh_Cond_Scheme= $_POST['Veh_Cond_Scheme'];
    $User_Pkg_Cond_Scheme= $_POST['Pkg_Cond_Scheme'];
    $User_Code2_Pref=$_POST['Code2_Pref'];


     $query="INSERT INTO Test_MBXU_User_Accounts (Username, Password, Sec_Lvl, First_Name, Last_Name, User_Email, User_Url,
            User_Address, User_Phone, Areas_of_Interest, User_is_Dealer, User_Memberships,
            Veh_Cond_Scheme, Pkg_Cond_Scheme, Code2_Pref) 
            VALUES ('$Username','$Password','$Sec_Lvl','$First_Name','$Last_Name', '$User_Email','$User_Url',
            '$User_Address','$User_Phone', ' $InterestString','$User_is_Dealer', '$User_Memberships',
            '$User_Veh_Cond_Scheme', '$User_Pkg_Cond_Scheme', '$User_Code2_Pref')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: Add_Version.php");
    
    $outcome=mysql_query($query);
    if ($outcome) {
         echo "<a href=\"index.php\">Success. Return to Main Page</a>";
     } // success 
     else {
         echo "<p>Account creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection); ?>