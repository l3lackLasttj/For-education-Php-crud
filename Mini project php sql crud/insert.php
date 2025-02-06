<?php 

session_start();
require_once "config/db.php";

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nickname = $_POST['nickname'];
    $birthdate = $_POST['birthdate'];

    $sql = "INSERT INTO students (first_name, last_name, nickname, birthdate) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$first_name, $last_name, $nickname, $birthdate]);

    if ($sql) {
        $_SESSION['success'] = "Data has been inserted successfully";
        header("location: index.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: index.php");
    }
}

?>
