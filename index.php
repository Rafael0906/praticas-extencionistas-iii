<?php
session_start();

// Proteção: verifica se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) { 
    header('Location: login.html'); 
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão Comunitária</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin: 50px auto; text-align: center;">
        <h2>🏠 Sistema de Gestão Comunitária</h2>
        <p>Bem-vindo, admin!</p>
        
        <div style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
            <!-- Linha alterada com base na imagem image_8ff580.png -->
            <a href="crud/listar_doacoes.php" class="btn" style="padding: 12px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; text-decoration: none; border-radius: 4px; font-weight: bold; display: block;">📦 Gerenciar Doações</a>
            
            <a href="relatorios.php" class="btn" style="padding: 12px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; text-decoration: none; border-radius: 4px; font-weight: bold; display: block;">🔍 Consultar Doações / Relatórios</a>
            
            <a href="fale_conosco.php" class="btn" style="padding: 12px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; text-decoration: none; border-radius: 4px; font-weight: bold; display: block;">📧 Fale Conosco</a>
            
            <a href="logout.php" class="btn" style="padding: 12px; background: #ff4757; color: white; text-decoration: none; border-radius: 4px; font-weight: bold; display: block;">🚪 Sair do Sistema</a>
        </div>
    </div>
</body>
</html>