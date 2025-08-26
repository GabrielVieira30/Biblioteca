<?php
require_once "models/Livro.php";
$livro = new Livro($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livro->criar($_POST["titulo"], $_POST["genero"], $_POST["ano_publicacao"], $_POST["id_autor"]);
}

$lista = $livro->listar();
?>

<h1>Livros</h1>
<form method="POST">
    Título: <input type="text" name="titulo">
    Gênero: <input type="text" name="genero">
    Ano: <input type="number" name="ano_publicacao">
    Autor ID: <input type="number" name="id_autor">
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
