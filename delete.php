<?php

require_once 'crud.php';

$idMusicaNova = 28;

$deleted = delete($pdo, 'musicas', "id = $idMusicaNova");

if ($deleted) {
    echo "Música excluída com sucesso.";
} else {
    echo "Nenhuma música encontrada para excluir.";
}