<?php
// while (true) { //infinite loop 

// function get_notifications()
// {
include 'inc/config/database.php';
session_start();
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $sql = "SELECT * FROM meetings WHERE owner_id = $userId AND reminder =1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $meeting_count = $stmt->rowCount();
    echo $meeting_count;
    $meetings = $stmt->fetchAll();

    // if ($meeting_dates) {
    foreach ($meetings as $meeting_detail) {
        $date_time = $meeting_detail->date .  $meeting_detail->start; // Use your own date and time here

        // Convert the date and time to a DateTime object
        $reminder_date_time = new DateTime($date_time);

        // Subtract minutes from the reminder time
        $reminder_date_time->sub(new DateInterval('PT' . $meeting_detail->reminder_minutes . 'M'));

        // Format the reminder time for display
        $reminder_formatted_time = $reminder_date_time->format('Y-m-d H:i:s');

        // Get the current date and time
        $current_date_time = date('Y-m-d H:i:s');

        if ($current_date_time >= $reminder_formatted_time) {

            // The current date and time matches the specified date and time
            $meeting_prompt = "Your meeting with " . $meeting_detail->personalities . " at " . $meeting_detail->venue . "will start in " .  $meeting_detail->reminder_minutes . " . Don't forget ";

            // creating and inserting notification inside table
            $sql = "INSERT INTO notifications (user_id,message) VALUES (?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId, $meeting_prompt]);
        }
    }
} else {
    header("Location: login.php");
}
// }
sleep(1); // Pause script execution for 1 second
// }
// get_notifications();

// // Set the date and time for the reminder
// $date_time = '2023-04-21 02:55:00'; // Use your own date and time here

// // Convert the date and time to a DateTime object
// $reminder_date_time = new DateTime($date_time);

// // Subtract 10 minutes from the reminder time
// $reminder_date_time->sub(new DateInterval('PT1M'));

// // Format the reminder time for display
// $reminder_formatted_time = $reminder_date_time->format('Y-m-d H:i:s');

// // Get the current date and time
// $current_date_time = date('Y-m-d H:i:s');
// // Compare the two dates and times
// if ($current_date_time >= $reminder_formatted_time) {
//     // The current date and time matches the specified date and time
//     echo "The current date and time matches the specified date and time!";
//     $time_past = "The current date and time does not match the specified date and time.";

//     // creating and inserting notification inside table
//     $sql = "INSERT INTO notifications (user_id,message) VALUES (?,?)";
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([$userId, $time_past]);
// } else {
//     // The current date and time is not the same as the specified date and time

// }
// $currentDateTime = date('Y-m-d H:i:s');
// echo $currentDateTime;
