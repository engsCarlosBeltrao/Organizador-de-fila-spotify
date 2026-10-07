<?php

include "conexao.php";

$busca = $_GET["busca"] ?? "";
$prioridade = $_GET["prioridade"] ?? "";

$sql = "SELECT * FROM pedidos 
        WHERE (musica LIKE '%$busca%' 
        OR artista LIKE '%$busca%')";

if ($prioridade != "") {
    $sql .= " AND prioridade = '$prioridade'";
}

$resultado = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fila de Músicas</title>
</head>

<body>

    <h1>Fila de Músicas</h1>

    <a href="back-end/cadastrar.php">Cadastrar música</a>
    <form method="GET">

    <input type="text" name="busca">

    <select name="prioridade">
        <option value="">Todas</option>
        <option value="Baixa">Baixa</option>
        <option value="Normal">Normal</option>
        <option value="Alta">Alta</option>
    </select>

    <button type="submit">Pesquisar</button>
    <a href="index.php">Limpar filtros</a>

</form>

    <hr>

    <?php while ($pedido = $resultado->fetch_assoc()) { ?>

        <div>
            <h2><?php echo $pedido["musica"]; ?></h2>

            <p>Artista: <?php echo $pedido["artista"]; ?></p>

            <p>Quem pediu: <?php echo $pedido["solicitante"]; ?></p>

            <p>Prioridade: <?php echo $pedido["prioridade"]; ?></p>

            <a href="back-end/visualizar.php?id=<?php echo $pedido["id"]; ?>">
                Visualizar
            </a>

            <a href="back-end/editar.php?id=<?php echo $pedido["id"]; ?>">
                Editar
            </a>

            <a href="back-end/excluir.php?id=<?php echo $pedido["id"]; ?>">
                Excluir
            </a>
        </div>

        <hr>

    <?php } ?>

</body>
</html>