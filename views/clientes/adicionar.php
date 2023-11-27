<?php
    include '../../conexao.php';
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
            <h2> Cadastro de Clientes </h2>
        </section>
        
        <form method="post" action="adicionar.php" id="form" class="form">
            <div class="form-content">
                <label for="nome"> Nome completo: </label>
                <input type="text" name="nome" placeholder="Digite o nome do cliente" required>
            </div>
            <div class="form-content">
                <label for="cpf"> CPF: </label>
                <input type="text" name="cpf" id="cpf" placeholder="Digite o CPF do cliente" required>
            </div>
            <div class="form-content">
                <label for="telefone"> Telefone: </label>
                <input type="text" name="telefone" id="telefone" placeholder="Digite o telefone do cliente" required>
            </div>
            <div class="form-content">
                <label for="rua"> Endereço: </label>
                <input type="text" name="rua" placeholder="Digite o endereço do cliente" required>
            </div>
            <div class="form-content">
                <label for="numero"> Número: </label>
                <input type="number" name="numero" placeholder="Digite o número da residência" required>
            </div>
            <div class="form-content">
                <label for="estado"> Estado: </label>
                <select name="estado" id="estado" required>
                    <option value=""> Selecione o estado </option>
                    <?php
                        $sql_estado = "SELECT id, uf FROM Estados ORDER BY nome ASC";
                        $result_estado = $conexao->query($sql_estado);

                        while ($row = $result_estado->fetch_assoc()) {
                            $estado_id = $row['id'];
                            $estado_uf = $row['uf'];
    
                            echo "<option value='$estado_id'>$estado_uf</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="cidade"> Cidade: </label>
                <select name="cidade" id="cidade" required>
                    <option value=""> Selecione o estado primeiro </option>
                </select>
            </div>
            <div class="form-content">
                <label for="cep"> CEP: </label>
                <input type="text" name="cep" id="cep" placeholder="Digite o CEP do endereço do cliente" required>
            </div>
            <div class="form-content">
                <button type="submit" value="cadastrar"> Cadastrar </button>
            </div>
            <div class="form-content">
                <a href="listar.php"> Voltar </a>
            </div>
        </form>
    </div>    
</body>
</html>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $nome_cliente = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $cep = $_POST['cep'];
            
        $sql = "INSERT INTO Clientes (nome, cpf, telefone, rua, numero, cidade, estado, cep) VALUES ('$nome_cliente', '$cpf', '$telefone', '$rua', '$numero', '$cidade', '$estado', '$cep')";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php"); 
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    
    $conexao->close();
?>