<?php

require_once 'config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO produtos
            (nome, fabricante, preco, estoque)
            VALUES
            (:nome, :fabricante, :preco, :estoque)";

    $comando = $pdo->prepare($sql);

    $comando->execute([
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':preco' => $preco,
        ':estoque' => $estoque
    ]);

    header("Location: index.php");
    exit;
}

require_once 'includes/header.php';
?>

<section class="container">

    <h2>Cadastrar Produto</h2>

    <form method="POST">

        <input type="text" name="nome" placeholder="Nome do Produto" required>

        <input type="text" name="fabricante" placeholder="Fabricante" required>

        <input type="number" step="0.01" name="preco" placeholder="Preço" required>

        <input type="number" name="estoque" placeholder="Quantidade em Estoque" required>

        <button type="submit">Cadastrar</button>

    </form>

</section>

<?php require_once 'includes/footer.php'; ?>