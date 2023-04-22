<?php include 'inc/config/database.php';
include_once 'reminder.php';

$userId = $_SESSION['id'];
$sql = "SELECT * FROM technicians WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$detail = $stmt->fetch();
$job = $detail->job;
$name = ucwords($detail->name);
$name_array = explode(' ', $name);
$last_name = end($name_array);
$first_name = $name_array[0];
$initial = substr($first_name, 0, 1);
$official_name = "$initial . $last_name";

$sql = "SELECT * FROM notifications WHERE is_read=0 && user_id=$userId";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$content = $stmt->fetchAll();
$notification_count = $stmt->rowCount();


if (isset($_POST['view_all'])) {
    $sql = "UPDATE notifications SET is_read=1 WHERE user_id = $userId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
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
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <!-- /**********
              * HEADER *
              **********/ -->
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center" style="visibility:none;">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center ">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">Handyman</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar justify-content-center">
            <form class="search-form d-flex align-items-center" method="POST" action="search.php">
                <input type="text" name="query" placeholder="Enter Search Keyword">
                <button name="search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <!-- /***********
              * NAV BAR *
              ***********/ -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon  -->

                <li class="nav-item dropdown">

                    <a class="nav-link  get_noti nav-icon" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number" Id="notification_count"></span>
                    </a><!-- End Notification Icon -->


                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications overflow-auto" id="notificationContainer" style="max-height:60vh;">



                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->


                <!-- /*********************
              * POST NOTIFICATION *
              *********************/ -->
                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a><!-- End Messages Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header">
                            You have 3 new messages
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Maria Hudson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Anna Nelson</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>David Muldon</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="dropdown-footer">
                            <a href="#">Show all messages</a>
                        </li>

                    </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->
                <!-- /*********************
          * POST NOTIFICATION *
          *********************/ -->


                <!-- /******************
                * AVATAR DETAILS *
                ******************/ -->
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/images/<?php echo $detail->image ?>" onerror="this.src='assets/img/profile-img.jpg'" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $official_name; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $name ?></h6>
                            <span><?php echo $job ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

                <!-- /******************
                * AVATAR DETAILS *
                ******************/ -->

            </ul>
        </nav><!-- End Icons Navigation -->

        <!-- /***********
              * NAV BAR *
              ***********/ -->

    </header><!-- End Header -->


    <!-- /**********
              * HEADER *
              **********/ -->
    <script type="text/javascript">
        //load notification counter 
        function loadCount() {
            setTimeout(function() {

                fetch('notification_count.php').then(res => {
                    console.log(res);
                    if (res.ok) {
                        return res.json();
                    } else {
                        throw (new Error);
                    }
                }).then(data => {
                    console.log(data);
                    document.getElementById("notification_count").innerHTML = data.count;
                }).catch(e => {
                    console.log(e);
                })

                // var xhttp = new XMLHttpRequest();
                // xhttp.onreadystatechange = function() {
                //     if (this.readyState == 4 && this.status == 200) {
                //         document.getElementById("notification_count").innerHTML = this.responseText;
                //     }
                // };
                // xhttp.open("GET", "notification_count.php", true);
                // xhttp.send();
            }, 1000);
        }
        loadCount();

        async function fetchNotifications() {
            const response = await fetch('notification_fetch.php');
            return response.json();
        }
        var notification_count = document.getElementById("#notification_count").innerHTML;
        document.getElementsByClassName('get_noti')[0].onclick = (ev) => {
            ev.preventDefault();
            console.log("eve")
            fetchNotifications().then(data => {
                console.log(data);
                const container = $('#notificationContainer');

                let notifications = ``;
                data.data.forEach(item => {
                    notifications += `
                      <li class="dropdown-header justify-content-between d-flex">
You have new notifications
                            <!-- Button to mark all notifications as read -->
                            <form method="post" style="border:none;">
                                <button class="badge rounded-pill bg-primary p-2 ms-2 border-0" name="view_all">View all</button>
                            </form>

                            <!-- <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a> -->
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item" id="${item.id}">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Message Prompt</h4>
                                <p>${item.message}</p>
                                
//                                    // assuming time1 and time2 are valid time strings in HH:MM:SS format
// const time1 = '${item.created_at}';
// const time2 = '18:45:30';

// // convert time strings to Date objects
// const d1 = new Date('2000-01-01T' + time1 + 'Z');
// const d2 = new Date('2000-01-01T' + time2 + 'Z');

// // calculate time difference in milliseconds
// const diffInMs = Math.abs(d2 - d1);

// // convert time difference from milliseconds to hours, minutes and seconds
// const diffInHrs = Math.floor(diffInMs / 3600000); // 1 Hour = 60 Minutes * 60 Seconds * 1000 Milliseconds
// const diffInMins = Math.floor((diffInMs % 3600000) / 60000); // 1 Minute = 60 Seconds * 1000 Milliseconds
// const diffInSecs = Math.floor(((diffInMs % 3600000) % 60000) / 1000);
// var difference = "diffInHrs hours , diffInMins mins, diffInSecs secs ago";
// document.getElementById("#time_difference").innerHTML= difference;
//                               <p id="time_difference">  </p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Show all notifications</a>
                        </li>

                    `
                })

                container.html(notifications);
            })
        }
    </script>