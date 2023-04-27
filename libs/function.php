<?php

function check_login($conn)
{
   if(!isset($_SESSION['id'])){
      header("Location: login.php");

   }

   // if(isset($_SESSION['username']))
   // {
   //    $userId = $_SESSION['username'];
   //    $query = "SELECT * FROM user_profile WHERE username = '$userId' limit 1";

   //    $result = mysqli_query($conn, $query);
   //    if($result && mysqli_num_rows($result) > 0)
   //    {
   //       $user_data = mysqli_fetch_assoc($result);
   //       return $user_data;
   //    }
   // }

   // //redirect to login
   // header("Location: login.php");

}

function registerValidate($table_name){
   global $conn;
   $fullname = $_POST['fullname'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $phonenumber = $_POST['phone'];
   $password = $_POST['password'];
   $sql = $conn->query("SELECT * FROM $table_name WHERE email = '$email'");
   $sql2 =  $conn->query("SELECT * FROM $table_name WHERE username = '$username'");
   if ($sql->num_rows > 0) {
     $emailErr = "This Email is already in use!";
     return $emailErr;
    
   } else if ($sql2->num_rows > 0) {
     $usernameErr = "This username is already taken!";
     return $usernameErr;
   } else if (!empty($fullname) && !empty($username) && !empty($password) && !empty($email) && !empty($phonenumber) && is_numeric($phonenumber) && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) <= 8) {
     $sql = $conn->query("INSERT into $table_name(fullname,username,email,phone,password) VALUES ('$fullname','$username','$email','$phonenumber','$password')") or die($sql->error);
     header("Location: login.php");
     return;
   }else{
     echo "Please enter some valid information";

   }
   return;
}

function loginValidate(){
   global $conn;
   $username = $_POST['username'];
   $password = $_POST['password'];
   // $_POST['fullname'];
   $passwordErr = "";
   $sql = $conn->query("SELECT * FROM technicians WHERE username = '$username' limit 1");
   $sql2 =  $conn->query("SELECT * FROM user_profile WHERE username = '$username' limit 1");
   if ($sql->num_rows > 0) {
      $user_data = mysqli_fetch_assoc($sql);

      if($user_data['password'] === $password){

         $_SESSION['username'] = $user_data['username'];
         $_SESSION['fullname'] = $user_data['fullname'];
         $_SESSION['id'] = $user_data['id'];

         header("Location: user-dashboard.php");
      }else if($user_data['password'] !== ['password']){
         return $passwordErr;
      }
   }else if($sql2->num_rows > 0){
      $user_data = mysqli_fetch_assoc($sql2);

      if($user_data['password'] === $password){

         $_SESSION['username'] = $user_data['username'];
         $_SESSION['id'] = $user_data['id'];
         $id = $_SESSION['id'];
         $_SESSION['fullname'] = $user_data['fullname'];
         $_SESSION['phone'] = $user_data['phone'];
         $_SESSION['altphone'] = $user_data['altphone'];
         $_SESSION['email'] = $user_data['email'];
         $_SESSION['image'] = $user_data['image'];
         $_SESSION['about'] = $user_data['about'];

         header("Location: user-dashboard.php");
      }else if($user_data['password'] !== ['password']){
         return $passwordErr;
      }
   }else{
      return $passwordErr;
   }
      
   return;
}


?>