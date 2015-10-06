<?php ob_start(); ?>
<?php
// we must never forget to start the session
session_start();
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

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
    $Username=mysql_real_escape_string($_POST['Username']);
    $Password=mysql_real_escape_string($_POST['Password']);
    $Sec_Lvl=2;
    $First_Name=$_POST['First_Name'];
    $Last_Name=$_POST['Last_Name'];
    $User_Email=$_POST['User_Email'];
    $User_Url=mysql_real_escape_string($_POST['User_Url']);
    $User_Address=mysql_real_escape_string($_POST['User_Address']);
    $User_Phone=mysql_real_escape_string($_POST['User_Phone']);
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
    $User_Memberships=mysql_real_escape_string($_POST['User_Memberships']);
    $User_Veh_Cond_Scheme= $_POST['Veh_Cond_Scheme'];
    $User_Pkg_Cond_Scheme= $_POST['Pkg_Cond_Scheme'];
    $User_Code2_Pref=$_POST['Code2_Pref'];


     $query="INSERT INTO MBXU_User_Accounts (Username, Password, Sec_Lvl, First_Name, Last_Name, User_Email, User_Url,
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
        // success 
        
        //Mail inputs
	    $emails = "info@mbx-u.com,duanejfalk@yahoo.com";
	    $subject = "MBX-U: New Member!";
	    $message = "We have a new member of Matchbox University named " . $First_Name . " " . $Last_Name . ".\r\n\r\nTheir email is " . $User_Email . ".\r\nTheir address is " . $User_Address . ".";
	    $headers = 'From:info@mbx-u.com' . "\r\n" . 'Reply-To:info@mbx-u.com';
	    
        mail($emails,$subject,$message,$headers);
        
        $location="Authenticate-test.php";
        redirect_to($location);
     } 
     else {
         echo "<p>Account creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection); ?>