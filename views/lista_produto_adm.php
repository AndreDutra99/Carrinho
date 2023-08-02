<?php
// Iniciar a sessão (caso ainda não tenha sido iniciada)
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/Carrinho/db/conexao.php';
// Função para obter todos os produtos do banco de dados
function obterProdutos() {
    global $conn;

    try {
        $sql = "SELECT * FROM produto";
        $conn = Conexao::conectar(); 
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $produtos;
    } catch (PDOException $e) {
        // Tratar erros de consulta
        echo "Erro ao obter produtos: " . $e->getMessage();
        return array();
    }
}

// Obter os produtos do banco de dados
$produtos = obterProdutos();

// Verificar se o usuário está logado e possui nível de acesso igual a 2
if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] == 2) {
    // Se o usuário possui permissão, continuar com o restante do código
    require_once $_SERVER["DOCUMENT_ROOT"] . "/Carrinho/templates/cabecalho.php";




?>
  
  <div class="table-container">
    <h1 style="text-align:center">Tabela de Produtos</h1>
    <table class="st">
        <thead>
            <tr>
                <th class="bordastyle">Produto</th>
                <th class="bordastyle">Nome</th>
                <th class="bordastyle">Preço</th>
                <th class="bordastyle">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto) { ?>
                <tr>
                    <td class="bordastyle"><img class="tamimg" src="data:image;charset=utf8;base64,<?php echo base64_encode($produto['imagem_produto']); ?>" alt="Imagem do Produto"></td>
                    <td class="bordastyle"><?php echo $produto['nome_produto']; ?></td>
                    <td class="bordastyle"> R$ <?php echo $produto['preco']; ?></td>
                    <td class="bordastyle">
                        <form action="/Carrinho/controllers/produto_controller.php" method="POST">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                            <!-- Adicione o ID do produto na URL do botão "Editar" -->
                            <a href="/Carrinho/views/edita_produto.php?id_produto=<?php echo $produto['id_produto']; ?>" class="link-sem-barra">
                                <button type="button" id="buttonmod">Editar</button>
                            </a>
                            
                            <button type="submit" id="buttonmod" name="acao" value="excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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