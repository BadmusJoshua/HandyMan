<?php
require 'inc/config/database.php';
if (isset($_GET['username'])) {
    $fetch_username = $_GET['username'];
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fetch_username]);
    $userCount = $stmt->rowCount();
    if ($userCount > 0) {
        $user_details = $stmt->fetch();
        session_start();
        $_SESSION['technician_id'] = $user_details->id;
        header("Location: view_technician_profile.php");
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fetch_username]);
        $userCount = $stmt->rowCount();
        if ($userCount > 0) {
            $user_details = $stmt->fetch();
            session_start();
            $_SESSION['client_id'] = $user_details->id;
            header("Location: view_client_profile.php");
        }
    }
}
