<?php 
include 'inc/header/header.php';
$sql="SELECT * FROM meetings WHERE owner_id = userId AND reminder != NULL";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$meeting_dates=$stmt->fetchAll();
if ($meeting_dates) {
    foreach($meeting_dates as $remind_in){
        // Set the date and time for the reminder
$date_time = '<?= $remind_in->date $remind_in->start ?>'; // Use your own date and time here

// Convert the date and time to a DateTime object
$reminder_date_time = new DateTime($date_time);

// Subtract 10 minutes from the reminder time
$reminder_date_time->sub(new DateInterval('PT<?= $remind_in->reminder ?>M'));

// Format the reminder time for display
$reminder_formatted_time = $reminder_date_time->format('Y-m-d H:i:s');

// Get the current date and time
$current_date_time = date('Y-m-d H:i:s');
// Compare the two dates and times
if ($current_date_time === $reminder_formatted_time) {
    // The current date and time matches the specified date and time
    echo "The current date and time matches the specified date and time!";
} else {
    // The current date and time is not the same as the specified date and time
    echo "The current date and time does not match the specified date and time.";
}
    }
}
// // Set the date and time for the reminder
// $date_time = '2022-01-01 17:00:00'; // Use your own date and time here

// // Convert the date and time to a DateTime object
// $reminder_date_time = new DateTime($date_time);

// // Subtract 10 minutes from the reminder time
// $reminder_date_time->sub(new DateInterval('PT10M'));

// // Format the reminder time for display
// $reminder_formatted_time = $reminder_date_time->format('Y-m-d H:i:s');

// // Output the reminder message
// echo "Reminder: Your event is scheduled for {$date_time}. Don't forget it in 10 minutes, at {$reminder_formatted_time}!";

?>