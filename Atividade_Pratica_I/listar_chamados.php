<?php
include 'db.php';

if (isset($_POST['atualizar_status'])) {
    $chamado_id = $_POST['chamado_id'];
    $novo_status = $_POST['status'];

    $update_query = "UPDATE Chamado SET status = ? WHERE chamado_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $novo_status, $chamado_id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['excluir_chamado'])) {
    $chamado_id = $_POST['chamado_id'];

    $delete_query = "DELETE FROM Chamado WHERE chamado_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $chamado_id);
    $stmt->execute();
    $stmt->close();
}

$query = "SELECT Chamado.*, Cliente.nome AS cliente_nome, Colaborador.nome AS colaborador_nome 
          FROM Chamado
          LEFT JOIN Cliente ON Chamado.cliente_id = Cliente.cliente_id
          LEFT JOIN Colaborador ON Chamado.colaborador_id = Colaborador.colaborador_id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Chamados</title>
</head>
<body>

<h1>Lista de Chamados</h1>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Descrição</th>
            <th>Criticidade</th>
            <th>Status</th>
            <th>Colaborador Responsável</th>
            <th>Atualizar</th>
            <th>Excluir</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['chamado_id'] ?></td>
                <td><?= $row['cliente_nome'] ?></td>
                <td><?= $row['descricao_problema'] ?></td>
                <td><?= $row['criticidade'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['colaborador_nome'] ?></td>
                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="chamado_id" value="<?= $row['chamado_id'] ?>">
                        <select name="status">
                            <option value="aberto" <?= $row['status'] == 'aberto' ? 'selected' : '' ?>>Aberto</option>
                            <option value="em andamento" <?= $row['status'] == 'em andamento' ? 'selected' : '' ?>>Em Andamento</option>
                            <option value="resolvido" <?= $row['status'] == 'resolvido' ? 'selected' : '' ?>>Resolvido</option>
                        </select>
                        <button type="submit" name="atualizar_status">Atualizar</button>
                    </form>
                </td>
                <td>
                    <form action="" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este chamado?');">
                        <input type="hidden" name="chamado_id" value="<?= $row['chamado_id'] ?>">
                        <button type="submit" name="excluir_chamado" style="color: red;">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>
