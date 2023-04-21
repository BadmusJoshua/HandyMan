<?php require './inc/header/header.php';
$sent = '';



if (isset($_POST['submit'])) {
  $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $sql = "INSERT into feedbacks (name,user_id, email, subject, message) VALUES (?, ?, ?, ?,?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$name, $userId, $email, $subject, $message]);
  $sent = 1;
}
?>



<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="profile.php">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="meetings.php">
        <i class="ri-building-4-line"></i>
        <span>Meetings</span>
      </a>
    </li><!-- End Meeting Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="jobs.php">
        <i class="bi bi-briefcase-fill"></i>
        <span>Jobs</span>
      </a>
    </li><!-- End Jobs Page Nav -->

    <li class="nav-item">
      <a class="nav-link " href="contact.php">
        <i class="bi bi-envelope"></i>
        <span>Help Desk</span>
      </a>
    </li><!-- End Help Desk Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="faq.php">
        <i class="bi bi-question-circle"></i>
        <span>F.A.Q</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->


    <li class="nav-item">
      <a class="nav-link collapsed" href="login.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Sign Out</span>
      </a>
    </li><!-- End Sign Out Page Nav -->

  </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Help Desk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Help Desk</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section contact">

    <div class="row gy-4">

      <div class="col-xl-6">

        <div class="row">
          <?php
          if ($sent) {
            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                          Message has been sent.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
          }
          ?>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>A108 Adam Street,<br>New York, NY 535022</p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-envelope"></i>
              <h3>Email Us</h3>
              <p>info@handyman.com<br>handyman@gmail.com</p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="info-box card">
              <i class="bi bi-clock"></i>
              <h3>Open Hours</h3>
              <p>Monday - Friday<br>9:00AM - 05:00PM</p>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-6">
        <div class="card p-4">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="<?= $detail->name ?>" required>
              </div>

              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" value="<?= $detail->email ?>" required>
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
              </div>
                <button type="submit" class="btn btn-primary" name="submit">Send Message</button>
              </div>

            </div>
          </form>
        </div>

      </div>

    </div>

  </section>

</main><!-- End #main -->
<?php require 'inc/footer/footer.php'; ?>