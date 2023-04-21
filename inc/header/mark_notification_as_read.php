<?php // Retrieve notification ID from URL parameter
$notificationId = $_GET['id'];

// Update notification status in database
$sql = "UPDATE notifications SET is_read=1 WHERE id= $notificationId ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Return OK status to indicate success
http_response_code(200);
