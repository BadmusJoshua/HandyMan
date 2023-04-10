<?php
require 'inc/config/database.php';
if (isset($_GET['username'])) {
    $fetch_username= $_GET['username'];
    $sql="SELECT * FROM technicians WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$fetch_username]);
    $userCount= $stmt->rowCount();
    if ($userCount>0) {
        $user_details=$stmt->fetch();
        echo $user_details->id;
        header("Location: view_technician_profile.php?id=$user_details->id");
    }else{
        $sql="SELECT * FROM clients WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fetch_username]);
        $userCount = $stmt->rowCount();
        if ($userCount > 0) {
            $user_details = $stmt->fetch();
            echo $user_details->id;
            header("Location: view_client_profile.php?id=$user_details->id");
        }
    }
}
