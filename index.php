<?php
require_once 'config/conexao.php';

$stmt = $pdo->prepare("SELECT * FROM produtos");
$stmt->execute();

$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<section class="container">

    <h2>Produtos em Estoque</h2>

    <div class="cards">

        <?php foreach($produtos as $produto): ?>

            <div class="card">

                <h3><?= ($produto['nome']) ?></h3>

                <p><strong>Fabricante:</strong> <?= ($produto['fabricante']) ?></p>

                <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

                <p><strong>Estoque:</strong> <?= $produto['estoque'] ?></p>

                <div class="acoes">
                    <a class="btn editar" href="editar.php?id=<?= $produto['id'] ?>">Editar</a>

                    <a class="btn excluir"
                       href="excluir.php?id=<?= $produto['id'] ?>"
                       onclick="return confirm('Deseja excluir?')">
                        Excluir
                    </a>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>