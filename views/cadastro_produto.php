<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="/Carrinho/controllers/produto_controller.php" autocomplete="on" method="POST">
            <fieldset id="loginmod">
                <h1>Cadastrar Produto</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Insira os dados do produto nos campos abaixo.</p> 
                 <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="nome_produto" id="nome_produto" placeholder="Nome do Produto" required>
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="preco" id="preco" placeholder="Preço do Produto" required>
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="imagem">Selecione uma imagem:</label>
                    <input type="file" name="imagem_produto" id="imagem_produto">
                </div>
                
                <button type="submit" id="buttonb">Cadastrar</button> 

            </fieldset>
         </form>
</div>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>