<?php
require_once "../conexao.php";

class Leitor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $sql = "SELECT * FROM leitores ORDER BY nome";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM leitores WHERE id_leitor = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $email, $telefone) {
        $sql = "INSERT INTO leitores (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone]);
    }

    public function atualizar($id, $nome, $email, $telefone) {
        $sql = "UPDATE leitores SET nome = ?, email = ?, telefone = ? WHERE id_leitor = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $id]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM leitores WHERE id_leitor = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function contarEmprestimosAtivos($id_leitor) {
        $sql = "SELECT COUNT(*) as total FROM emprestimos WHERE id_leitor = ? AND data_devolucao IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_leitor]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM leitores WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
