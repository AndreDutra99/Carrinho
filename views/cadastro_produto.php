<?php
// Iniciar a sessão (caso ainda não tenha sido iniciada)
session_start();

// Verificar se o usuário está logado e possui nível de acesso igual a 2
if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 2) {
    // Se o usuário possui permissão, continuar com o restante do código
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";
?>

<div>
        <form action="/Carrinho/controllers/produto_controller.php" autocomplete="on" method="POST" enctype="multipart/form-data">
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
                
                <button type="submit" id="buttonb" value="inserir" name="acao">Cadastrar</button> 

            </fieldset>
         </form>
</div>

<?php 
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/rodape.php";
} else {
    // Se o usuário não possui permissão, defina um cookie com a mensagem de erro
    setcookie('erro_permissao', 'Você não possui permissão para acessar esta página.', time() + 3600, '/');
    
    // Redirecionar para a página de index.php
    header('Location: /Carrinho/index.php');
    exit();
}
?>