<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";

session_start();

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
<!--
/* // Verificar se o carrinho está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>O carrinho está vazio.</p>";
} else {
    // Exibir os itens do carrinho
    echo "<h1>Itens do Carrinho</h1>";

    foreach ($_SESSION['carrinho'] as $item) {
        $nome_produto = $item['nome_produto'];
        $preco = $item['preco'];
        $quantidade = $item['quantidade'];

        echo "<div>";
        echo "<p><strong>Nome:</strong> $nome_produto</p>";
        echo "<p><strong>Preço:</strong> R$ $preco</p>";
        echo "<p><strong>Quantidade:</strong> $quantidade</p>";

        // Opção para atualizar a quantidade do item
        echo "<form method='POST' action='/Carrinho/controllers/atualizar_quantidade.php'>";
        echo "<input type='hidden' name='nome_produto' value='$nome_produto'>";
        echo "<input type='number' name='quantidade' value='$quantidade'>";
        echo "<input type='submit' value='Atualizar'>";
        echo "</form>";

        // Opção para remover o item do carrinho
        echo "<form method='POST' action='/Carrinho/controllers/remover_item.php'>";
        echo "<input type='hidden' name='nome_produto' value='$nome_produto'>";
        echo "<input type='submit' value='Remover'>";
        echo "</form>";

        echo "</div>";
    }
}
?>
 */-->
<h1>Carrinho de Compras</h1>

<?php if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])): ?>
    <table>
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
                    <td><?php echo $item['preco'] * $item['quantidade']; ?></td>
                    <td><a href="/Carrinho/controllers/atualizar_quantidade.php"  id="linkb">Adicionar</a></td>
                    <td><a href="/Carrinho/controllers/remover_item.php"  id="linkb">Remover</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total do Carrinho: <?php echo calcularTotalCarrinho(); ?></p>

    <a href="checkout.php">Finalizar Compra</a>
<?php else: ?>
    <p>O carrinho está vazio.</p>
<?php endif; ?>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>