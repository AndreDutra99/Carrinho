<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <?php if (isset($_COOKIE['sucesso'])) : ?>
            <p><?= $_COOKIE['sucesso'] ?></p>
            <?php setcookie('sucesso', '', time() - 3600, '/') ?>
        <?php endif; ?>
        <form action="/Carrinho/controllers/pessoa_controller.php" autocomplete="on" method="POST">
            <fieldset id="loginmod">
                
                <h1 id="h1style">Cadastre-se</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Preencha os campos abaixo.</p> 
                <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="nome" id="nome" placeholder="Nome de usuário">
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="mail" class="bordainput meu-input" name="email" id="email" placeholder="E-mail" required >
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