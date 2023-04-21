<?php

include 'inc/header/header.php';
if (isset($_POST['new'])) {
    $customer = filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $service = filter_input(INPUT_POST, 'service', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $period = ucfirst(filter_input(INPUT_POST, 'period', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($number > 1) {
        $duration = "$number $period s";
    } else {
        $duration = "$number $period";
    }

    $sql = "INSERT INTO jobs (customer, price,service,duration,seller_id) VALUES(?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$customer, $price, $service, $duration, $userId]);
}

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Job</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="justify-content-center">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="" class="form-label">Customer:</label>
                            <input type="text" name="customer" id="" class="form-control">
                        </div>
                        <div class="col">
                            <label for="" class="form-label">Price:</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text" id="inputGroupPrepend">$</span>
                                <input type="number" name="price" id="" class="form-control" min="1" oninput="validity.valid||(value='');">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col">
                            <label for="" class="form-label">Service: </label>
                            <textarea name="service" id="" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="" class="form-label">Duration </label>&nbsp;
                        <div class="col">
                            <label for="" class="form-label">Number: </label>
                            <input type="number" name="number" class="form-control" id="" min="1" oninput="validity.valid||(value='');">
                        </div>
                        <div class=" col">
                            <label for="" class="form-label">Period</label>
                            <select name="period" id="" class="form-control">
                                <option value=""></option>
                                <option value="day">Day(s)</option>
                                <option value="week">Week(s)</option>
                                <option value="month">Month(s)</option>
                                <option value="year">Year(s)</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success m-auto d-flex" name="new"> Add to Jobs</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link collapsed " href="index.php">
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
        </li><!-- End Blank Page Nav -->

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
        </li><!-- End Help Desk Page Nav -->

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
        <h1>Jobs</h1>
        <nav class="d-flex justify-content-between">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Jobs</li>
            </ol>
            <button type="button" class="btn btn-primary   " data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:20%;">
                <i class="bi bi-clipboard-plus"></i> New
            </button>
        </nav>

    </div><!-- End Page Title -->
    <div class="card-body">
        <h5 class="card-title">Recent Sales <span>| Today</span></h5>
        <table class="table table-borderless datatable">
            <thead>
                <tr>
                    <th scope="col">Job Id</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Service</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><a href="#">#2457</a></th>
                    <td>Brandon Jacob</td>
                    <td><a href="#" class="text-primary">At praesentium minu</a></td>
                    <td>$64</td>
                    <td><span class="badge bg-success">Approved</span></td>
                </tr>
                <?php
                $sql = "SELECT * FROM jobs WHERE seller_id=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$userId]);
                $logs = $stmt->fetchAll();
                foreach ($logs as $log) :


                ?>

                    <tr>
                        <th scope="row" class="text-primary"><?= "#$log->id" ?></th>
                        <td><?= $log->customer ?></td>
                        <td><?= $log->service ?></td>
                        <td><?= "$$log->price" ?></td>
                        <td><?= $log->duration ?></td>
                        <td><?php
                            $status = $log->completed;
                            if ($status == 0) {
                                echo "<p class='text-primary '>in progress</p>";
                            } elseif ($status == 1) {
                                echo "<p class='text-warning'>pending</p>";
                            } elseif ($status == 2) {
                                echo "<p class='text-danger'>cancelled</p>";
                            } else {
                                echo "<p class='text-success'>completed</p>";
                            }
                            ?>

                        </td>
                        <td>

                            <a href="progress.php?id=<?= $log->id ?>" class="btn btn-primary"><i class="ri-play-line"></i></a>
                            <a href="pending.php?id=<?= $log->id ?>" class="btn btn-warning"> <i class="ri-indeterminate-circle-line"></i> </a>
                            <a href="cancel.php?id=<?= $log->id ?>" class="btn btn-danger"> <i class="ri-close-line"></i></a>
                            <a href="complete.php?id=<?= $log->id ?>" class="btn btn-success"><i class="ri-check-double-line"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    <?= include 'inc/footer/footer.php'; ?>