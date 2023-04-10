<?php
require 'inc/config/database.php';
if (isset($_GET['token'])) {
    //Check if token is valid
    echo $_GET['token'];
    
    session_start();
    $_SESSION['token'] = $_GET['token'];


}
header("Location:new_password_input.php");
?>
