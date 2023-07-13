<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="produto_controller.php" autocomplete="off" method="POST">
            <fieldset id="loginmod">
                <h1 id="h1style">Cadastrar Produto</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Insira os dados do produto nos campos abaixo.</p> 
                 <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="username" id="username" placeholder="Nome do Produto" required>
                </div>
                <div style="margin-bottom: 10px;">
                    <label for="imagem">Selecione uma imagem:</label>
                    <input type="file" name="imagem" id="imagem">
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="password" class="bordainput meu-input" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <button type="submit" id="buttonb">Cadastrar</button> 

            </fieldset>
         </form>
</div>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>