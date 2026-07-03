<?php
session_start();

// 1. Proteção de Login
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) { 
    header('Location: ../login.html'); 
    exit; 
}
include '../db_connect.php';

$mensagem = "";

// 2. Procura Voluntários (Trata Maiúsculas/Minúsculas)
$voluntarios = $conn->query("SELECT id_voluntario, nome FROM Voluntario ORDER BY nome");
if (!$voluntarios) {
    $voluntarios = $conn->query("SELECT id_voluntario, nome FROM voluntario ORDER BY nome");
}

// 3. Procura Ações (Trata Maiúsculas/Minúsculas)
$acoes = $conn->query("SELECT id_acao, titulo FROM Acao ORDER BY titulo");
if (!$acoes) {
    $acoes = $conn->query("SELECT id_acao, titulo FROM acao ORDER BY titulo");
}

// 4. Processamento do Formulário (Submissão)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_voluntario = isset($_POST['id_voluntario']) ? intval($_POST['id_voluntario']) : 0;
    $id_acao = isset($_POST['id_acao']) ? intval($_POST['id_acao']) : 0;
    $tipo_item = $conn->real_escape_string($_POST['tipo_item']);
    $quantidade = !empty($_POST['quantidade']) ? intval($_POST['quantidade']) : 0;
    $valor = !empty($_POST['valor']) ? floatval(str_replace(',', '.', $_POST['valor'])) : 0.00;
    $data_doacao = $_POST['data_doacao'];

    if ($id_voluntario === 0 || $id_acao === 0) {
        $mensagem = "<div style='background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>❌ Erro: Selecione um voluntário e uma ação válida!</div>";
    } else {
        // Tenta inserir com Nome de Tabela em Maiúsculo
        $sql = "INSERT INTO Doacao (id_voluntario, id_acao, valor, tipo_item, quantidade, data_doacao) 
                VALUES ($id_voluntario, $id_acao, $valor, '$tipo_item', $quantidade, '$data_doacao')";
                
        if ($conn->query($sql)) {
            header('Location: listar_doacoes.php');
            exit;
        } else {
            // Tenta inserir com Nome de Tabela em Minúsculo
            $sql_minusculo = "INSERT INTO doacao (id_voluntario, id_acao, valor, tipo_item, quantidade, data_doacao) 
                              VALUES ($id_voluntario, $id_acao, $valor, '$tipo_item', $quantidade, '$data_doacao')";
            
            if ($conn->query($sql_minusculo)) {
                header('Location: listar_doacoes.php');
                exit;
            } else {
                $mensagem = "<div style='background:#f8d7da; color:#721c24; padding:15px; margin-bottom:20px; border-radius:5px; font-weight:bold;'>❌ Erro no Banco: " . $conn->error . "</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Doação</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container" style="max-width: 500px; margin: 50px auto; padding: 20px; font-family: sans-serif;">
        <h2>➕ Registrar Nova Doação</h2>
        
        <?php echo $mensagem; ?>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            
            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Selecione o Voluntário</label>
                <select name="id_voluntario" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    <option value="">-- Selecione um Voluntário --</option>
                    <?php if($voluntarios && $voluntarios->num_rows > 0): ?>
                        <?php while($v = $voluntarios->fetch_assoc()): ?>
                            <option value="<?= $v['id_voluntario'] ?>"><?= htmlspecialchars($v['nome']) ?></option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="" disabled>Nenhum voluntário encontrado no banco.</option>
                    <?php endif; ?>
                </select>
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Selecione a Ação Comunitária</label>
                <select name="id_acao" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
                    <option value="">-- Selecione uma Ação --</option>
                    <?php if($acoes && $acoes->num_rows > 0): ?>
                        <?php while($a = $acoes->fetch_assoc()): ?>
                            <option value="<?= $a['id_acao'] ?>"><?= htmlspecialchars($a['titulo']) ?></option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="" disabled>Nenhuma ação encontrada no banco.</option>
                    <?php endif; ?>
                </select>
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Tipo de Item</label>
                <input type="text" name="tipo_item" required placeholder="Ex: Cesta Básica, Cobertores" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Quantidade</label>
                <input type="number" name="quantidade" placeholder="Ex: 10" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Valor em R$</label>
                <input type="text" name="valor" placeholder="Ex: 150.00" style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div>
                <label style="display:block; margin-bottom:5px; font-weight:bold;">Data da Doação</label>
                <input type="date" name="data_doacao" value="<?=date('Y-m-d')?>" required style="width:100%; padding:8px; border:1px solid #ccc; border-radius:4px;">
            </div>

            <div style="margin-top:10px; display:flex; gap:10px;">
                <button type="submit" class="btn" style="flex:1; padding:10px; background:#007bff; color:white; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Salvar Doação</button>
                <a href="listar_doacoes.php" class="btn btn-secondary" style="padding:10px; background:#6c757d; color:white; text-decoration:none; border-radius:4px; text-align:center;">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>