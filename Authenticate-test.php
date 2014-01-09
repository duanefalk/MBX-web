<?php
// we must never forget to start the session
session_start();
$_SESSION['Sec_Lvl']=1;
?>

<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<html>
<table id="structure">
    <tr>
        <td id="navigation">	
        </td>
        <td id="page">
            <title>Basic Login</title>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
            <head>
            </head>
            <body>
                <h2>Log In</h2>    
                <?php
                $errorMessage = '';
                if (isset($_POST['txtUserId']) && isset($_POST['txtPassword'])) {
                    $userId = $_POST['txtUserId'];
                    $password = $_POST['txtPassword'];
                 
                    // check if the user id and password combination exist in database
                    $query = ("SELECT * 
                            FROM Test_MBXU_User_Accounts
                            WHERE Username = '$userId'
                            AND Password = '$password'");   
                    $result = mysql_query($query);
                    $rows_count= mysql_num_rows($result);
                    
                    if ($rows_count == 0) {
                        echo "Sorry, wrong user id / password";  
                        // the user id and password match, 
                        // set the session
                    } else {
                        $_SESSION['db_is_logged_in'] = true;
                        // get sec lvl from db
                        $row=mysql_fetch_array($result);
                        $_SESSION['Sec_Lvl']=$row["Sec_Lvl"];
                        $_SESSION['Veh_Cond_Scheme']=$row["Veh_Cond_Scheme"];
                        $_SESSION['Pkg_Cond_Scheme']=$row["Pkg_Cond_Scheme"];
                        $_SESSION['Code2_Pref']=$row["Code2_Pref"];
                        echo $userId.$password."<br />";
                        echo $rows_count. ' '.$row[Username].' '.$row[Password]." ".$row[Sec_Lvl];
                  
                        // after login we move to the main page
                        header('Location: main_page.php');
                        exit;
                    } 
                   include 'includes/close_db_connection.php';
                }
                ?>

                <?php
                if ($errorMessage != '') {
                ?>
                <p align="center"><strong><font color="#990000"><?php echo $errorMessage; ?></font></strong></p>
                <?php
                }
                ?> 
                <form method="post" name="frmLogin" id="frmLogin">
                <table width="400" border="1" align="center" cellpadding="2" cellspacing="2">
                <tr>
                <td width="150">User Id</td>
                <td><input name="txtUserId" type="text" id="txtUserId"></td>
                </tr>
                <tr>
                <td width="150">Password</td>
                <td><input name="txtPassword" type="password" id="txtPassword"></td>
                </tr>
                <tr>
                <td width="150">&nbsp;</td>
                <td><input type="submit" name="btnLogin" value="Login"></td>
                </tr>
                </table>
                </form>
                <a href="guest_login.php">Log in as Guest</a>
            </body>
                
        </td>
    </tr>
</table>
<?php include("includes/footer.php"); ?>
</html>