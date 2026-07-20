<?php 
$servername = "127.0.0.1";
$username = "root";
$password = "12345678";
$dbname = "usuarios_db";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


?>