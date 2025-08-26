<?php
require_once "conexao.php";
require_once "models/livro.php";

try {
    $livro = new Livro($pdo);
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($livro->excluir($id)) {
            header("Location: views/livros.php");
            exit();
        } else {
            echo "Erro ao excluir o livro.";
        }
    } else {
        echo "ID do livro não especificado.";
    }
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
