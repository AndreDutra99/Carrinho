<?php
// Inclua o arquivo de conexão com o banco de dados
require_once '../db/conexao.php';


// Função para cadastrar um novo usuário
function cadastrar($nome, $email, $senha) {
    // Verifique se o nome de usuário e a senha foram fornecidos
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Sanitize os dados de entrada
        $nome = htmlspecialchars($nome);
        $email = htmlspecialchars($email);
        $senha = htmlspecialchars($senha);

        // Verifique se o nome de usuário já existe no banco de dados
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $conn = Conexao::conectar();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // O nome de usuário não existe, então podemos prosseguir com o cadastro
            // Hash da senha
            $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);

            // Execute a consulta para inserir o novo usuário no banco de dados
            $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $hashed_senha);
            $stmt->execute();

            // Cadastro bem-sucedido
            // Inicie uma sessão e armazene as informações do usuário, se necessário
            session_start();
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['email'] = $email;

            // Redirecione para a página de perfil ou área restrita
            header('Location: /Carrinho/index.php');
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

