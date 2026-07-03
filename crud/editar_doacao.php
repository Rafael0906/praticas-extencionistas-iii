<?php
session_start();
if(!isset($_SESSION['logado'])) {
    header('Location: ../login.html');
    exit;
}
include '../db_connect.php';

$id = $_GET['id'];
$doacao = $conn->query("SELECT * FROM Doacao WHERE id_doacao = $id")->fetch_assoc();
$voluntarios = $conn->query("SELECT id_voluntario, nome FROM Voluntario");
$acoes = $conn->query("SELECT id_acao, titulo FROM Acao");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Doação</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <h1>✏️ Editar Doação #<?php echo $id; ?></h1>
        
        <form action="atualizar_doacao.php" method="POST">
            <input type="hidden" name="id_doacao" value="<?php echo $id; ?>">
            
            <label>Voluntário</label>
            <select name="id_voluntario">
                <option value="">-- Selecione --</option>
                <?php while($v = $voluntarios->fetch_assoc()): ?>
                    <option value="<?php echo $v['id_voluntario']; ?>" 
                        <?php echo ($doacao['id_voluntario'] == $v['id_voluntario']) ? 'selected' : ''; ?>>
                        <?php echo $v['nome']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            
            <label>Ação</label>
            <select name="id_acao">
                <option value="">-- Selecione --</option>
                <?php while($a = $acoes->fetch_assoc()): ?>
                    <option value="<?php echo $a['id_acao']; ?>"
                        <?php echo ($doacao['id_acao'] == $a['id_acao']) ? 'selected' : ''; ?>>
                        <?php echo $a['titulo']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
            
            <label>Valor</label>
            <input type="number" step="0.01" name="valor" value="<?php echo $doacao['valor']; ?>">
            
            <label>Tipo de Item</label>
            <input type="text" name="tipo_item" value="<?php echo $doacao['tipo_item']; ?>">
            
            <label>Quantidade</label>
            <input type="number" name="quantidade" value="<?php echo $doacao['quantidade']; ?>">
            
            <label>Data da Doação</label>
            <input type="date" name="data_doacao" value="<?php echo $doacao['data_doacao']; ?>" required>
            
            <button type="submit">Atualizar</button>
            <a href="listar_doacoes.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>