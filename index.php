<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/db/conexao.php";

try {
    // Conexão com o banco de dados
    $conn = Conexao::conectar();

    // Consulta SQL para obter os produtos disponíveis
    $sql = "SELECT id_produto, nome_produto, preco, imagem_produto FROM produto";
    $stmt = $conn->query($sql);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}

// Verificar se o carrinho está vazio
$carrinhoVazio = true;
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $carrinhoVazio = false;
}
?>

<div class="d-flex justify-content-center m-3">
    <div id="carouselExampleCaptions" class="carousel slide col col-lg-6">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php foreach ($produtos as $index => $produto): ?>
            <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
                <img src="data:image;charset=utf8;base64,<?= base64_encode($produto['imagem_produto']); ?>" class="d-block w-100 imagem-produto" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Roupas Top 1</h5>
                    <p>As melhores roupas do mercado.</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="d-flex justify-content-evenly flex-wrap m-3">
    <?php foreach ($produtos as $produto): ?>
        <div class="card m-3" style="width: 18rem;">
            <img src="data:image;charset=utf8;base64,<?= base64_encode($produto['imagem_produto']); ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <p class="card-text"><?= $produto['nome_produto'] ?></p>
                <p class="card-text"> R$ <?= $produto['preco'] ?></p>
                <form action="/Carrinho/controllers/adicionar_ao_carrinho.php" method="POST">
                    <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">
                    <input type="hidden" name="nome_produto" value="<?= $produto['nome_produto'] ?>">
                    <input type="hidden" name="preco" value="<?= $produto['preco'] ?>">
                    <input type="hidden" name="imagem_produto" value="<?= base64_encode($produto['imagem_produto']); ?>">
                    <input type="hidden" name="quantidade" value="1" min="1">
                    <button type="submit" class="btn btn-primary">Carrinho</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
  
<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>