<?php
include 'admin/config.php';
define('BASE_URL', 'http://localhost/Authentication_system_php/');
if (!isset($_REQUEST['token'])) {
    header('location: ' . BASE_URL);
}

$statement = $pdo->prepare("SELECT * FROM users WHERE token=?");
$statement->execute([$_REQUEST['token']]);
$total = $statement->rowCount();
if ($total) {
    $statement = $pdo->prepare("UPDATE users SET status=? WHERE token=?");
    $statement->execute([1, $_REQUEST['token']]);
    $total = $statement->rowCount();


    header('location: ' . BASE_URL . 'registration-success.php');
} else {
    header('location: ' . BASE_URL);
}
