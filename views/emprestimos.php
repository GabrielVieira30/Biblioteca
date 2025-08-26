<?php
require_once "../conexao.php";
require_once "../models/emprestimo.php";
require_once "../models/leitor.php";
require_once "../models/livro.php";

$emprestimoModel = new Emprestimo($pdo);
$leitorModel = new Leitor($pdo);
$livroModel = new Livro($pdo);

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 'todos';

// Processar novo empréstimo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["novo_emprestimo"])) {
    $id_livro = $_POST["id_livro"];
    $id_leitor = $_POST["id_leitor"];
    $data_emprestimo = $_POST["data_emprestimo"];
    
    try {
        $emprestimoModel->criar($id_livro, $id_leitor, $data_emprestimo);
        header("Location: emprestimos.php");
        exit();
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}

// Processar devolução
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["devolver"])) {
    $id_emprestimo = $_POST["id_emprestimo"];
    $data_devolucao = $_POST["data_devolucao"];
    
    $emprestimoModel->devolver($id_emprestimo, $data_devolucao);
    header("Location: emprestimos.php");
    exit();
}

// Obter lista baseada no tipo
switch ($tipo) {
    case 'ativos':
        $lista = $emprestimoModel->listarAtivos();
        break;
    case 'concluidos':
        $lista = $emprestimoModel->listarConcluidos();
        break;
    default:
        $lista = $emprestimoModel->listarTodos();
}

$leitores = $leitorModel->listar();
$livrosDisponiveis = $emprestimoModel->buscarLivrosDisponiveis();
?>

<h1>Empréstimos</h1>

<div style="margin-bottom: 20px;">
    <a href="emprestimos.php?tipo=todos" style="margin-right: 10px;">Todos</a>
    <a href="emprestimos.php?tipo=ativos" style="margin-right: 10px;">Ativos</a>
    <a href="emprestimos.php?tipo=concluidos">Concluídos</a>
</div>

<?php if (isset($erro)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">
        <?= $erro ?>
    </div>
<?php endif; ?>

<!-- Formulário para novo empréstimo -->
<h3>Novo Empréstimo</h3>
<form method="POST">
    <input type="hidden" name="novo_emprestimo" value="1">
    Livro: 
    <select name="id_livro" required>
        <option value="">Selecione um livro</option>
        <?php foreach($livrosDisponiveis as $livro): ?>
            <option value="<?= $livro['id_livro'] ?>">
                <?= $livro['titulo'] ?> (<?= $livro['autor_nome'] ?>)
            </option>
        <?php endforeach; ?>
    </select>
    
    Leitor: 
    <select name="id_leitor" required>
        <option value="">Selecione um leitor</option>
        <?php foreach($leitores as $leitor): ?>
            <option value="<?= $leitor['id_leitor'] ?>">
                <?= $leitor['nome'] ?> (<?= $leitorModel->contarEmprestimosAtivos($leitor['id_leitor']) ?> ativos)
            </option>
        <?php endforeach; ?>
    </select>
    
    Data do Empréstimo: <input type="date" name="data_emprestimo" value="<?= date('Y-m-d') ?>" required>
    
    <button type="submit">Registrar Empréstimo</button>
</form>

<!-- Tabela de empréstimos -->
<h3>Lista de Empréstimos</h3>
<table border="1">
<tr>
    <th>ID</th>
    <th>Livro</th>
    <th>Leitor</th>
    <th>Data Empréstimo</th>
    <th>Data Devolução</th>
    <th>Status</th>
    <th>Ação</th>
</tr>
<?php foreach($lista as $e): ?>
<tr>
    <td><?= $e["id_emprestimo"] ?></td>
    <td><?= $e["livro_titulo"] ?></td>
    <td><?= $e["leitor_nome"] ?></td>
    <td><?= $e["data_emprestimo"] ?></td>
    <td><?= $e["data_devolucao"] ?? 'Não devolvido' ?></td>
    <td><?= $e["data_devolucao"] ? 'Concluído' : 'Ativo' ?></td>
    <td>
        <?php if (!$e["data_devolucao"]): ?>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="devolver" value="1">
                <input type="hidden" name="id_emprestimo" value="<?= $e['id_emprestimo'] ?>">
                <input type="date" name="data_devolucao" value="<?= date('Y-m-d') ?>" required>
                <button type="submit">Devolver</button>
            </form>
        <?php endif; ?>
        <a href="excluir_emprestimo.php?id=<?= $e['id_emprestimo'] ?>">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
