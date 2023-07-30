<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";


function calcularTotalCarrinho()
{
    $total = 0;

    if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $item) {
            $subtotal = $item['preco'] * $item['quantidade'];
            $total += $subtotal;
        }
    }

    return $total;
}
?>

<div>
    <h1>Carrinho de Compras</h1>
    <?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
        <table class="st">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Adicionar item</th>
                    <th>Remover item</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['carrinho'] as $item): ?>
                    <tr>
                        <td class="bordastyle"><img class="tamimg" src="data:image;charset=utf8;base64,<?php echo base64_encode($item['imagem_produto']); ?>" alt="..."></td>
                        <td><?php echo $item['nome_produto']; ?></td>
                        <td><?php echo $item['preco']; ?></td>
                        <td><?php echo $item['quantidade']; ?></td>
                        <td> R$ <?php echo $item['preco'] * $item['quantidade']; ?></td>
                        <td> 
                            <!-- Formulário para adicionar item -->
                            <form action="/Carrinho/controllers/atualizar_quantidade.php" method="post">
                                <input type="hidden" name="nome_produto" value="<?php echo $item['nome_produto']; ?>">
                                <button type="submit" id="buttonmod" class="link-sem-barra">Adicionar</button>
                            </form>
                        </td>
                        <td>
                            <!-- Formulário para remover item -->
                            <form action="/Carrinho/controllers/remover_item.php" method="post">
                                <input type="hidden" name="nome_produto" value="<?php echo $item['nome_produto']; ?>">
                                <button type="submit" id="buttonmod" class="link-sem-barra">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Total do Carrinho:</th>
                    <th>R$ <?php echo calcularTotalCarrinho(); ?></th>
                </tr>
                <tr>
                    <td colspan="6">
                        <button id="buttonmod2">
                            <a href="checkout.php" style="color: white;" class="link-sem-barra">Finalizar Compra</a>
                        </button>
                    </td>  
                </tr>
            </tfoot>
        </table>
    
        <?php else: ?>
        <p>O carrinho está vazio.</p>
    <?php endif; ?>
</div>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>