<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="" autocomplete="off" method="POST">
            <fieldset id="loginmod">
                <h1 id="h1style">Login</h1>
                <p class= "fontelogin">Digite os seus dados de acesso nos campos abaixo.</p> 
                <br>
                <div>
                    <input type="mail" class="bordainput meu-input" name="nome" id="nome" placeholder="E-mail" required autofocus>
                </div>
                <br>
                <div>
                    <input type="password" class="bordainput meu-input" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <br>
                <button type="submit" id="buttonb">Acessar</button>
                <br><br>
                <p><a href="esqueci_senha.html" id="linkb">Esqueci minha senha</a></p> 
                <p><a href="/Carrinho/views/cadastro_usuario.php"  id="linkb">Cadastrar</a></p> 
                <br>

            </fieldset>
         </form>
</div>

<?php 
require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
?>