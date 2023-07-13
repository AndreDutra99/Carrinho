<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="pessoa_controller.php" autocomplete="off" method="POST">
            <fieldset id="loginmod">
                <h1 id="h1style">Cadastre-se</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Preencha os campos abaixo.</p> 
                <div style="margin-bottom: 10px;">
                    <input type="mail" class="bordainput meu-input" name="email" id="email" placeholder="E-mail" required autofocus>
                </div>
                 <div style="margin-bottom: 10px;">
                    <input type="text" class="bordainput meu-input" name="username" id="username" placeholder="Nome de usuário" required>
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