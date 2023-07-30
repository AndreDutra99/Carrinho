<?php
session_start();

// Verificar se o nome do item foi fornecido e não é vazio
if (isset($_POST['nome_produto']) && $_POST['nome_produto'] !== '') {
    $nome_produto = $_POST['nome_produto'];

    // Verificar se o carrinho existe na sessão
    if (isset($_SESSION['carrinho'])) {
        // Percorrer o carrinho e verificar se o item corresponde ao nome fornecido
        foreach ($_SESSION['carrinho'] as $indice => $item) {
            if ($item['nome_produto'] == $nome_produto) {
                // Aumentar a quantidade do item em 1
                $_SESSION['carrinho'][$indice]['quantidade'] += 1;
                break;
            }
        }
    }

    // Redirecionar de volta para a página do carrinho
    header('Location: /Carrinho/views/carrinho.php');
    exit();
} else {
    // Se o nome do produto não foi fornecido ou está vazio, defina um cookie de erro
    setcookie('erro', 'O nome do produto não foi fornecido', time() + 3600, '/');
    header('Location: /Carrinho/views/erro.php');
    exit();
}
?>
