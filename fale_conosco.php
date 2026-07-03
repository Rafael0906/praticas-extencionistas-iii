<?php
session_start();

// Proteção: verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) { 
    header('Location: login.html'); 
    exit; 
}

$mensagem_sucesso = "";

// Simula o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $texto = $_POST['mensagem'];
    
    // Mostra o aviso verde de sucesso na tela
    $mensagem_sucesso = "<div style='background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>✉️ Mensagem enviada com sucesso! Entraremos em contato em breve.</div>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Fale Conosco - Gestão Comunitária</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 20px; font-family: sans-serif;">
        <h2>📧 Fale Conosco</h2>
        <p style="margin-bottom: 20px; color: #555;">Tem alguma dúvida, sugestão ou feedback? Envie-nos uma mensagem!</p>
        
        <?php echo $mensagem_sucesso; ?>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Seu Nome</label>
                <input type="text" name="nome" required placeholder="Ex: Rafael Oliveira" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Seu E-mail</label>
                <input type="email" name="email" required placeholder="Ex: rafael@email.com" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Assunto</label>
                <input type="text" name="assunto" required placeholder="Ex: Suporte técnico, Dúvida sobre doações" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Mensagem</label>
                <textarea name="mensagem" required rows="5" placeholder="Digite aqui sua mensagem em detalhes..." style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; resize:vertical; font-family:sans-serif;"></textarea>
            </div>

            <div style="margin-top:10px; display:flex; gap:10px;">
                <button type="submit" class="btn" style="flex:1; padding:10px; background:#007bff; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Enviar Mensagem</button>
                <a href="index.php" class="btn btn-secondary" style="padding:10px; background:#6c757d; color:white; text-decoration:none; border-radius:4px; text-align:center; font-weight:bold;">Voltar ao Menu</a>
            </div>
        </form>
    </div>
</body>
</html>