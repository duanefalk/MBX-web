<?php 
	$pageTitle = "Processing a User Upload";
	require_once("includes/db_connection.php");
	require_once("includes/functions.php");
	include("includes/header.php");
?>

<div class="row">
	<div class="large-12 columns">
			
		<h2>File Upload</h2>

		<?php
		    $query=("SELECT * FROM MBXU_User_Uploads ORDER BY user_input_id DESC LIMIT 1");
		    $result = mysql_query($query);
		    $row=mysql_fetch_array($result);
		    echo "<div style='display:none'>" . $row["user_input_id"] . "</div>";
		    
		    $new_input_id=$row["user_input_id"];
		    echo "<div style='display:none'>" . $new_input_id++ . "</div>"; 
		    
		    //add fields to db
		    $upload_user_name = $_POST['user_name'];
		    $upload_comment = $_POST['user_comment'];
		    $file_uploaded = 0;				
		
		    //check if a file has been uploaded
		    if ($_FILES['upload']['error'] != UPLOAD_ERR_NO_FILE) {
		  
				//enter conditional logic
				//echo "there is a file";
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
	                        echo "<h4>Success! Thank you for uploading the " . $_FILES['upload']['name'] . " file.</h4>";
                            //exit;
                            $file_uploaded=1;
                        } else {
                            echo "<p>Error uploading file.</p>";
                            exit;
                        }
                    } else {
                        echo "<p>Invalid file type.</p>";
                        exit;
                    }
	            } else {
                    echo "<p>File too large- submit only files < 5mb.</p>";
                    exit;
	            }
		    }
	
	
		    $query="INSERT INTO MBXU_User_Uploads (user_input_id, user_name, user_comment, user_file_loaded) VALUES ('$new_input_id', '$upload_user_name', '$upload_comment', '$file_uploaded')";
		    $outcome=mysql_query($query);
		    
			$file_output_url =  ROOTURL . "/" . UPLOAD_URL . $unique_file_name;
		    
		    if ($outcome) {
			    
			    //Mail inputs
			    $emails = "info@mbx-u.com,duanejfalk@yahoo.com";
			    $subject = "MBX-U: New Upload!";
			    
			    //$message = "<html><head></head><body>";
			    //$message = "There's a new upload from " . $upload_user_name . ".\r\n\r\nComment: " . $upload_comment . ".\r\n\r\n<img src='" . $$file_output_url . "' alt='' />";
			    //$message .= "</body></html>";
			    $message = "There's a new upload from " . $upload_user_name . ".\r\n\r\nComment: " . $upload_comment . ".";
			    
			    $headers = 'From:info@mbx-u.com' . "\r\n" . 'Reply-To:info@mbx-u.com';
			    
		        mail($emails,$subject,$message,$headers);
		        
		        //redirect_to("User_Upload.php");
		        //exit;
		        ?>						
		    
				<div class="row">
			        <div class="large-12 columns">
						<img src="<?php echo $file_output_url; ?>" style="margin-bottom:1em;" />
			        </div>
				</div>        
		        
		        <div class="row">
					<div class="large-2 small-6 columns">
						<a href="<?php echo ROOTURL; ?>User_Upload.php" class="button dark">Upload Another File</a>
					</div>
					<div class="large-2 small-6 columns end">
						<a href="<?php echo ROOTURL; ?>" class="button cancel">Return to Home</a>
					</div>
				</div>
		        
		        <?php
		    } 
			else {
			    echo "<p>Subject creation failed.</p>";
		        echo "<p>Error: ".mysql_error()."</p>";
		        exit;
			 }
		?>
		
	</div>
</div>