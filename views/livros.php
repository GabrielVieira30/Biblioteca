<?php
require_once "../conexao.php";
require_once "../models/livro.php";

// Create database connection using the variables from conexao.php
try {
    $livro = new Livro($pdo);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["titulo"]) && !empty($_POST["genero"]) && !empty($_POST["ano_publicacao"]) && !empty($_POST["id_autor"])) {
            try {
                $livro->criar($_POST["titulo"], $_POST["genero"], $_POST["ano_publicacao"], $_POST["id_autor"]);
                header("Location: livros.php");
                exit();
            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        } else {
            $erro = "Todos os campos são obrigatórios!";
        }
    }

    $lista = $livro->listar();
} catch(PDOException $e) {
    $erro = "Erro de conexão: " . $e->getMessage();
}
?>

<h1>Livros</h1>

<?php if (isset($erro)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST">
    Título: <input type="text" name="titulo" required>
    Gênero: <input type="text" name="genero" required>
    Ano: <input type="number" name="ano_publicacao" required min="1000" max="<?= date('Y') ?>">
    Autor ID: <input type="number" name="id_autor" required min="1">
    <button type="submit">Salvar</button>
</form>

<table border="1">
<tr><th>ID</th><th>Título</th><th>Autor</th><th>Ano</th><th>Ação</th></tr>
<?php foreach($lista as $l): ?>
<tr>
    <td><?= $l["id_livro"] ?></td>
    <td><?= $l["titulo"] ?></td>
    <td><?= $l["autor"] ?></td>
    <td><?= $l["ano_publicacao"] ?></td>
    <td><a href="excluir_livro.php?id=<?= $l['id_livro'] ?>">Excluir</a></td>
</tr>
<?php endforeach; ?>
</table>
