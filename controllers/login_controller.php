<?php

// Inclua o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';

// Função para realizar o login
function login($email, $password) {
    // Verifique se o nome de usuário e a senha foram fornecidos
    if (!empty($email) && !empty($password)) {
        // Sanitize os dados de entrada
        $email = htmlspecialchars($email);
        $password = htmlspecialchars($password);

        // Execute uma consulta para selecionar o usuário com base no nome de usuário fornecido
        $sql = "SELECT * FROM carrinho WHERE email = :email";
        $conn = Conexao::conectar(); // tem que conectar antes sempre, essa linha faz isso.
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

            // Verifique se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($password, $hashed_password)) {
                // Autenticação bem-sucedida
                // Inicie uma sessão e armazene as informações do usuário, se necessário
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                // Redirecione para a página de perfil ou área restrita
                header('Location:/Carrinho/views/index_u.php');
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
