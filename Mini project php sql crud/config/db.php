<?php
$host = "localhost"; 
$dbname = "school_db"; 
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully!!!"; 
} catch (PDOException $e) {
    die("Connection failed!!!: " . $e->getMessage());
}
?>
<?php

