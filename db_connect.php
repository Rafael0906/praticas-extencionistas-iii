<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'gestao_comunitaria';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Definir charset para UTF-8
$conn->set_charset("utf8");
?>