<?php
session_start();

// Verificar se o nome do item foi fornecido
if (isset($_POST['nome_produto'])) {
    $nome_produto = $_POST['nome_produto'];

    // Verificar se o carrinho existe na sessão
    if (isset($_SESSION['carrinho'])) {
        // Percorrer o carrinho e remover o item correspondente ao nome fornecido
        foreach ($_SESSION['carrinho'] as $indice => $item) {
            if ($item['nome_produto'] == $nome_produto) {
                unset($_SESSION['carrinho'][$indice]);
                break;
            }
        }

        // Redefinir as chaves do array do carrinho
        $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    }

    // Redirecionar de volta para a página do carrinho
    header('Location: /Carrinho/index.php');
    exit();
} else {
    // Se os dados necessários não forem fornecidos, defina um cookie de erro
    if (!isset($_POST['id_produto']) || !isset($_POST['nome_produto']) || !isset($_POST['preco']) || !isset($_POST['quantidade'])) {
        setcookie('erro', 'Os dados necessários não foram fornecidos', time() + 3600, '/');
        header('Location: /Carrinho/views/erro.php');
        exit();
    }
}
?>
