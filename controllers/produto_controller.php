<?php
// Incluir o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';

// Função para cadastrar um novo produto
function cadastrarProduto($nome_produto, $preco, $imagem_produto) {
    global $conn;

    try {
        $sql = "INSERT INTO produto (nome_produto, preco, imagem_produto) VALUES (:nome_produto, :preco, :imagem_produto)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem_produto', $imagem_produto);
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
function atualizarProduto($id, $nome_produto, $preco, $imagem_produto) {
    global $conn;

    try {
        $sql = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, imagem_produto= :imagem_produto WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('nome_produto', $nome_produto);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem_produto', $imagem_produto);
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
