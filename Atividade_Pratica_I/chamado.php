<?php
include 'db.php';

// Recebe os clientes e colaboradores para preencher os selects
$clientes_query = "SELECT * FROM Cliente";
$clientes_result = $conn->query($clientes_query);

$colaboradores_query = "SELECT * FROM Colaborador";
$colaboradores_result = $conn->query($colaboradores_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente_id = $_POST['cliente_id'];
    $descricao_problema = $_POST['descricao_problema'];
    $criticidade = $_POST['criticidade'];
    $status = $_POST['status'];
    $colaborador_id = $_POST['colaborador_id'];

    $sql = "INSERT INTO Chamado (cliente_id, descricao_problema, criticidade, status, colaborador_id) 
            VALUES ('$cliente_id', '$descricao_problema', '$criticidade', '$status', '$colaborador_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Chamado registrado com sucesso!";
    } else {
        echo "Erro ao registrar chamado: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Chamado</title>
</head>
<body>

<h1>Cadastro de Chamado</h1>
<form method="POST" action="chamado.php">
    <label for="cliente_id">Cliente:</label>
    <select name="cliente_id" id="cliente_id" required>
        <?php while ($row = $clientes_result->fetch_assoc()) { ?>
            <option value="<?= $row['cliente_id'] ?>"><?= $row['nome'] ?></option>
        <?php } ?>
    </select><br><br>

    <label for="descricao_problema">Descrição do Problema:</label>
    <textarea name="descricao_problema" id="descricao_problema" required></textarea><br><br>

    <label for="criticidade">Criticidade:</label>
    <select name="criticidade" id="criticidade" required>
        <option value="baixa">Baixa</option>
        <option value="média">Média</option>
        <option value="alta">Alta</option>
    </select><br><br>

    <label for="status">Status:</label>
    <select name="status" id="status" required>
        <option value="Aberto">Aberto</option>
        <option value="Em andamento">Em andamento</option>
        <option value="Resolvido">Resolvido</option>
    </select><br><br>

    <label for="colaborador_id">Colaborador Responsável:</label>
    <select name="colaborador_id" id="colaborador_id" required>
        <?php while ($row = $colaboradores_result->fetch_assoc()) { ?>
            <option value="<?= $row['colaborador_id'] ?>"><?= $row['nome'] ?></option>
        <?php } ?>
    </select><br><br>

    <button type="submit">Registrar Chamado</button>
</form>

</body>
</html>