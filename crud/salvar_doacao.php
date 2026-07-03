<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header('Location: ../login.html');
    exit;
}
include '../db_connect.php';

$id_voluntario = $_POST['id_voluntario'] ?: 'NULL';
$id_acao = $_POST['id_acao'] ?: 'NULL';
$valor = $_POST['valor'] ?: 'NULL';
$tipo_item = $_POST['tipo_item'] ? "'".$_POST['tipo_item']."'" : 'NULL';
$quantidade = $_POST['quantidade'] ?: 'NULL';
$data_doacao = $_POST['data_doacao'];

$sql = "INSERT INTO Doacao (id_voluntario, id_acao, valor, tipo_item, quantidade, data_doacao) 
        VALUES ($id_voluntario, $id_acao, $valor, $tipo_item, $quantidade, '$data_doacao')";

if($conn->query($sql)) {
    header('Location: listar_doacoes.php?msg=sucesso');
} else {
    echo "Erro: " . $conn->error;
}
?>