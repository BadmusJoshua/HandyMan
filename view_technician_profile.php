<?php
include 'inc/header/header.php';
$review_submit = '';
if (isset($_SESSION['technician_id'])) {
    $technician_id = $_SESSION['technician_id'];
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$technician_id]);
    $technician_details = $stmt->fetch();
} else {
}
if (isset($_POST['comment'])) {
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rating = ($_POST['rating']);
    if (!empty($message) && (!empty($rating))) {
        $sql = "INSERT INTO reviews (message,rating,client_id,client_name,client_image,technician_id) VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$message, $rating, $userId, $name, $detail->image, $technician_id]);
        $review_submit = 1;
    }
}
//fetch sum of ratings
$sql = "SELECT sum(rating) AS TOTAL_RATING FROM reviews WHERE technician_id = $technician_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$totalRating = $stmt->fetch(PDO::FETCH_NUM);
$ratingSum = $totalRating[0];

//fetch count of ratings
$sql = "SELECT * FROM reviews WHERE technician_id = $technician_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$totalCount = $stmt->rowCount();
if ($totalCount == 0) {
    $rates = 0;
} else {
    $rates = ($ratingSum / $totalCount);
}
$sql = "UPDATE users SET rating = $rates WHERE id=$technician_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <?php
            if ($technician == 1) { ?>
                <a class="nav-link collapsed " href="technician_index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            <?php } else { ?>
                <a class="nav-link collapsed " href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            <?php }
            ?>
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
        </li><!-- End Meetings Page Nav -->




        <li class="nav-item">
            <a class="nav-link collapsed" href="contact.php">
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
            <a class="nav-link collapsed" href="logout.php">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Sign Out</span>
            </a>
        </li><!-- End Sign Out Page Nav -->



    </ul>

</aside><!-- End Sidebar-->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Technician Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Technician Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <?php
                if ($review_submit) { ?>
                    <div class="col-12 alert alert-success text-center alert-dismissible fade show" role="alert">
                        Your review has been submitted</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }
        ?>
        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="assets/<?= "images/$technician_details->image" ?>" onerror="this.src='assets/img/profile-img.jpg'" alt="Profile" class="" style="height:130px; width:180px;border-radius:50%;">
                <h2><?php echo $technician_details->name ?></h2>
                <h3><?php echo $technician_details->job ?></h3>
                <div class="social-links mt-2">
                    <a href="<?php echo $technician_details->twitter ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="<?php echo $technician_details->facebook ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="<?php echo $technician_details->instagram ?>" class="instagram"><i class="bi bi-instagram"></i></a>
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
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews">Reviews</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#leave_review">Leave Review</button>
                        </li>

                        <!-- <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li> -->

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">About</h5>
                            <p class="small fst-italic"><?php echo $technician_details->about ?></p>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->name ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Company</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->company ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Job</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->job ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Rating</div>
                                <div class="col-lg-9 col-md-8"><?php $technician_details->rating;
                                                                $rate = $technician_details->rating;
                                                                echo $rate;
                                                                if ($rate == 0) {
                                                                    echo ' No reviews yet';
                                                                } elseif ($rate == 1) {
                                                                    echo '
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate >= 1.5 && $rate  < 2) {
                                                                    echo
                                                                    '
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-half"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate == 2) {
                                                                    echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate >= 2.5 && $rate < 3) {
                                                                    echo
                                                                    '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate == 3) {
                                                                    echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate >= 3.5 && $rate < 4) {
                                                                    echo
                                                                    '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-half"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate == 4) {
                                                                    echo '  
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i> 
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                                } elseif ($rate >= 4.5 && $rate < 5) {
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
                                                                }
                                                                ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Country</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->country ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->address ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->phone ?></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8"><?php echo $technician_details->email ?></div>
                            </div>

                        </div>



                        <div class="tab-pane fade pt-3" id="reviews">

                            <?php
                            $sql = "SELECT * FROM reviews WHERE technician_id=? ORDER BY rating DESC";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$technician_id]);
                            $review_count = $stmt->rowCount();
                            if ($review_count == 0) { ?>
                                <div class="text-center m-auto">No Reviews yet!</div>
                            <?php } else {
                                $review = $stmt->fetchAll(); ?>
                                <div>
                                    <?php foreach ($review as $comment) : ?>
                                        <div class="row border p-2">
                                            <div class="col-2 justify-content-center ">
                                                <img src="assets/images/<?= $comment->client_image ?>" alt="" style="height:70px;width:70px;" onerror="this.src='assets/img/profile-img.jpg'" class="rounded-circle">
                                            </div>
                                            <div class="col-10 justify-content-between">
                                                <h5><?= $comment->client_name ?></h5>
                                                <small><?= $comment->created ?></small>
                                            </div>
                                            <div class="col-12"><?= $comment->message ?></div>
                                            <div class="col-12 text-center">
                                                <?php
                                                $rate = $comment->rating;

                                                if ($rate == 1) {
                                                    echo '
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                        <i class="bi bi-star"></i>
                                                    ';
                                                } elseif ($rate == 2) {
                                                    echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                } elseif ($rate == 3) {
                                                    echo '
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                } elseif ($rate == 4) {
                                                    echo '  
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i> 
                                                    <i class="bi bi-star"></i>
                                                    ';
                                                } else {
                                                    echo '  
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>';
                                                } ?>
                                            </div>

                                        </div>
                                    <?php endforeach ?>
                                </div>

                            <?php } ?>



                        </div>
                        <div class="tab-pane fade pt-3" id="leave_review">
                            <!-- Review Form -->
                            <?php
                            if ($detail->username == $technician_details->username) { ?>
                                <div class="text-center m-auto">You can't leave a review for yourself </div>

                            <?php } else { ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

                                    <div class="row mb-3 justify-content-center gap-2">
                                        <div class="col-12">
                                            <label for="" class="form-label">Comment: </label>
                                            <textarea name="message" id="" class="form-control" cols="30" rows="5" placeholder="You can leave comments and reviews on services"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="form-label">Rating: </label>
                                            <select name="rating" id="" class="form-control">
                                                <option value=""></option>
                                                <option value="1">Terrible 😠</option>
                                                <option value="2">Bad 😫</option>
                                                <option value="3">Fair 😐</option>
                                                <option value="4">Very Good 🙂</option>
                                                <option value="5">Excellent 😁</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" name="comment">Leave Comment</button>
                                    </div>
                                </form><!-- End review Form -->
                            <?php }

                            ?>

                        </div>
                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
        </div>
    </section>

</main><!-- End #main -->

<?php require 'inc/footer/footer.php'; ?>