<?php
    include '../../conexao.php';
    
    $limite = 10;
    $pagina = isset($_GET['pagina'])?(int)$_GET['pagina']:1;
    $inicio = ($pagina - 1) * $limite;

    $sql = "SELECT cl.id, cl.nome AS nome_cliente, cl.cpf, cl.telefone, cl.rua, cl.numero, c.nome AS cidade, e.uf AS estado, cl.cep
            FROM Clientes AS cl
            LEFT JOIN Cidades AS c ON cl.cidade = c.id
            LEFT JOIN Estados AS e ON cl.estado = e.id
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
    <title> Gerenciador de Clientes </title>
</head>
<body>
    <h2> Gerenciador de Clientes </h2>
    <a href="adicionar.php" class="botao-enviar"> Adicionar Novo Cliente </a> 
    
    <table>
        <thead>
            <tr>
                <th> ID </th>
                <th> Nome </th>
                <th> CPF </th>
                <th> Telefone </th>
                <th> Endereço </th>
                <th> Número </th>
                <th> Estado </th>
                <th> Cidade </th>
                <th> CEP </th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nome_cliente"] . "</td>";
                        echo "<td>" . $row["cpf"] . "</td>";
                        echo "<td>" . $row["telefone"] . "</td>";
                        echo "<td>" . $row["rua"] . "</td>";
                        echo "<td>" . $row["numero"] . "</td>";
                        echo "<td>" . $row["estado"] . "</td>";
                        echo "<td>" . $row["cidade"] . "</td>";
                        echo "<td>" . $row["cep"] . "</td>";
                        echo "<td><a href='editar.php?id=" . $row["id"] . "' class='botao-enviar'>Editar</a> <a href='deletar.php?id=" . $row["id"] . "' class='botao-deletar'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'> Sem clientes cadastrados </td></tr>";
                }
            ?>
        </tbody>
        <div class="pagination">
            <?php  
                $total = "SELECT COUNT(id) AS total FROM Clientes";
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