<?php
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $nome_animal = $_POST['nome'];
        $especie = $_POST['especie'];
        $idade = $_POST['idade'];
        $raca = $_POST['raca'];
        $sexo = $_POST['sexo'];
        $dono_animal_id = $_POST['dono_animal'];
    
        $sql = "UPDATE Animais SET nome='$nome_animal', especie='$especie', idade='$idade', raca='$raca', sexo='$sexo', cliente='$dono_animal_id' WHERE id=$id";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro ao atualizar: " . $conexao->error;
        }
    } else {
        $id = $_GET['id'];
        $sql = "SELECT a.id, a.nome AS animal, a.especie, a.idade, a.raca, a.sexo, a.cliente AS id_cliente, c.nome AS cliente
                FROM Animais AS a 
                LEFT JOIN Clientes AS c ON a.cliente = c.id 
                WHERE a.id=$id";
        
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $animal = $result->fetch_assoc();
        } else {
            echo "Animal não encontrado!";
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
    <title> Formulário de Animais </title>
</head>
<body>
    <div class="container">
        <section class="cabecalho">
            <h2> Edição de Animais </h2>
        </section>
        
        <form method="post" action="editar.php" id="form" class="form">
            <div>
                <input type="hidden" name="id" value="<?php echo $animal['id'];?>">
            </div>
            <div class="form-content">
                <label for="nome"> Nome do animal: </label>
                <input type="text" name="nome" value="<?php echo $animal['animal'];?>" required>
            </div>
            <div class="form-content">
                <label for="especie"> Espécie: </label>
                <input type="text" name="especie" value="<?php echo $animal['especie'];?>" required>
            </div>
            <div class="form-content">
                <label for="idade"> Idade: </label>
                <input type="number" name="idade" value="<?php echo $animal['idade'];?>" required>
            </div>
            <div class="form-content">
                <label for="raca"> Raça: </label>
                <input type="text" name="raca" value="<?php echo $animal['raca'];?>" required>
            </div>
            <div class="form-content">
                <label for="sexo"> Sexo: </label>
                <select name="sexo" required>
                    <option value="<?php echo $animal['sexo'];?>"><?php echo $animal['sexo'];?></option>
                    <?php
                        if ($animal['sexo'] == "Macho") {
                            echo "<option value='Fêmea'> Fêmea </option>";
                        } else {
                            echo "<option value='Macho'> Macho </option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-content">
                <label for="dono_animal"> Dono do animal: </label>
                <select name="dono_animal" id="dono_animal" required>
                    <option value="<?php echo $animal['id_cliente'];?>"><?php echo $animal['cliente'];?></option>
                    <?php
                        $sql_dono_animal = "SELECT id, nome FROM Clientes ORDER BY nome ASC";
                        $result_dono_animal = $conexao->query($sql_dono_animal);

                        while ($row = $result_dono_animal->fetch_assoc()) {
                            $dono_animal_id = $row['id'];
                            $dono_animal_nome = $row['nome'];

                            if ($dono_animal_id <> $animal['id_cliente']) {
                                echo "<option value='$dono_animal_id'>$dono_animal_nome</option>";
                            }
                        }
                    ?>
                </select>
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