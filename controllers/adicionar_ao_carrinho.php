<?php
session_start();

// Verificar se o ID, nome, preço, quantidade e imagem foram fornecidos
if (
    isset($_POST['id_produto']) && isset($_POST['nome_produto']) && isset($_POST['preco']) && isset($_POST['quantidade']) && isset($_POST['imagem_produto'])
) {
        $id_produto = $_POST['id_produto'];
        $nome_produto = $_POST['nome_produto'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $imagem_produto = $_POST['imagem_produto']; // Conteúdo da imagem em base64

        // Decodificar a imagem da base64 para dados binários
        $imagem_binaria = base64_decode($imagem_produto);

        // Criar um array com os detalhes do item, incluindo a imagem binária
        $item = array(
            'id_produto' => $id_produto,
            'nome_produto' => $nome_produto,
            'preco' => $preco,
            'quantidade' => $quantidade,
            'imagem_produto' => $imagem_binaria
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
?>