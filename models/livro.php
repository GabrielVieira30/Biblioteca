<?php
require_once "../conexao.php";

class Livro {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $sql = "SELECT l.*, a.nome as autor 
                FROM livros l 
                JOIN autores a ON l.id_autor = a.id_autor";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function criar($titulo, $genero, $ano, $id_autor) {
        // Validar ano de publicação
        $ano_atual = date('Y');
        if ($ano < 1500 || $ano > $ano_atual) {
            throw new Exception("Ano de publicação deve estar entre 1500 e $ano_atual");
        }
        
        $sql = "INSERT INTO livros (titulo, genero, ano_publicacao, id_autor) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$titulo, $genero, $ano, $id_autor]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM livros WHERE id_livro=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>
