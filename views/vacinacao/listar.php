<?php
    include '../../conexao.php';

    $limite = 10;
    $pagina = isset($_GET['pagina'])?(int)$_GET['pagina']:1;
    $inicio = ($pagina - 1) * $limite;
    
    $sql = "SELECT v.id, v.data_aplicacao, a.nome AS nome_animal, vc.nome AS nome_vacina 
            FROM Vacinacao as v
            LEFT JOIN Animais as a ON v.animal = a.id
            LEFT JOIN Vacinas as vc ON v.vacina = vc.id
            LIMIT $inicio, $limite";

    $result = $conexao->query($sql);
?>

<?php
    include '../../base/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/tabelas.css">
    <title> Gerenciador de Vacinações </title>
</head>
<body>
    <h2> Gerenciador de Vacinações </h2>
    <a href="adicionar.php" class="botao-enviar"> Adicionar Nova Vacinação </a>

    <table>
        <thead>
            <tr>
                <th> ID </th>
                <th> Nome do animal </th>
                <th> Vacina </th>
                <th> Data da aplicação </th>
                <th> Ações </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nome_animal"] . "</td>";
                        echo "<td>" . $row["nome_vacina"] . "</td>";
                        echo "<td>" . date('d/m/y', strtotime($row["data_aplicacao"])) . "</td>";
                        echo "<td><a href='editar.php?id=" . $row["id"] . "' class='botao-enviar'>Editar</a> <a href='deletar.php?id=" . $row["id"] . "' class='botao-deletar'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'> Sem vacinações cadastradas </td></tr>";
                }
            ?>
        </tbody>
        <div class="pagination">
            <?php  
                $total = "SELECT COUNT(id) AS total FROM Vacinacao";
                $result = $conexao->query($total);
                $row = $result->fetch_assoc();
                $paginas = ceil($row['total'] / $limite);

                for($i = 1; $i <= $paginas; $i++) {
                    if ($i == $pagina) {
                        echo "<strong>$i</strong> ";
                    } else {
                        echo "<a href='listar.php?pagina=$i'>$i</a> ";
                    }
                }
            ?>
        <div>
    </table>
</body>
</html>

<?php
    $conexao->close();
?>