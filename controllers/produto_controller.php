<?php
// Incluir o arquivo de conexão com o banco de dados
require_once $_SERVER["DOCUMENT_ROOT"] . '/Carrinho/db/conexao.php';

// Função para cadastrar um novo produto
function cadastrarProduto($nome, $preco, $imagem) {
    global $conn;

    try {
        $sql = "INSERT INTO produto (nome, preco, imagem) VALUES (:nome, :preco, :imagem)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->execute();

        // Retorna o ID do produto recém-cadastrado
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao cadastrar produto: " . $e->getMessage();
        return false;
    }
}

// Função para atualizar os dados de um produto
function atualizarProduto($id, $nome, $preco, $imagem) {
    global $conn;

    try {
        $sql = "UPDATE produto SET nome = :nome, preco = :preco, imagem= :imagem WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Retorna true se a atualização foi bem-sucedida
        return true;
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao atualizar produto: " . $e->getMessage();
        return false;
    }
}

// Função para excluir um produto
function excluirProduto($id) {
    global $conn;

    try {
        $sql = "DELETE FROM produto WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Retorna true se a exclusão foi bem-sucedida
        return true;
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao excluir produto: " . $e->getMessage();
        return false;
    }
}
