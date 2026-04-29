<?php

require_once 'crud.php';

$novamusica = [
    'nome' => 'Yebba´s Heartbreak',
    'cantor' => 'Drake',
    'estilo' => 'Rap'
];

$idMusicaNova = create($pdo, 'musicas', $novamusica);
echo "Nova música inserida com ID: " . $idMusicaNova;