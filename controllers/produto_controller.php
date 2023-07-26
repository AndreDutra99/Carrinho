<?php
// Incluir o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';

// Função para cadastrar um novo produto
function cadastrarProduto($nome_produto, $preco, $imagem_produto)
{
    global $conn;

    try {
        // Converter o preço para um número de ponto flutuante
        $preco = floatval($preco);
        $sql = "INSERT INTO produto (nome_produto, preco, imagem_produto) VALUES (:nome_produto, :preco, :imagem_produto)";
        $conn = Conexao::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem_produto', $imagem_produto);
        $stmt->execute();

        // Retorna o ID do produto recém-cadastrado
        /* return $conn->lastInsertId(); */
        header('Location: /Carrinho/views/lista_produto_adm.php');
        exit();
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao cadastrar produto: " . $e->getMessage();
        return false;
    }
}


// Função para atualizar os dados de um produto
function atualizarProduto($id_produto, $nome_produto, $preco, $imagem_produto)
{
    global $conn;

    try {
        // Converter o preço para um número de ponto flutuante
        $preco = floatval($preco);
        $sql = "UPDATE produto SET nome_produto = :nome_produto, preco = :preco, imagem_produto= :imagem_produto WHERE id_produto = :id_produto";
        $conn = Conexao::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome_produto', $nome_produto);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem_produto', $imagem_produto);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();

        header('Location: /Carrinho/views/lista_produto_adm.php');
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao atualizar produto: " . $e->getMessage();
        return false;
    }
}

// Função para excluir um produto
function excluirProduto($id_produto)
{
    global $conn;

    try {
        $sql = "DELETE FROM produto WHERE id_produto = :id_produto";
        $conn = Conexao::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();

        header('Location: /Carrinho/views/lista_produto_adm.php');
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao excluir produto: " . $e->getMessage();
        return false;
    }
}

try {
    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['acao'] === 'inserir') {
        // Obtenha as variáveis do formulário
        $nome_produto = $_POST["nome_produto"];
        $preco = $_POST["preco"];
        $imagem_produto = file_get_contents($_FILES["imagem_produto"]['tmp_name']);

        // Chamada da função que deseja executar
        cadastrarProduto($nome_produto, $preco, $imagem_produto);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"  && $_POST['acao'] === 'atualizar') {
        // Obtenha as variáveis do formulário
        $id_produto = $_POST["id_produto"];
        $nome_produto = $_POST["nome_produto"];
        $preco = $_POST["preco"];
        $imagem_produto = $_POST["imagem_produto"];

        // Chamada da função que deseja executar
        atualizarProduto($id_produto, $nome_produto, $preco, $imagem_produto);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"  && $_POST['acao'] === 'excluir') {
        // Obtenha as variáveis do formulário
        $id_produto = $_POST["id_produto"];

        // Chamada da função que deseja executar
        excluirProduto($id_produto);
    }
} catch (Exception $e) {
    // Tratamento da exceção
    echo "Ocorreu um erro: " . $e->getMessage();
}
