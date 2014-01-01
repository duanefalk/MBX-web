<?php
// file for basic function

//Redirect to another page
function redirect_to($location) {
    header("Location: {$location}");
    exit;
}
?>