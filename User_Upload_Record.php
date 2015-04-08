<?php require_once("includes/db_connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    $query=("SELECT * FROM MBXU_User_Uploads ORDER BY user_input_id DESC LIMIT 1");
    $result = mysql_query($query);
    $row=mysql_fetch_array($result);
    echo $row["user_input_id"];
    $new_input_id=$row["user_input_id"];
    echo $new_input_id++; 
    
    //add fields to db
    $upload_user_name=$_POST['user_name'];
    $upload_comment=$_POST['user_comment'];
    $file_uploaded=0;				

    //check if a file has been uploaded
    if ($_FILES['upload']['error'] != UPLOAD_ERR_NO_FILE) {
    //these next two trials didnt work:
    //if (file_exists(UPLOAD_PATH.$_FILES['upload']['name']))   { 
    //if (!empty($_FILES)) {

    // enter conditional logic
            // echo "there is a file";
            //exit;
            // check file size first
            if ($_FILES["upload"]["size"] < 5000000) {
                    // if size ok, check file type   , "doc"
                    $allowedExts = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "txt", "xls", "xlsx");
                    $extension = end(explode(".", $_FILES['upload']['name']));
                    if (in_array($extension, $allowedExts)) {
                            //set the destination dir
                            $destination = UPLOAD_URL;
                            // add unique prefix to file name to match db record id
                            $unique_file_name=$new_input_id."_".$_FILES['upload']['name'];

                            //move file
                            if (move_uploaded_file($_FILES['upload']['tmp_name'], $destination.$unique_file_name)) {
                                echo $_FILES['upload']['name'] . " uploaded to " . $destination;
                                //exit;
                                $file_uploaded=1;
                            } else {
                                echo "error uploading file";
                                exit;
                            }
                    } else {
                            echo "Invalid file type";
                            exit;
                    }
            } else {
                    echo "File too large- submit only files <5mb";
                    exit;
            }
    }
    $query="INSERT INTO MBXU_User_Uploads (
    user_input_id, user_name, user_comment, user_file_loaded
    ) VALUES (
    '$new_input_id', '$upload_user_name', '$upload_comment', '$file_uploaded'
    )";
    $outcome=mysql_query($query);
    if ($outcome) {
        redirect_to("User_Upload.php");
        exit;
    } // success 
     else {
        echo "<p>Subject creation failed.</p>";
        echo "<p>".mysql_error()."</p>";
        exit;
     }
        ?>	