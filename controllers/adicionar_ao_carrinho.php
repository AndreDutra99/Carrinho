<?php 
session_start();


// Verificar se o ID, nome, preço e quantidade foram fornecidos
if (isset($_POST['id_produto']) && isset($_POST['nome_produto']) && isset($_POST['preco']) && isset($_POST['quantidade'])) {
    $id_produto = $_POST['id_produto'];
    $nome_produto = $_POST['nome_produto'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    // Criar um array com os detalhes do item
    $item = array(
        'id_produto' => $id_produto,
        'nome_produto' => $nome_produto,
        'preco' => $preco,
        'quantidade' => $quantidade
    );

    // Verificar se o carrinho já existe na sessão
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    // Verificar se o produto já está no carrinho
    $produtoExistente = false;
    foreach ($_SESSION['carrinho'] as $indice => $itemCarrinho) {
        if ($itemCarrinho['id_produto'] == $id_produto) {
            // Atualizar a quantidade do produto existente no carrinho
            $_SESSION['carrinho'][$indice]['quantidade'] += $quantidade;
            $produtoExistente = true;
            break;
        }
    }

    // Se o produto não existir no carrinho, adicionar o novo item
    if (!$produtoExistente) {
        $_SESSION['carrinho'][] = $item;
    }

    // Redirecionar de volta para a página de produtos
    header('Location: /Carrinho/views/carrinho.php');
    exit();
} else {
    // Se os dados necessários não foram fornecidos, defina um cookie de erro
    setcookie('erro', 'Os dados necessários não foram fornecidos', time() + 3600, '/');
    header('Location: /Carrinho/views/erro.php');
    exit();

}

