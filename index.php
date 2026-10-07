<?php

include "conexao.php";

$sql = "SELECT * FROM pedidos";
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

    <a href="cadastrar.php">Cadastrar música</a>

    <hr>

    <?php while ($pedido = $resultado->fetch_assoc()) { ?>

        <div>
            <h2><?php echo $pedido["musica"]; ?></h2>

            <p>Artista: <?php echo $pedido["artista"]; ?></p>

            <p>Quem pediu: <?php echo $pedido["solicitante"]; ?></p>

            <p>Prioridade: <?php echo $pedido["prioridade"]; ?></p>

            <a href="visualizar.php?id=<?php echo $pedido["id"]; ?>">
                Visualizar
            </a>

            <a href="editar.php?id=<?php echo $pedido["id"]; ?>">
                Editar
            </a>

            <a href="excluir.php?id=<?php echo $pedido["id"]; ?>">
                Excluir
            </a>
        </div>

        <hr>

    <?php } ?>

</body>
</html>