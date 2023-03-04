<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "point_system";
 
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
 ?>