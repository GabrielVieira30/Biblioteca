<?php
require_once "../conexao.php";
require_once "../models/autor.php";

$autorModel = new Autor($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $nacionalidade = $_POST["nacionalidade"];
    $ano_nascimento = $_POST["ano_nascimento"];
    
    if (!empty($nome) && !empty($nacionalidade) && !empty($ano_nascimento)) {
        $autorModel->criar($nome, $nacionalidade, $ano_nascimento);
        header("Location: autores.php");
        exit();
    } else {
        $erro = "Todos os campos são obrigatórios!";
    }
}

$lista = $autorModel->listar();
?>

<h1>Autores</h1>

<?php if (isset($erro)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST">
    Nome: <input type="text" name="nome" required>
    Nacionalidade: <input type="text" name="nacionalidade" required>
    Ano de Nascimento: <input type="number" name="ano_nascimento" required>
    <button type="submit">Adicionar Autor</button>
</form>

<table border="1">
<tr><th>ID</th><th>Nome</th><th>Nacionalidade</th><th>Ano de Nascimento</th><th>Ação</th></tr>
<?php foreach($lista as $a): ?>
<tr>
    <td><?= $a["id_autor"] ?></td>
    <td><?= $a["nome"] ?></td>
    <td><?= $a["nacionalidade"] ?></td>
    <td><?= $a["ano_nascimento"] ?></td>
    <td>
        <a href="editar_autor.php?id=<?= $a['id_autor'] ?>">Editar</a> | 
        <a href="excluir_autor.php?id=<?= $a['id_autor'] ?>">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
