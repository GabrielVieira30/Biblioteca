<?php
require_once "../conexao.php";
require_once "../models/leitor.php";

$leitorModel = new Leitor($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    
    if (!empty($nome) && !empty($email) && !empty($telefone)) {
        // Verificar se email já existe
        $leitorExistente = $leitorModel->buscarPorEmail($email);
        if ($leitorExistente) {
            $erro = "Este email já está cadastrado!";
        } else {
            $leitorModel->criar($nome, $email, $telefone);
            header("Location: leitores.php");
            exit();
        }
    } else {
        $erro = "Todos os campos são obrigatórios!";
    }
}

$lista = $leitorModel->listar();
?>

<h1>Leitores</h1>

<?php if (isset($erro)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= $erro ?>
    </div>
<?php endif; ?>

<form method="POST">
    Nome: <input type="text" name="nome" required>
    Email: <input type="email" name="email" required>
    Telefone: <input type="text" name="telefone" required>
    <button type="submit">Adicionar Leitor</button>
</form>

<table border="1">
<tr><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Empréstimos Ativos</th><th>Ação</th></tr>
<?php foreach($lista as $l): ?>
<tr>
    <td><?= $l["id_leitor"] ?></td>
    <td><?= $l["nome"] ?></td>
    <td><?= $l["email"] ?></td>
    <td><?= $l["telefone"] ?></td>
    <td><?= $leitorModel->contarEmprestimosAtivos($l["id_leitor"]) ?></td>
    <td>
        <a href="editar_leitor.php?id=<?= $l['id_leitor'] ?>">Editar</a> | 
        <a href="excluir_leitor.php?id=<?= $l['id_leitor'] ?>">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
