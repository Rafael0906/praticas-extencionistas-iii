<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header('Location: ../login.html');
    exit;
}
include '../db_connect.php';

$mensagem_enviada = false;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $mensagem = $conn->real_escape_string($_POST['mensagem']);
    
    $sql = "INSERT INTO ContatoMensagem (nome, email, mensagem) VALUES ('$nome', '$email', '$mensagem')";
    if($conn->query($sql)) {
        $mensagem_enviada = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contato - Fale Conosco</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <h1>📧 Fale com os Desenvolvedores</h1>
        <p>Envie sua mensagem, sugestão ou reporte problemas.</p>
        
        <?php if($mensagem_enviada): ?>
            <div class="success">✅ Mensagem enviada com sucesso! Obrigado pelo contato.</div>
        <?php endif; ?>
        
        <form method="POST">
            <label>Seu Nome</label>
            <input type="text" name="nome" required>
            
            <label>Seu E-mail</label>
            <input type="email" name="email" required>
            
            <label>Mensagem</label>
            <textarea name="mensagem" rows="5" required placeholder="Digite sua mensagem aqui..."></textarea>
            
            <button type="submit">Enviar Mensagem</button>
            <a href="../index.html" class="btn btn-secondary">← Voltar</a>
        </form>
        
        <hr style="margin: 30px 0;">
        <h3>Informações de Contato</h3>
        <p>📞 Telefone: (11) 99999-8888</p>
        <p>✉️ E-mail: suporte@gestaocomunitaria.org</p>
        <p>🏠 Endereço: Rua da Solidariedade, 123 - São Paulo, SP</p>
    </div>
</body>
</html