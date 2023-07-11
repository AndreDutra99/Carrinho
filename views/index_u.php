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
    

    <link rel="stylesheet" href="<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="/Carrinho/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/Carrinho/index.php">Home</a></li>
                <li><a href="/Carrinho/views/carrinho.php">Carrinho</a></li>
                <li>
                    <a href="/Carrinho/controllers/logout_controller.php"><span class="material-symbols-outlined">
                        person
                        </span>Logout</a>
                </li>
            </ul>
        </nav>        
    </header>
    <main>



<p>
    carrosel
</p>

<p>
    imagens produtos
</p>




<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>