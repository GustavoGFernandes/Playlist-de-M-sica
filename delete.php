<?php

require_once __DIR__ . '/crud.php';

$t = 'musicas';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    try {
        if ($id < 1) {
            $msg = 'Informe um ID válido.';
        } else {
            $n = deleteRow($pdo, $t, 'id = ' . $id);
            $msg = $n > 0 ? 'Excluído.' : 'Nenhuma linha com esse ID.';
        }
    } catch (Throwable $e) {
        $msg = $e->getMessage();
    }
}

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
    <title>Excluir</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main class="page">
    <h1>Excluir música</h1>
    <?php if ($msg !== '') { ?>
        <p class="msg"><?= hs($msg) ?></p>
    <?php } ?>
    <section class="box">
        <form method="post" action="" onsubmit="return confirm('Excluir este ID?');">
            <p><label>ID <input name="id" type="number" min="1" required value="<?= hs($_POST['id'] ?? '') ?>"></label></p>
            <p><button type="submit" class="del">Excluir</button></p>
        </form>
    </section>
    <p class="muted"><a href="index.php">Painel principal</a></p>
</main>
</body>
</html>
