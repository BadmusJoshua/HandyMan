<?php include 'inc/config/database.php';
// if (isset($_SESSION['id'])) {
session_start();
$userId = $_SESSION['id'];
// }

$sql = "SELECT * FROM notifications WHERE is_read=0 && user_id = $userId";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
$result_count = $stmt->rowCount();
if ($result_count == 0) { ?>
    <li class="dropdown-header justify-content-between d-flex" id="notification_header">You have no new notification </li>
    <?php } elseif ($result_count > 0) {
    if ($result_count == 1) { ?>
        <li class="dropdown-header justify-content-between d-flex align-items-center" id="notification_header">
            <h6>You have 1 new notification</h6>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <button class="bg-primary" name="mark_all">Read All</button>
            </form>
        </li>
    <?php } else { ?>
        <li class="dropdown-header d-flex m-auto justify-content-center align-items-center gap-2" id="notification_header">
            <h6>You have <?= $result_count ?> new notifications</h6>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="m-auto d-flex">
                <button class="border-0 bg-primary" style="border-radius:5em;color:white;font-size:12px;" name="mark_all">Read All</button>
            </form>
        </li>

    <?php }
    foreach ($result as $notification) { ?>
        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="notification-item" id="$notification->id">
            <!-- <i class="bi bi-exclamation-circle text-warning"></i> -->
            <div>
                <p class="text-dark text-center"><strong><?= $notification->message ?></strong></p>
                <p class="text-center"><?= $notification->created_at ?></p>
            </div>
        </li>

    <?php   }  ?>
    <li>
        <hr class="dropdown-divider">
    </li>
    <li class="dropdown-footer">
        <a href="#">Show all notifications</a>
    </li>
<?php } ?>