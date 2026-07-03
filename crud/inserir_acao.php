<?php
session_start();
if (!isset($_SESSION['logado'])) { 
    header('Location: ../login.html'); 
    exit; 
}
include '../db_connect.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $conn->real_escape_string($_POST['titulo']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $status = $conn->real_escape_string($_POST['status']);

    // Insere apenas as colunas garantidas no banco de dados
    $sql = "INSERT INTO Acao (titulo, descricao, status) VALUES ('$titulo', '$descricao', '$status')";
    
    if ($conn->query($sql)) {
        $mensagem = "<div style='background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>✅ Ação Comunitária cadastrada com sucesso!</div>";
    } else {
        $mensagem = "<div style='background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>❌ Erro ao cadastrar no banco: " . $conn->error . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ação</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 20px; font-family: sans-serif;">
        <h2>🏳️ Cadastrar Nova Ação Comunitária</h2>
        
        <?php echo $mensagem; ?>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Título da Ação</label>
                <input type="text" name="titulo" required placeholder="Ex: Campanha de Agasalho" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Descrição</label>
                <textarea name="descricao" rows="3" placeholder="Breve descrição da ação..." style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px; font-family:sans-serif;"></textarea>
            </div>
            
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Status</label>
                <select name="status" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    <option value="planejada">Planejada</option>
                    <option value="andamento" selected>Em Andamento</option>
                    <option value="concluida">Concluída</option>
                </select>
            </div>
            
            <div style="margin-top:10px; display:flex; gap:10px;">
                <button type="submit" class="btn" style="flex:1; padding:10px; background:#ff9800; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Salvar Ação</button>
                <a href="listar_doacoes.php" class="btn btn-secondary" style="padding:10px; background:#6c757d; color:white; text-decoration:none; border-radius:4px; text-align:center;">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>