<?php
$host = "localhost";
$user = "root";
$password = "root";
$database = "atividade_pratica_i";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
?>