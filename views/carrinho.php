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
                        <td><?php echo $item['nome_produto']; ?></td>
                        <td><?php echo $item['preco']; ?></td>
                        <td><?php echo $item['quantidade']; ?></td>
                        <td> R$ <?php echo $item['preco'] * $item['quantidade']; ?></td>
                        <td> 
                            <!-- Formulário para adicionar item -->
                            <form action="/Carrinho/controllers/adicionar_ao_carrinho.php" method="post">
                                <input type="hidden" name="id_produto" value="<?php echo $item['id_produto']; ?>">
                                <input type="hidden" name="nome_produto" value="<?php echo $item['nome_produto']; ?>">
                                <input type="hidden" name="preco" value="<?php echo $item['preco']; ?>">
                                <button type="submit" class="link-sem-barra">Adicionar</button>
                            </form>
                        </td>
                        <td>
                            <!-- Formulário para remover item -->
                            <form action="/Carrinho/controllers/remover_item.php" method="post">
                                <input type="hidden" name="nome_produto" value="<?php echo $item['nome_produto']; ?>">
                                <button type="submit" class="link-sem-barra">Remover</button>
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
                        <button>
                            <a href="checkout.php" class="link-sem-barra">Finalizar Compra</a>
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