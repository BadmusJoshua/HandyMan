<?php
include 'inc/config/database.php';
session_start();
$userId=$_SESSION['id'];
if (isset($_COOKIE['remember_me'])) {
$cookie_parts = explode(':', $_COOKIE['remember_me']);
$token = end($cookie_parts);
    // Delete the user's session ID or token from the database
    $query = "DELETE FROM remember_me_tokens WHERE user_id= ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    // Log the user out and delete the "remember me" cookie
    //deleting the cookie
    setcookie('remember_me', '', time() - 86400);

    header("Location: login.php");
}else{
    header("Location: login.php");
}

?>