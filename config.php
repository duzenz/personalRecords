<?php

$hostname = "localhost";
$username = "root";
$password = "root";
$database = "myProject";
global $conn;
try {
    $conn = new PDO("mysql:host={$hostname};dbname={$database}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query('SET NAMES "utf8"');
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
require_once 'util.php';
