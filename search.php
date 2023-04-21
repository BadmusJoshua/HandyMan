<?php
include 'inc/header/header.php';
$no_result = '';

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

</aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Search</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Search</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard" style="position:relative;">
        <div class="row">
            <?php
if ($no_result) {
                echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                          No Result Found! 
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          
                        </div>  ';
}

            if (isset($_POST['search'])) {
                $query = filter_input(INPUT_POST, 'query', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if (!empty($query)) {
                    $sql = "SELECT * FROM technicians WHERE name LIKE '%$query%' or job LIKE '%$query%' or address LIKE '%$query%' or email LIKE '%$query%' or phoneNumber LIKE '%$query%' or company LIKE '%$query%'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $technician_query_count = $stmt->rowCount();

                    if ($technician_query_count > 0) { ?>
                        <div class="col-md-6">
                            <?php foreach ($result as $log) { ?>
                                <div class="col-12">
                                    <!-- Card with an image on left -->
                                    <div class="card">
                                        <div class="row g-0">
                                            <div class=" col-md-4">
                                                <img src="assets/images/<?php echo $log->image; ?>" class="img-fluid rounded-start" onerror="this.src='assets/img/profile-img.jpg'">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class=" my-1">Technician <?php echo $log->name; ?></h5>
                                                    <h6><span style="color: #012970;margin-bottom:0;margin-top:-20px;font-weight:bolder;">Occupation:</span> <?php echo $log->job; ?></h6>
                                                    <h6 style="line-height:1.3rem;"><span style="color: #012970;font-weight:bolder;">Address:</span> <?php echo $log->address; ?></h6>
                                                    <h6><span style="color: #012970;font-weight:bolder;margin-bottom:0;">Rating:</span> <?php
                                                                                                                                        $rate = $log->rating;
                                                                                                                                        echo $rate;
                                                                                                                                        if ($rate == 0) {
                                                                                                                                            echo 'No reviews yet';
                                                                                                                                        } elseif ($rate == 1) {
                                                                                                                                            echo '
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate >= 1.5 && $rate  < 2
                                                                                                                                        ) {
                                                                                                                                            echo
                                                                                                                                            '
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate == 2
                                                                                                                                        ) {
                                                                                                                                            echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate >= 2.5 && $rate < 3
                                                                                                                                        ) {
                                                                                                                                            echo
                                                                                                                                            '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate == 3
                                                                                                                                        ) {
                                                                                                                                            echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate >= 3.5 && $rate < 4
                                                                                                                                        ) {
                                                                                                                                            echo
                                                                                                                                            '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate == 4
                                                                                                                                        ) {
                                                                                                                                            echo '  
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i> 
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                                                                                        } elseif (
                                                                                                                                            $rate >= 4.5 && $rate < 5
                                                                                                                                        ) {
                                                                                                                                            echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                    ';
                                                                                                                                        } else {
                                                                                                                                            echo '  
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>';
                                                                                                                                        } ?></h6>
                                                    <a href="view_profile.php?username=<?php echo $log->username; ?>">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Card with an image on left -->
                                </div>
                            <?php } ?>
                        </div>
                    <?php }

                    $sql = "SELECT * FROM clients WHERE name LIKE '%$query%' or address LIKE '%$query%' or phoneNumber LIKE '%$query%'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    $client_query_count = $stmt->rowCount();

                    if ($client_query_count > 0) { ?>
                        <div class="col-md-6">
                            <?php foreach ($result as $c_log) { ?>
                                <div class="col-12">
                                    <!-- Card with an image on left -->
                                    <div class="card">
                                        <div class="row g-0">
                                            <div class=" col-md-4">
                                                <img src="assets/images/<?php echo $c_log->image; ?>" class="img-fluid rounded-start" onerror="this.src='assets/img/profile-img.jpg'">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class=" my-1"> <?php echo $c_log->name; ?></h5>
                                                    <h6 style="line-height:1.3rem;"><span style="color: #012970;font-weight:bolder;">Country:</span> <?php echo $c_log->country; ?></h6>
                                                    <h6 style="line-height:1.3rem;"><span style="color: #012970;font-weight:bolder;">Address:</span> <?php echo $c_log->address; ?></h6>
                                                    <a href="view_profile.php?username=<?php echo $c_log->username; ?>">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Card with an image on left -->
                                </div>
                            <?php } ?>
                        </div>
            <?php }

                    if ($technician_query_count == 0 && $client_query_count == 0) {
                        $no_result = 1;
                    }
                }
            }
            ?>

        </div>
    </section>
</main>
<div style="position:absolute;bottom:1vh;width:100%;margin:auto;">
    <?php include 'inc/footer/footer.php' ?>

</div>