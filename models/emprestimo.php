<?php
require_once "../conexao.php";

class Emprestimo {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTodos() {
        $sql = "SELECT e.*, l.titulo as livro_titulo, lt.nome as leitor_nome 
                FROM emprestimos e 
                JOIN livros l ON e.id_livro = l.id_livro 
                JOIN leitores lt ON e.id_leitor = lt.id_leitor 
                ORDER BY e.data_emprestimo DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarAtivos() {
        $sql = "SELECT e.*, l.titulo as livro_titulo, lt.nome as leitor_nome 
                FROM emprestimos e 
                JOIN livros l ON e.id_livro = l.id_livro 
                JOIN leitores lt ON e.id_leitor = lt.id_leitor 
                WHERE e.data_devolucao IS NULL 
                ORDER BY e.data_emprestimo DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarConcluidos() {
        $sql = "SELECT e.*, l.titulo as livro_titulo, lt.nome as leitor_nome 
                FROM emprestimos e 
                JOIN livros l ON e.id_livro = l.id_livro 
                JOIN leitores lt ON e.id_leitor = lt.id_leitor 
                WHERE e.data_devolucao IS NOT NULL 
                ORDER BY e.data_emprestimo DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorLeitor($id_leitor) {
        $sql = "SELECT e.*, l.titulo as livro_titulo, l.genero 
                FROM emprestimos e 
                JOIN livros l ON e.id_livro = l.id_livro 
                WHERE e.id_leitor = ? 
                ORDER BY e.data_emprestimo DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_leitor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT e.*, l.titulo as livro_titulo, lt.nome as leitor_nome 
                FROM emprestimos e 
                JOIN livros l ON e.id_livro = l.id_livro 
                JOIN leitores lt ON e.id_leitor = lt.id_leitor 
                WHERE e.id_emprestimo = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($id_livro, $id_leitor, $data_emprestimo) {
        // Verificar se o livro já está emprestado
        if ($this->livroEstaEmprestado($id_livro)) {
            throw new Exception("Este livro já está emprestado e não foi devolvido ainda.");
        }

        // Verificar se o leitor já tem 3 empréstimos ativos
        $leitorModel = new Leitor($this->pdo);
        if ($leitorModel->contarEmprestimosAtivos($id_leitor) >= 3) {
            throw new Exception("Este leitor já possui 3 empréstimos ativos. Máximo permitido.");
        }

        // Validar data de empréstimo
        if (empty($data_emprestimo)) {
            throw new Exception("A data de empréstimo não pode estar vazia.");
        }

        $sql = "INSERT INTO emprestimos (id_livro, id_leitor, data_emprestimo) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_livro, $id_leitor, $data_emprestimo]);
    }

    public function devolver($id_emprestimo, $data_devolucao) {
        $sql = "UPDATE emprestimos SET data_devolucao = ? WHERE id_emprestimo = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$data_devolucao, $id_emprestimo]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM emprestimos WHERE id_emprestimo = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function livroEstaEmprestado($id_livro) {
        $sql = "SELECT COUNT(*) as total FROM emprestimos WHERE id_livro = ? AND data_devolucao IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_livro]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] > 0;
    }

    public function buscarLivrosDisponiveis() {
        $sql = "SELECT l.*, a.nome as autor_nome 
                FROM livros l 
                JOIN autores a ON l.id_autor = a.id_autor 
                WHERE l.id_livro NOT IN (
                    SELECT id_livro FROM emprestimos WHERE data_devolucao IS NULL
                )
                ORDER BY l.titulo";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
