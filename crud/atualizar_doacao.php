<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header('Location: ../login.html');
    exit;
}
include '../db_connect.php';

$id = $_POST['id_doacao'];
$id_voluntario = $_POST['id_voluntario'] ?: 'NULL';
$id_acao = $_POST['id_acao'] ?: 'NULL';
$valor = $_POST['valor'] ?: 'NULL';
$tipo_item = $_POST['tipo_item'] ? "'".$_POST['tipo_item']."'" : 'NULL';
$quantidade = $_POST['quantidade'] ?: 'NULL';
$data_doacao = $_POST['data_doacao'];

$sql = "UPDATE Doacao SET 
        id_voluntario = $id_voluntario,
        id_acao = $id_acao,
        valor = $valor,
        tipo_item = $tipo_item,
        quantidade = $quantidade,
        data_doacao = '$data_doacao'
        WHERE id_doacao = $id";

$conn->query($sql);
header('Location: listar_doacoes.php');
?>