<?php
include 'inc/config/database.php';
$user = $username = $noCategory= "";

if (isset($_POST['submit'])) {

  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
  $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $phoneNumber = filter_input(INPUT_POST,'phoneNumber',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $unhashed_password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $hashed_password = password_hash($unhashed_password, PASSWORD_DEFAULT);

  if ($_POST['sign_as'] == 'Technician') {

    $sql = "select * FROM technicians WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $userCount = $stmt->rowCount();
    if ($userCount > 0) {
      $user = 1;
    } else {
      $sql = "select * FROM technicians WHERE username = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$username]);
      $usernameCheck = $stmt->rowCount();
      if ($usernameCheck > 0) {
        $username = 1;
      } else {
        $sql = "insert into technicians (name, email, username, phoneNumber, password) values (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $username, $phoneNumber, (string) $hashed_password]);

        $sql = "SELECT * FROM technicians WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $detail = $stmt->fetch();
        $userId = $detail->id;
        session_start();
        $_SESSION['id'] = $userId;
        header("Location:index.php");

      }
    }
  } elseif ($_POST['sign_as'] == 'Technician') {
    $sql = "select * FROM clients WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $userCount = $stmt->rowCount();
    if ($userCount > 0) {
      $user = 1;
    } else {
      $sql = "select * FROM clients WHERE username = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$username]);
      $usernameCheck = $stmt->rowCount();
      if ($usernameCheck > 0) {
        $username = 1;
      } else {
        $sql = "insert into clients (name, email, username, phoneNumber, password) values (?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $email, $username, $phoneNumber, (string) $hashed_password]);

        $sql = "SELECT * FROM clients WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usename]);
        $detail = $stmt->fetch();
        $userId = $detail->id;
        session_start();
        $_SESSION['id'] = $userId;
        header("Location:user-dashboard.php");
      }
    }
  }else{
    $noCategory=1;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
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
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Handyman</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" novalidate>
                    <?php
                    if ($noCategory) {
                      echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                          You have to specify the category you want to sign up as
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if ($user) {
                      echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                          Account already exists!
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if ($username) {
                      echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                          This username has already been used
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }

                    ?>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Sign up as :</label>
                      <select name="sign_as" id="" class="form-control">
                        <option value=""></option>
                        <option value="Client" class="form-control">Client</option>
                        <option value="Technician" class="form-control">Technician</option>
                      </select>
                      <div class="invalid-feedback">What kind of account do you want to create?</div>
                    </div>

                    <div class="col-12">
                      <label for="yourName" class="form-label">Your Name</label>
                      <input type="text" name="name" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPhoneNumber" class="form-label">Phone Number</label>
                      <div class="input-group has-validation">
                        <input type="tel" name="phoneNumber" class="form-control" id="yourphoneNumber" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="submit" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </form>
                  <!--  -->
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

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