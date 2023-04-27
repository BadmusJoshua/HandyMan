<?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'josh');
   define('DB_PASS', 'josh0574');
   define('DB_NAME', 'handyman');

   //creating the connection
   $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
   //check connection
   if($conn->connect_error){
      die('Connection Failed'. $conn->connect_error);
   }

   //creating the connection using PDO
   $host = 'localhost';
   $db = 'handyman';
   $user = 'josh';
   $password = 'josh0574';

   $dsn = "mysql:host=localhost;dbname=handyman;charset=UTF8";

   try {   // set DSN
      $dsn="mysql:host=$host;dbname=$db;charset=UTF8";
  
        //new PDO instance
        $pdo = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }
        catch(PDOException $ex){
            die(json_encode(array('outcome' => false , 'message' => $ex->getMessage())));
        }
  
        //setting pdo attribute
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        // echo'seen database';

   
// if(isset($_POST['submit'])){
//    $fullname = $_POST['fullname'];
//    $password = $_POST['password'];
//    $email = $_POST['email'];
//    $about = $_POST['about'];
//    $address = $_POST['address'];
//    $state = $_POST['state'];
//    $city = $_POST['city'];
//    $phone = $_POST['phone'];
//    $altphone = $_POST['altphone'];
//    $twitter = $_POST['twitter'];
//    $facebook = $_POST['facebook'];
//    $instagram = $_POST['instagram'];
//    $linkedin = $_POST['linkedin'];

//    $query = mysqli_query
// }
?>