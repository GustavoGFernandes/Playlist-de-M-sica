<?php

require_once __DIR__ . '/crud.php';

$t = 'musicas';
$musicas = readAll($pdo, $t);
$umId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$musicaUm = ($umId > 0) ? read($pdo, $t, 'id = ' . $umId) : null;

function hs($v)
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main class="page">
    <h1>Listar músicas</h1>
    <section class="box">
        <h2>Filtro por ID (opcional)</h2>
        <form method="get" action="">
            <p><label>ID <input name="id" type="number" min="1" value="<?= $umId > 0 ? $umId : '' ?>"></label></p>
            <p><button type="submit">Buscar</button> <a href="select.php" style="margin-left:0.5rem;color:#4c6ef5;">Limpar</a></p>
        </form>
        <?php if ($umId > 0 && $musicaUm) { ?>
            <p class="msg"><?= hs($musicaUm['nome']) ?> — <?= hs($musicaUm['cantor']) ?> (<?= hs($musicaUm['estilo']) ?>)</p>
        <?php } elseif ($umId > 0) { ?>
            <p class="muted">Nenhuma música com esse ID.</p>
        <?php } ?>
    </section>
    <section class="box">
        <h2>Todas</h2>
        <?php if (!$musicas) { ?>
            <p class="muted">Vazio.</p>
        <?php } else { ?>
            <table>
                <tr><th>ID</th><th>Nome</th><th>Cantor</th><th>Estilo</th></tr>
                <?php foreach ($musicas as $m) { ?>
                    <tr>
                        <td><?= hs($m['id']) ?></td>
                        <td><?= hs($m['nome']) ?></td>
                        <td><?= hs($m['cantor']) ?></td>
                        <td><?= hs($m['estilo']) ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </section>
    <p class="muted"><a href="index.php">Painel principal</a></p>
</main>
</body>
</html>
