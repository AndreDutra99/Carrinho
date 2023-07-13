<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="produto_controller.php" autocomplete="off" method="POST">
            <fieldset id="loginmod">
                <h1 id="h1style">Cadastrar Produto</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Insira os dados do produto nos campos abaixo.</p> 
                 <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="nome" id="nome" placeholder="Nome do Produto" required>
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="price" class="bordainput meu-input" name="preco" id="preco" placeholder="Senha" required>
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