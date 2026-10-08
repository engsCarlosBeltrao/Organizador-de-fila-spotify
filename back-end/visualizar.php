<?php

include "conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM pedidos WHERE id = $id";
$resultado = $conexao->query($sql);

if ($resultado->num_rows == 0) {
    die("Pedido não encontrado.");
}

$pedido = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Pedido</title>
    <link rel="stylesheet" href="../front-end/css/style.css">
</head>

<body>

    <h1>Pedido Musical</h1>
    <div class = "card">

        <h2><?php echo $pedido["musica"]; ?></h2>
        
        <p>
            <strong>Artista:</strong>
            <?php echo $pedido["artista"]; ?>
        </p>
        
        <p>
            <strong>Quem pediu:</strong>
            <?php echo $pedido["solicitante"]; ?>
        </p>
        
        <p>
            <strong>Prioridade:</strong>
            <?php echo $pedido["prioridade"]; ?>
        </p>
        
    </div>
    <br>

    <a href="index.php" class="botao-voltar"> Voltar para a fila</a>

</body>
</html>