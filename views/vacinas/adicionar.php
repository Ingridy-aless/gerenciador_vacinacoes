<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/formulario.css">
    <title> Formulário de Vacinas </title>
</head>
<body>
    <div class="container">
        <section class="cabecalho">
            <h2> Cadastro de Vacinas </h2>
        </section>
        
        <form method="post" action="adicionar.php" id="form" class="form">
            <div class="form-content">
                <label for="nome"> Nome da vacina: </label>
                <input type="text" name="nome" placeholder="Digite o nome da vacina" required>
            </div>
            <div class="form-content">
                <label for="laboratorio"> Nome do laboratório: </label>
                <input type="text" name="laboratorio" placeholder="Digite o nome do laboratório" required>
            </div>
            <div class="form-content">
                <label for="lote"> Lote: </label>
                <input type="number" name="lote" placeholder="Digite o lote da vacina" required>
            </div>
            <div class="form-content">
                <label for="validade"> Validade: </label>
                <input type="date" name="validade" required>
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
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $nome_vacina = $_POST['nome'];
        $laboratorio = $_POST['laboratorio'];
        $lote = $_POST['lote'];
        $validade = $_POST['validade'];
            
        $sql = "INSERT INTO Vacinas (nome, laboratorio, lote, validade) VALUES ('$nome_vacina', '$laboratorio', '$lote', '$validade')";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php"); 
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    
    $conexao->close();
?>