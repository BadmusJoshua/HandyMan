<?php

   //  //validate confirm password
   //  if(empty($_POST['confirmpassword'])){
   //     $confirmpasswordErr = 'PLease reconfirm password';
   //  }else{
   //     $confirmpassword = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   //  }
 

 class Project{
   public function __construct()
   {

      if(array_key_exists('updateProfile',$_POST)){
         $this->updateProfile();
      }else if(array_key_exists('logout',$_POST)){
         $this->logout();
      }
   }

   public function updateProfile(){
      global $conn;
      // $username = $_POST['username'];
      $username = $_SESSION['username'];
      $fullname = $_POST['fullname'];
      // $email = $_POST['email'];
      // $about =$conn->real_escape_string($_POST['about']);
      $address = $conn->real_escape_string($_POST['address']);
      $state = $conn->real_escape_string($_POST['state']);
      $city =$_POST['city'];
      $phone = $_POST['phone'];
      $altphone = $_POST['altphone'];
      $twitter = $_POST['twitter'];
      $facebook = $_POST['facebook'];
      $instagram = $_POST['instagram'];
      $image_name = $_FILES['profileImage'];


      $sql = $conn->query("UPDATE user_profile SET fullname = '$fullname',address ='$address',state = '$state',city = '$city',phone = '$phone',altphone = '$altphone',twitter = '$twitter',facebook = '$facebook',instagram = '$instagram',image = '$image_name' WHERE username = '$username'") or die($sql->error);

      // email = '$email'

      $_SESSION['fullname'] = $fullname;
      $_SESSION['phone'] = $phone;
      $_SESSION['altphone'] = $altphone;
      $_SESSION['address'] = $address;
      // $_SESSION['about'] = $about;
      $_SESSION['state'] = $state;
      $_SESSION['city'] = $city;
      $_SESSION['twitter'] = $twitter;
      $_SESSION['facebook'] = $facebook;
      $_SESSION['instagram'] = $instagram;
      $_SESSION['image'] = $image_name;


      return;
   
   }

   public function validation(){
      $fullname = $email = $about = $phone = $address = $state = $city = $altphone = $twitter = $facebook = $instagram = $linkedin = '';
   
   $fullname = $emailErr = $about = $phonenumberErr = $addressErr = $stateErr = $cityErr = '';

      //validate name
      if(empty($_POST['fullname'])){
         $fullnameErr = 'Fullname is required';
      }else{
         $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
  
      //validate email
      if(empty($_POST['email'])){
         $emailErr = 'Email is required';
      }else{
         $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      }
  
      //validate about
      if(empty($_POST['about'])){
         $aboutErr = 'about cannot be empty';
      }else{
         $about = filter_input(INPUT_POST, 'about', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
  
      //validate phonenumber
      if(empty($_POST['phone'])){
         $phonenumberErr = 'Phone Number is required';
      }else{
         $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
      }
  
      //validate address
      if(empty($_POST['address'])){
         $address = 'Address is required';
      }else{
         $address = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
  
      //validate state
      if(empty($_POST['state'])){
         $stateErr = 'State is required';
      }else{
         $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }
  
      //validate city
      if(empty($_POST['city'])){
         $cityErr = 'City is required';
      }else{
         $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      }

      if(empty($fullnameErr) && empty($emailErr) && empty($aboutErr) && empty($phonenumberErr) && empty($addressErr) && empty($stateErr) && empty($cityErr)){

         global $conn; 
         
          $sql = $conn->query("INSERT INTO user_profile (fullname,email,about,address,state,city,phone,altphone,twitter,facebook,instagram,linkedin) VALUES ('$fullname','$email','$about','$address','$state','$city','$phone','$altphone','$twitter','$facebook','$instagram','$linkedin')") or die($sql->error);
      }
  
      // //validate password
      // if(empty($_POST['password'])){
      //    $passwordErr = 'Password is required';
      // }elseif(strlen($_POST['password']) < 8){
      //   $passwordErr = 'Password is required';
      // }else{
      //    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      // }
   }

   public function formInject(){
   }




   function logout(){
      if(isset($_SESSION['id']) && isset($_POST['logout']))
      {
         session_destroy();
      }
   
      // unset($_SESSION['username']);
   
      header("Location: login.php");
   }

   // function uploadImage(){
   //    global $conn;
   //    $username = $_SESSION['username'];
   //    $imageErr = '';
   //    $invalidImage = '';
   //    $largeFile = '';
   //    $success = '';

   //    // if(empty($_SESSION['image'])){
   //    //    return 
   //    // }

   //    $allowed_ext = array('png','jpg','jpeg','gif');
   //    if(!empty($_FILES['upload']['name'])){
   //       $file_name = $_FILES['upload']['name'];
   //       $file_size = $_FILES['upload']['size'];
   //       $file_tmp = $_FILES['upload']['tmp_name'];
   //       $target_dir = "./upload/$file_name";

   //       //Get File ext
   //       $file_ext = explode('.',$file_name);
   //       $file_ext = strtolower(end($file_ext));
         

   //       //validate file ext
   //       if(in_array($file_ext, $allowed_ext)){
   //          if($file_size<= 1000000){
   //             if(move_uploaded_file($file_tmp, $target_dir)){
   //                $sql = $conn->query("UPDATE user_profile SET image='$file_name' WHERE username ='$username'");
   //                if($sql){
   //                   return $success;
   //                   $_SESSION['image'] = $image;
   //                }
   //             }
   //          }else{
   //             return $largeFile;
   //          }
   //       }else{
   //          return $invalidImage;
   //       }

   //    }else{
   //       return $imageErr;
   //    }
   // }
 }

 $project = new Project();
?> 