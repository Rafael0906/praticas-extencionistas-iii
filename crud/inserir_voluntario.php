<?php
session_start();
// Proteção: impede o acesso se não tiver feito login antes
if (!isset($_SESSION['logado'])) { 
    header('Location: ../login.html'); 
    exit; 
}

// Caminho de conexão padrão.
$caminho_conexao = '../db_connect.php';

if (!file_exists($caminho_conexao)) {
    die("<div style='color:red; font-family:sans-serif; padding:20px;'>
            <h3>❌ Erro de Configuração</h3>
            O ficheiro de conexão <strong>db_connect.php</strong> não foi encontrado na raiz do projeto.<br>
            Verifique se o nome do ficheiro na pasta principal está exatamente como <code>db_connect.php</code>.
         </div>");
}

include $caminho_conexao;

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);

    // Removida a coluna data_cadastro para evitar o erro de coluna inexistente no banco atual
    $sql = "INSERT INTO Voluntario (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";
    
    if ($conn->query($sql)) {
        $mensagem = "<div style='background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>✅ Voluntário cadastrado com sucesso!</div>";
    } else {
        $mensagem = "<div style='background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>❌ Erro ao cadastrar no banco: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Voluntário</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 20px; font-family: sans-serif;">
        <h2>👤 Cadastrar Novo Voluntário</h2>
        
        <?php echo $mensagem; ?>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Nome do Voluntário</label>
                <input type="text" name="nome" required placeholder="Ex: João Silva" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">E-mail</label>
                <input type="email" name="email" required placeholder="Ex: joao@email.com" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Telefone</label>
                <input type="text" name="telefone" placeholder="Ex: (11) 99999-1111" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div style="margin-top:10px; display:flex; gap:10px;">
                <button type="submit" class="btn" style="flex:1; padding:10px; background:#4CAF50; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Salvar Voluntário</button>
                <a href="listar_doacoes.php" class="btn btn-secondary" style="padding:10px; background:#6c757d; color:white; text-decoration:none; border-radius:4px; text-align:center;">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>