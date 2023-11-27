<?php
    include '../../conexao.php';
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
            <h2> Cadastro de Animais </h2>
        </section>
        
        <form method="post" action="adicionar.php" id="form" class="form">
            <div class="form-content">
                <label for="nome"> Nome do animal: </label>
                <input type="text" name="nome" placeholder="Digite o nome do animal" required>
            </div>
            <div class="form-content">
                <label for="especie"> Espécie: </label>
                <input type="text" name="especie" placeholder="Digite a espécie do animal" required>
            </div>
            <div class="form-content">
                <label for="idade"> Idade: </label>
                <input type="number" name="idade" placeholder="Digite a idade do animal" required>
            </div>
            <div class="form-content">
                <label for="raca"> Raça: </label>
                <input type="text" name="raca" placeholder="Digite a raça do animal" required>
            </div>
            <div class="form-content">
                <label for="sexo"> Sexo: </label>
                <select name="sexo" required>
                    <option value=""> Selecione o sexo do animal </option>
                    <option value="Fêmea"> Fêmea </option>
                    <option value="Macho"> Macho </option>
                </select>
            </div>
            <div class="form-content">
                <label for="dono_animal"> Dono do animal: </label>
                <select name="dono_animal" id="dono_animal" required>
                    <option value=""> Selecione o dono do animal </option>
                    <?php
                        $sql_dono_animal = "SELECT id, nome FROM Clientes ORDER BY nome ASC";
                        $result_dono_animal = $conexao->query($sql_dono_animal);

                        while ($row = $result_dono_animal->fetch_assoc()) {
                            $dono_animal_id = $row['id'];
                            $dono_animal_nome = $row['nome'];
                            
                            echo "<option value='$dono_animal_id'>$dono_animal_nome</option>";
                        }
                    ?>
                </select>
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
        $nome_animal = $_POST['nome'];
        $especie = $_POST['especie'];
        $idade = $_POST['idade'];
        $raca = $_POST['raca'];
        $sexo = $_POST['sexo'];
        $dono_animal_id = $_POST['dono_animal'];
            
        $sql = "INSERT INTO Animais (nome, especie, idade, raca, sexo, cliente) VALUES ('$nome_animal', '$especie', '$idade', '$raca', '$sexo', '$dono_animal_id')";
        
        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php"); 
        } else {
            echo "Erro: " . $conexao->error;
        }
    }
    
    $conexao->close();
?>