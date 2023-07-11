<?php
// Arquivo cadastrarController.php

// Inclua o arquivo de conexão com o banco de dados
require_once $_SERVER["DOCUMENT_ROOT"] . '/Carrinho/db/conexao.php';

// Função para cadastrar um novo usuário
function cadastrar($username, $email, $password) {
    // Verifique se o nome de usuário e a senha foram fornecidos
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Sanitize os dados de entrada
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        // Verifique se o nome de usuário já existe no banco de dados
        $sql = "SELECT * FROM carrinho WHERE email = :email";
        $conn = Conexao::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // O nome de usuário não existe, então podemos prosseguir com o cadastro
            // Hash da senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Execute a consulta para inserir o novo usuário no banco de dados
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();

            // Cadastro bem-sucedido
            // Inicie uma sessão e armazene as informações do usuário, se necessário
            session_start();
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['email'] = $email;

            // Redirecione para a página de perfil ou área restrita
            header('Location: /Carrinho/views/index_u.php');
            exit();
        } else {
            // O nome de usuário já existe
            echo "Nome de usuário já cadastrado.";
        }
    } else {
        // Campos em branco
        echo "Por favor, preencha todos os campos.";
    }
}

