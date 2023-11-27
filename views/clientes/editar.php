<?php
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nome_cliente = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['cep'];
    
        $sql = "UPDATE Clientes SET nome='$nome_cliente', cpf='$cpf', telefone='$telefone', rua='$rua', numero='$numero', cidade='$cidade', estado='$estado', cep='$cep' WHERE id=$id";

        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro ao atualizar: " . $conexao->error;
        }
    } else {
        $id = $_GET['id'];
        $sql = "SELECT cl.id, cl.nome, cl.cpf, cl.telefone, cl.rua, cl.numero, cl.cidade AS id_cidade, cl.estado AS id_estado, cl.cep, c.nome AS nome_cidade, e.uf AS nome_estado
                FROM Clientes AS cl
                LEFT JOIN Cidades AS c ON cl.cidade = c.id
                LEFT JOIN Estados AS e ON cl.estado = e.id
                WHERE cl.id=$id";

        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
        } else {
            echo "Cliente não encontrado!";
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/jquery.mask.min.js"></script>
    <script src="../../js/mascaras.js"></script>
    <script src="../../js/select.dinamico.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/formulario.css">
    <title> Formulário de Clientes </title>
</head>
<body>
    <div class="container">
        <section class="cabecalho">
            <h2> Edição de Clientes </h2>
        </section>
        
        <form method="post" action="editar.php" id="form" class="form">
            <div>
                <input type="hidden" name="id" value="<?php echo $cliente['id'];?>">
            </div>
            <div class="form-content">
                <label for="nome"> Nome completo: </label>
                <input type="text" name="nome" value="<?php echo $cliente['nome'];?>" required>
            </div>
            <div class="form-content">
                <label for="cpf"> CPF: </label>
                <input type="text" name="cpf" id="cpf" value="<?php echo $cliente['cpf'];?>" required>
            </div>
            <div class="form-content">
                <label for="telefone"> Telefone: </label>
                <input type="text" name="telefone" id="telefone" value="<?php echo $cliente['telefone'];?>" required>
            </div>
            <div class="form-content">
                <label for="rua"> Endereço: </label>
                <input type="text" name="rua" value="<?php echo $cliente['rua'];?>" required>
            </div>
            <div class="form-content">
                <label for="numero"> Número: </label>
                <input type="number" name="numero" value="<?php echo $cliente['numero'];?>" required>
            </div>
            <div class="form-content">
                <label for="estado"> Estado: </label>
                <select name="estado" id="estado" required>
                    <option value="<?php echo $cliente['id_estado'];?>"><?php echo $cliente['nome_estado'];?></option>
                    <?php
                        $sql_estado = "SELECT id, uf FROM Estados ORDER BY nome ASC";
                        $result_estado = $conexao->query($sql_estado);

                        while ($row = $result_estado->fetch_assoc()) {
                            $estado_id = $row['id'];
                            $estado_uf = $row['uf'];

                            if ($estado_id <> $cliente['id_estado']) {
                                echo "<option value='$estado_id'>$estado_uf</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="cidade"> Cidade: </label>
                <select name="cidade" id="cidade" required>
                    <option value="<?php echo $cliente['id_cidade'];?>"><?php echo $cliente['nome_cidade'];?></option>
                    <option value=""> Selecione o estado primeiro </option>
                </select>
            </div>
            <div class="form-content">
                <label for="cep"> CEP: </label>
                <input type="text" name="cep" id="cep" value="<?php echo $cliente['cep'];?>" required>
            </div>
            <div class="form-content">
                <button type="submit" value="salvar"> Salvar </button>
            </div>
            <div class="form-content">
                <a href="listar.php"> Voltar </a>
            </div>
        </form>
    </div>    
</body>
</html>

<?php
    $conexao->close();
?>