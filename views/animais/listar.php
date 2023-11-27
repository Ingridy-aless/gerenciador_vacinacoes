<?php
    include '../../conexao.php';

    $limite = 10;
    $pagina = isset($_GET['pagina'])?(int)$_GET['pagina']:1;
    $inicio = ($pagina - 1) * $limite;

    $sql = "SELECT a.id, a.nome AS animal, a.especie, a.idade, a.raca, a.sexo, c.nome AS cliente
            FROM Animais AS a 
            LEFT JOIN Clientes AS c ON a.cliente = c.id
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
    <title> Gerenciador de Animais </title>
</head>
<body>
    <h2> Gerenciador de Animais </h2>
    <a href="adicionar.php" class="botao-enviar"> Adicionar Novo Animal </a>

    <table>
        <thead>
            <tr>
                <th> ID </th>
                <th> Nome </th>
                <th> Espécie </th>
                <th> Idade </th>
                <th> Raça </th>
                <th> Sexo </th>
                <th> Dono </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["animal"] . "</td>";
                        echo "<td>" . $row["especie"] . "</td>";
                        echo "<td>" . $row["idade"] . "</td>";
                        echo "<td>" . $row["raca"] . "</td>";
                        echo "<td>" . $row["sexo"] . "</td>";
                        echo "<td>" . $row["cliente"] . "</td>";
                        echo "<td><a href='editar.php?id=" . $row["id"] . "' class='botao-enviar'>Editar</a> <a href='deletar.php?id=" . $row["id"] . "' class='botao-deletar'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'> Sem animais cadastrados </td></tr>";
                }
            ?>
        </tbody>
        <div class="pagination">
            <?php  
                $total = "SELECT COUNT(id) AS total FROM Animais";
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