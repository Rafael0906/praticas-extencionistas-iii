<?php
session_start();

// Proteção: impede o acesso se não estiver logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) { 
    header('Location: ../login.html'); 
    exit; 
}
include '../db_connect.php';

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_doacao = intval($_GET['id']);

    // Executa a exclusão na tabela com nome padrão
    $sql = "DELETE FROM Doacao WHERE id_doacao = $id_doacao";
    $executou = $conn->query($sql);

    // Se falhar por conta de maiúsculas/minúsculas, tenta com o nome em minúsculo
    if (!$executou) {
        $sql_minusculo = "DELETE FROM doacao WHERE id_doacao = $id_doacao";
        $conn->query($sql_minusculo);
    }
}

// Redireciona de volta para a listagem atualizada
header('Location: listar_doacoes.php');
exit;
?>