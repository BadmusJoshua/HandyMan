<?php

include 'inc/header/header.php';
//fetching top rated technicians
$sql = "SELECT * FROM users WHERE is_technician = 1 ORDER BY rating DESC LIMIT 4 ";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$top_technicians = $stmt->fetchAll();


//getting sales count
$sql = "SELECT * FROM jobs WHERE seller_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$salesCount = $stmt->rowCount();

// getting percentage increase of sales
$prevSalesCount = $salesCount - 1;
if ($salesCount != 0) {
  $salesIncrease = (($salesCount - $prevSalesCount) / $salesCount) * 100;
} else {
  $salesIncrease = 0;
}
// echo ;
// echo ;

// getting total revenue
$sqli = "SELECT sum(price) FROM jobs WHERE seller_id =? AND completed =?";
$stmt = $pdo->prepare($sqli);
$stmt->execute([$userId, 4]);
$totalSales = $stmt->fetch(PDO::FETCH_NUM);
$balance = $totalSales[0];
//complete id
$num = 4;
//getting prev revenue sum
$sqlx = "SELECT sum(price) AS TOTAL_PRICE FROM jobs WHERE seller_id=? AND completed=? AND id != (SELECT MAX(id) FROM jobs WHERE seller_id=? AND completed=?)";
$stmt = $pdo->prepare($sqlx);
$stmt->bindParam(1, $userId, PDO::PARAM_INT);
$stmt->bindParam(2, $num, PDO::PARAM_INT);
$stmt->bindParam(3, $userId, PDO::PARAM_INT);
$stmt->bindParam(4, $num, PDO::PARAM_INT);
$stmt->execute();
$totalPrevRevenue = $stmt->fetch(PDO::FETCH_NUM);
$prevbalance = $totalPrevRevenue[0];
//getting percentage increase in revenue
if ($balance != 0) {
  $revenueIncrease = (($balance - $prevbalance) / $balance) * 100;
} else {
  $revenueIncrease = 0;
  $balance = 0;
}


//getting customer count
$sqly = "SELECT DISTINCT customer FROM jobs WHERE seller_id = ?";
$stmt = $pdo->prepare($sqly);
$stmt->execute([$userId]);
$totalCustomers = $stmt->rowCount();

//getting percentage increase of customers
$prevCustomers = $totalCustomers - 1;
if ($totalCustomers != 0) {
  $customerIncrease = (($totalCustomers - $prevCustomers) / $totalCustomers) * 100;
} else {
  $customerIncrease = 0;
}
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item d-block d-md-none">
      <button class="btn btn-primary"> <a href="become_a_technician.php" class="text-decoration-none text-light"> Become a Technician</a> </button>
    </li>

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
      <a class="nav-link collapsed" href="logout.php">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Sign Out</span>
      </a>
    </li><!-- End suggestionin Page Nav -->
  </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <div class="col">
        <h5>Top Suggestions</h5>
        <div class="row d-flex justify-content-evenly">
          <?php foreach ($top_technicians as $suggestion) { ?>
            <div class="col-3">
              <div class="card">
                <div class="row g-0">
                  <div class=" col-md-4">
                    <img src="assets/images/<?php echo $suggestion->image; ?>" class="img-fluid rounded-start h-100" onerror="this.src='assets/img/profile-img.jpg'">
                  </div>
                  <div class="col-md-8 ">
                    <div class="card-body px-0 text-center">
                      <h5 class=" my-1 " style="font-size:15px;"><?php echo $suggestion->name; ?></h5>
                      <h6><span style="color: #012970;margin-bottom:0;margin-top:-20px;font-weight:bolder;font-size:12px;"></span> <?php echo $suggestion->job; ?></h6>
                      <!-- <h6 style="line-height:1.3rem;"><span style="color: #012970;font-weight:bolder;">Address:</span> <?php # echo $suggestion->address; 
                                                                                                                            ?></h6> -->
                      <h6><span style="color: #012970;font-weight:bolder;margin-bottom:0;font-size:15px;"></span> <?php
                                                                                                                  $rate = $suggestion->rating;

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
                      <a href="view_profile.php?username=<?php echo $suggestion->username; ?>">View Profile</a>
                    </div>
                  </div>
                </div>
              </div><!-- End Card with an image on left -->
            </div>
          <?php } ?>

        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-7">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo iste velit molestiae eligendi esse eos mollitia adipisci quisquam ea nihil, voluptate reprehenderit, sapiente ex suscipit ipsum itaque incidunt! Fugiat alias doloribus aliquid nam dicta dignissimos inventore ea sint non libero rem veniam eum tenetur rerum, nesciunt ratione vero aliquam veritatis.
      </div>
      <div class="col-5 technician_testimonial text-center border mt-200px " style=" margin:auto;border-radius:5px; overflow:hidden">

        <div id="carouselExampleAutoplaying" class="row carousel slide p-0 m-0 " data-bs-ride="carousel" style="width:100%;margin:auto;border-radius:5px;">
          <div class="carousel-inner p-0 m-0" style="width:100%;">
            <div class="carousel-item active bg-primary " style="width:100%;">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe amet suscipit enim
                ipsam
                laudantium sequi odio vero non voluptate consequatur.</p>
              <div class="avatar_details" style="display:flex;width:80%;margin:auto;">
                <img src="" alt="avatar_image">
                <div class="avatar_info align-text-center" style="width:85%;">
                  <h6 class="mb-0">John Doe</h6>
                  <smal>mechanic</small>
                </div>
              </div>
            </div>
            <div class="carousel-item bg-secondary">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe amet suscipit enim
                ipsam
                laudantium sequi odio vero non voluptate consequatur.</p>
              <div class="avatar_details" style="display:flex;width:80%;margin:auto;">
                <img src="" alt="avatar_image">
                <div class="avatar_info align-text-center" style="width:85%;">
                  <h6 class="mb-0">Kyle Peter</h6>
                  <smal>electrician</small>
                </div>
              </div>
            </div>
            <div class="carousel-item bg-warning">
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe amet suscipit enim
                ipsam
                laudantium sequi odio vero non voluptate consequatur.</p>
              <div class="avatar_details" style="display:flex;width:80%;margin:auto;">
                <img src="" alt="avatar_image">
                <div class="avatar_info align-text-center" style="width:85%;">
                  <h6 class="mb-0">Samuel Jason</h6>
                  <smal>carpenter</small>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>


      </div>
    </div>





    </div>
  </section>

</main><!-- End #main -->



<?php include 'inc/footer/footer.php'; ?>