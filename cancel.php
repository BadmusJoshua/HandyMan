<?= include 'inc/config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $num = 2;
    $sql = "UPDATE jobs SET completed=? where id=? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$num, $id]);
    header("Location: jobs.php");
} else {
    header("Location: login.php");
}
?>