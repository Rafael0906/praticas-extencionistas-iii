<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header('Location: ../login.html');
    exit;
}
include '../db_connect.php';

// Filtros de busca obtidos pela URL
$filtro_tipo = isset($_GET['tipo']) ? $conn->real_escape_string($_GET['tipo']) : '';
$filtro_data = isset($_GET['data']) ? $conn->real_escape_string($_GET['data']) : '';

// Consulta SQL direta e simplificada na tabela Doacao
$sql = "SELECT * FROM Doacao WHERE 1=1";

if($filtro_tipo) {
    $sql .= " AND tipo_item LIKE '%$filtro_tipo%'";
}
if($filtro_data) {
    $sql .= " AND data_doacao = '$filtro_data'";
}
$sql .= " ORDER BY data_doacao DESC";

$result = $conn->query($sql);

// Totais para a seção de relatórios
$totalValorQuery = $conn->query("SELECT SUM(valor) as total FROM Doacao");
$totalValor = $totalValorQuery ? $totalValorQuery->fetch_assoc()['total'] : 0;

$totalItensQuery = $conn->query("SELECT SUM(quantidade) as total FROM Doacao WHERE quantidade IS NOT NULL");
$totalItens = $totalItensQuery ? $totalItensQuery->fetch_assoc()['total'] : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta - Relatórios de Doações</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <h1>🔍 Consulta e Filtros de Doações</h1>
        
        <div class="report-cards" style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; flex: 1; font-family: sans-serif;">
                <strong>Total em Dinheiro:</strong> R$ <?php echo number_format($totalValor ?? 0, 2, ',', '.'); ?>
            </div>
            <div style="background: #e8f5e9; padding: 15px; border-radius: 5px; flex: 1; font-family: sans-serif;">
                <strong>Total de Itens:</strong> <?php echo $totalItens ?? 0; ?> unidades
            </div>
        </div>

        <form method="GET" action="" style="display: flex; gap: 10px; margin-bottom: 20px;">
            <input type="text" name="tipo" placeholder="Filtrar por tipo de item" value="<?php echo htmlspecialchars($filtro_tipo); ?>" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex: 1;">
            <input type="date" name="data" value="<?php echo htmlspecialchars($filtro_data); ?>" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <button type="submit" style="padding: 8px 15px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">🔍 Filtrar</button>
            <a href="consulta_doacoes.php" class="btn btn-secondary" style="padding: 8px 15px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; text-align: center; font-weight: bold;">Limpar</a>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo Item</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_doacao']; ?></td>
                        <td><?php echo htmlspecialchars($row['tipo_item'] ?? '-'); ?></td>
                        <td><?php echo $row['quantidade'] ?: '-'; ?></td>
                        <td><?php echo $row['valor'] ? 'R$ ' . number_format($row['valor'], 2, ',', '.') : '-'; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($row['data_doacao'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="text-align:center;">Nenhuma doação encontrada para os filtros aplicados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <br>
        <a href="../index.php" class="btn btn-secondary" style="padding: 10px 20px; background: #6c757d; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">← Voltar para o Menu</a>
    </div>
</body>
</html>