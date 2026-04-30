<?php
require_once __DIR__ . '/crud.php';

$t = 'musicas';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = $_POST['action'] ?? '';
    try {
        if ($a === 'insert') {
            $nome = trim($_POST['nome'] ?? '');
            $cantor = trim($_POST['cantor'] ?? '');
            $estilo = trim($_POST['estilo'] ?? '');
            if ($nome === '' || $cantor === '' || $estilo === '') {
                header('Location: index.php?err=1');
                exit;
            }
            create($pdo, $t, compact('nome', 'cantor', 'estilo'));
            header('Location: index.php?ok=1');
            exit;
        }
        if ($a === 'update') {
            $id = (int)($_POST['id'] ?? 0);
            $nome = trim($_POST['nome'] ?? '');
            $cantor = trim($_POST['cantor'] ?? '');
            $estilo = trim($_POST['estilo'] ?? '');
            if ($id < 1 || $nome === '' || $cantor === '' || $estilo === '') {
                header('Location: index.php?err=2');
                exit;
            }
            update($pdo, $t, compact('nome', 'cantor', 'estilo'), "id = $id");
            header('Location: index.php?ok=2');
            exit;
        }
        if ($a === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id < 1) {
                header('Location: index.php?err=3');
                exit;
            }
            deleteRow($pdo, $t, "id = $id");
            header('Location: index.php?ok=3');
            exit;
        }
    } catch (Throwable $e) {
        header('Location: index.php?err=' . rawurlencode($e->getMessage()));
        exit;
    }
    header('Location: index.php');
    exit;
}

$musicas = readAll($pdo, $t);

function h($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

$msg = '';
if (isset($_GET['err'])) {
    $msg = is_numeric($_GET['err'])
        ? (['1' => 'Preencha os campos.', '2' => 'Dados inválidos.', '3' => 'ID inválido.'][$_GET['err']] ?? '')
        : (string) $_GET['err'];
} elseif (isset($_GET['ok'])) {
    $msg = ['1' => 'Inserido.', '2' => 'Atualizado.', '3' => 'Excluído.'][$_GET['ok']] ?? '';
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Playlist</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<main class="page">
    <h1>Playlist</h1>
    <?php if ($msg !== '') { ?>
        <p class="msg"><?= h($msg) ?></p>
    <?php } ?>

    <section class="box">
        <h2>Lista</h2>
        <?php if (!$musicas) { ?>
            <p class="muted">Vazio.</p>
        <?php } else { ?>
            <table>
                <tr><th>ID</th><th>Nome</th><th>Cantor</th><th>Estilo</th></tr>
                <?php foreach ($musicas as $m) { ?>
                    <tr>
                        <td><?= h($m['id']) ?></td>
                        <td><?= h($m['nome']) ?></td>
                        <td><?= h($m['cantor']) ?></td>
                        <td><?= h($m['estilo']) ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </section>

    <section class="box">
        <h2>Novo</h2>
        <form method="post">
            <input type="hidden" name="action" value="insert">
            <p><label>Nome <input name="nome" required></label></p>
            <p><label>Cantor <input name="cantor" required></label></p>
            <p><label>Estilo <input name="estilo" required></label></p>
            <p><button type="submit">Inserir</button></p>
        </form>
    </section>

    <section class="box">
        <h2>Editar</h2>
        <form method="post">
            <input type="hidden" name="action" value="update">
            <p><label>ID <input name="id" type="number" min="1" required></label></p>
            <p><label>Nome <input name="nome" required></label></p>
            <p><label>Cantor <input name="cantor" required></label></p>
            <p><label>Estilo <input name="estilo" required></label></p>
            <p><button type="submit">Salvar</button></p>
        </form>
    </section>

    <section class="box">
        <h2>Excluir</h2>
        <form method="post">
            <input type="hidden" name="action" value="delete">
            <p><label>ID <input name="id" type="number" min="1" required></label></p>
            <p><button type="submit" class="del">Excluir</button></p>
        </form>
    </section>
</main>
</body>
</html>
