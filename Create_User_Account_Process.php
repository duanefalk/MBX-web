<?php
// we must never forget to start the session
session_start();
?>

<!-- fields:
    Username
    Password
    Sec_Lvl
    User_Name
    User_Email
    User_Url
    User_Address
    User_Phone
    Areas_of_Interest
    User_is_Dealer
    User_Memberships
-->

<?php
    $Username=$_POST['Master_Mack_No'];
    $Password=$_POST['VerName'];
    $Sec_Lvl=2;
    $User_Name=$_POST['User_Name'];
    $User_Email=$_POST['User_Email'];
    $User_Url=$_POST['User_Url'];
    $User_Address=$_POST['User_Address'];
    $User_Phone=$_POST['User_Phone'];
    $Areas_of_Interest=$_POST['Areas_of_Interest'];
        if(isset($Areas_of_Interest)) {
            $InterestString='';
            foreach ($Area_of_Interest as $key => $value) { 
                $InterestString .= $value.", "; 
            }}
        else
            {
              $InterestString='';
            }
  
    $User_is_Dealer=$_POST['User_is_Dealer'];
    $User_Memberships= $_POST['User_Memberships'];
    
     $query="INSERT INTO Test_MBXU_User_Accounts (Username, Password, Sec_Lvl, User_Name, User_Email, User_Url,
            User_Address, User_Phone, Areas_of_Interest, User_is_Dealer, User_Memberships) 
            ) VALUES ('$Username','$Password','$Sec_Lvl','$User_Name','$User_Email','$User_Url',
            '$User_Address','$User_Phone', '$InterestString','$User_is_Dealer', '$User_Memberships')";
    // mysql_query($query);
    // "turned output buffering on cause this was giving me errors- couldnt find the source in the includes;
    // header("Location: Add_Version.php");
    
    $outcome=mysql_query($query);
    if ($outcome) {
         echo "<a href=\"Create_User_Account_Form.php\">Success. Return to Main Page</a>";
     } // success 
     else {
         echo "<p>Account creation failed.</p>";
         echo "<p>".mysql_error()."</p>";
      }
    mysql_close($connection); ?>