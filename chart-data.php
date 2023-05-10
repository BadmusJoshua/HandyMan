<?php include 'inc/config/database.php';
$chartData = array(
    'labels' => array('Revenue', 'Customers', 'Sales'),
    'data' => array(17, 45, 22),
    'type' => 'doughnut'
);

header('Content-Type: application/json');
echo json_encode($chartData);
