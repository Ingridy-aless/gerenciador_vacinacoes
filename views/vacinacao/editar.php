<?php
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $data_aplicacao = $_POST['data_aplicacao'];
        $animal_id = $_POST['animal'];
        $vacina_id = $_POST['vacina'];
    
        $sql = "UPDATE Vacinacao SET data_aplicacao='$data_aplicacao', animal='$animal_id', vacina='$vacina_id' WHERE id=$id";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro ao atualizar: " . $conexao->error;
        }
    } else {
        $id = $_GET['id'];
        $sql = "SELECT v.id, v.data_aplicacao, v.animal AS id_animal, v.vacina AS id_vacina, a.nome AS nome_animal, vc.nome AS nome_vacina 
                FROM Vacinacao as v
                LEFT JOIN Animais as a ON v.animal = a.id
                LEFT JOIN Vacinas as vc ON v.vacina = vc.id
                WHERE v.id=$id";

        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $vacinacao = $result->fetch_assoc();
        } else {
            echo "Vacinação não encontrada!";
            exit;
        }
    }
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
            <h2> Edição de Vacinações </h2>
        </section>
        
        <form method="post" action="editar.php" id="form" class="form">
            <div>
                <input type="hidden" name="id" value="<?php echo $vacinacao['id'];?>">
            </div>
            <div class="form-content">
                <label for="animal"> Nome do animal: </label>
                <select name="animal" id="animal" required>
                    <option value="<?php echo $vacinacao['id_animal'];?>"><?php echo $vacinacao['nome_animal'];?></option>
                    <?php
                        $sql_animal = "SELECT id, nome FROM Animais ORDER BY nome ASC";
                        $result_animal = $conexao->query($sql_animal);

                        while ($row = $result_animal->fetch_assoc()) {
                            $animal_id = $row['id'];
                            $animal_nome = $row['nome'];

                            if ($animal_id <> $vacinacao['id_animal']) {
                                echo "<option value='$animal_id'>$animal_nome</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="vacina"> Nome da vacina: </label>
                <select name="vacina" id="vacina" required>
                    <option value="<?php echo $vacinacao['id_vacina'];?>"><?php echo $vacinacao['nome_vacina'];?></option>
                    <?php
                        $sql_vacina = "SELECT id, nome FROM Vacinas ORDER BY nome ASC";
                        $result_vacina = $conexao->query($sql_vacina);

                        while ($row = $result_vacina->fetch_assoc()) {
                            $vacina_id = $row['id'];
                            $vacina_nome = $row['nome'];

                            if ($vacina_id <> $vacinacao['id_vacina']) {
                                echo "<option value='$vacina_id'>$vacina_nome</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="data_aplicacao"> Data de aplicação: </label>
                <input type="date" name="data_aplicacao" value="<?php echo $vacinacao['data_aplicacao'];?>" required>
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