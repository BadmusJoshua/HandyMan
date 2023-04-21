<?php include 'inc/config/database.php';
session_start();
$userId = $_SESSION['id'];

$sql = "SELECT * FROM notifications WHERE is_read=0 && user_id=$userId";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();
echo $count;
