<?php
session_start();
include 'db_connect.php';

if (isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $senha = md5($_POST['senha']);

    // Busca na tabela correta com a coluna id_usuario e senha
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $dados = $result->fetch_assoc();
        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['logado'] = true;
        header('Location: index.php');
        exit;
    }
}

// Se a senha estiver errada, volta para o login com aviso de erro
header('Location: login.html?erro=1');
exit;