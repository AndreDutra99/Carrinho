<?php

// Inclua o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';

// Função para realizar o login
function login($email, $senha) {
    // Verifique se o nome de usuário e a senha foram fornecidos
    if (!empty($email) && !empty($password)) {
        // Sanitize os dados de entrada
        $email = htmlspecialchars($email);
        $senha = htmlspecialchars($senha);

        // Execute uma consulta para selecionar o usuário com base no nome de usuário fornecido
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $conn = Conexao::conectar(); // tem que conectar antes sempre, essa linha faz isso.
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_senha = $row['senha'];

            // Verifique se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $hashed_senha)) {
                // Autenticação bem-sucedida
                // Inicie uma sessão e armazene as informações do usuário, se necessário
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                // Redirecione para a página de perfil ou área restrita
                header('Location:/Carrinho/index.php');
                exit();
            } else {
                // Senha incorreta
                echo "Senha incorreta.";
            }
        } else {
            // Usuário não encontrado
            echo "Nome de usuário não existe.";
        }
    } else {
        // Campos em branco
        echo "Por favor, preencha todos os campos.";
    }
}
