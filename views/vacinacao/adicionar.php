<?php
    include '../../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/formulario.css">
    <title> Formulário de Vacinações </title>
</head>
<body>
    <div class="container">
        <section class="cabecalho">
            <h2> Cadastro de Vacinações </h2>
        </section>
        
        <form method="post" action="adicionar.php" id="form" class="form">
            <div class="form-content">
                <label for="animal"> Nome do animal: </label>
                <select name="animal" id="animal" required>
                    <option value=""> Selecione o animal </option>
                    <?php
                        $sql_animal = "SELECT id, nome FROM Animais ORDER BY nome ASC";
                        $result_animal = $conexao->query($sql_animal);

                        while ($row = $result_animal->fetch_assoc()) {
                            $animal_id = $row['id'];
                            $animal_nome = $row['nome'];

                            echo "<option value='$animal_id'>$animal_nome</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="vacina"> Nome da vacina: </label>
                <select name="vacina" id="vacina" required>
                    <option value=""> Selecione a vacina </option>
                    <?php
                        $sql_vacina = "SELECT id, nome FROM Vacinas ORDER BY nome ASC";
                        $result_vacina = $conexao->query($sql_vacina);

                        while ($row = $result_vacina->fetch_assoc()) {
                            $vacina_id = $row['id'];
                            $vacina_nome = $row['nome'];
                            
                            echo "<option value='$vacina_id'>$vacina_nome</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="data_aplicacao"> Data de aplicação: </label>
                <input type="date" name="data_aplicacao" required>
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
        $data_aplicacao = $_POST['data_aplicacao'];
        $animal_id = $_POST['animal'];
        $vacina_id = $_POST['vacina'];
            
        $sql = "INSERT INTO Vacinacao (data_aplicacao, animal, vacina) VALUES ('$data_aplicacao', '$animal_id', '$vacina_id')";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php"); 
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    
    $conexao->close();
?>