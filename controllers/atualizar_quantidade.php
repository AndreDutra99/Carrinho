<?php
session_start();

// Verificar se o nome e a quantidade foram fornecidos
if (isset($_POST['nome_produto']) && isset($_POST['quantidade'])) {
    $nome_produto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];

    // Verificar se o carrinho existe na sessão
    if (isset($_SESSION['carrinho'])) {
        // Percorrer o carrinho e atualizar a quantidade do item correspondente
        foreach ($_SESSION['carrinho'] as &$item) {
            if ($item['nome_produto'] == $nome_produto) {
                $item['quantidade'] = $quantidade;
                break;
            }
        }
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
