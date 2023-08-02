<?php

// Inclua o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';

// Função para realizar o login
function login($email, $senha) {
    
    // Verifique se o nome de usuário e a senha foram fornecidos
    if (!empty($email) && !empty($senha)) {
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
            var_dump($hashed_senha);

            // Verifique se a senha fornecida corresponde à senha armazenada no banco de dados
            if (password_verify($senha, $hashed_senha)) {
                // Autenticação bem-sucedida
                // Inicie uma sessão e armazene as informações do usuário, se necessário
                session_start();
                $_SESSION['user_id'] = $row['id_usuario'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['nivel_acesso'] = $row['nivel_acesso'];



                // Redirecione para a página de perfil ou área restrita
                header('Location:/Carrinho/index.php');
                exit();
            } else {
                // Senha incorreta
                echo "Senha incorreta.";
                header('Location: /Carrinho/views/cadastro_usuario.php');
                exit();
            }
        } else {
            setcookie('erro', 'Email ou senha incorretos', time() + 3600, '/');
        }
    } else {
        // Campos em branco
        echo "Por favor, preencha todos os campos.";
        header('Location: /Carrinho/views/cadastro_usuario.php');
        exit();
    }
}


try {
    // Obtenha as variáveis do banco de dados
    $email = $_POST["email"];
    $senha = $_POST["senha"];

   

    // Chamada da função que deseja executar
    login($email, $senha); 
} catch (Exception $e) {
   // Tratamento da exceção
   echo "Ocorreu um erro: " . $e->getMessage();
}