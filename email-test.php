<?php 
	$First_Name = "duncan";
	$Last_Name = "falk";
	$User_Email = "djflakk@gmail.com";
		
	$emails = "info@mbx-u.com,duncan@designfreund.com";
    $subject = "MBX-U: New Member!";
    $message = "We have a new member of Matchbox University named " . $First_Name . " " . $Last_Name . ".\r\n\r\n";
    $message .= "Their email is " . $User_Email . "\r\n\r\n";
    //$message .= "Their address is:\r\n" . $User_Addr_1 . ", " . $User_Addr_2 . "\r\n" . $User_City . ", " . $User_State . ", " . $User_Postal_Code . " " . $User_Country;
    $headers = 'From:info@mbx-u.com' . "\r\n" . 'Reply-To:info@mbx-u.com';
    mail($emails,$subject,$message,$headers);
?>