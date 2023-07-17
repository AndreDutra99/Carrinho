<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
require_once "/Carrinho/db/conexao.php";
try {
    // Conexão com o banco de dados
    $conn = Conexao::conectar();

    // Consulta SQL para obter os produtos
    $sql = "SELECT * FROM produto";
    $stmt = $conn->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>

<h1>Lista de Produtos</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imagem</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto['id_produto']; ?></td>
                <td><?php echo $produto['nome_produto']; ?></td>
                <td>R$ <?php echo $produto['preco']; ?></td>
                <td><img src="<?php echo $produto['imagem_produto']; ?>" alt="Imagem do Produto"></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>