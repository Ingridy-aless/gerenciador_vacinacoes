<?php
    include '../conexao.php';

    $id_estado = $_POST['estadoId'];
    $sql_cidade = "SELECT id AS id_cidade, nome, uf, ibge FROM Cidades WHERE uf=$id_estado ORDER BY nome ASC";
    $result_cidade = $conexao->query($sql_cidade);

    while ($row = $result_cidade->fetch_assoc()) {
        $cidade_id = $row['id_cidade'];
        $cidade_nome = $row['nome'];

        echo "<option value='$cidade_id'>$cidade_nome</option>";
    }

    $conexao->close();
?>