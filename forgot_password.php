<?php
include_once 'inc/config/database.php';
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

$account_not_found = $message_unsent = $message_sent = "";



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


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
        $user = $stmt->fetch();
        $username = $user->name;
        $userCount = $stmt->rowCount();
        if ($userCount > 0) {

            //Update the password_reset_token column in the database
            $stmt = $pdo->prepare("UPDATE technicians SET password_reset_token = :token, password_reset_expires_at = :expires_at WHERE email = :email AND phoneNumber = :phoneNumber");
            $stmt->execute(array(':token' => $token, ':expires_at' => $expires_at, ':email' => $email, ':phoneNumber' => $phoneNumber));

            //creating reset link
            $reset_link = "http://localhost/NiceAdmin/HandyMan/forgot_password.php?token=$token";


            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {

                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = '17a1d32f239ef6';
                $mail->Password = '4bad338b4ab5c1';

                //Recipients
                $mail->setFrom('handyman@info.com', 'HandyMan');
                $mail->addAddress($email, $username);     //Add a recipient
                $mail->addReplyTo('no-reply@info.com', 'handyman no-reply');


                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Testing';
                $mail->Body    = '<div style="width:80%;border:1px solid black; margin:auto;padding:10px;">Click on the following link to reset your password<br> <b> <a href="http://localhost/NiceAdmin/HandyMan/new_password.php?token=' . $token . '">Password Reset<a></b><br>This token expires at ' . $expires_at . '</div>';
                // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $message_sent = 1;
            } catch (Exception $e) {
                $message_unsent = 1;
            }
            $mail->smtpClose();
        } elseif ($userCount < 1) {

            //checking category of user
            $sql = "SELECT * FROM clients WHERE email = ? AND phoneNumber = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$email, $phoneNumber]);
            $userCount = $stmt->rowCount();
            if ($userCount > 0) {
                //Update the password_reset_token column in the database
                $stmt = $pdo->prepare("UPDATE clients SET password_reset_token = :token, password_reset_expires_at = :expires_at WHERE email = :email AND phoneNumber = :phoneNumber");
                $stmt->execute(array(':token' => $token, ':expires_at' => $expires_at, ':email' => $email, ':phoneNumber' => $phoneNumber));

                //creating reset link
                $reset_link = "http://localhost/NiceAdmin/HandyMan/new_password.php?token=$token"; //Replace example.com with your domain name

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {

                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth = true;
                    $mail->Port = 2525;
                    $mail->Username = '17a1d32f239ef6';
                    $mail->Password = '4bad338b4ab5c1';

                    //Recipients
                    $mail->setFrom('handyman@info.com', 'HandyMan');
                    $mail->addAddress('$email', '$username');     //Add a recipient
                    $mail->addReplyTo('no-reply@info.com', 'handyman no-reply');


                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Testing';
                    $mail->Body    = '<div style="width:80%;border:1px solid black; margin:auto;">Click on the following link to reset your password: \n\n <b> $reset_link</b>\n\nThis token expires at $expires_at</div>';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();
                    $message_sent = 1;
                    header("Location:login.php");
                } catch (Exception $e) {
                    $message_unsent = 1;
                }
                $mail->smtpClose();
            } else {
                $account_not_found = 1;
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - NiceAdmin Bootstrap Template</title>
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

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="login.php" class="logo d-flex align-items-center w-auto">
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
                                    <?php
                                    if ($message_unsent) {
                                        echo '< div class="col-12 alert alert-danger text-center alert-dismissible fade show" role="alert">
                                            Message could not be sent. Mailer Error: {$mail->ErrorInfo}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                    }
                                    if ($message_sent) {
                                        echo '< div class="col-12 alert alert-success text-center alert-dismissible fade show" role="alert">
                                            Check your E-mail, your reset link has been sent
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                    }
                                    if ($account_not_found) {
                                        echo '< div class="col-12 alert alert-danger text-center alert-dismissible fade show" role="alert">
                                            Account not found!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                    }
                                    ?>
                                    <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                        <div class="col-12">
                                            <label for="" class="form-label">Email</label>
                                            <input type="email" name="email" id="" class="form-control" required>
                                            <div class="invalid-feedback">Please enter your email!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="" class="form-label">Phone Number</label>
                                            <input type="tel" name="phoneNumber" id="" class="form-control" required>
                                            <div class="invalid-feedback">Please enter your phone number!</div>

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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>