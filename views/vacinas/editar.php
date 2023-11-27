<?php
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nome_vacina = $_POST['nome'];
        $laboratorio = $_POST['laboratorio'];
        $lote = $_POST['lote'];
        $validade = $_POST['validade'];
    
        $sql = "UPDATE Vacinas SET nome='$nome_vacina', laboratorio='$laboratorio', lote='$lote', validade='$validade' WHERE id=$id";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro ao atualizar: " . $conexao->error;
        }
    } else {
        $id = $_GET['id'];
        $sql = "SELECT id, nome, laboratorio, lote, validade FROM Vacinas WHERE id=$id";
        
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $vacina = $result->fetch_assoc();
        } else {
            echo "Vacina não encontrada!";
            exit;
        }
    }

    $conexao->close();
?>

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
            <h2> Edição de Vacinas </h2>
        </section>
        
        <form method="post" action="editar.php" id="form" class="form">
            <div>
                <input type="hidden" name="id" value="<?php echo $vacina['id'];?>">
            </div>
            <div class="form-content">
                <label for="nome"> Nome da vacina: </label>
                <input type="text" name="nome" value="<?php echo $vacina['nome'];?>" required>
            </div>
            <div class="form-content">
                <label for="laboratorio"> Nome do laboratório: </label>
                <input type="text" name="laboratorio" value="<?php echo $vacina['laboratorio'];?>" required>
            </div>
            <div class="form-content">
                <label for="lote"> Lote: </label>
                <input type="number" name="lote" value="<?php echo $vacina['lote'];?>" required>
            </div>
            <div class="form-content">
                <label for="validade"> Validade: </label>
                <input type="date" name="validade" value="<?php echo $vacina['validade'];?>" required>
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