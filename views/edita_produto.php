<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
require_once '/Carrinho/db/conexao.php';
require_once '/Carrinho/controllers/produto_controller.php';

// Função para obter todos os produtos do banco de dados
function obterProdutos() {
    global $conn;

    try {
        $sql = "SELECT * FROM produto";
        $conn = Conexao::conectar(); 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $produtos;
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao obter produtos: " . $e->getMessage();
        return array();
    }
}

// Verificar se o formulário foi submetido para atualizar ou excluir um produto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o botão de atualizar foi clicado
    if (isset($_POST['atualizar'])) {
        $id_produto = $_POST['id_produto'];
        $nome_produto = $_POST['nome_produto'];
        $preco = $_POST['preco'];
        $imagem_produto = $_POST['imagem_produto'];

        // Chamar a função para atualizar o produto
        if (atualizarProduto($id_produto, $nome_produto, $preco, $imagem_produto)) {
            echo "Produto atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar o produto.";
        }
    }

    // Verificar se o botão de excluir foi clicado
    if (isset($_POST['excluir'])) {
        $id_produto = $_POST['id_produto'];

        // Chamar a função para excluir o produto
        if (excluirProduto($id_produto)) {
            echo "Produto excluído com sucesso.";
        } else {
            echo "Erro ao excluir o produto.";
        }
    }
}

// Obter os produtos do banco de dados
$produtos = obterProdutos();

?>

    <h1>Editar Produtos</h1>

    <?php foreach ($produtos as $produto) { ?>
    <form action="/Carrinho/controllers/produto_controller.php" method="POST">
        <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">

        <label for="nome_produto">Nome do Produto:</label>
        <input type="text" id="nome_produto" name="nome_produto" value="<?php echo $produto['nome_produto']; ?>" required><br>

        <label for="preco">Preço do Produto:</label>
        <input type="text" id="preco" name="preco" value="<?php echo $produto['preco']; ?>" required><br>

        <label for="imagem_produto">Imagem do Produto:</label>
        <input type="text" id="imagem_produto" name="imagem_produto" value="<?php echo $produto['imagem_produto']; ?>"><br>

        <input type="submit" name="atualizar" value="Atualizar">
        <input type="submit" name="excluir" value="Excluir">
    </form>
    <br>
    <?php } ?>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>