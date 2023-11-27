<?php
    include '../../conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM Animais WHERE id=$id";

        if ($conexao->query($sql) === TRUE) {
            header("Location: listar.php");
        } else {
            echo "Erro ao deletar: " . $conexao->error;
        }
    }

    $conexao->close();
?>