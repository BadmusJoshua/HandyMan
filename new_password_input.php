<?php
require 'inc/config/database.php';
$invalid_token = $token_not_found = $passwordErr = $password_reset = $password_unmatch = '';
session_start();

if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];
    echo $token;
    if (isset($_POST['update_password'])) {

        echo "clicked";
        $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (strlen($new_password) > 8) {
        } else {
            $passwordErr = 1;
        }
        if (($new_password == $confirm_password)) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        } else {
            $password_unmatch = 1;
        }
        $sql = "SELECT * FROM technicians WHERE password_reset_token = ? AND password_reset_expires_at > NOW()";
        $stmt = $pdo->prepare("$sql");
        $stmt->execute([$token]);
        $technicians = $stmt->fetch();
        echo $technicians->name;
        //
        $is_technician = $stmt->rowCount();
        echo $is_technician;

        if ($is_technician > 0) {
            echo "technician";

            echo $new_password;

            $stmt = $pdo->prepare("UPDATE technicians SET password = ?, password_reset_token = NULL, password_reset_expires_at = NULL WHERE id = ?");
            $stmt->execute([$new_password, $technicians->id]);
            $password_reset = 1;
            echo "technician";
            header("Location:login.php");
            exit;
        } else {

            $sql = "SELECT * FROM clients WHERE password_reset_token = ? AND password_reset_expires_at > NOW()";
            $stmt = $pdo->prepare("sql");
            $stmt->execute([$token]);
            $clients = $stmt->fetch();
            $is_client = $stmt->rowCount();

            if ($is_client > 0) {
                $sql = "UPDATE clients SET password = ?, password_reset_token = NULL, password_reset_expires_at = NULL WHERE id = ?";
                $stmt = $pdo->prepare("$sql");
                $stmt->execute([$new_password, $clients->id]);
                $password_reset = 1;
                echo "client";
                header("Location:login.php");
            } else {
                $sql = "SELECT * FROM admins WHERE password_reset_token = ? AND password_reset_expires_at > NOW()";
                $stmt = $pdo->prepare("$sql");
                $stmt->execute([$token]);
                $admins = $stmt->fetch();
                $is_admin = $stmt->rowCount();
                if ($is_admins > 0) {

                    $stmt = $pdo->prepare("UPDATE admins SET password = :new_password, password_reset_token = NULL, password_reset_expires_at = NULL WHERE id = :id");
                    $stmt->execute(array(':new_password' => $new_password, ':id' => $technicians['id']));
                    echo $technicians['id'];
                    $password_reset = 1;
                    echo "admin";
                    header("Location: login.php");
                } else {
                    $invalid_token = 1;
                }
            }
        }
    }
} else {
    $token_not_found = 1;
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>New Password</title>
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
                                        <h5 class="card-title text-center pb-0 fs-4">Secure Your Account</h5>
                                        <p class="text-center small">Enter new password to complete password reset</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" novalidate>
                                        <?php
                                        if ($invalid_token) {
                                            echo '<div class="col-12 alert alert-danger text-center alert-dismissible fade show" role="alert">
                                            Sorry, your reset token has expired.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                        }
                                        if ($token_not_found) {
                                            echo "<div class=' alert alert-danger text-center alert-dismissible fade show' role='alert'>
                                            You can't reset your password without a token
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                        }
                                        if ($password_reset) {
                                            echo '<div class="col-12 alert alert-success text-center alert-dismissible fade show" role="alert">
                                            Your password has been reset successfully!
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                        }
                                        if ($password_unmatch) {
                                            echo '<div class="col-12 alert alert-danger text-center alert-dismissible fade show" role="alert">
                                            Your password does not match
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                        }
                                        if ($passwordErr) {
                                            echo '<div class="col-12 alert alert-danger text-center alert-dismissible fade show" role="alert">
                                            Your password must have a minimum of 8 characters
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
                                        }
                                        ?>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="new_password" class="form-control" id="yourPassword" placeholder="Enter new password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                            <?php
                                            ?>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Confirm Password</label>
                                            <input type="password" name="confirm_password" placeholder="Confirm your password" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">Please confirm your password!</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" name="update_password">Update Password</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

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