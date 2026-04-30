<?php

require_once __DIR__ . '/crud.php';

$t = 'musicas';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $cantor = trim($_POST['cantor'] ?? '');
    $estilo = trim($_POST['estilo'] ?? '');
    try {
        if ($id < 1 || $nome === '' || $cantor === '' || $estilo === '') {
            $msg = 'Informe um ID válido e preencha todos os campos.';
        } else {
            $linhas = update($pdo, $t, compact('nome', 'cantor', 'estilo'), 'id = ' . $id);
            $msg = $linhas > 0 ? 'Atualizado (' . $linhas . ' linha(s)).' : 'Nenhuma linha com esse ID.';
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
    <title>Atualizar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main class="page">
    <h1>Atualizar música</h1>
    <?php if ($msg !== '') { ?>
        <p class="msg"><?= hs($msg) ?></p>
    <?php } ?>
    <section class="box">
        <form method="post" action="">
            <p><label>ID <input name="id" type="number" min="1" required value="<?= hs($_POST['id'] ?? '') ?>"></label></p>
            <p><label>Nome <input name="nome" required value="<?= hs($_POST['nome'] ?? '') ?>"></label></p>
            <p><label>Cantor <input name="cantor" required value="<?= hs($_POST['cantor'] ?? '') ?>"></label></p>
            <p><label>Estilo <input name="estilo" required value="<?= hs($_POST['estilo'] ?? '') ?>"></label></p>
            <p><button type="submit">Salvar</button></p>
        </form>
    </section>
    <p class="muted"><a href="index.php">Painel principal</a></p>
</main>
</body>
</html>
