<?php

require_once 'crud.php';

$idMusica = 28;

$dadosAtualizados = [
    'nome' => 'Magia Negra for Dummies',
    'cantor' => 'Leticia',
    'estilo' => 'Rap'
];

$linhasAfetadas = update($pdo, 'musicas', $dadosAtualizados, "id = $idLivro");

if ($linhasAfetadas > 0) {
    echo "Música atualizada com sucesso. Linhas afetadas: " . $linhasAfetadas;
} else {
    echo "Nenhuma música encontrada para atualizar.";
}