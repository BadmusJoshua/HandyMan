<?php include 'inc/header/header.php';

if (isset($_POST['schedule'])) {
  $input_date = $_POST['date'];
  $month_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  $date_items = explode('-', $input_date);
  // $month = $month_array[($date_items[1] - 1)];
  $year = end($date_items);
  session_start();
  $_SESSION['id'] = $userId;

  $start_time = $_POST['s_time'];
  $finish_time = $_POST['f_time'];
  $meetingwith = $_POST['meeting_people'];
      if (isset($_POST["reminder"]) && !empty($_POST["reminder"])) {
        $reminderPermit = $_POST["reminder"];
        if ($reminderPermit == 'yes') {
          $reminder = $_POST['reminder_minutes'];
        }
        echo "You selected ".$reminder;
    }

  $sql = 'INSERT INTO meetings (date, start, end, personalities, owner_id, reminder) VALUES (?,?,?,?,?,?)';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$input_date, $start_time,  $finish_time, $meetingwith,  $userId, $reminder]);
}

if (isset($_POST['reschedule'])) {
  $id = $_POST['id'];
  $new_input_date = $_POST['new_date'];
  $new_start_time = $_POST['new_s_time'];
  $new_finish_time = $_POST['new_f_time'];
  $new_meeting_with = $_POST['new_meeting_people'];
  if (isset($_POST["reminder"]) && !empty($_POST["reminder"])) {
        $reminderPermit = $_POST["reminder"];
        if ($reminderPermit == 'yes') {
          $reminder = $_POST['reminder_minutes'];
        }
        echo "You selected ".$reminder;
    }

  $sql = "UPDATE meetings SET date = ?, start=?,end=?,personalities=?,reminder=? WHERE id =?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$new_input_date, $new_start_time, $new_finish_time, $new_meeting_with, $reminder, $id]);
}
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM meetings WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
}
$n = 1;

?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Schedule Meeting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="justify-content-center">
          <div class="row ">
            <div class="col">
              <label for="" class="form-label">Date:</label>
              <input type="date" name="date" id="">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="form-label">Start Time</label>
              <input type="time" name="s_time" id="">
            </div>
            <div class="col">
              <label for="" class="form-label">Finish Time</label>
              <input type="time" name="f_time" id="">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="form-label">Personalities : </label>&nbsp;
              <input type="text" name="meeting_people" id="">
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="" class="form-label">Set Reminder :</label>
              <input type="radio" name="reminder" value="yes" id="">Yes
              <input type="radio" name="reminder" value="no" id="">No
            </div>
            <div class="col">
              <label for="" class="form-label">Venue :</label><br>
              <input type="time" name="venue" id="" value="<?php echo $log->end ?>">
            </div>
            <div class="col">
              <label for="" class="form-label">When should you be reminded?</label>
              <select name="reminder_minutes" id="">
                <option value="10"> 10 minutes before meeting</option>
                <option value="30">30 minutes before meeting</option>
                <option value="45">45 minutes before meeting</option>
                <option value="60">60 minutes before meeting</option>
              </select>
            </div>
          </div>


          <button class="btn btn-success m-auto d-flex" name="schedule"> Schedule meeting</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
      <a class="nav-link " href="meetings.php">
        <i class="ri-building-4-line"></i>
        <span>Meetings</span>
      </a>
    </li><!-- End Meetings Page Nav -->

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
    </li><!-- End Sign Out Page Nav -->

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
    <h1>Meetings</h1>
    <nav class="d-flex justify-content-between ">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Meetings</li>
      </ol>
      <button type="button" class="btn btn-primary   " data-bs-toggle="modal" data-bs-target="#exampleModal" style="width:20%;">
        <i class="bi bi-calendar-plus"></i> New
      </button>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg">

        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Date</th>
              <th scope="col">Starts</th>
              <th scope="col">Ends</th>
              <th scope="col">Personalities</th>
              <th scope="col">actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = 'SELECT * FROM meetings WHERE owner_id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId]);
            $logs = $stmt->fetchAll();

            foreach ($logs as $log) :
            ?>

              <!-- Modal -->
              <div class="modal fade" id="staticBackdrop<?php echo $log->id ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Reschedule Meeting</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="justify-content-center">
                        <div class="row ">

                          <div class="col">
                            <label class="form-label">Date of meeting: </label>
                            <input type="date" name="new_date" id="" value="<?php echo $log->date; ?>">
                          </div>
                          <div class="col">
                            <label for="" class="form-label">Starts By :</label>
                            <input type="time" name="new_s_time" id="" value="<?php echo $log->start ?>">
                          </div>
                          <div class="col">
                            <label for="" class="form-label">Finish By :</label><br>
                            <input type="time" name="new_f_time" id="" value="<?php echo $log->end ?>">
                          </div>
                          <div class="col">
                            <label for="" class="form-label"> Meeting Personalities : </label>
                            <input type="text" name="new_meeting_people" id="" value="<?php echo $log->personalities ?>">
                            <input type="hidden" name="id" value="<?php echo $log->id ?>">
                          </div>
                          <div class="col">
                            <label for="" class="form-label">Venue :</label><br>
                            <input type="time" name="venue" id="" value="<?php echo $log->end ?>">
                          </div>
                        </div>
                        <div class="justify-content-center">
                          <button class="btn btn-success" name="reschedule" id="reschedule_meeting"> Reschedule Meeting</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <tr>
                <td>
                  <?= $n++ ?>
                </td>
                <td>
                  <?php
                  $fetched_date = $log->date;
                  $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                  $date_items = explode('-', $fetched_date);
                  $year = $date_items[0];
                  $month_index = ($date_items[1] - 1);
                  $day = $date_items[2];
                  echo " $day $month[$month_index], $year";
                  //Creating alarms for meetings
                  //$today = date("F j, Y, g:i,a")
                 // if (
                   // $today == $meetingDay
                  //) {
                    # code...
                 // }
                  ?>
                </td>
                <td>
                  <?php
                  // echo $log->start;
                  $fetched_time = $log->start;
                  $time_items = explode(':', $fetched_time);
                  $hour = $time_items[0];
                  $minute = $time_items[1];
                  $seconds = $time_items[2];
                  if ($hour > 12) {
                    $converted_hour = ($hour % 12);

                    if ($converted_hour < 12) {
                      $meridian = "pm";
                      echo "$converted_hour:$minute $meridian";
                    }
                  } else {
                    $meridian = "am";
                    echo "$hour:$minute $meridian";
                  }
                  ?>
                </td>
                <td>
                  <?php
                  $fetched_time = $log->end;
                  $time_items = explode(':', $fetched_time);
                  $hour = $time_items[0];
                  $minute = $time_items[1];
                  $seconds = $time_items[2];
                  if ($hour > 12) {
                    $converted_hour = ($hour % 12);

                    if ($converted_hour < 12) {
                      $meridian = "pm";
                      echo "$converted_hour:$minute $meridian";
                    }
                  } else {
                    $meridian = "am";
                    echo "$hour:$minute $meridian";
                  }
                  ?>
                </td>
                <td>
                  <?php echo $log->personalities; ?>
                </td>
                <td>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $log->id; ?>">
                    <i class="ri-edit-2-line"></i>
                  </button>
                  <a href="meetings.php?id=<?php echo $log->id; ?>" class="btn btn-danger"><i class="ri-delete-bin-2-line"></i></a>

                </td>
                <!-- <td>2016-05-25</td> -->

              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

      </div>


    </div>
  </section>

</main><!-- End #main -->

<?php include 'inc/footer/footer.php'; ?>