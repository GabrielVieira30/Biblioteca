<?php
require_once "../conexao.php";

class Autor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $sql = "SELECT * FROM autores ORDER BY nome";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM autores WHERE id_autor = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $nacionalidade, $ano_nascimento) {
        $sql = "INSERT INTO autores (nome, nacionalidade, ano_nascimento) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $nacionalidade, $ano_nascimento]);
    }

    public function atualizar($id, $nome, $nacionalidade, $ano_nascimento) {
        $sql = "UPDATE autores SET nome = ?, nacionalidade = ?, ano_nascimento = ? WHERE id_autor = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $nacionalidade, $ano_nascimento, $id]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM autores WHERE id_autor = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function contarLivros($id_autor) {
        $sql = "SELECT COUNT(*) as total FROM livros WHERE id_autor = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_autor]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>
