<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="/Carrinho/controllers/login_controller.php" autocomplete="on" method="POST">
            <fieldset id="loginmod">
                <h1 id="h1style">Login</h1>
                <p class= "fontelogin" style="margin-bottom: 10px;">Digite os seus dados de acesso nos campos abaixo.</p> 
                <div style="margin-bottom: 10px;">
                    <input type="mail" class="bordainput meu-input" name="email" id="email" placeholder="E-mail" required autofocus>
                </div>
                <div style="margin-bottom: 10px;">
                    <input type="password" class="bordainput meu-input" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <button type="submit" id="buttonb">Acessar</button>
                <p  style="margin-top: 5px;"><a href="/Carrinho/views/cadastro_usuario.php"  id="linkb">Cadastrar</a></p> 

            </fieldset>
         </form>
</div>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>