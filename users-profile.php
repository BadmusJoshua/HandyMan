<?php include 'inc/header.php';


$user = $passwordErr = $password_change = $userUpdate = $imageErr = '';
$profileImage = $detail->image;
if (isset($_POST['updateProfile'])) {
  $image = $_FILES['profileImage'];
  // print_r($_FILES['profileImage']);
  $imageName = $image['name'];
  $imageTemp = $image['tmp_name'];
  $imageDir = 'uploads/' . $imageName;
  $imageSplit = explode('.', $imageName);
  $imageExt = strtolower(end($imageSplit));
  $acceptedExt = array('jpeg', 'jpg', 'png');
  if (in_array($imageExt, $acceptedExt)) {
    move_uploaded_file($imageTemp, $imageDir);
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $altphone = filter_input(INPUT_POST, 'altphone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $twitter = filter_input(INPUT_POST, 'twitter', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $facebook = filter_input(INPUT_POST, 'facebook', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $instagram = filter_input(INPUT_POST, 'instagram', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $linkedin = filter_input(INPUT_POST, 'linkedin', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $sql = "select * FROM user_profile WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    $userCount = $stmt->rowCount();
    if ($userCount > 1) {
      $user = 1;
    } else {
      $sql = "UPDATE user_profile SET image = ?,state=?,city=?,address=?,phone=?,altphone=?,twitter=?,facebook=?,instagram=? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$imageName, $state, $city, $address, $phone, $altphone, $twitter, $facebook, $instagram, $userId]);
      $_SESSION['image']=$imageName;
      $image_name=$_SESSION['image'];
      $userUpdate = 1;
    }
  } else {
    $imageErr = "invalid file type";
  }
}
//Update Password
if (isset($_POST['changePassword'])) {
  $sql = "SELECT * FROM user_profile WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$userId]);
  $detail = $stmt->fetch();
  $current_hashed_password = $detail->password;
  $input_old_password = $_POST['password'];
  $input_new_password = $_POST['newpassword'];
  $confirm_password = $_POST['renewpassword'];
  $confirmPassword = password_verify($input_old_password, $current_hashed_password);
  if ($confirmPassword) {
    if ($confirm_password != $input_new_password) {
      $passwordErr = "your password does not match";
    } else {
      $hashed_password = password_hash($input_new_password, PASSWORD_DEFAULT);
      $sql = "UPDATE user_profile SET password = ? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$hashed_password, $userId]);
      $password_change = 1;
    }
  } else {
    $passwordErr = "incorrect password";
  }
}
// session_start();
// $userId = $_SESSION['username'];
// var_dump($_SESSION['email']);
?>

<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="user-dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link" href="users-profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="search.php">
        <i class="bi bi-search"></i>
        <span>Search</span>
      </a>
    </li><!-- End Meeting Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="transactions.php">
        <i class="bi bi-bag-check"></i>
        <span>Transactions</span>
      </a>
    </li><!-- End Jobs Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="faq.php">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="contact.php">
        <i class="bi bi-envelope"></i>
        <span>Help Desk</span>
      </a>
    </li><!-- End Contact Page Nav -->



    <li class="nav-item">
      <a class="nav-link collapsed" href="login.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Sign Out</span>
      </a>
    </li><!-- End Login Page Nav -->
  </ul>

</aside>

  <main id="main" class="main">

  <!-- <?= isset($imageErr) ? '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">No image uploaded!</div>' : '' ?>

  <?= isset($invalidImage) ? '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">Invalid image file format </div>' : '' ?>

  <?= isset($largeFile) ? '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">File size is too large</div>' : '' ?>

  <?= isset($success) ? '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">Image uploaded successfully</div>' : '' ?> -->

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user-dashboard.php">Home</a></li>
          <!-- <li class="breadcrumb-item">Users</li> -->
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <?php
        if ($password_change) {
          echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                              Password changed successfully
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              
                            </div>  ';
        }
        if ($userUpdate) {
          echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                              Your information has been updated
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
      ?>
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $_SESSION['image'] ?>" onerror="this.src='assets/img/default_profile_picture.png'" alt="Profile" class="rounded-circle">
              <h2><?php echo $_SESSION['fullname'];  ?></h2>
              <!-- <h3>Web Designer</h3> -->
              <div class="social-links mt-2">
                <a href="<?php echo $_SESSION['twitter'] ?? ''; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?php echo $_SESSION['facebook'] ?? ''; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?php echo $_SESSION['instagram'] ?? ''; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <!-- <a href="<?php echo $_SESSION['linkedin']; ?>" class="linkedin"><i class="bi bi-linkedin"></i></a> -->
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title"></h5>
                  <p class="small fst-italic"></p>

                  <h5 class="card-title">Profile Details</h5>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['fullname'] ;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Address</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['address'] ?? '' ;?></div>
                  </div>

                  

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['phone'] ;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alternate Phone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION['altphone'] ?? '' ;?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">
                      <?php 
                      echo $_SESSION['email'];
                     ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" class= "needs-validation"novalidate enctype="multipart/form-data">
                    <div class="row mb-3">
                    <!-- <?= isset($imageErr) ? '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">No image uploaded!</div>' : '' ?> -->
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                      <img src="uploads/<?php echo $_SESSION['image'] ?>" onerror="this.src='assets/img/default_profile_picture.png'" alt="Profile Photo" class="rounded-circle">
                        <div class="col-md-8 col-lg-9 ">
                        <input type="file" name="profileImage" class="mt-2 btn btn-sm btn-light">
                        </div>
                        <!-- <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" name="upload"><i class="bi bi-upload"></i></a>
                          <button class="btn btn-sm btn-primary" title="Upload New Profile Image" name="upload"><i class="bi bi-upload"></i></button>
                          <button class="btn btn-danger btn-sm" title="Remove my profile image" name="delete"><i class="bi bi-trash"></i></button>
                        </div> -->
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullname" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullname" type="text" class="form-control <?php echo $fullnameErr ? 'is-invalid' : null; ?>" id="fullname" value="<?= $_SESSION['fullname'] ?? '' ; ?>" required>
                      </div>
                      <div class="invalid-feedback">
                        <?php echo $fullnameErr ?>
                      </div>
                    </div>

                    

                    <div class="row mb-3">
                      <label for="State" class="col-md-4 col-lg-3 col-form-label">State</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state" type="text" class="form-control <?php echo $stateErr ? 'is-invalid' : null; ?>" id="State" value="<?= $_SESSION['state'] ?? '' ?>">
                      </div>
                      <div class="invalid-feedback">
                        <?php echo $stateErr ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="City" class="col-md-4 col-lg-3 col-form-label">City</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="city" type="text" class="form-control <?php echo $cityErr ? 'is-invalid' : null; ?>" id="City" value="<?= $_SESSION['city'] ?? '' ; ?>">
                      </div>
                      <div class="invalid-feedback">
                        <?php echo $cityErr ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control <?php echo $addressErr ? 'is-invalid' : null; ?>" id="Address" value="<?= $_SESSION['address'] ?? '' ; ?>">
                      </div>
                      <div class="invalid-feedback">
                        <?php echo $addressErr ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control <?php echo $phoneErr ? 'is-invalid' : null; ?>" id="Phone" value="<?= $_SESSION['phone'] ?? '' ; ?>">
                      </div><div class="invalid-feedback">
                        <?php echo $phoneErr ?>
                      </div>

                    </div>

                    <div class="row mb-3">
                      <label for="altphone" class="col-md-4 col-lg-3 col-form-label">Alternate Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="altphone" type="text" class="form-control" id="AltPhone" value="<?= $_SESSION['altphone'] ?? '' ; ?>">
                      </div>
                    </div>

                    

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="<?= $_SESSION['twitter'] ?? '' ; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="<?= $_SESSION['facebook'] ?? '' ; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="<?= $_SESSION['instagram'] ?? '' ; ?>">
                      </div>
                    </div>

                    

                    <div class="text-center">
                      <button type="submit" name="updateProfile" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                      <div class="error"><?php echo $passwordErr ?></div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'inc/footer.php'; ?>