<?php
include_once'inc/config/database.php';
if (isset($_POST['send_reset'])) {
    //sanitizing input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!empty($email && $phoneNumber)) {

        $token = bin2hex(random_bytes(32)); //Generate a random token
        $expires_at = date('Y-m-d H:i:s', strtotime('+15 minutes')); //Set the expiration time to 15 minutes from now

        //checking category of user
        $sql = "SELECT * FROM technicians WHERE email = ? AND phoneNumber = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $phoneNumber]);
        $userCount = $stmt->rowCount();
        if ($userCount > 0) {

            //Update the password_reset_token column in the database
            $stmt = $pdo->prepare("UPDATE technicians SET password_reset_token = :token, password_reset_expires_at = :expires_at WHERE email = :email AND phoneNumber = :phoneNumber");
            $stmt->execute(array(':token' => $token, ':expires_at' => $expires_at, ':email' => $email, ':phoneNumber' => $phoneNumber));

            //creating reset link
            $reset_link = "http://localhost/NICEADMIN/NiceAdmin/forgot_password.php?token=$token"; //Replace example.com with your domain name

            //creating reset message
            $message = "Click on the following link to reset your password: \n\n $reset_link \n\nThis token expires at $expires_at";
            //sending mail
            mail($email, "Password Reset", $message);
        } elseif ($userCount < 1) {

            //checking category of user
            $sql = "SELECT * FROM technicians WHERE email = ? AND phoneNumber = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $phoneNumber]);
            $userCount = $stmt->rowCount();
            if ($userCount > 0) {
                //Update the password_reset_token column in the database
                $stmt = $pdo->prepare("UPDATE clients SET password_reset_token = :token, password_reset_expires_at = :expires_at WHERE email = :email AND phoneNumber = :phoneNumber");
                $stmt->execute(array(':token' => $token, ':expires_at' => $expires_at, ':email' => $email, ':phoneNumber' => $phoneNumber));

                //creating reset link
                $reset_link = "http://localhost/NICEADMIN/NiceAdmin/forgot_password.php?token=$token"; //Replace example.com with your domain name

                //creating reset message
                $message = "Click on the following link to reset your password: \n\n $reset_link \n\nThis token expires at $expires_at";
                //sending mail
                mail($email, "Password Reset", $message);
            } else {
                echo "Account not found";
            }
        }
    } else {
        echo "You need to provide your email and phone Number so we can confirm it/s you";
    }
}


if (isset($_GET['token'])) {
    //Check if token is valid
    $stmt = $pdo->prepare("SELECT * FROM users WHERE password_reset_token = :token AND password_reset_expires_at > NOW()");
    $stmt->execute(array(':token' => $_GET['token']));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        //Display password reset form
        echo "<form method='post'>
                <input type='password' name='new_password' required>
                <button type='submit'>Reset Password</button>
              </form>";

        //Update user's password in the database
        if (isset($_POST['new_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = :new_password, password_reset_token = NULL,  password_reset_expires_at = NULL WHERE id = :id");
            $stmt->execute(array(':new_password' => $new_password, ':id' => $user['id']));
            echo "Password reset successfully!";
        }
    } else {
        echo "Invalid token!";
    }
} else {
    echo "Token not provided!";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <title>Password Recover</title>
</head>

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class=" d-lg-block">Handyman</span>
                                </a>
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Help us verify it's you</h5>
                                        <p class="text-center small">Enter your email and phone number to get reset link</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                        <div class="col-12">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" name="email" id="" class="form-control">
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="form-label">Phone Number</label>
                                            <input type="tel" name="phoneNumber" id="" class="form-control">
                                        </div>
                                        <button class="btn btn-primary" name="send_reset">Reset Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>