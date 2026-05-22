<?php

require_once 'config/conexao.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = :id";
$comando = $pdo->prepare($sql);

$comando->execute([
    ':id' => $id
]);

$produto = $comando->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $fabricante = $_POST['fabricante'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $update = "UPDATE produtos
               SET nome = :nome,
                   fabricante = :fabricante,
                   preco = :preco,
                   estoque = :estoque
               WHERE id = :id";

    $comando = $pdo->prepare($update);

    $comando->execute([
        ':nome' => $nome,
        ':fabricante' => $fabricante,
        ':preco' => $preco,
        ':estoque' => $estoque,
        ':id' => $id
    ]);

    header("Location: index.php");
    exit;
}

require_once 'includes/header.php';
?>

<section class="container">

    <h2>Editar Produto</h2>

    <form method="POST">

        <input type="text"
               name="nome"
               value="<?= ($produto['nome']) ?>"
               required>

        <input type="text"
               name="fabricante"
               value="<?= ($produto['fabricante']) ?>"
               required>

        <input type="number"
               step="0.01"
               name="preco"
               value="<?= $produto['preco'] ?>"
               required>

        <input type="number"
               name="estoque"
               value="<?= $produto['estoque'] ?>"
               required>

        <button type="submit">Salvar Alterações</button>

    </form>

</section>

<?php require_once 'includes/footer.php'; ?>