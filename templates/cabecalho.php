<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho Teste</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/Carrinho/css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="/Carrinho/index.php">Home</a></li>
                <li><a href="/Carrinho/views/carrinho.php">Carrinho</a></li>
                <?php

                    if (isset($_SESSION['user_id'])  && $_SESSION['nivel_acesso'] == 2) :
                        // O usuário logado for nível 2, exibir botão de adicionar produto
                    ?>
                        <li><a href="/Carrinho/views/cadastro_produto.php">Adicionar Produto</a></li>
                    <?php
                    else :
                        //se não, não exibir nada
                    ?>
                       
                    <?php
                    endif;
                    ?>
                
                <li>

                    <?php

                    if (isset($_SESSION['user_id'])) :
                        // O usuário está logado, exibir botão de logout
                    ?>
                        <a href="/Carrinho/controllers/logout_controller.php"><span class="material-symbols-outlined">
                                logout
                            </span>Logout</a>
                    <?php
                    else :
                        // O usuário não está logado, exibir botão de login
                    ?>
                        <a href="/Carrinho/views/login.php"><span class="material-symbols-outlined">
                                person
                            </span>Login</a>

                    <?php
                    endif;
                    ?>

                </li>
            </ul>
        </nav>
    </header>
    <main role="main">