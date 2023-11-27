<?php
    include '../../base/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/home.css">
    <title> Gerenciador de Vacinações </title>
</head>
<body>
    <main>
        <ul class="lista">
            <li>
                <a href="../clientes/listar.php"><img src="../../images/user_icon.png" alt="Ícone do usuário"></a>
                </br>
                <a href="../clientes/listar.php" class="botao-home"> Gerenciador de Clientes </a>
            </li>
            <li>
                <a href="../animais/listar.php"><img src="../../images/animal_icon.png" alt="Ícone do animal"></a>
                </br>
                <a href="../animais/listar.php" class="botao-home"> Gerenciador de Animais </a>
            </li>
            <li>
                <a href="../vacinas/listar.php"><img src="../../images/vacina_icon.png" alt="Ícone da vacina"></a>
                </br>
                <a href="../vacinas/listar.php" class="botao-home"> Gerenciador de Vacinas </a>
            </li>
            <li>
                <a href="../vacinacao/listar.php"><img src="../../images/vacination_icon.png" alt="Ícone da vacinação"></a>
                </br>
                <a href="../vacinacao/listar.php" class="botao-home"> Gerenciador de Vacinações </a>
            </li>
        </ul>
    </main>
</body>
</html>

<?php
    include '../../base/footer.php';
?>