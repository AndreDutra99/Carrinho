<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<h1>Ocorreu um erro</h1>
<p><?php echo $_COOKIE['erro']; ?></p>
<a href="/Carrinho/index.php">Voltar para os produtos</a>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>