<?php
session_start();

// Proteção: verifica se a variável existe e se é verdadeira
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) { 
    header('Location: ../login.html'); 
    exit; 
}
include '../db_connect.php';

// Consulta robusta com LEFT JOIN para garantir que NENHUMA doação suma da tela
$sql = "SELECT d.*, v.nome AS voluntario_nome, a.titulo AS acao_titulo 
        FROM Doacao d
        LEFT JOIN Voluntario v ON d.id_voluntario = v.id_voluntario
        LEFT JOIN Acao a ON d.id_acao = a.id_acao
        ORDER BY d.data_doacao DESC";

$result = $conn->query($sql);

// Caso dê erro por conta de maiúsculas/minúsculas no servidor MySQL, tenta a versão em minúsculo
if (!$result) {
    $sql_minusculo = "SELECT d.*, v.nome AS voluntario_nome, a.titulo AS acao_titulo 
                      FROM doacao d
                      LEFT JOIN voluntario v ON d.id_voluntario = v.id_voluntario
                      LEFT JOIN acao a ON d.id_acao = a.id_acao
                      ORDER BY d.data_doacao DESC";
    $result = $conn->query($sql_minusculo);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Doações</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h2>📦 Gerenciamento de Doações</h2>
        
        <div style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="inserir_doacao.php" class="btn" style="padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">➕ Registrar Nova Doação</a>
            <a href="inserir_voluntario.php" class="btn" style="padding: 10px; background: #4CAF50; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">👤 Novo Voluntário</a>
            <a href="inserir_acao.php" class="btn" style="padding: 10px; background: #ff9800; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">🏳️ Nova Ação</a>
            <a href="../index.php" class="btn btn-secondary" style="padding: 10px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">🏠 Voltar ao Menu</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Voluntário</th>
                    <th>Ação Social</th>
                    <th>Tipo Item</th>
                    <th>Quantidade</th>
                    <th>Valor (R$)</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_doacao'] ?></td>
                        <td><?= htmlspecialchars($row['voluntario_nome'] ?? 'Não associado') ?></td>
                        <td><?= htmlspecialchars($row['acao_titulo'] ?? 'Não associada') ?></td>
                        <td><?= htmlspecialchars($row['tipo_item'] ?? '-') ?></td>
                        <td><?= $row['quantidade'] ?: '-' ?></td>
                        <td><?= $row['valor'] ? 'R$ ' . number_format($row['valor'], 2, ',', '.') : '-' ?></td>
                        <td><?= date('d/m/Y', strtotime($row['data_doacao'])) ?></td>
                        <td>
                            <a href="excluir_doacao.php?id=<?= $row['id_doacao'] ?>" class="btn" style="padding:5px 10px; background:#dc3545; color:white; text-decoration:none; border-radius:4px; font-size:14px; font-weight:bold;" onclick="return confirm('Tem certeza que deseja excluir esta doação?')">❌ Excluir</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="8" style="text-align:center;">Nenhuma doação cadastrada ainda.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>