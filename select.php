<?php

require_once 'crud.php';

print '<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cantor</th>
        <th>Estilo</th>
    </tr>';
    $musicas = readAll($pdo, 'musicas', 'id < 28');
foreach($musicas as $musica) {
    echo "<tr>";
    echo "<td>" . $musica['id'] . "</td>";
    echo "<td>" . $musica['nome'] . "</td>";
    echo "<td>" . $musica['cantor'] . "</td>";
    echo "<td>" . $musica['estilo'] . "</td>";
    echo "</tr>";
}

print "</table>";

$musica = read($pdo, 'musicas', 'id = 27');
if ($musica) {
    echo "Música encontrada: " . $musica['nome'] . " por " . $musica['cantor'] . " - " . $musica['estilo'];
} else {
    echo "Música não encontrada.";
}